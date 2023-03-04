<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'warning',
        'allow_withdrawal'
    ];

}
