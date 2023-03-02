<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPhotoFactory extends Factory
{

    public function definition()
    {
        return [
            'src' => $this->faker->imageUrl(),
            'order' => $this->faker->numberBetween(1, 10)
        ];
    }

}
