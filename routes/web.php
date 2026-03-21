<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('Admin page coming soon');
});

Route::get('/user', function () {
    return view('welcome');
});