<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecieveItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recieve_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->references('id')
                ->on('recieve_orders')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedDouble('weight')->nullable();
            $table->date('expiration_date')->nullable();
            $table->foreignId('warehouse_product_id')
                    ->references('id')
                    ->on('warehouse_products')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recieve_items');
    }
}
