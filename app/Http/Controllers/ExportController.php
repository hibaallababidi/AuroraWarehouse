<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\ExportItem;
use App\Models\ExportOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExportController extends Controller
{
    public function add_export_order(Request $request)
    {
        $input = [
            'client_id' => 'required|integer|exists:clients,id',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'is_manager' => 'required|boolean',
            'user_id' => 'required|integer',
        ];
        $validate = Validator::make($request->all(), $input);
        if ($validate->fails())
            return response()->json($validate->errors(), 400);

        $order_date = Carbon::now();
        if ($request['by_manager'] == "true") {
            $export_order = ExportOrder::create([
                'order_date' => $order_date,
                'by_manager' => $request->is_manager,
                'manager_id' => $request->user_id,
                'client_id' => $request->client_id,
                'warehouse_id' => $request->warehouse_id,
            ]);
        } else {
            $export_order = ExportOrder::create([
                'order_date' => $order_date,
                'by_manager' => $request->is_manager,
                'keeper_id' => $request->user_id,
                'client_id' => $request->client_id,
                'warehouse_id' => $request->warehouse_id,
            ]);
        }
        return response()->json([
            'order_id' => $export_order->id,
        ], 201);
    }


    public function first_expiration_date($product_id)
    {
        $product=DB::table('warehouse_products')
            ->where('id',$product_id)
            ->pluck('expiration_date');
        if($product[0] == null){
            $show1 = DB::table('recieve_items')
                ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
                ->where('recieve_items.warehouse_products_id', '=', $product_id)
                ->where('product_batches.batch_quantity', '!=', 0)
                ->Where('product_batches.batch_weight', '!=', 0)
                ->pluck('product_batches.id');
            $s = $show1[0];
            return $s;
        }
        $show1 = DB::table('recieve_items')
            ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
            ->where('recieve_items.warehouse_product_id', '=', $product_id)
            ->where('product_batches.batch_quantity', '!=', 0)
            ->Where('product_batches.batch_weight', '!=', 0)
            ->oldest('recieve_items.expiration_date')->pluck('product_batches.id');
        $s = $show1[0];
        return $s;
    }

    public function quantity_first_expiration_date($product_id)
    {
        $product=DB::table('warehouse_products')
            ->where('id',$product_id)
            ->first();
        return $product;
//        if($product[0] == null){
//            $show1 = DB::table('recieve_items')
//                ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
//                ->where('recieve_items.warehouse_products_id', '=', $product_id)
//                ->where('product_batches.batch_quantity', '!=', 0)
//                ->Where('product_batches.batch_weight', '!=', 0)
//                ->pluck('product_batches.id');
//            $s = $show1[0];
//            return $s;
//        }
//        $show1 = DB::table('recieve_items')
//            ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
//            ->where('recieve_items.warehouse_product_id', '=', $product_id)
//            ->where('product_batches.batch_quantity', '!=', 0)
//            ->oldest('recieve_items.expiration_date')->pluck('product_batches.id');
//        $s = $show1[0];
//        return $s;
    }

    public function weight_first_expiration_date($product_id)
    {
        $product=DB::table('warehouse_products')
            ->where('id',$product_id)
            ->pluck('expiration_date');
        if($product[0] == null){
            $show1 = DB::table('recieve_items')
                ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
                ->where('recieve_items.warehouse_products_id', '=', $product_id)
                ->where('product_batches.batch_quantity', '!=', 0)
                ->Where('product_batches.batch_weight', '!=', 0)
                ->pluck('product_batches.id');
            $s = $show1[0];
            return $s;
        }
        $show1 = DB::table('recieve_items')
            ->join('product_batches', 'product_batches.recieve_item_id', '=', 'recieve_items.id')
            ->where('recieve_items.warehouse_product_id', '=', $product_id)
            ->Where('product_batches.batch_weight', '!=', 0)
            ->oldest('recieve_items.expiration_date')->pluck('product_batches.id');
        $s = $show1[0];
        return $s;
    }

    public function add_export_item(Request $request)
    {
        $input = [
            'quantity' => '',
            'weight' => '',
            'order_id' => 'required|integer|exists:export_orders,id',
            'product_id' => 'required|integer|exists:warehouse_products,id',
        ];
        $validate = Validator::make($request->all(), $input);
        if ($validate->fails())
            return response()->json($validate->errors(), 400);
        if (empty($request->quantity) && empty($request->weight))
            return response()->json([
                'qw' => 'can\'t add item with no quantity or weight'
            ],400);


        if ($request->has('quantity') and !$request->has('weight')) {
            //$this->decrease_total_quantity($request);
            //$batch =
              return  $this->quantity_first_expiration_date($request->product_id);
            //$this->decrease_batch_quantity($batch, $request->quantity);

        } elseif ($request->has('weight') and !$request->has('quantity')) {
            $this->decrease_total_weight($request);
            $batch = $this->weight_first_expiration_date($request->product_id);
            $this->decrease_batch_weight($batch, $request->weight);
        } else {
            $this->decrease_total_quantity($request);
            $this->decrease_total_weight($request);
            $batch = $this->first_expiration_date($request->product_id);
            $this->decrease_batch_quantity($batch, $request->quantity);
            $this->decrease_batch_weight($batch, $request->weight);
        }

//        $add_export_item = ExportItem::create([
//            'quantity' => $request->quantity,
//            'weight' => $request->weight,
//            'batch_id' => $batch,
//            'order_id' => $request->order_id,
//
//        ]);
//        return response()->json([
//            'message' => 'export_item successfully added',
//        ], 201);
    }

    private function decrease_total_quantity(Request $request)
    {
        DB::table('warehouse_products')
            ->where('id', $request->product_id)
            ->where('warehouse_products.total_quantity', '>=', $request->quantity)
            ->decrement('warehouse_products.total_quantity', $request->quantity);
    }

    private function decrease_total_weight(Request $request)
    {
        DB::table('warehouse_products')
            ->where('id', $request->product_id)
            ->where('warehouse_products.total_weight', '>=', $request->weight)
            ->decrement('warehouse_products.total_weight', $request->weight);
    }

    private function decrease_batch_quantity($batch, $quantity)
    {
        DB::table('product_batches')
            ->where('id', $batch)
            ->where('product_batches.batch_quantity', '>=', $quantity)
            ->decrement('product_batches.batch_quantity', $quantity);
    }

    private function decrease_batch_weight($batch, $weight)
    {
        DB::table('product_batches')
            ->where('id', $batch)
            ->where('product_batches.batch_weight', '>=', $weight)
            ->decrement('product_batches.batch_weight', $weight);
    }
}
