<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')
                    ->references('id')
                    ->on('managers')
                    ->onDelete('cascade');
            $table->integer('verification_code');
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
        Schema::dropIfExists('manager_verifications');
    }
}
