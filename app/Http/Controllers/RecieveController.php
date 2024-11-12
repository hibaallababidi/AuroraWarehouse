<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\ProductBatch;
use App\Models\RecieveItem;
use App\Models\RecieveOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RecieveController extends Controller
{
    public function add_recieve_order(Request $request)
    {
        $validator = Validator::make($request->all(), $this->order_rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $recieve_order = RecieveOrder::create([
            'warehouse_id' => $request->warehouse_id,
            'by_manager' => $request->is_manager,
            'client_id' => $request->client_id
        ]);

        if ($request->by_manager) {
            $recieve_order->update([
                'manager_id' => $request->user_id
            ]);
        } else {
            $recieve_order->update([
                'keeper_id' => $request->user_id
            ]);
        }

        return response()->json([
            'order_id' => $recieve_order->id,
        ], 201);

    }

    public function order_rules()
    {
        $rules = [
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'is_manager' => 'required|bool',
            'user_id' => 'required|integer',
            'client_id' => 'required|integer|exists:clients,id'
        ];
        return $rules;
    }

    public function add_recieve_item(Request $request)
    {
        $validator = Validator::make($request->all(), $this->item_rules());
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        if (empty($request->quantity) && empty($request->weight)) {
            return response()->json([
                'qw' => 'can\'t add item with no quantity or weight'
            ],400);
        }

        $item_id = $this->recieve_item($request);
        $this->product_batch($request, $item_id);
        $this->update_total_q_w($request);

        return response()->json([
            'success'
        ], 201);
    }

    public function item_rules()
    {
        $rules = [
            'order_id' => 'required|integer|exists:recieve_orders,id',
            'quantity' => 'integer|min:1',
            'weight' => '',
            'expiration_date' => '',
            'product_id' => 'required|integer|exists:warehouse_products,id',
            'department_id' => 'required|integer|exists:departments,id'
        ];
        return $rules;
    }

    public function recieve_item(Request $request)
    {
        $item = RecieveItem::create([
            'order_id' => $request->order_id,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'expiration_date' => $request->expiration_date,
            'warehouse_product_id' => $request->product_id
        ]);
        return $item->id;
    }

    public function product_batch(Request $request, $item_id)
    {
        ProductBatch::create([
            'recieve_item_id' => $item_id,
            'batch_quantity' => $request->quantity,
            'batch_weight' => $request->weight,
            'department_id' => $request->department_id
        ]);
    }

    public function update_total_q_w(Request $request)
    {
        if (isset($request->quantity)) {
            DB::table('warehouse_products')
                ->where('id', $request->product_id)
                ->increment('total_quantity', $request->quantity);
        }
        if (isset($request->weight)) {
            DB::table('warehouse_products')
                ->where('id', $request->product_id)
                ->increment('total_weight', $request->weight);
        }
    }

    public function recieve_report(Request $request){
        $validator = Validator::make($request->all(),[
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'date'=>'required|date',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);


        $products=DB::table('product_batches')
            ->join('departments', 'departments.id', '=', 'product_batches.department_id')
            ->join('recieve_items', 'recieve_items.id', '=', 'product_batches.recieve_item_id')
            ->join('warehouse_products', 'warehouse_products.id', '=', 'recieve_items.warehouse_product_id')
            ->join('recieve_orders','recieve_orders.id','=','recieve_items.order_id')
            ->join('clients','clients.id','=','recieve_orders.client_id')
            ->join('sub_categories', 'warehouse_products.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('warehouse_products.warehouse_id',$request->warehouse_id)
            ->whereDate('recieve_orders.order_date',$request->date);

        $sort=new SortController();
        $products = $sort->batches_details($products);

        return $products;

        //return JWTAuth::user();
    }

}
