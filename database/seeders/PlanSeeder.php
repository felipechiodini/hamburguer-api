<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanPrice;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{

    public function run()
    {
        Plan::create(['name' => 'Básico', 'description' => Lorem::paragraph()]);
        Plan::create(['name' => 'Avançado', 'description' => Lorem::paragraph()]);
        Plan::create(['name' => 'Pro', 'description' => Lorem::paragraph()]);

        PlanPrice::create(['plan_id' => 1, 'recurence' => 1, 'value' => 10]);
        PlanPrice::create(['plan_id' => 2, 'recurence' => 1, 'value' => 50]);
        PlanPrice::create(['plan_id' => 3, 'recurence' => 1, 'value' => 100]);

        PlanPrice::create(['plan_id' => 1, 'recurence' => 6, 'value' => 60]);
        PlanPrice::create(['plan_id' => 2, 'recurence' => 6, 'value' => 300]);
        PlanPrice::create(['plan_id' => 3, 'recurence' => 6, 'value' => 1200]);

        PlanPrice::create(['plan_id' => 1, 'recurence' => 12, 'value' => 120]);
        PlanPrice::create(['plan_id' => 2, 'recurence' => 12, 'value' => 600]);
        PlanPrice::create(['plan_id' => 3, 'recurence' => 12, 'value' => 2400]);
    }

}
