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
        Schema::create('store_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->timestamps();
        });

        Schema::create('store_combos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('store_combos_product_id_foreign');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('store_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('document');
            $table->string('cellphone');
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });


        Schema::create('user_stores', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->unsignedBigInteger('user_id')->index('user_stores_user_id_foreign');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('store_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignUuid('store_id')->nullable()->references('id')->on('user_stores');
            $table->foreignId('store_card_id')->nullable()->references('id')->on('store_cards');
            $table->enum('type', ['balcony', 'delivery']);
            $table->enum('status', ['pending', 'aceppted', 'closed'])->default('pending');
            $table->timestamps();
        });



        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('store_order_id')->references('id')->on('store_orders');
            $table->double('value');
            $table->timestamps();
        });


        Schema::create('order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('store_order_id')->references('id')->on('store_orders');
            $table->string('name');
            $table->string('cep');
            $table->string('street');
            $table->string('city');
            $table->string('number');
            $table->timestamps();
        });

        Schema::create('plan_has_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id')->index('plan_has_modules_plan_id_foreign');
            $table->unsignedBigInteger('module_id')->index('plan_has_modules_module_id_foreign');
            $table->timestamps();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('plan_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('plan_id')->references('id')->on('plans');
            $table->double('value');
            $table->integer('recurence');
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

        // Schema::create('sub_order_has_products', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('order_id')->index('sub_order_has_products_order_id_foreign');
        //     $table->unsignedBigInteger('product_id')->index('sub_order_has_products_product_id_foreign');
        //     $table->smallInteger('quantity');
        //     $table->double('value', 8, 2);
        //     $table->text('observation');
        //     $table->timestamps();
        // });

        // Schema::create('sub_orders', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('order_id')->index('sub_orders_order_id_foreign');
        //     $table->unsignedBigInteger('waiter_id')->index('sub_orders_waiter_id_foreign');
        //     $table->timestamps();
        // });

        Schema::create('user_store_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('user_store_id', 36)->index('user_store_configurations_user_store_id_foreign');
            $table->timestamp('open_in');
            $table->timestamp('closed_in');
            $table->timestamps();
        });

        Schema::create('user_store_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('user_store_id', 36)->index('user_store_schedules_user_store_id_foreign');
            $table->timestamp('open_at');
            $table->timestamp('close_at');
            $table->timestamps();
        });



        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('user_subscriptions_user_id_foreign');
            $table->foreignId('plan_price_id')->references('id')->on('plan_prices');
            $table->timestamp('start_at');
            $table->timestamp('expire_at');
            $table->timestamps();
        });

        Schema::create('waiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('store_combos', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        // Schema::table('order_payments', function (Blueprint $table) {
        //     $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->foreignId('store_card_id')->references('id')->on('store_cards');
        //     $table->foreign(['customer_id'])->references(['id'])->on('store_customers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        //     $table->foreign(['order_address_id'])->references(['id'])->on('order_addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });

        Schema::table('plan_has_modules', function (Blueprint $table) {
            $table->foreign(['module_id'])->references(['id'])->on('modules')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_id'])->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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

        // Schema::table('sub_order_has_products', function (Blueprint $table) {
        //     $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        //     $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });

        // Schema::table('sub_orders', function (Blueprint $table) {
        //     $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        //     $table->foreign(['waiter_id'])->references(['id'])->on('waiters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        // });

        Schema::table('user_store_configurations', function (Blueprint $table) {
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('user_store_schedules', function (Blueprint $table) {
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('user_stores', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

};
