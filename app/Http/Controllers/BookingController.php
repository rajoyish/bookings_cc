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
use App\Models\Employee;

class BookingController extends Controller
{
    public function __invoke()
    {
        # Year Slots
        // $slots = CarbonInterval::days(1)
        //     ->toPeriod(now(), now()->addYear());

        $schedule = Schedule::find(2);
        $service = Service::find(1);

        $employee = Employee::find(1);

        $slots = $employee->availableTimeSlots($schedule, $service);


        // dd($slots);

        return view('bookings.create', [
            'slots' => $slots
        ]);
    }
}
