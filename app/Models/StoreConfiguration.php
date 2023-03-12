<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreConfiguration extends Model
{

    protected $fillable = [
        'user_store_id',
        'warning',
        'allow_withdrawal',
        'withdrawal_time',
        'delivery_time',
        'minimum_order_value',
    ];

}
