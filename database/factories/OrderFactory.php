<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{

    public function definition()
    {
        return [
            'store_card_id' => Card::all('id')->random()->id,
            'type' => 'balcony',
            'status' => 'pending',
        ];
    }

}
