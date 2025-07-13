<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\NotificationController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
})->name('home');

Route::get('/hello', function () {
	return 'Hello World';
});

Route::get('/send-notification', [NotificationController::class, 'send']);

Route::resource('classrooms', ClassroomController::class);
