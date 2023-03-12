<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserStore;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $category = Category::where('user_store_id', $request->header(UserStore::HEADER_KEY))
            ->first();

        return response()->json($category);
    }

    public function store(Request $request)
    {
        Category::create([
            'user_store_id' => $request->header(UserStore::HEADER_KEY),
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Categoria criada com sucesso!'], 201);
    }

}
