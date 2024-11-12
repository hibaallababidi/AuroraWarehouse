<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function add_client(Request $request)
    {
        $input = [
            'name' => 'required|string|max:20',
            'location_id' => 'required|integer|exists:locations,id',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'phone_number' => 'required|string|max:20',
            'is_company' => 'required|boolean',
        ];
        $validate = Validator::make($request->all(), $input);
        if ($validate->fails())
            return response()->json($validate->errors(), 400);

        $client = Client::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'is_company' => $request->is_company,
            'warehouse_id' => $request->warehouse_id,
            'location_id' => $request->location_id,
        ]);
        return response()->json([
            'client name' => $client->name,
            'client phone_number' => $client->phone_number,
            'is_company' => $client->is_company,
            'warehouse_id' => $client->warehouse_id,
            'location_id' => $client->location_id,

        ], 201);
    }

    public function updated_client($client_id, Request $request)
    {
        $input = [
            'name' => 'required|string|max:20',
            'location_id' => 'required|integer|exists:locations,id',
            'phone_number' => 'required|string|max:20',
            'is_company' => 'required|boolean',
        ];
        $validate = Validator::make($request->all(), $input);

        if ($validate->fails())
            return response()->json($validate->errors(), 400);
        $name = $request->name;
        $location_id = $request->location_id;
        $phone_number = $request->phone_number;
        $is_company = $request->is_company;
        $update_client = DB::table('clients')
            ->where('id', $client_id)
            ->update([
                'name' => $name,
                'location_id' => $location_id,
                'phone_number' => $phone_number,
                'is_company' => $is_company,

            ]);
        return response()->json([
            'message' => 'The Client Has Been Updated',
        ], 201);
    }

    public function warehouse_clients($warehouse_id)
    {
        $clients = DB::table('clients AS cl')
            ->join('locations AS lo', 'cl.location_id', '=', 'lo.id')
            ->join('cities AS ci', 'lo.city_id', '=', 'ci.id')
            ->where('cl.warehouse_id', $warehouse_id)
            ->get([
                'cl.id', 'cl.name AS client_name', 'cl.phone_number AS client_phone_number',
                'ci.city_name AS city', 'lo.location_name AS location'
            ]);
        return $clients;
    }
}
