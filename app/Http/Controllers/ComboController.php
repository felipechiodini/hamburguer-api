<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;

class ComboController extends Controller
{

    public function index()
    {
        return response()->json(Combo::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name',
            'products'
        ]);

        $combo = Combo::create([
            'name' => $request->name
        ]);

        $combo->products()->attach($request->products);

        return response()->json(['message' => 'Sucesso!']);
    }
}
