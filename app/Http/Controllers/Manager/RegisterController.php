<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\Keeper;
use App\Models\Manager;
use App\Models\ManagerVerification;
use App\Notifications\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Swift_SwiftException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,30',
            'email' => 'required|email|max:30',
            'password' => 'required|string|confirmed|min:8'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $manager = Manager::firstWhere('email', $request->email);
        if (isset($manager) && !$manager->is_activated) {
            ManagerVerification::firstWhere('manager_id',$manager->id)->delete();
            $manager->delete();
            return response()->json([], 401);
        } elseif (isset($manager) && $manager->is_activated)
            return response()->json([], 400);

        $manager = Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->send_verification_code($manager);
    }


    public function send_verification_code($manager)
    {
        $manager_id = $manager->id;
        $email = $manager->email;
        $code = mt_rand(100000, 999999);
        $details = [
            'title' => 'Hello',
            'message' => 'Your Verification code',
            'code' => $code
        ];

        try {
            Notification::route('mail', $email)
                ->notify(new EmailVerification($details));
        } catch (Swift_SwiftException $exception) {
            Manager::find($manager_id)->delete();
            return response()->json([
                'message' => 'email does not exist'
            ], 404);
        }
        ManagerVerification::create([
            'manager_id' => $manager_id,
            'verification_code' => $code
        ]);

        return response()->json([
            'user_id' => $manager->id,
            'name' => $manager->name,
            'phone_number' => $manager->phone_number,
            'warehouse_id' => 0,
            'is_manager' => true
        ], 201);
    }


    public function Resend_verification_code(Request $request)
    {
        $code = mt_rand(100000, 999999);
        $details = [
            'title' => 'Hello',
            'message' => 'Your Verification code',
            'code' => $code
        ];
        if($request->is_manager){
            $user = Manager::firstWhere('id',$request->user_id);
            Notification::send($user, new EmailVerification($details));
            if($request->is_register)
                ManagerVerification::where('manager_id', $user->id)->update(['verification_code' => $code]);
            else
                ForgotPassword::where('manager_id', $user->id)->update(['verification_code' => $code]);
            $is_manager = true;
            $warehouse_id = 0;
        }
        else{
            $user = Keeper::firstWhere('id',$request->user_id);
            Notification::send($user, new EmailVerification($details));
            ForgotPassword::where('keeper_id', $user->id)->update(['verification_code' => $code]);
            $is_manager = true;
            $warehouse_id = 0;
        }

        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'warehouse_id' => $warehouse_id,
            'is_manager' => $is_manager
        ], 201);
    }


    public function verify_manager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|int|exists:manager_verifications,verification_code'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $manager_verification = ManagerVerification::firstWhere('verification_code', $request->code);
        if ($manager_verification->isExpire())
            return response()->json([
                'message' => 'this verification code has expired'
            ], 401);
        $id = $manager_verification->manager_id;
        $manager_verification->delete();
        $manager = Manager::find($id)
            ->makeVisible(['password']);
        DB::table('managers')
            ->where('id', $id)
            ->update(['is_activated' => 1, 'email_verified_at' => Carbon::now()]);
        $token = JWTAuth::fromUser($manager);

        return response()->json([
            'user_id' => $manager->id,
            'name' => $manager->name,
            'phone_number' => $manager->phone_number,
            'warehouse_id' => 0,
            'token' => $token,
            'is_manager' => true
        ], 200);
    }

}
