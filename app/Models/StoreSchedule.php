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
        'close_at'
    ];

    protected $appends = [
        'closed'
    ];

    public function getClosedAttribute()
    {
        return $this->open_at === null && $this->close_at === null;
    }

}
