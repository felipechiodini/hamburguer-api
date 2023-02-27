<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\StoreOrder;

class StoreOrderRepository implements OrderRepositoryInterface
{
    private $store;

    public function getAllOrders()
    {
        return StoreOrder::all();
    }

    public function getOrderById($orderId)
    {
        return StoreOrder::findOrFail($orderId);
    }

    public function deleteOrder($orderId)
    {
        StoreOrder::destroy($orderId);
    }

    public function createOrder(array $orderDetails)
    {
        return StoreOrder::create($orderDetails);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return StoreOrder::whereId($orderId)->update($newDetails);
    }

    public function getFulfilledOrders()
    {
        return StoreOrder::where('is_fulfilled', true);
    }
}
