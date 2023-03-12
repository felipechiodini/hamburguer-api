<?php

namespace App\Http\Controllers;

use App\Dashboard\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function get(Request $request)
    {
        $dashboard = Home::store($request->header('x-store-uuid'))
            ->get();

        return response()->json($dashboard);
    }

}
