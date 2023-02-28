<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_store_id',
        'number'
    ];
}
