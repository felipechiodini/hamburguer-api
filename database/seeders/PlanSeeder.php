<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create(['name' => 'Básico', 'value' => 10]);
        Plan::create(['name' => 'Avançado', 'value' => 50]);
        Plan::create(['name' => 'Pro', 'value' => 100]);
    }
}
