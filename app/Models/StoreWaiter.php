<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWaiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('store', function ($query) {
            return $query->where('user_store_id', request()->header(UserStore::HEADER_KEY));
        });
    }

}
