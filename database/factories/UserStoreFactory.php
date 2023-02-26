<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserStoreFactory extends Factory
{

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->word()
        ];
    }

}
