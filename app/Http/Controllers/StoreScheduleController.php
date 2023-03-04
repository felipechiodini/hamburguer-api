<?php

namespace App\Http\Controllers;

use App\Models\StoreSchedule;
use Illuminate\Http\Request;

class StoreScheduleController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'schedules' => 'required|array'
        ]);

        foreach ($request->input('schedules') as $schedule) {
            StoreSchedule::updateOrCreate([
                'week_day' => $schedule->week_day
            ],[
                'closed' => $schedule->closed,
                'open_at' => $schedule->open_at,
                'close_at' => $schedule->close_at
            ]);
        }

        return response()->json(['message' => 'Salvo']);
    }

}
