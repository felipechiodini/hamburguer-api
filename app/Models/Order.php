<?php

namespace App\Models;

use App\Order\CalculateOrderTotalValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'card_id',
        'customer_id',
        'type',
        'status',
    ];

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute()
    {
        return CalculateOrderTotalValue::order($this)->totalValue();
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
