<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'store_card_id',
        'store_customer_id',
        'type',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('store', function ($query) {
            return $query->where('user_store_id', request()->header(UserStore::HEADER_KEY));
        });
    }

    public function card()
    {
        return $this->belongsTo(StoreCard::class);
    }

    public function subOrders()
    {
        return $this->hasMany(SubOrder::class);
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

}
