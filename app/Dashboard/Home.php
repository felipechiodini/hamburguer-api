<?php

namespace App\Dashboard;

use App\Models\Order;
use App\Models\UserStore;

class Home {

    private $store;

    private function __construct($store)
    {
        $this->store = UserStore::find($store);
    }

    public static function store($store)
    {
        return new static($store);
    }

    public function get()
    {
        return [
            'store_status' => $this->store->isOpen(),
            'charts' => [
                $this->ordersToday()
            ]
        ];
    }

    public function ordersToday()
    {
        $rows = Order::where('user_store_id', $this->store->id)
            ->get();

        $chartOptions = [
            'name' => 'Masculino / Feminino',
            'config' => [
                'width' => 300,
                'type' => 'pie'
            ],
            'options' => [
                'labels' => $rows->pluck('gender')
            ],
            'series' => $rows->pluck('quantity')
        ];

        return $chartOptions;
    }

}
