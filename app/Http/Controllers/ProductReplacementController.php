<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReplacement;
use Illuminate\Http\Request;

class ProductReplacementController extends Controller
{

    public function store(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'value' => 'required|numeric'
        ]);

        ProductReplacement::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'value' => $request->value
        ]);

        return response()->json(['message' => 'Substituição salva']);
    }

}
