<?php

namespace App\Http\Controllers;

use App\Bookings\Filters\AppointmentFilter;
use App\Models\Service;
use App\Models\Schedule;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Bookings\TimeSlotGenerator;
use App\Models\ScheduleUnavailability;
use App\Bookings\Filters\UnavailabilityFilter;
use App\Bookings\Filters\SlotsPassedTodayFilter;
use App\Models\Appointment;

class BookingController extends Controller
{
    public function __invoke()
    {
        # Year Slots
        // $slots = CarbonInterval::days(1)
        //     ->toPeriod(now(), now()->addYear());

        $schedule = Schedule::find(1);
        $service = Service::find(1);

        $appointments = Appointment::whereDate('date', '2022-07-29')->get();

        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters(
                [
                    new SlotsPassedTodayFilter(),
                    new UnavailabilityFilter($schedule->unavailabilities),
                    new AppointmentFilter($appointments)

                ]
            )
            ->get();


        // dd($slots);

        return view('bookings.create', [
            'slots' => $slots
        ]);
    }
}
