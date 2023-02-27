<?php

namespace App\Repositories;

use App\Models\StoreWaiter;

class StoreWaiterRepository
{
    public function getAllWaiters()
    {
        return StoreWaiter::store(request()->header('X-store-uuid'))->all();
    }

    public function getWaiterById($WaiterId)
    {
        return StoreWaiter::findOrFail($WaiterId);
    }

    public function deleteWaiter($WaiterId)
    {
        StoreWaiter::destroy($WaiterId);
    }

    public function createWaiter(array $WaiterDetails)
    {
        return StoreWaiter::create($WaiterDetails);
    }

    public function updateWaiter($WaiterId, array $newDetails)
    {
        return StoreWaiter::whereId($WaiterId)->update($newDetails);
    }

    public function getFulfilledWaiters()
    {
        return StoreWaiter::where('is_fulfilled', true);
    }
}
