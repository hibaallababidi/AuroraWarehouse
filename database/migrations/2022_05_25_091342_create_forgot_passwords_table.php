<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForgotPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forgot_passwords', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_manager');
            $table->integer('verification_code');
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
        Schema::dropIfExists('forgot_passwords');
    }
}
