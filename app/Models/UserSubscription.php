<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_price_id',
        'start_at',
        'expire_at'
    ];

    protected $appends = [
        'status'
    ];

    public function planPrice()
    {
        return $this->belongsTo(PlanPrice::class);
    }

    public function getStatusAttribute()
    {
        if (now()->isAfter($this->expire_at)) {
            return 'expired';
        } else if (now()->isAfter($this->start_at)) {
            return 'active';
        }
    }

}
