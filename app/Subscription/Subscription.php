<?php

namespace App\Subscription;

use App\Models\PlanPrice;
use App\Models\User;
use Exception;

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

        $response = $braintree->gateway()->customer()->create([
            'firstName' =>  $this->user->first_name,
            'lastName' => $this->user->last_name,
            'email' => $this->user->email,
            'paymentMethodNonce'=> $token
        ]);

        if ($response->success === true) {
            $response = $braintree->subscribe($response->paymentMethods[0]->token, $this->planPrice->plan->braintree_id);

            if ($response->success === true) {
                $this->user->subscription()->create([
                    'plan_price_id' => $this->planPrice->id,
                    'start_at' => now()->toDateTimeString(),
                    'expire_at' => now()->addMonths($this->planPrice->recurrence)->toDateTimeString()
                ]);
            }
        }

        throw new Exception('Falha ao tentar assinar');
    }

}
