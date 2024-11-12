<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Keeper;
use App\Notifications\KeeperAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Swift_SwiftException;

class CreateKeeperAccountController extends Controller
{
    public function create_account(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $keeper = Keeper::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number'=>$request->phone_number,
            'password' => Crypt::encrypt($request->password),
            'warehouse_id' => $request->warehouse_id,
            'in_date'=>Carbon::now()
        ]);
        return $this->send_info($keeper);
    }

    public function send_info($keeper)
    {
        $name=$keeper->name;
        $email=$keeper->email;
        $password=Crypt::decrypt($keeper->password);
        $details = [
            'title' => 'Hello',
            'message' => 'Your Account Info',
            'name' => 'Name: '.$name,
            'email' => 'Email: '.$email,
            'password' => 'Password: '.$password
        ];

        try {
            Notification::route('mail', $email)
                ->notify(new KeeperAccount($details));
        } catch (Swift_SwiftException $exception) {
            Keeper::find($keeper->id)->delete();
            return response()->json([
                'message' => 'email does not exist'
            ], 400);
        }

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    public function change_keeper(Request $request){
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        DB::table('keepers')
            ->where('warehouse_id',$request->warehouse_id)
            ->update([
                'is_active'=> 0
            ]);
        $keeper = Keeper::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number'=>$request->phone_number,
            'password' => Crypt::encrypt($request->password),
            'warehouse_id'=>$request->warehouse_id,
            'in_date'=>Carbon::now()
        ]);
        return $this->send_info($keeper);
    }

    public function rules(){
        $rules = [
            'warehouse_id'=>'required|integer|exists:warehouses,id',
            'name' => 'required|string|between:2,30',
            'email' => 'required|string|max:30',
            'phone_number'=>'required|string|min:10',
            'password' => 'required|string|confirmed|min:8'
        ];
        return $rules;
    }
}
