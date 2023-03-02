<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'category_id',
        'name',
        'description'
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

}
