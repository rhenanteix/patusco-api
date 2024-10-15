<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Dashboard');
});

Route::resource('appointments', AppointmentController::class);
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('appointments/{id}/assign-doctor', [AppointmentController::class, 'assignDoctor']);
Route::get('appointments/create', function () {
    return Inertia::render('Appointments/Create');
});

Route::post('appointments', [AppointmentController::class, 'store']);


