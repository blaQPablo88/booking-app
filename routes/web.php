<?php

use Illuminate\Support\Facades\Route;

// Dependencies to handle forms
use Illuminate\Http\Request;
use App\Models\Timeslot;
use App\Models\Employee;
use App\Models\EmployeeTimeslot;
use App\Models\Booking;
use App\Http\Controllers\BookingController;


// ──────────────────────────────────────────────────────────────
//                      GET methods
// ──────────────────────────────────────────────────────────────

// HOME-CONTROLLER
Route::get('/', function () {
    return view('home');
});
    
// ADMIN-PAGE-CONTROLLER
Route::get('/admin', function () {
    // return view('admin', [
    //     'timeslots' => Timeslot::all(),
    //     'employees' => Employee::all(
    // ]);
        
    $timeslots = Timeslot::all();
    $employees = Employee::all();

    $bookings = Booking::with([
        'employeeTimeslot.employee',
        'employeeTimeslot.timeslot'
    ])->get();

    return view('admin', compact('timeslots', 'employees', 'bookings'));

});

// USER-PAGE-CONTROLLER
Route::get('/user', function () {

    $bookings = Booking::with([
        'employeeTimeslot.employee',
        'employeeTimeslot.timeslot'
    ])->get();

    // $employeeTimeslots = EmployeeTimeslot::with([
    //     'employee',
    //     'timeslot'
    // ])->get();
    $timeslots = Timeslot::with('employeeTimeslots.employee')->get();


    $positions = Employee::select('position')
        ->distinct()
        ->pluck('position');

    return view('user', [
        'bookings' => $bookings,
        'timeslots' => $timeslots,
        'positions' => $positions
    ]);
});



// ──────────────────────────────────────────────────────────────
//                      DELETE methods
// ──────────────────────────────────────────────────────────────

Route::delete('/user/booking/{id}/delete', function ($id) {

    $booking = Booking::findOrFail($id);

    // free up the slot again
    $booking->employeeTimeslot->update([
        'is_assigned' => false
    ]);

    // delete booking
    $booking->delete();

    return back()->with('success', 'Booking cancelled successfully');
});



// ──────────────────────────────────────────────────────────────
//                      Timeslot Routes
// ──────────────────────────────────────────────────────────────

Route::post('/admin/timeslot', function (Request $request) {
    
    // Create timeslot
    Timeslot::create([
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    return back();
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

// Using a controller for better separation of concerns
Route::post('/book', [BookingController::class, 'store']);
