<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserStoreController extends Controller
{

    public function store(User $user, Request $request)
    {
        UserStore::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Loja criada com sucesso!']);
    }

}
