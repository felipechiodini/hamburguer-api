<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::create($request->only('name'));

        return response()->json(['message' => $category]);
    }

}
