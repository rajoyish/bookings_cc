<?php

namespace App\Http\Controllers;

use App\Bookings\TimeSlotGenerator;
use App\Models\Schedule;
use App\Models\Service;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __invoke()
    {
        # Year Slots
        // $slots = CarbonInterval::days(1)
        //     ->toPeriod(now(), now()->addYear());

        $schedule = Schedule::find(3);
        $service = Service::find(2);

        $slots = (new TimeSlotGenerator($schedule, $service))->get();


        // dd($slots);

        return view('bookings.create', [
            'slots' => $slots
        ]);
    }
}
