<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use App\Models\UserStore;
use Illuminate\Http\Request;

class WaiterController extends Controller
{

    public function index()
    {
        return response()->json(Waiter::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $waiter = Waiter::create([
            'store_id'=> $request->header(UserStore::HEADER_KEY),
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Garçom registrado com sucesso', 'waiter' => $waiter]);
    }

}
