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

    public function registerCustomer($user)
    {
        return $this->gateway()->customer()->create([
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
            'email' => 'mike.jones@example.com',
            'phone' => '281.330.8004',
            'fax' => '419.555.1235',
            'website' => 'http://example.com'
        ]);
    }

}
