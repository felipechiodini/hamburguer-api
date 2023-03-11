<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dashboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dashboards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignUuid('user_store_id')->references('id')->on('user_stores');
            $table->enum('key', ['general', 'waiters']);
            $table->json('config');
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
        //
    }
}
