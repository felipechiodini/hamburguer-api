<?php

namespace Database\Seeders;

use App\Models\UserStore;
use Illuminate\Database\Seeder;

class UserStoreSeeder extends Seeder
{

    public function run()
    {
        UserStore::create([
            'name' => 'Loja 1'
        ]);
    }

}
