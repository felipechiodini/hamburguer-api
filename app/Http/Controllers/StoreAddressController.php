<?php

namespace App\Http\Controllers;

use App\Models\StoreAddress;
use App\Models\UserStore;
use Illuminate\Http\Request;

class StoreAddressController extends Controller
{

    public function get(Request $request)
    {
        $address = StoreAddress::where('user_store_id', $request->header(UserStore::HEADER_KEY))
            ->first();

        return response()->json($address);
    }

    public function updateOrCreate(Request $request)
    {
        StoreAddress::updateOrCreate([
            'user_store_id' => $request->header(UserStore::HEADER_KEY),
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
