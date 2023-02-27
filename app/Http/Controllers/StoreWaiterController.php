<?php

namespace App\Http\Controllers;

use App\Models\StoreWaiter;
use Illuminate\Http\Request;

class StoreWaiterController extends Controller
{

    public function index()
    {
        return response()->json(StoreWaiter::store()->get());
    }

    public function store(Request $request)
    {
        StoreWaiter::store($request->header('X-store-uuid'))->create([
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Garçom registrado com sucesso']);
    }

}
