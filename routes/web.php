<?php

use Illuminate\Support\Facades\Route;

// Dependencies to handle forms
use Illuminate\Http\Request;
use App\Models\Timeslot;
use App\Models\Employee;
// use App\Models\EmployeeTimeslot;


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
    return view('user');
});


Route::post('/admin/timeslot', function (Request $request) {

    Timeslot::create([
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    return back(); // reloads the page
});

Route::post('/admin/employee', function (Request $request) {
    Employee::create([
        'full_name' => $request->full_name,
        'position' => $request->position,
    ]);

    return back();
});


use App\Models\EmployeeTimeslot;
Route::post('/admin/assign', function (Request $request) {
    // dd($request->all());
    EmployeeTimeslot::create([
        'timeslot_id' => $request->timeslot_id,
        'employee_id' => $request->employee_id,
        'queue_position' => $request->queue_position,
        'is_assigned' => false,
    ]);

    return back();
});
