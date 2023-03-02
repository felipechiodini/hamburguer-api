<?php

namespace App\Product;

use App\Models\Product;

class CalculatePriceProduct {

    private $product;
    private $additionals = [];

    private function __construct(Product $product)
    {
        $this->product = $product;
    }

    public static function product(Product $product)
    {
        return new static($product);
    }

    public function getPrice()
    {
        $price = $this->price();

        if ($price->promotions !== null) {
            foreach ($price->promotions as $promotion) {
                if (now()->between($promotion->start_date, $promotion->end_date)) {
                    $price = $promotion;
                }
            }
        }

        if ($this->hasAdditionals()) {
            foreach ($this->additionals as $additional) {
                $price->value = $price->value + ($additional->value * $additional->times);
            }
        }

        return $price->value;
    }

    public function additional($additionals, $times = 1)
    {
        $additional = $this->product
            ->additionals
            ->find($additionals);

        $additional->times = $times;

        array_push($this->additionals, $additional);

        return $this;
    }

    public function hasAdditionals()
    {
        return count($this->additionals);
    }

    private function price()
    {
        foreach ($this->product->prices as $price) {
            if (now()->between($price->start_date, $price->end_date)) {
                return $price;
            }
        }
    }

}
