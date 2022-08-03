<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Bookings\TimeSlotGenerator;
use App\Bookings\Filters\SlotsPassedTodayFilter;

class BookingController extends Controller
{
    public function __invoke()
    {
        # Year Slots
        // $slots = CarbonInterval::days(1)
        //     ->toPeriod(now(), now()->addYear());

        $schedule = Schedule::find(2);
        $service = Service::find(2);

        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters(
                [new SlotsPassedTodayFilter()]
            )
            ->get();


        // dd($slots);

        return view('bookings.create', [
            'slots' => $slots
        ]);
    }
}
