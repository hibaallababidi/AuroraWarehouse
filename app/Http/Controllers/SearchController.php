<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function Symfony\Component\String\isEmpty;


class SearchController extends Controller
{
    public function search_product(Request $request)
    {
        $validator = Validator::make($request->all(), $this->product_rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $products = null;
        switch ($request->by) {
            case 'name':
                $products = $this->search_products_name($request);
                break;
            case 'category':
                $products = $this->search_product_category($request);
                break;
        }
        if (sizeof($products)==0)
        return response()->json([],404);
        return $products;
    }

    private function search_products_name(Request $request)
    {
        $ids = DB::table('warehouse_products')
            ->where([
                ['warehouse_products.warehouse_id', $request->warehouse_id],
                ['product_name', 'LIKE', '%' . $request->text . '%']
            ])
            ->pluck('id');
        $details=new ProductController();
        return $details->products($ids);
    }

    private function search_product_category(Request $request)
    {
        $ids = DB::table('warehouse_products AS wp')
            ->join('sub_categories AS sc', 'wp.subcategory_id', '=', 'sc.id')
            ->where([
                ['wp.warehouse_id', $request->warehouse_id],
                ['wp.subcategory_id', $request->search_id]
            ])
            ->pluck('wp.id');
        $details=new ProductController();
        return $details->products($ids);
    }


    public function search_client(Request $request){
        $validator = Validator::make($request->all(), $this->client_rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $clients = null;
        switch ($request->by) {
            case 'name':
                $clients = $this->search_client_name($request);
                break;
            case 'location':
                $clients = $this->search_client_location($request);
                break;
        }
        if (sizeof($clients)==0)
            return response()->json([],404);
        return $clients;
    }

    private function search_client_name(Request $request){
        $clients = DB::table('clients AS cl')
            ->join('locations AS lo','cl.location_id','=','lo.id')
            ->join('cities AS ci','lo.city_id','=','ci.id')
            ->where('cl.warehouse_id',$request->warehouse_id)
            ->where('cl.name', 'LIKE', '%' . $request->text . '%')
            ->get([
                'cl.id','cl.name AS client_name','cl.phone_number AS client_phone_number',
                'ci.city_name AS city','lo.location_name AS location'
            ]);
        return $clients;
    }

    private function search_client_location(Request $request){
        $clients = DB::table('clients AS cl')
            ->join('locations AS lo','cl.location_id','=','lo.id')
            ->join('cities AS ci','lo.city_id','=','ci.id')
            ->where('cl.warehouse_id',$request->warehouse_id)
            ->where('cl.location_id', $request->search_id)
            ->get([
                'cl.id','cl.name AS client_name','cl.phone_number AS client_phone_number',
                'ci.city_name AS city','lo.location_name AS location'
            ]);
        return $clients;
    }

    private function product_rules(){
        $rules = [
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'by' => Rule::in('name','category'),
            'text',
            'search_id'=> 'integer|exists:sub_categories,id'
        ];
        return $rules;
    }

    private function client_rules(){
        $rules = [
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'by' => Rule::in('name','location'),
            'text',
            'search_id'=> 'integer|exists:locations,id'
        ];
        return $rules;
    }

}
