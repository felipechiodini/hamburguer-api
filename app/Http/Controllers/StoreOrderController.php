<?php

namespace App\Http\Controllers;

use App\Models\StoreOrder;
use Illuminate\Http\Request;

class StoreOrderController extends Controller
{

    public function index()
    {
        return response()->json(StoreOrder::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_card_id' => 'nullable|numeric|exists:waiters,id',
        ]);

        StoreOrder::create([
            'store_card_id' => $request->store_card_id,
            'type' => 'balcony',
            'status' => 'pending',
        ]);

        return response()->json();
    }

}
