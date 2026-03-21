<?php

use Illuminate\Support\Facades\Route;

// Dependencies to handle forms
use Illuminate\Http\Request;
use App\Models\Timeslot;
use App\Models\Employee;
use App\Models\EmployeeTimeslot;
use App\Models\Booking;





// ──────────────────────────────────────────────────────────────
//                      GET methods
// ──────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin', [
        'timeslots' => Timeslot::all(),
        'employees' => Employee::all()
    ]);
});

Route::get('/user', function () {
    return view('user', [
        'employeeTimeslots' => EmployeeTimeslot::with(['employee', 'timeslot'])->get(),
        'bookings' => Booking::all(), 
        'positions' => Employee::select('position')->distinct()->pluck('position')
    ]);
});



// ──────────────────────────────────────────────────────────────
//                      Timeslot Routes
// ──────────────────────────────────────────────────────────────

Route::post('/admin/timeslot', function (Request $request) {
    
    // Create timeslot
    Timeslot::create([
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    return back(); // reloads the page
});


// ──────────────────────────────────────────────────────────────
//                      Employee Routes
// ──────────────────────────────────────────────────────────────

Route::post('/admin/employee', function (Request $request) {
    
    // Create employee
    Employee::create([
        'full_name' => $request->full_name,
        'position' => $request->position,
    ]);

    return back();
});


// ──────────────────────────────────────────────────────────────
//                    Employee Timeslot Rutes
// ──────────────────────────────────────────────────────────────

Route::post('/admin/assign', function (Request $request) {

    // Create employee timeslot
    EmployeeTimeslot::create([
        'timeslot_id' => $request->timeslot_id,
        'employee_id' => $request->employee_id,
        'queue_position' => $request->queue_position,
        'is_assigned' => false,
    ]);

    return back();
});


// ──────────────────────────────────────────────────────────────
//                      Booking Routes
// ──────────────────────────────────────────────────────────────

Route::post('/user/book', function (Request $request) {

    // Validate input
    $request->validate([
        'user_email' => 'required|email',
        'timeslot_id' => 'required'
    ]);

    // Get next available employee in queue
    $employeeSlot = EmployeeTimeslot::where('timeslot_id', $request->timeslot_id)
        ->where('is_assigned', false)
        ->orderBy('queue_position')
        ->first();

    if (!$employeeSlot) {
        return back()->with('error', 'No employees available for this timeslot');
    }

    // Mark employee as assigned
    $employeeSlot->update([
        'is_assigned' => true
    ]);

    // Create booking
    Booking::create([
        'user_email' => $request->user_email,
        'employee_timeslot_id' => $employeeSlot->id
    ]);

    return back()->with('success', 'Booking confirmed!');
});