<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->unsignedInteger('total_quantity')->default(0);
            $table->unsignedDouble('total_weight')->default(0);
            $table->unsignedInteger('min_quantity');
            $table->foreignId('subcategory_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
            $table->foreignId('warehouse_id')
                    ->references('id')
                    ->on('warehouses')
                    ->onDelete('cascade');
            $table->foreignId('company_id')
                    ->references('id')
                    ->on('clients')
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
        Schema::dropIfExists('warehouse_products');
    }
}
