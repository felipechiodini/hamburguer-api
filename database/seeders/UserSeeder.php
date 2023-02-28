<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\SubOrder;
use App\Models\User;
use App\Models\UserStore;
use App\Models\UserSubscription;
use App\Models\Waiter;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::factory()
            ->times(30)
            ->has(
                UserStore::factory()
                    ->has(Customer::factory()->count(30), 'customers')
                    ->has(Waiter::factory()->count(10), 'waiters')
                    ->has(Card::factory()->count(20), 'cards')
                    ->has(Order::factory()
                        ->has(OrderPayment::factory()->count(1), 'payment')
                        ->has(SubOrder::factory()->count(3), 'subOrders')
                        ->count(50), 'orders')
            ->count(2), 'stores')
            ->has(UserSubscription::factory()->count(1), 'subscription')
            ->create();
    }

}
