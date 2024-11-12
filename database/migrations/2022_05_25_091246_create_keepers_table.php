<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeepersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keepers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->where('is_active',true);
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->foreignId('warehouse_id')
                    ->references('id')
                    ->on('warehouses')
                    ->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamp('in_date');
            $table->date('out_date')->nullable();
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
        Schema::dropIfExists('keepers');
    }
}
