<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserStore;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return response()->json(Product::paginate(20));
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'user_store_id' => $request->header(UserStore::HEADER_KEY),
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json(['product' => $product], 201);
    }

    public function show(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Produto deletado']);
    }

}
