<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->references('id')
                ->on('export_orders')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedDouble('weight')->nullable();
            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('product_batches')
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
        Schema::dropIfExists('export_items');
    }
}
