<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('document');
            $table->string('cellphone');
            $table->timestamps();
        });

        Schema::create('order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order_addresses_order_id_foreign');
            $table->string('name');
            $table->string('cep');
            $table->string('street');
            $table->string('city');
            $table->string('number');
            $table->timestamps();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order_payments_order_id_foreign');
            $table->double('value', 8, 2);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('card_id')->nullable()->index('orders_card_id_foreign');
            $table->unsignedBigInteger('customer_id')->nullable()->index('orders_customer_id_foreign');
            $table->foreignId('order_address_id')->nullable()->references('id')->on('order_addresses');
            $table->enum('type', ['balcony', 'delivery']);
            $table->enum('status', ['pending', 'aceppted', 'closed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('product_additionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_additionals_product_id_foreign');
            $table->string('name');
            $table->double('value', 8, 2);
            $table->smallInteger('max');
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product_price_promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_id')->index('product_price_promotions_price_id_foreign');
            $table->enum('type', ['percent', 'unit']);
            $table->double('value', 8, 2);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamps();
        });

        Schema::create('product_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_prices_product_id_foreign');
            $table->double('value', 8, 2);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamps();
        });

        Schema::create('product_replacements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_replacements_product_id_foreign');
            $table->string('name');
            $table->double('value', 8, 2);
            $table->timestamps();
        });

        Schema::create('product_stock_entry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_stock_id')->index('product_stock_entry_product_stock_id_foreign');
            $table->double('amount', 8, 2);
            $table->enum('type', ['grams', 'unit']);
            $table->timestamps();
        });

        Schema::create('product_stock_exit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_stock_id')->index('product_stock_exit_product_stock_id_foreign');
            $table->double('amount', 8, 2);
            $table->enum('type', ['grams', 'unit']);
            $table->timestamps();
        });

        Schema::create('product_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_stocks_product_id_foreign');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_category_id')->index('products_product_category_id_foreign');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('sub_order_has_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('sub_order_has_products_order_id_foreign');
            $table->unsignedBigInteger('product_id')->index('sub_order_has_products_product_id_foreign');
            $table->smallInteger('quantity');
            $table->double('value', 8, 2);
            $table->text('observation');
            $table->timestamps();
        });

        Schema::create('sub_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('sub_orders_order_id_foreign');
            $table->unsignedBigInteger('waiter_id')->index('sub_orders_waiter_id_foreign');
            $table->timestamps();
        });

        Schema::create('waiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('order_addresses', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('order_payments', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['card_id'])->references(['id'])->on('cards')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['customer_id'])->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_additionals', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_price_promotions', function (Blueprint $table) {
            $table->foreign(['price_id'])->references(['id'])->on('product_prices')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_prices', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_replacements', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_stock_entry', function (Blueprint $table) {
            $table->foreign(['product_stock_id'])->references(['id'])->on('product_stocks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_stock_exit', function (Blueprint $table) {
            $table->foreign(['product_stock_id'])->references(['id'])->on('product_stocks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['product_category_id'])->references(['id'])->on('product_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('sub_order_has_products', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('sub_orders', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['waiter_id'])->references(['id'])->on('waiters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_orders', function (Blueprint $table) {
            $table->dropForeign('sub_orders_order_id_foreign');
            $table->dropForeign('sub_orders_waiter_id_foreign');
        });

        Schema::table('sub_order_has_products', function (Blueprint $table) {
            $table->dropForeign('sub_order_has_products_order_id_foreign');
            $table->dropForeign('sub_order_has_products_product_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_product_category_id_foreign');
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropForeign('product_stocks_product_id_foreign');
        });

        Schema::table('product_stock_exit', function (Blueprint $table) {
            $table->dropForeign('product_stock_exit_product_stock_id_foreign');
        });

        Schema::table('product_stock_entry', function (Blueprint $table) {
            $table->dropForeign('product_stock_entry_product_stock_id_foreign');
        });

        Schema::table('product_replacements', function (Blueprint $table) {
            $table->dropForeign('product_replacements_product_id_foreign');
        });

        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropForeign('product_prices_product_id_foreign');
        });

        Schema::table('product_price_promotions', function (Blueprint $table) {
            $table->dropForeign('product_price_promotions_price_id_foreign');
        });

        Schema::table('product_additionals', function (Blueprint $table) {
            $table->dropForeign('product_additionals_product_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_card_id_foreign');
            $table->dropForeign('orders_customer_id_foreign');
        });

        Schema::table('order_payments', function (Blueprint $table) {
            $table->dropForeign('order_payments_order_id_foreign');
        });

        Schema::table('order_addresses', function (Blueprint $table) {
            $table->dropForeign('order_addresses_order_id_foreign');
        });

        Schema::dropIfExists('waiters');

        Schema::dropIfExists('users');

        Schema::dropIfExists('sub_orders');

        Schema::dropIfExists('sub_order_has_products');

        Schema::dropIfExists('products');

        Schema::dropIfExists('product_stocks');

        Schema::dropIfExists('product_stock_exit');

        Schema::dropIfExists('product_stock_entry');

        Schema::dropIfExists('product_replacements');

        Schema::dropIfExists('product_prices');

        Schema::dropIfExists('product_price_promotions');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('product_additionals');

        Schema::dropIfExists('orders');

        Schema::dropIfExists('order_payments');

        Schema::dropIfExists('order_addresses');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('customers');

        Schema::dropIfExists('cards');
    }
};
