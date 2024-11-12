<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_batches', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_quantity')->nullable();
            $table->double('batch_weight')->nullable();
            $table->foreignId('recieve_item_id')
                    ->references('id')
                    ->on('recieve_items')
                    ->onDelete('cascade');
            $table->foreignId('department_id')
                    ->references('id')
                    ->on('departments')
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
        Schema::dropIfExists('product_batches');
    }
}
