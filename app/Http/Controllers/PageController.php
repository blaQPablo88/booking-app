<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeslot;
use App\Models\Employee;
use App\Models\Booking;

/**
 * Class PageController
 *
 * Handles rendering of admin and user views with relevant data
 * such as timeslots, employees, and bookings.
 */

class PageController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * Retrieves all timeslots, employees, and bookings with their
     * related employee and timeslot data, then passes them to the
     * 'admin' view.
     *
     * @return \Illuminate\View\View
     */

    public function home() {
        return view('home');
    }

    public function admin() {
        $timeslots = Timeslot::latest()->get();
        $employees = Employee::latest()->get();

        $bookings = Booking::with([
            'employeeTimeslot.employee',
            'employeeTimeslot.timeslot'
        ])->get();

        return view('admin', compact('timeslots', 'employees', 'bookings'));
    }

    public function user() {
        $bookings = Booking::with([
            'employeeTimeslot.employee',
            'employeeTimeslot.timeslot'
        ])->get();

        $timeslots = Timeslot::with('employeeTimeslots.employee')->get();

        $positions = Employee::select('position')
            ->distinct()
            ->pluck('position');

        return view('user', compact('bookings', 'timeslots', 'positions'));
    }
}
