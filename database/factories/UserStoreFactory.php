<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserStoreFactory extends Factory
{

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'user_id' => User::all('id')->random()->id,
            'name' => $this->faker->text(15)
        ];
    }

}
