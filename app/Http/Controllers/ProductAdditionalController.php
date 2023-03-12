<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAdditional;
use Illuminate\Http\Request;

class ProductAdditionalController extends Controller
{

    public function index(Product $product, Request $request)
    {
        $additionals = ProductAdditional::where('product_id', $product->id)
            ->get();

        return response()->json($additionals);
    }

    public function store()
    {
        //
    }

}
