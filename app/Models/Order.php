<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'store_card_id',
        'store_customer_id',
        'type',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('store', function ($query) {
            return $query->where('store_id', request()->header(UserStore::HEADER_KEY));
        });
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
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
