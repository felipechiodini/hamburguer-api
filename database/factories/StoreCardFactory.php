<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreCardFactory extends Factory
{

    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(100,999),
        ];
    }

}
