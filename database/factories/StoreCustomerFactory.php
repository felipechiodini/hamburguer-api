<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreCustomerFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => "{$this->faker->firstName()} {$this->faker->lastName()}",
            'document' => $this->faker->cpf(false),
            'cellphone' => $this->faker->phoneNumber()
        ];
    }

}
