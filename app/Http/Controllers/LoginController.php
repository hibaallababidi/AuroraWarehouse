<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Keeper;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $email = $request->email;
        if (null != Keeper::firstWhere('email', $email)) {
            $keeper = Keeper::firstWhere('email', $email);
            return $this->KeeperLogin($keeper, $request);
        }
        if (null != Manager::firstWhere('email', $email)) {
            $manager = Manager::firstWhere('email', $email);
            return $this->ManagerLogin($manager, $request);
        }

        return response()->json([
            'message' => 'you need to register first !'
        ], 404);

        //if (filter_var($request->text, FILTER_VALIDATE_EMAIL)){}
        // if (Keeper::where('name', '=', $request->text)->exists()){
        //     $user = Keeper::firstWhere('name', $request->text);
        //     return $this->KeeperLogin($user,$request);
        // }
        // if (Manager::where('name', '=', $request->text)->exists()){
        //     $manager = Manager::firstWhere('name', $request->text);
        //     return $this->ManagerLogin($manager,$request);
        // }

    }

    public function KeeperLogin(Keeper $keeper, Request $request)
    {
        Config::set('jwt.user', 'App\Models\Keeper');
        Config::set('auth.providers.users.model', Keeper::class);
        if ($keeper->is_active) {
            $password=Crypt::decrypt($keeper->password);
            if ($password==$request->password) {
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
        $keeper->delete();
        return response()->json([
            'message' => 'you need to register first !'
        ], 404);
    }

    public function ManagerLogin(Manager $manager, Request $request)
    {
        Config::set('jwt.user', 'App\Models\Manager');
        Config::set('auth.providers.users.model', Manager::class);
        if ($manager->is_activated)
        {
            if (Hash::check($request->password, $manager->password)) {
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
        $manager->delete();
        return response()->json([
            'message' => 'you need to register first !'
        ], 404);
    }
}
