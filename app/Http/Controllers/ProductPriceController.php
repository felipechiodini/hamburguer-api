<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{

    public function index(Product $product, Request $request)
    {
        return response()->json($product->prices()->get());
    }

    public function store(Product $product, Request $request)
    {
        $productPrice = ProductPrice::create([
            'product_id' => $product->id,
            'value' => $request->value,
            'start_date' => $request->date('start_date'),
            'end_date' => $request->date('end_date')
        ]);

        return response()->json(['message' => 'Preço cadastrado', 'product_price' => $productPrice]);
    }

}
