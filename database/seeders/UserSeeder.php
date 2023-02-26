<?php

namespace Database\Seeders;

use App\Models\StoreCustomer;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::factory()
            ->times(30)
            ->has(UserStore::factory()->has(StoreCustomer::factory()->count(10), 'customers')->count(2), 'stores')
            ->create();
    }

}
