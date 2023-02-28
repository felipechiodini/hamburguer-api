<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        return response()->json(Order::with('card')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_card_id' => 'nullable|numeric|exists:waiters,id',
        ]);

        Order::create([
            'store_card_id' => $request->store_card_id,
            'type' => 'balcony',
            'status' => 'pending',
        ]);

        return response()->json();
    }

}
