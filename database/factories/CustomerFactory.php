<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'document' => $this->faker->cpf(false),
            'cellphone' => $this->faker->phoneNumber()
        ];
    }

}
