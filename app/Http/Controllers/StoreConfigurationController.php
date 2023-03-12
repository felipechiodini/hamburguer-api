<?php

namespace App\Http\Controllers;

use App\Models\StoreConfiguration;
use App\Models\UserStore;
use Illuminate\Http\Request;

class StoreConfigurationController extends Controller
{

    public function get(Request $request)
    {
        $configuration = StoreConfiguration::where('user_store_id', $request->header(UserStore::HEADER_KEY))
            ->first();

        return response()->json($configuration);
    }

    public function updateOrCreate(Request $request)
    {
        StoreConfiguration::updateOrCreate([
            'user_store_id' => $request->header(UserStore::HEADER_KEY),
            'warning' => $request->input('warning'),
            'allow_withdrawal' => $request->input('allow_withdrawal'),
            'withdrawal_time' => $request->input('withdrawal_time'),
            'delivery_time' => $request->input('delivery_time'),
            'minimum_order_value' => $request->input('minimum_order_value'),
        ]);

        return response()->json(['message' => 'Configurações salvas com sucesso!']);
    }

}
