<?php

namespace App\Http\Controllers;

use App\Subscription\Subsctiption;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(Request $request)
    {
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Salvo']);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_price_id' => 'required'
        ]);

        Subsctiption::user(auth()->user())
            ->planPrice($request->plan_price_id)
            ->subscribe();

        return response()->json(['message' => 'Sucesso ao assinar!']);
    }

}
