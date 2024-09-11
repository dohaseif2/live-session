<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// web.php
Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create.form');
Route::post('/meetings/create', [MeetingController::class, 'createMeeting'])->name('meetings.create');
Route::delete('meetings/{id}', [MeetingController::class, 'destroy'])->name('meetings.destroy');
Route::get('/meetings/{id}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');
Route::put('/meetings/{id}', [MeetingController::class, 'update'])->name('meetings.update');
Route::get('/meetings/{id}/view', [MeetingController::class, 'viewMeeting'])->name('meetings.view');
Route::get('/meetings/{id}/view-gest', [MeetingController::class, 'viewGestMeeting'])->name('meetings.view.gest');

