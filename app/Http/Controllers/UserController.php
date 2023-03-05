<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Subscription\Subscription;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function subscribe(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cellphone' => $request->cellphone
        ]);

        Subscription::user($user)
            ->planPrice($request->plan_price_id)
            ->subscribe($request->token);

        return response()->json(['message' => 'Sucesso ao assinar!']);
    }

}
