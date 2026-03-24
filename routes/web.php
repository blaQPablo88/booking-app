<?php

use Illuminate\Support\Facades\Route;

// Web controllers
use App\Http\Controllers\PageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;


// ──────────────────────────────────────────────────────────────
//                      PAGES
// ──────────────────────────────────────────────────────────────

Route::get('/', [PageController::class, 'home']);
Route::get('/admin', [PageController::class, 'admin']);
Route::get('/user', [PageController::class, 'user']);


// ──────────────────────────────────────────────────────────────
//                      Booking
// ──────────────────────────────────────────────────────────────

// Using a controller for better separation of concerns
Route::post('/book', [BookingController::class, 'store']);


/*
|──────────────────────────────────────────────────────────────
|                      ADMIN ROUTES
|             These routes handle admin actions
|──────────────────────────────────────────────────────────────
*/

// Delete a booking by id
Route::delete('/admin/booking/{id}', [AdminController::class, 'deleteBooking']);

// Create a new timeslot
Route::post('/admin/timeslot', [AdminController::class, 'storeTimeslot']);

// Add a new employee
Route::post('/admin/employee', [AdminController::class, 'storeEmployee']);

// Assign an employee to a specific timeslot
Route::post('/admin/employee-timeslot', [AdminController::class, 'assignEmployeeToTimeslot']);