<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function index(Request $request)
    {
        return response()->json();
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric'
        ]);

        $card = Card::create([
            'store_id' => $request->header(UserStore::HEADER_KEY),
            'number' => $request->number,
        ]);

        return response()->json(['message' => 'Criado com sucesso!', 'card' => $card]);
    }

}
