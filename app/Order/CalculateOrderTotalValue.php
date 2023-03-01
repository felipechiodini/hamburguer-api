<?php

namespace App\Order;

class CalculateOrderTotalValue {

    private $order;
    private $total = 0;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public static function order($order)
    {
        return new static($order);
    }

    private function sumInTotal($value)
    {
        $this->total = $this->total + $value;
    }

    public function totalValue()
    {
        foreach ($this->order->subOrders as $subOrder) {
            foreach ($subOrder->products as $product) {
                $this->sumInTotal($product->pivot->value * $product->pivot->amount);
            }
        }

        return $this->total;
    }

}
