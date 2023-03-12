<?php

namespace Database\Seeders;

use App\Models\StoreConfiguration;
use App\Models\UserStore;
use Illuminate\Database\Seeder;

class StoreConfigurationSeeder extends Seeder
{

    public function run()
    {
        UserStore::each(function(UserStore $store) {
            StoreConfiguration::create([
                'user_store_id' => $store->id,
                'warning' => 'warning',
                'allow_withdrawal' => 'allow_withdrawal',
                'withdrawal_time' => 'withdrawal_time',
                'delivery_time' => 'delivery_time',
                'minimum_order_value' => 'minimum_order_value',
            ]);
        });
    }

}
