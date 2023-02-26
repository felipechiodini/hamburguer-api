<?php

namespace Database\Factories;

use App\Models\StoreCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreOrderFactory extends Factory
{

    public function definition()
    {
        return [
            'store_card_id' => StoreCard::all('id')->random()->id,
            'store_customer_id' => null,
            'type' => 'balcony',
            'status' => 'pending',
        ];
    }

}
