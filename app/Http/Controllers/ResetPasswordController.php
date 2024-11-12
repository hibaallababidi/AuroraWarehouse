<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\ForgotPassword;
use App\Models\Keeper;
use App\Models\Manager;
use App\Notifications\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ResetPasswordController extends Controller
{
    public function reset_password(Request $request){
        $validator = Validator::make($request->all(),[
           'is_manager'=>'required|bool',
           'password'=>'required|string',
           'new_password'=> 'required|string|confirmed'
        ]);
        if($validator->fails())
            return response()->json($validator->errors(),400);
        $user = JWTAuth::user();
        if($request->is_manager){
            $manager = Manager::find($user->id);
            if(Hash::check($request->password, $manager->password)){
                $manager->update(['password'=>bcrypt($request->new_password)]);
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
            return response()->json([
                'message' => 'password is not correct !',
            ], 401);
        }
        $keeper = Keeper::find($user->id);
        if($request->password == Crypt::decrypt($keeper->password)){
            $keeper->update(['password'=>Crypt::encrypt($request->new_password)]);
            $token = JWTAuth::fromUser($keeper);
            return response()->json([
                'user_id' => $keeper->id,
                'name' => $keeper->name,
                'phone_number' => $keeper->phone_number,
                'warehouse_id' => $keeper->warehouse_id,
                'token' => $token,
                'is_manager' => false
            ], 200);
        }
        return response()->json([
            'message' => 'password is not correct !',
        ], 401);
    }
}
