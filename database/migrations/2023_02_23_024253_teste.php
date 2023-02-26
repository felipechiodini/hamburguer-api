<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('store_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('store_id')->references('id')->on('stores');
            $table->timestamp('open_at');
            $table->timestamp('close_at');
            $table->timestamps();
        });

        Schema::create('store_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('store_id')->references('id')->on('stores');
            $table->timestamp('open_in');
            $table->timestamp('closed_in');
            $table->timestamps();
        });

        Schema::create('combos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('name');
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
