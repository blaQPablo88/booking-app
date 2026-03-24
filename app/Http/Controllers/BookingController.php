<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeTimeslot;
use App\Models\Booking;

/**
 * Class BookingController
 *
 * Handles booking requests for employee timeslots.
 * Ensures that timeslots are not overbooked by using
 * database transactions and row-level locking.
 */

class BookingController extends Controller
{
    /**
     * Store a new booking.
     *
     * Validates the incoming request, checks for available timeslots,
     * and creates a booking record while marking the timeslot as assigned.
     * Uses a database transaction to ensure atomicity and prevent race conditions.
     *
     * @param \Illuminate\Http\Request $request
     *   The HTTP request containing 'timeslot_id' and 'email'.
     *
     * @return \Illuminate\Http\RedirectResponse
     *   Redirects back with a success message if booking succeeds,
     *   or with an error message if the timeslot is fully booked or another error occurs.
     *
     * @throws \Exception
     *   If no available timeslot is found or transaction fails.
     */

    public function store(Request $request)
    {
        $request->validate([
            'timeslot_id' => 'required|exists:timeslots,id',
            'email' => 'required|email'
        ]);

        try {
            $assignedMechanic = DB::transaction(function () use ($request) {
                $slot = EmployeeTimeslot::where('timeslot_id', $request->timeslot_id)
                    ->where('is_assigned', false)
                    ->orderBy('queue_position')
                    ->lockForUpdate()
                    ->first();

                if (!$slot) {
                    throw new \Exception('Timeslot fully booked');
                }

                $slot->update(['is_assigned' => true]);

                Booking::create([
                    'user_email' => $request->email,
                    'employee_timeslot_id' => $slot->id
                ]);

                return $slot->employee->full_name;   // return name for flash
            });

            return back()->with([
                'success' => 'Booking confirmed!',
                'mechanic' => $assignedMechanic
            ]);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
