<?php

namespace App\Http\Controllers;

use App\Models\StoreSchedule;
use App\Models\UserStore;
use Illuminate\Http\Request;

class StoreScheduleController extends Controller
{

    public function index(Request $request)
    {
        $schedules = StoreSchedule::where('user_store_id', $request->header(UserStore::HEADER_KEY))
            ->get();

        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        foreach ($request->all() as $schedule) {
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
