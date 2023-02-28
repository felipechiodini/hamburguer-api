<?php

namespace App\Http\Controllers;

use App\Models\StoreWaiter;
use App\Models\UserStore;
use Illuminate\Http\Request;

class StoreWaiterController extends Controller
{

    public function index()
    {
        return response()->json(StoreWaiter::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $waiter = StoreWaiter::create([
            'user_store_id'=> $request->header(UserStore::HEADER_KEY),
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Garçom registrado com sucesso', 'waiter' => $waiter]);
    }

}
