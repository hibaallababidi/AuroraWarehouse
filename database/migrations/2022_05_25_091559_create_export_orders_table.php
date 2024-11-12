<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_date');
            $table->foreignId('warehouse_id')
                ->references('id')
                ->on('warehouses')
                ->onDelete('cascade');
            $table->boolean('by_manager');
            $table->foreignId('manager_id')
                    ->nullable()
                    ->references('id')
                    ->on('managers')
                    ->onDelete('cascade');
            $table->foreignId('keeper_id')
                   ->nullable()
                   ->references('id')
                   ->on('keepers')
                   ->onDelete('cascade');
            $table->foreignId('client_id')
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
        Schema::dropIfExists('export_orders');
    }
}
