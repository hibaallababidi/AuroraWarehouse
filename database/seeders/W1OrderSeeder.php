<?php

namespace Database\Seeders;

use App\Models\ProductBatch;
use App\Models\RecieveItem;
use App\Models\RecieveOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class W1OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * WAREHOUSE 1
         */
        //ORDER 1
        $recieve_order = RecieveOrder::create([
            'warehouse_id' => 1,
            'by_manager' => 0,
            'keeper_id'=>1,
            'client_id' => 19
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2023-5-1'),
            'warehouse_product_id' => 1
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 45,
            'expiration_date' => Carbon::parse('2023-8-5'),
            'warehouse_product_id' => 2
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 15,
            'expiration_date' => Carbon::parse('2022-8-15'),
            'warehouse_product_id' => 3
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 20,
            'expiration_date' => Carbon::parse('2023-4-1'),
            'warehouse_product_id' => 4
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 23,
            'expiration_date' => Carbon::parse('2023-1-1'),
            'warehouse_product_id' => 5
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2023-2-2'),
            'warehouse_product_id' => 6
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2023-5-1'),
            'warehouse_product_id' => 7
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 15,
            'expiration_date' => Carbon::parse('2022-8-20'),
            'warehouse_product_id' => 8
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 35,
            'expiration_date' => Carbon::parse('2023-8-1'),
            'warehouse_product_id' => 9
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 35,
            'expiration_date' => Carbon::parse('2023-2-15'),
            'warehouse_product_id' => 10
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);


        /*
         * WAREHOUSE 1
         */
        //ORDER 2
        $recieve_order = RecieveOrder::create([
            'warehouse_id' => 1,
            'by_manager' => 0,
            'keeper_id'=>1,
            'client_id' => 19
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 1
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 30,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 2
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 15,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 3
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 15,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 4
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 20,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 5
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 6
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 25,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 7
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 10,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 8
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 35,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 9
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);

        $recieve_item = RecieveItem::create([
            'order_id' => $recieve_order->id,
            'quantity' => 30,
            'expiration_date' => Carbon::parse('2024-1-1'),
            'warehouse_product_id' => 10
        ]);
        ProductBatch::create([
            'recieve_item_id' => $recieve_item->id,
            'batch_quantity' => $recieve_item->quantity,
            'department_id' => 1
        ]);
    }
}
