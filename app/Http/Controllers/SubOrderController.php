<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubOrder;
use App\Product\CalculatePriceProduct;
use Illuminate\Http\Request;

class SubOrderController extends Controller
{

    public function store($order, Request $request)
    {
        $subOrder = SubOrder::create([
            'order_id' => $order,
            'waiter_id' => $request->input('waiter_id'),
        ]);

        foreach ($request->json('products') as $product) {
            $modelProduct = Product::find($product['id']);

            $subOrder->products()->attach($product['id'], [
                'value' => CalculatePriceProduct::product($modelProduct)->getCurrentPrice(),
                'amount' => $product['amount']
            ]);
        }

        return response()->json(['message' => 'Criado com sucesso!']);
    }
}
