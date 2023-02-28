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
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_order_id')->index('order_addresses_store_order_id_foreign');
            $table->string('name');
            $table->string('cep');
            $table->string('street');
            $table->string('city');
            $table->string('number');
            $table->timestamps();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_order_id')->index('order_payments_store_order_id_foreign');
            $table->double('value');
            $table->timestamps();
        });

        Schema::create('plan_has_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id')->index('plan_has_modules_plan_id_foreign');
            $table->unsignedBigInteger('module_id')->index('plan_has_modules_module_id_foreign');
            $table->timestamps();
        });

        Schema::create('plan_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id')->index('plan_prices_plan_id_foreign');
            $table->double('value');
            $table->integer('recurence');
            $table->timestamps();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
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

        Schema::create('store_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('user_store_id', 36)->index('store_cards_user_store_id_foreign');
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
            $table->char('user_store_id', 36)->index('store_customers_user_store_id_foreign');
            $table->string('name');
            $table->string('document');
            $table->string('cellphone');
            $table->timestamps();
        });

        Schema::create('store_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('user_store_id', 36)->index('store_orders_user_store_id_foreign');
            $table->unsignedBigInteger('store_card_id')->nullable()->index('store_orders_store_card_id_foreign');
            $table->enum('type', ['balcony', 'delivery']);
            $table->enum('status', ['pending', 'aceppted', 'closed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('store_waiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('user_store_id', 36)->index('store_waiters_user_store_id_foreign');
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->timestamps();
        });

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

        Schema::create('user_stores', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->unsignedBigInteger('user_id')->index('user_stores_user_id_foreign');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('user_subscriptions_user_id_foreign');
            $table->unsignedBigInteger('plan_price_id')->index('user_subscriptions_plan_price_id_foreign');
            $table->timestamp('start_at');
            $table->timestamp('expire_at');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('order_addresses', function (Blueprint $table) {
            $table->foreign(['store_order_id'])->references(['id'])->on('store_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('order_payments', function (Blueprint $table) {
            $table->foreign(['store_order_id'])->references(['id'])->on('store_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plan_has_modules', function (Blueprint $table) {
            $table->foreign(['module_id'])->references(['id'])->on('modules')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_id'])->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plan_prices', function (Blueprint $table) {
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

        Schema::table('store_cards', function (Blueprint $table) {
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('store_combos', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('store_customers', function (Blueprint $table) {
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('store_orders', function (Blueprint $table) {
            $table->foreign(['store_card_id'])->references(['id'])->on('store_cards')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('store_waiters', function (Blueprint $table) {
            $table->foreign(['user_store_id'])->references(['id'])->on('user_stores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

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
            $table->foreign(['plan_price_id'])->references(['id'])->on('plan_prices')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropForeign('user_subscriptions_plan_price_id_foreign');
            $table->dropForeign('user_subscriptions_user_id_foreign');
        });

        Schema::table('user_stores', function (Blueprint $table) {
            $table->dropForeign('user_stores_user_id_foreign');
        });

        Schema::table('user_store_schedules', function (Blueprint $table) {
            $table->dropForeign('user_store_schedules_user_store_id_foreign');
        });

        Schema::table('user_store_configurations', function (Blueprint $table) {
            $table->dropForeign('user_store_configurations_user_store_id_foreign');
        });

        Schema::table('store_waiters', function (Blueprint $table) {
            $table->dropForeign('store_waiters_user_store_id_foreign');
        });

        Schema::table('store_orders', function (Blueprint $table) {
            $table->dropForeign('store_orders_store_card_id_foreign');
            $table->dropForeign('store_orders_user_store_id_foreign');
        });

        Schema::table('store_customers', function (Blueprint $table) {
            $table->dropForeign('store_customers_user_store_id_foreign');
        });

        Schema::table('store_combos', function (Blueprint $table) {
            $table->dropForeign('store_combos_product_id_foreign');
        });

        Schema::table('store_cards', function (Blueprint $table) {
            $table->dropForeign('store_cards_user_store_id_foreign');
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

        Schema::table('plan_prices', function (Blueprint $table) {
            $table->dropForeign('plan_prices_plan_id_foreign');
        });

        Schema::table('plan_has_modules', function (Blueprint $table) {
            $table->dropForeign('plan_has_modules_module_id_foreign');
            $table->dropForeign('plan_has_modules_plan_id_foreign');
        });

        Schema::table('order_payments', function (Blueprint $table) {
            $table->dropForeign('order_payments_store_order_id_foreign');
        });

        Schema::table('order_addresses', function (Blueprint $table) {
            $table->dropForeign('order_addresses_store_order_id_foreign');
        });

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_subscriptions');

        Schema::dropIfExists('user_stores');

        Schema::dropIfExists('user_store_schedules');

        Schema::dropIfExists('user_store_configurations');

        Schema::dropIfExists('store_waiters');

        Schema::dropIfExists('store_orders');

        Schema::dropIfExists('store_customers');

        Schema::dropIfExists('store_combos');

        Schema::dropIfExists('store_cards');

        Schema::dropIfExists('products');

        Schema::dropIfExists('product_stocks');

        Schema::dropIfExists('product_stock_exit');

        Schema::dropIfExists('product_stock_entry');

        Schema::dropIfExists('product_replacements');

        Schema::dropIfExists('product_prices');

        Schema::dropIfExists('product_price_promotions');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('product_additionals');

        Schema::dropIfExists('plans');

        Schema::dropIfExists('plan_prices');

        Schema::dropIfExists('plan_has_modules');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('order_payments');

        Schema::dropIfExists('order_addresses');

        Schema::dropIfExists('modules');

    }
};
