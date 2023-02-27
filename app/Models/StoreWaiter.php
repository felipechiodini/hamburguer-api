<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWaiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeStore($query)
    {
        return $query->where(request()->header('X-store-id'));
    }

}
