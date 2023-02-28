<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    use HasFactory;

    public const HEADER_KEY = 'X-store-uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'name'
    ];

    public function customers()
    {
        return $this->hasMany(StoreCustomer::class);
    }

    public function orders()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function waiters()
    {
        return $this->hasMany(StoreWaiter::class);
    }

    public function cards()
    {
        return $this->hasMany(StoreCard::class);
    }

}
