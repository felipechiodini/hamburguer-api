<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Subscription\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_price_id' => 'required|exists:plan_prices,id',
            'name' => 'required',
            'email' => 'required',
            'cellphone' => 'required',
            'password' => 'required',
            'token' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'cellphone' => $request->cellphone,
                'password' => bcrypt($request->password)
            ]);

            Subscription::user($user)
                ->planPrice($request->plan_price_id)
                ->subscribe($request->token);

            DB::commit();

            return response()->json(['message' => 'Sucesso ao assinar!']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
