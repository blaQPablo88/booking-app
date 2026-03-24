<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeslot;
use App\Models\Employee;
use App\Models\Booking;
use App\Models\EmployeeTimeslot;


/**
 * Class AdminController
 *
 * Handles administrative actions related to timeslots.
 */

class AdminController extends Controller
{
    /**
     * Store a newly created timeslot in the database.
     *
     * Validates the incoming request to ensure that:
     * - `date` is required and must be a valid date.
     * - `start_time` is required.
     * - `end_time` is required and must be after `start_time`.
     *
     * @param Request $request The HTTP request containing timeslot data.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */

    public function storeTimeslot(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'date'       => 'required|date|after_or_equal:today',
            
        ]);

        Timeslot::create([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Timeslot created');
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->employeeTimeslot) {
            $booking->employeeTimeslot->update([
                'is_assigned' => false
            ]);
        }

        $booking->delete();

        return back()->with('success', 'Booking cancelled');
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        Employee::create($request->only('full_name', 'position'));

        return back()->with('success', 'Employee created');
    }


    public function assignEmployeeToTimeslot(Request $request)
    {
        $request->validate([
            'timeslot_id' => 'required|exists:timeslots,id',
            'employee_id' => 'required|exists:employees,id',
            'queue_position' => 'required|integer|min:1',
        ]);

        EmployeeTimeslot::create([
            'timeslot_id' => $request->timeslot_id,
            'employee_id' => $request->employee_id,
            'queue_position' => $request->queue_position,
            'is_assigned' => false,
        ]);

        return back()->with('success', 'Employee assigned');
    }
}
