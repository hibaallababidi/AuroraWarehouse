<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\ForgotPassword;
use App\Models\Keeper;
use App\Models\Manager;
use App\Notifications\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $email = $request->email;
        $user = null;
        if (null != Keeper::firstWhere('email', $email)) {
            $user = Keeper::firstWhere('email', $email);
            $this->send_reset_password_code($user, false);
            $warehouse_id = $user->warehouse_id;
            $is_manager = false;
        } else if (null != Manager::firstWhere('email', $email)) {
            $user = Manager::firstWhere('email', $email);
            $this->send_reset_password_code($user, true);
            $warehouse_id = 0;
            $is_manager = true;
        } else
            return response()->json([
                'message' => 'you need to register first !'
            ], 404);

        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'warehouse_id' => $warehouse_id,
            'is_manager' => $is_manager
        ], 201);
    }

    public function send_reset_password_code($user, $is_manager)
    {
        $code = mt_rand(100000, 999999);
        $details = [
            'title' => 'Hello',
            'message' => 'Your password reset code',
            'code' => $code
        ];
        Notification::route('mail', $user->email)
            ->notify(new EmailVerification($details));
        if ($is_manager)
            ForgotPassword::create([
                'is_manager' => $is_manager,
                'manager_id' => $user->id,
                'verification_code' => $code
            ]);

        else
            ForgotPassword::create([
                'is_manager' => $is_manager,
                'keeper_id' => $user->id,
                'verification_code' => $code
            ]);
    }

    public function check_forgot_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|int|exists:forgot_passwords,verification_code'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $forgot_password = ForgotPassword::firstWhere('verification_code', $request->code);

        if ($forgot_password->isExpire())
            return response()->json([
                'message' => 'password reset code is expired'
            ], 401);

        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function forgot_password_reset(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required|int|exists:forgot_passwords,verification_code',
            'password' => 'required|string|confirmed|min:8'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $forgot_password = ForgotPassword::firstWhere('verification_code', $request->code);
        $is_manager = $forgot_password->is_manager;
        if ($is_manager) {
            $is_manager = true;
            //DB::table('managers')->where('id',$forgot_password->manager_id)
            $user = Manager::find($forgot_password->manager_id);
            $user->update(['password' => bcrypt($request->password)]);
            $forgot_password->delete();
            $user = $user->makeVisible('password');
            $token = JWTAuth::fromUser($user);
            $warehouse_id = 0;
        } else {
            $is_manager = false;
            $user = Keeper::find($forgot_password->keeper_id);
            $user->update(['password' => Crypt::encrypt($request->password)]);
            $forgot_password->delete();
            $user = $user->makeVisible('password');
            $token = JWTAuth::fromUser($user);
            $warehouse_id = $user->warehouse_id;
        }
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'warehouse_id' => $warehouse_id,
            'is_manager' => $is_manager,
            'token' => $token
        ], 200);

    }
}
