<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{

    public function store(Product $product, Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $product->photos()->create([
            'src' => Storage::put("{$product->user_store_id}/$product->id/")
        ]);

        return response()->json(['message' => 'Foto cadastrada com sucesso!']);
    }

}
