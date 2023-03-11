<?php

class Waiter {

    private $waiter;
    private $start;
    private $end;

    private function __construct($waiter)
    {
        $this->waiter = $waiter;
    }

    public static function waiter(Waiter $waiter)
    {
        return new static($waiter);
    }

    public function startPeriod($start)
    {
        $this->start = $start;
    }

    public function endPeriod($end)
    {
        $this->end = $end;
    }

    public function period($start = null, $end = null)
    {
        $this->startPeriod($start);
        $this->endPeriod($end);
    }

    public function subOrders()
    {
        return $this->waiter
            ->subOrders()
            ->where('created_at', '>', $this->start)
            ->where('created_at', '<', $this->end);
    }

    public function OrdersCount()
    {
        return $this->subOrders()
            ->count();
    }

    public function revenue()
    {
        $total = 0;

        foreach ($this->subOrders() as $subOrder) {
            $total = $total + $subOrder->total();
        }

        return $total;
    }


}
