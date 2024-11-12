<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class NeedController extends Controller
{
    public function get_locations()
    {
        $city_id = DB::table('cities')->orderBy('id')->pluck('id');
        $city_names = DB::table('cities')->orderBy('id')->pluck('city_name');
        $ids = [];
        $locations = [];
        for ($i = 0; $i < sizeof($city_id); $i++) {
            $id = DB::table('locations')
                ->where('city_id', $city_id[$i])
                ->pluck('id');
            $location = DB::table('locations')
                ->where('city_id', $city_id[$i])
                ->pluck('location_name');
            $locations[$i] = $location;
            $ids[$i] = $id;
        }
        return response()->json([
            'city'=>$city_id,
            'cities' => $city_names,
            'ids' => $ids,
            'locations' => $locations
        ]);
    }

    public function get_categories()
    {
        $category_id = DB::table('categories')->orderBy('id')->pluck('id');
        $categories = DB::table('categories')->orderBy('id')->pluck('category_name');
        $result = [];
        for ($i = 0; $i < sizeof($category_id); $i++) {
            $id = DB::table('sub_categories')
                ->where('category_id', $category_id[$i])
                ->pluck('id');
            $sub = DB::table('sub_categories')
                ->where('category_id', $category_id[$i])
                ->pluck('sub_category');
            $photo = DB::table('sub_categories')
                ->where('category_id', $category_id[$i])
                ->pluck('photo_path');
            $sub_categories = [];
            for ($j = 0; $j < sizeof($sub); $j++) {
                $sub_categories[$j] = [
                    'id' => $id[$j],
                    'sub' => $sub[$j],
                    'photo' => URL::to($photo[$j])
                ];
            }
            $result[$i] = $sub_categories;
        }
        return response()->json([
            'categories' => $categories,
            'ids'=>$category_id,
            'sub_categories' => $result,
        ]);
    }

    public function get_companies($warehouse_id){
        $id = DB::table('clients')
            ->where('warehouse_id',$warehouse_id)
            ->where('is_company','=','1')
            ->pluck('id');
        $companies = DB::table('clients')
            ->where('warehouse_id',$warehouse_id)
            ->where('is_company','=','1')
            ->pluck('name');
        return response()->json([
            "id"=>$id,
            "companies"=>$companies
        ]);
    }

    public function get_product_client_department($warehouse_id){
        $clients = $this->get_clients($warehouse_id);
        $clients=json_decode(json_encode($clients), true);
        $products=$this->get_products($warehouse_id);
        $products=json_decode(json_encode($products), true);
        $departments=$this->get_departments($warehouse_id);
        $departments=json_decode(json_encode($departments), true);
        return response()->json([
            'clients_id'=>$clients['original']['clients_id'],
            'clients_name'=>$clients['original']['clients_name'],
            'products_id'=>$products['original']['products_id'],
            'products_name'=>$products['original']['products_name'],
            'departments_id'=>$departments['original']['departments_id'],
            'departments_name'=>$departments['original']['departments_name']
        ]);
    }

    public function get_clients($warehouse_id){
        $clients_id = DB::table('clients')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('id');
        $clients_name = DB::table('clients')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('name');
        return response()->json([
           'clients_id'=>$clients_id,
           'clients_name'=>$clients_name
        ]);
    }

    public function get_products($warehouse_id){
        $products_id = DB::table('warehouse_products')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('id');
        $products_name = DB::table('warehouse_products')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('product_name');
        return response()->json([
            'products_id'=>$products_id,
            'products_name'=>$products_name
        ]);
    }

    public function get_departments($warehouse_id){
        $products_id = DB::table('departments')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('id');
        $products_name = DB::table('departments')
            ->where('warehouse_id',$warehouse_id)
            ->pluck('department_name');
        return response()->json([
            'departments_id'=>$products_id,
            'departments_name'=>$products_name
        ]);
    }
}
