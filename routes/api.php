<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('braintree/token',  'BraintreeController@token');

Route::post('subscribe', 'UserController@subscribe');
Route::apiResource('order', 'OrderController');
Route::apiResource('product', 'ProductController');
Route::apiResource('product/{product}/price', 'ProductPriceController');
Route::apiResource('product/{product}/replacement', 'ProductReplacementController');
Route::apiResource('combo', 'ComboController');
Route::apiResource('waiter', 'WaiterController');
Route::apiResource('combo/{combo}/product', 'ComboProductController');
Route::apiResource('order/{order}/sub-order', 'SubOrderController');
Route::apiResource('order/{order}/sub-order', 'StoreScheduleController');

Route::fallback(function () {
    return response()->json(['message' => 'Serviço não encontrado!'], 404);
});
