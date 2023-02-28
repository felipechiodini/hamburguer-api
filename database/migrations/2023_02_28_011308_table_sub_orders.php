<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableSubOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('waiter_id')->nullable()->references('id')->on('waiters');
            $table->timestamps();
        });

        Schema::create('sub_order_has_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sub_order_id')->references('id')->on('sub_orders');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->float('value');
            $table->float('amount');
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
