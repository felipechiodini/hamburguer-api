<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSchedule extends Model
{
    use HasFactory;

    protected $fillalbe = [
        'week_day',
        'open_at',
        'close_at',
        'closed'
    ];

}
