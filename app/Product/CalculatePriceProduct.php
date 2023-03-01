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

    public function getCurrentPrice()
    {
        return $this->product->prices[0]->value;
    }

}
