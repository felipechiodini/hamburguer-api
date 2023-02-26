<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{

    public function definition()
    {
        return [
            'card_id' => Card::all('id')->random()->id,
            'customer_id' => null,
            'type' => 'balcony',
            'status' => 'pending',
        ];
    }

}
