<?php

namespace App\Subscription;

class Braintree {

    public function gateway()
    {
        return new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    public function token()
    {
        return $this->gateway()
            ->clientToken()
            ->generate();
    }

    public function subscribe($token, $planId)
    {
        return $this->gateway()->subscription()->create([
            'paymentMethodToken' => $token,
            'planId' => $planId
        ]);
    }

    public function getCustomer($id)
    {
        return $this->gateway()
            ->customer()
            ->find($id);
    }

}
