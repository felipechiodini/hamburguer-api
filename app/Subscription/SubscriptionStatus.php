<?php

namespace App\Subscription;

use App\Models\UserSubscription;

class SubscriptionStatus {

    private $userSubscription;

    private function __construct($userSubscription)
    {
        $this->userSubscription = $userSubscription;
    }

    public static function subscription(UserSubscription $userSubscription)
    {
        return new static($userSubscription);
    }

    public function getStatus()
    {
        if ($this->userSubscription->canceled === true) {
            return 'canceled';
        } else if ($this->userSubscription->start_at === null) {
            return 'pending';
        } else if (now()->isAfter($this->userSubscription->expire_at)) {
            return 'expired';
        } else if (now()->between($this->userSubscription->start_at, $this->userSubscription->expire_at)) {
            return 'active';
        }
    }

    public function isActive()
    {
        return $this->getStatus() === 'active';
    }

    public function isExpired()
    {
        return $this->getStatus() === 'expired';
    }

    public function isPending()
    {
        return $this->getStatus() === 'pending';
    }

    public function isCanceled()
    {
        return $this->getStatus() === 'canceled';
    }

}
