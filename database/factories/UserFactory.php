<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => 'felipechiodinibona@hotmail.com',
            'cellphone' => $this->faker->phoneNumber(),
            'email_verified_at' => now(),
            'password' => Hash::make('132567'),
            'remember_token' => Str::random(10),
        ];
    }

}
