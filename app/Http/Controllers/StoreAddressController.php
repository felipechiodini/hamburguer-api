<?php

namespace App\Http\Controllers;

use App\Models\StoreAddress;
use App\Models\UserStore;
use Illuminate\Http\Request;

class StoreAddressController extends Controller
{

    public function insert(UserStore $userStore, Request $request)
    {
        StoreAddress::updateOrCreate([
            'user_store_id' => $userStore->id,
        ], [
            'street' => $request->street,
            'number' => $request->number,
            'district' => $request->district,
            'city' => $request->city,
            'state' => $request->state
        ]);

        return response()->json(['message' => 'Endereço salvo']);
    }

}
