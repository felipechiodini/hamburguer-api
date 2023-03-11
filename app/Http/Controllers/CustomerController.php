<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UserStore;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        return response()->json(Customer::paginate(20));
    }

    public function store(Request $request)
    {
        Customer::create([
            'store_id' => $request->header(UserStore::HEADER_KEY),
            'name' => $request->name,
            'document' => $request->document,
            'cellphone' => $request->cellphone
        ]);

        return response()->json(['message' => 'Usuário criado com sucesso!'], 201);
    }

}
