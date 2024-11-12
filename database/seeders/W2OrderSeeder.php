<?php

namespace Database\Seeders;

use App\Models\ProductBatch;
use App\Models\RecieveItem;
use App\Models\RecieveOrder;
use Illuminate\Database\Seeder;

class W2OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * ORDER 1
         */
        $recieve_order = RecieveOrder::create([
            'warehouse_id' => 2,
            'by_manager' => 0,
            'keeper_id'=>2,
            'client_id' => 20
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'weight'=>150,
            'warehouse_product_id' => 11
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 2
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 60,
            'weight'=>60,
            'warehouse_product_id' => 12
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'batch_weight'=>$recieve_item->weight,
            'department_id' => 2
        ]);


        /*
         * ORDER 2
         */
        $recieve_order = RecieveOrder::create([
            'warehouse_id' => 2,
            'by_manager' => 0,
            'keeper_id'=>2,
            'client_id' => 21
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 40,
            'weight'=>80,
            'warehouse_product_id' => 13
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 3
        ]);


        /*
         * ORDER 3
         */
        $recieve_order = RecieveOrder::create([
            'warehouse_id' => 2,
            'by_manager' => 0,
            'keeper_id'=>2,
            'client_id' => 22
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 20,
            'weight'=>100,
            'warehouse_product_id' => 14
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 4
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 15,
            'weight'=>60,
            'warehouse_product_id' => 15
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 4
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 35,
            'weight'=>35,
            'warehouse_product_id' => 16
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 4
        ]);
    }
}
