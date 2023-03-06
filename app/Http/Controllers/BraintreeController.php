<?php

namespace App\Http\Controllers;

use App\Subscription\Braintree;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{

    public function token()
    {
        $braintree = new Braintree();
        return response()->json(['token' => $braintree->token()]);
    }

}
