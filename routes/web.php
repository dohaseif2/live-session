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
