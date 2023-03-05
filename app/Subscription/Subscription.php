<?php

namespace App\Subscription;

use App\Models\PlanPrice;
use App\Models\User;

class Subscription {

    private $user;
    private $planPrice;

    private function __construct($user)
    {
        $this->user = $user;
    }

    public static function user(User $user)
    {
        return new static($user);
    }

    public function planPrice($planPrice)
    {
        $this->planPrice = PlanPrice::find($planPrice);
        return $this;
    }

    public function subscribe($token)
    {
        $braintree = new Braintree();

        $response = $braintree->registerCustomer([
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'cellphone' => $this->user->cellphone,
        ]);

        $response = $braintree->subscribe($token, 'silver_plan');

        if ($response->success === true) {
            $this->user->subscription()->create([
                'plan_price_id' => $this->planPrice->id,
                'start_at' => now()->toDateTimeString(),
                'expire_at' => now()->addMonths($this->planPrice->recurrence)->toDateTimeString()
            ]);
        }
    }

}
