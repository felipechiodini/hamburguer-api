<?php

namespace App\Product;

use App\Models\Product;

class CalculatePriceProduct {

    private $product;

    private function __construct(Product $product)
    {
        $this->product = $product;
    }

    public static function product($product)
    {
        return new static($product);
    }

    private function price()
    {
        foreach ($this->product->prices as $price) {
            if (now()->between($price->start_date, $price->end_date)) {
                return $price;
            }
        }
    }

    public function getCurrentPrice()
    {
        $price = $this->price();

        if ($price->promotions !== null) {
            foreach ($price->promotions as $promotion) {
                if (now()->between($promotion->start_date, $promotion->end_date)) {
                    return $promotion->value;
                }
            }
        }

        return $price->value;
    }

}
