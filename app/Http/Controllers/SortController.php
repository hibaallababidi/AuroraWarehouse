<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SortController extends Controller
{
    public function sort_quantity($warehouse_id)
    {
        $ids = DB::table('warehouse_products')
            ->where('warehouse_products.warehouse_id', $warehouse_id)
            ->orderBy('total_quantity')
            ->pluck('id');
        $details=new ProductController();

        return $details->products($ids);
    }

    public function sort_expiration_date($warehouse_id){

        $products=DB::table('product_batches')
            ->join('departments', 'departments.id', '=', 'product_batches.department_id')
            ->join('recieve_items', 'recieve_items.id', '=', 'product_batches.recieve_item_id')
            ->join('warehouse_products', 'warehouse_products.id', '=', 'recieve_items.warehouse_product_id')
            ->join('recieve_orders','recieve_orders.id','=','recieve_items.order_id')
            ->join('clients','clients.id','=','recieve_orders.client_id')
            ->join('sub_categories', 'warehouse_products.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where([
                ['warehouse_products.warehouse_id',$warehouse_id],
                ['recieve_items.expiration_date','!=',null]
            ])
            ->orderBy('expiration_date');

        $products = $this->batches_details($products);
        $products1= DB::table('product_batches')
            ->join('departments', 'departments.id', '=', 'product_batches.department_id')
            ->join('recieve_items', 'recieve_items.id', '=', 'product_batches.recieve_item_id')
            ->join('warehouse_products', 'warehouse_products.id', '=', 'recieve_items.warehouse_product_id')
            ->join('recieve_orders','recieve_orders.id','=','recieve_items.order_id')
            ->join('clients','clients.id','=','recieve_orders.client_id')
            ->join('sub_categories', 'warehouse_products.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where([
                ['warehouse_products.warehouse_id',$warehouse_id],
                ['recieve_items.expiration_date',null]
            ]);
        $products1 = $this->batches_details($products1);
        $products = array_merge($products,$products1);
        return $products;
    }

    public function batches_details($batches){

        $batches = $batches->get([
            'product_batches.id as batch_id',
            'warehouse_products.product_name',
            'recieve_items.expiration_date',
            'recieve_items.quantity AS recieved_quantity',
            'recieve_items.weight AS recieved_weight',
            'product_batches.batch_quantity AS current_quantity',
            'product_batches.batch_weight AS current_weight',
            'departments.department_name AS department',
            'recieve_orders.order_date',
            'clients.name As client',
            'sub_categories.sub_category',
            'sub_categories.photo_path',
            'categories.category_name AS category',
        ]);
        $batches = json_decode(json_encode($batches), true);
        $test1 = [];
        $test2 = [];
        for ($i = 0; $i < sizeof($batches); $i++) {
            $test1['batch_id'] = $batches[$i]['batch_id'];
            $test1['product_name'] = $batches[$i]['product_name'];
            $test1['expiration_date'] = $batches[$i]['expiration_date'];
            $test1['recieved_quantity'] = $batches[$i]['recieved_quantity'];
            $test1['recieved_weight'] = $batches[$i]['recieved_weight'];
            $test1['current_quantity'] = $batches[$i]['current_quantity'];
            $test1['current_weight'] = $batches[$i]['current_weight'];
            $test1['department'] = $batches[$i]['department'];
            $test1['order_date'] = $batches[$i]['order_date'];
            $test1['client'] = $batches[$i]['client'];
            $test1['sub_category'] = $batches[$i]['sub_category'];
            //$test1['photo_path'] = $batches[$i]['photo_path'];
            $test1['photo_path'] = URL::to($batches[$i]['photo_path']);
            $test1['category'] = $batches[$i]['category'];
            $date = Carbon::now();
            $date->addDays(30);
            if ($test1['expiration_date'] != null && $test1['expiration_date'] <= $date)
                $test1['expired'] = true;
            else
                $test1['expired'] = false;
            if($test1['current_quantity']!=0 || $test1['current_weight']!=0)
                $test1['finished']=false;
            else
                $test1['finished']=true;
            $test2[$i] = $test1;
        }
        return $test2;
    }
}
