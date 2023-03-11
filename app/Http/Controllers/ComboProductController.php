<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;

class ComboProductController extends Controller
{

    public function index(Combo $combo, Request $request)
    {
        return response()->json($combo->products()->get());
    }

    public function store(Combo $combo, Request $request)
    {
        $combo->products()->attach($request->products);

        return response()->json(['message' => 'Produtos vinculados']);
    }

}
