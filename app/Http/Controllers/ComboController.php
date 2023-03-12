<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;

class ComboController extends Controller
{

    public function index()
    {
        return response()->json(Combo::paginate(20));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'
        ]);

        $combo = Combo::create([
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Combo criado com sucesso!'], 201);
    }

}
