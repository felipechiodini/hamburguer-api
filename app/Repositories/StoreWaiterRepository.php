<?php

namespace App\Repositories;

use App\Models\Waiter;

class WaiterRepository
{
    public function getAllWaiters()
    {
        return Waiter::store(request()->header(UserStore::HEADER_KEY))->all();
    }

    public function getWaiterById($WaiterId)
    {
        return Waiter::findOrFail($WaiterId);
    }

    public function deleteWaiter($WaiterId)
    {
        Waiter::destroy($WaiterId);
    }

    public function createWaiter(array $WaiterDetails)
    {
        return Waiter::create($WaiterDetails);
    }

    public function updateWaiter($WaiterId, array $newDetails)
    {
        return Waiter::whereId($WaiterId)->update($newDetails);
    }

    public function getFulfilledWaiters()
    {
        return Waiter::where('is_fulfilled', true);
    }
}
