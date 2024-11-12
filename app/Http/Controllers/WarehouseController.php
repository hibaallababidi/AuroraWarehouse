<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Keeper;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class WarehouseController extends Controller
{
    public function warehouse_details($warehouse_id)
    {
        $keeper = Keeper::where('warehouse_id',$warehouse_id)
            ->where('is_active',true)->first();
        if(isset($keeper))
        {
            $keeper_exists = true;
            $warehouse = DB::table('warehouses')
                ->join('managers', 'warehouses.manager_id', '=', 'managers.id')
                ->join('locations', 'warehouses.location_id', '=', 'locations.id')
                ->join('cities', 'locations.city_id', '=', 'cities.id')
                ->join('keepers', 'warehouses.id', '=', 'keepers.warehouse_id')
                ->where('keepers.is_active', '1')
                ->where('warehouses.id', $warehouse_id)
                ->get([
                    'warehouse_name', 'managers.name AS manager', 'city_name AS city',
                    'location_name AS location', 'keepers.name AS keeper_name', 'keepers.email AS keeper_email',
                    'keepers.phone_number AS keeper_phone'
                ])->first();
            $warehouse = json_decode(json_encode($warehouse), true);
        }
        else
        {
            $keeper_exists = false;
            $warehouse = DB::table('warehouses')
                ->join('managers', 'warehouses.manager_id', '=', 'managers.id')
                ->join('locations', 'warehouses.location_id', '=', 'locations.id')
                ->join('cities', 'locations.city_id', '=', 'cities.id')
                //->where('keepers.is_active', '1')
                ->where('warehouses.id', $warehouse_id)
                ->get([
                    'warehouse_name', 'managers.name AS manager', 'city_name AS city',
                    'location_name AS location'
                ])->first();
            $warehouse = json_decode(json_encode($warehouse), true);
            if (empty($warehouse))
                return response()->json([],404);
            $warehouse['keeper_name']=null;
            $warehouse['keeper_email']=null;
            $warehouse['keeper_phone'] = null;
        }
        if (sizeof($warehouse)==0)
            return response()->json([]);

        $departments = Department::where('warehouse_id', $warehouse_id)
            ->pluck('department_name');

        $warehouse['keeper_exists']=$keeper_exists;
        $warehouse['departments'] = $departments;
        return response($warehouse);
    }

    public function add_warehouse(Request $request)
    {
        $input = [
            'warehouse_name' => 'required|string|max:20',
            'location_id' => 'required|integer|exists:locations,id',
            'department_name' => 'array',
        ];
        $validate = Validator::make($request->all(), $input);
        if ($validate->fails())
            return response()->json($validate->errors(), 400);
        $user = JWTAuth::user();
        $warehouse = Warehouse::create([
            'warehouse_name' => $request->warehouse_name,
            'location_id' => $request->location_id,
            'manager_id' => $user->id
        ]);
        $h2 = $warehouse->id;
        $hs = $request->department_name;
        if (empty($hs)) {
            Department::create([
                'department_name' => 'basic',
                'warehouse_id' => $h2,
            ]);
        } else
            foreach ($hs as $h) {
                Department::create([
                    'department_name' => $h,
                    'warehouse_id' => $h2,
                ]);
            }
        return response()->json([
            'warehouse_id'=>$h2,
            'warehouse_name'=>$warehouse->warehouse_name,
            'location_id'=>$warehouse->location_id,
            'manager_id'=>$warehouse->manager_id,
            'departments'=>$hs,
        ], 201);
    }

    public function manager_warehouses()
    {
        $user = JWTAuth::user();
        $warehouses = DB::table('warehouses')
            ->join('locations', 'warehouses.location_id', '=', 'locations.id')
            ->join('cities', 'locations.city_id', '=', 'cities.id')

            ->where('manager_id', $user->id)
            ->get(['warehouses.id AS warehouse_id','cities.city_name','locations.location_name', 'warehouses.warehouse_name']);
        return $warehouses;

    }


}
