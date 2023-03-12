<?php

namespace Database\Seeders;

use App\Models\StoreAddress;
use App\Models\UserStore;
use Illuminate\Database\Seeder;

class StoreAddressSeeder extends Seeder
{

    public function run()
    {
        UserStore::each(function(UserStore $store) {
            StoreAddress::create([
                'user_store_id' => $store->id,
                'street' => 'Arthue Gonçalves de Araújo',
                'number' => 500,
                'district' => 'João Pessoa',
                'city' => 'Jaraguá do Sul',
                'state' => 'SC',
            ]);
        });
    }

}
