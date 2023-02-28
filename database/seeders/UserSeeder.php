<?php

namespace Database\Seeders;

use App\Models\OrderPayment;
use App\Models\StoreCard;
use App\Models\StoreCustomer;
use App\Models\StoreOrder;
use App\Models\StoreWaiter;
use App\Models\User;
use App\Models\UserStore;
use App\Models\UserSubscription;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::factory()
            ->times(30)
            ->has(
                UserStore::factory()
                    ->has(StoreCustomer::factory()->count(30), 'customers')
                    ->has(StoreWaiter::factory()->count(10), 'waiters')
                    ->has(StoreCard::factory()->count(20), 'cards')
                    ->has(StoreOrder::factory()->has(OrderPayment::factory()->count(1), 'payment')->count(50), 'orders')
            ->count(2), 'stores')
            ->has(UserSubscription::factory()->count(1), 'subscription')
            ->create();
    }

}
