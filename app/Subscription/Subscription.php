<?php

namespace App\Subscription;

use App\Jobs\ProcessPayment;
use App\Models\PlanPrice;
use App\Models\User;

class Subsctiption {

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

    public function subscribe()
    {
        $this->user->subscription()->create([
            'plan_price_id' => $this->planPrice->id,
            'start_at' => now()->toDateTimeString(),
            'expire_at' => now()->addMonths($this->planPrice->recurrence)->toDateTimeString()
        ]);
    }

}
