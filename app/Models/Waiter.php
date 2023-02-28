<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('store', function ($query) {
            return $query->where('store_id', request()->header(UserStore::HEADER_KEY));
        });
    }

}
