<?php

namespace App\Http\Controllers;

use App\Models\StoreConfiguration;
use Illuminate\Http\Request;

class StoreConfigurationController extends Controller
{

    public function update(Request $request)
    {
        $request->validate([
            'warning' => 'required'
        ]);

        StoreConfiguration::updateOrCreate([
            'warning' => $request->input('warning'),
            'allow_withdrawal' => $request->input('allow_withdrawal')
        ]);

        return response()->json(['message' => 'Sucesso']);
    }



}
