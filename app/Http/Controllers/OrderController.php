<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        Order::create([
            'type' => 'balcony',
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Pedido criado com sucesso!']);
    }

    public function setStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'in:pending,canceled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Sucesso!']);
    }

}
