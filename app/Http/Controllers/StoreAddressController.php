<?php

namespace App\Http\Controllers;

use App\Models\StoreAddress;
use Illuminate\Http\Request;

class StoreAddressController extends Controller
{

    public function store(Request $request)
    {
        StoreAddress::updateOrCreate($request->only('number, street', 'city', 'state'));
    }

}
