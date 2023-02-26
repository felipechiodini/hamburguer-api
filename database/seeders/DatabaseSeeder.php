<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\UserStore::factory(10)->create();
        \App\Models\StoreCard::factory(10)->create();
        \App\Models\StoreCustomer::factory(10)->create();
        \App\Models\StoreOrder::factory(30)->create();
    }
}
