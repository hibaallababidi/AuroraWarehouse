<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\WarehouseProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use function Symfony\Component\String\isEmpty;

class ProductController extends Controller
{
    public function add_product(Request $request)
    {
        $input = [
            'product_name' => 'required|string|max:30',
            'subcategory_id' => 'required|integer|exists:sub_categories,id',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'company_id' => 'required|integer|exists:clients,id',
            'min_quantity' => 'required|integer',
        ];
        $validate = Validator::make($request->all(), $input);

        if ($validate->fails())
            return response()->json($validate->errors(), 400);

        $WarehouseProducts = WarehouseProducts::create([
            'product_name' => $request->product_name,
            'min_quantity' => $request->min_quantity,
            'subcategory_id' => $request->subcategory_id,
            'warehouse_id' => $request->warehouse_id,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            ' product_id' => $WarehouseProducts->id,
        ], 201);
    }

    public function show_details_product1($id_products)
    {
        $show_details_product = DB::table('warehouse_products')
            ->join('clients', 'warehouse_products.company_id', '=', 'clients.id')
            ->join('sub_categories', 'warehouse_products.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('warehouse_products.id', '=', $id_products)
            ->get(['warehouse_products.product_name',
                'warehouse_products.total_quantity',
                'warehouse_products.total_weight',
                'sub_categories.sub_category',
                'warehouse_products.min_quantity',
                'clients.name AS company',
                'sub_categories.photo_path',
                'categories.category_name',
            ]);
        $show_details_product = json_decode(json_encode($show_details_product), true);
        return $show_details_product[0];


    }

    public function show_details_product2($id_products)
    {
        $show_details_product1 = DB::table('product_batches')
            ->join('departments', 'departments.id', '=', 'product_batches.department_id')
            ->join('recieve_items', 'recieve_items.id', '=', 'product_batches.recieve_item_id')
            ->join('warehouse_products', 'warehouse_products.id', '=', 'recieve_items.warehouse_product_id')
            ->join('recieve_orders', 'recieve_orders.id', '=', 'recieve_items.order_id')
            ->join('clients', 'clients.id', '=', 'recieve_orders.client_id')
            ->where('warehouse_products.id', '=', $id_products)
            //->where('product_batches.batch_quantity', '!=', 0)
            //->Where('product_batches.batch_weight', '!=', 0)
            ->get([
                'recieve_items.expiration_date',
                'product_batches.batch_quantity',
                'product_batches.batch_weight',
                'departments.department_name AS department',
                'recieve_orders.order_date',
                'clients.name As client'
            ]);
        $show_details_product1 = $show_details_product1
            ->whereNotIn('batch_quantity', '0');
        $show_details_product1 = $show_details_product1
            ->whereNotIn('batch_weight', '0');

        $show_details_product1 = json_decode(json_encode($show_details_product1), true);
        $show_details_product1 =  $this->batches($show_details_product1);

        return $show_details_product1;
    }

    public function show_details_product($id_products)
    {
        $show_details_product1 = $this->show_details_product1($id_products);
        $show_details_product2 = $this->show_details_product2($id_products);
        return response()->json([
            'product' => $show_details_product1,
            'batches' => $show_details_product2
        ]);
    }

    public function warehouse_products($warehouse_id)
    {
        $ids = DB::table('warehouse_products')
            ->where('warehouse_products.warehouse_id', $warehouse_id)
            ->pluck('id');
        if ($ids->isEmpty())
            return response()->json([], 404);
        return $this->products($ids);
    }

    public function products($ids){
        $products = [];
        for ($i = 0; $i < sizeof($ids); $i++) {
            $product = $this->show_details_product1($ids[$i]);
            $products[$i]['product_name'] = $product['product_name'];
            $products[$i]['total_quantity'] = $product['total_quantity'];
            if ($product['total_quantity'] <= $product['min_quantity'])
                $products[$i]['is_min'] = true;
            else
                $products[$i]['is_min'] = false;
            $products[$i]['total_weight'] = $product['total_weight'];
            $products[$i]['sub_category'] = $product['sub_category'];
            $products[$i]['min_quantity'] = $product['min_quantity'];
            $products[$i]['company'] = $product['company'];
            //$products[$i]['photo_path'] = $product['photo_path'];
            $products[$i]['photo_path'] = URL::to($product['photo_path']);
            $products[$i]['category'] = $product['category_name'];
            $products[$i]['batches'] = $this->show_details_product2($ids[$i]);
        }
        return $products;
    }

    public function batches($batches){
        $test1 = [];
        $test2 = [];
        for ($i = 0; $i < sizeof($batches); $i++) {
            $test1['expiration_date'] = $batches[$i]['expiration_date'];
            $test1['batch_quantity'] = $batches[$i]['batch_quantity'];
            $test1['batch_weight'] = $batches[$i]['batch_weight'];
            $test1['department'] = $batches[$i]['department'];
            $test1['order_date'] = $batches[$i]['order_date'];
            $test1['client'] = $batches[$i]['client'];
            $date = Carbon::now();
            $date->addDays(30);
            if ($test1['expiration_date'] != null && $test1['expiration_date'] <= $date)
                $test1['expired'] = true;
            else
                $test1['expired'] = false;
            $test2[$i] = $test1;
        }
        return $test2;
    }

}
