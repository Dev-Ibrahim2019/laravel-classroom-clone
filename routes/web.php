<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('classrooms')->as('classrooms.')->group(function () {
        Route::get('trashed', [ClassroomController::class, 'trashed'])->name('trashed');
        Route::put('trashed/{classroom}', [ClassroomController::class, 'restore'])->name('restore');
        Route::delete('trashed/{classroom}', [ClassroomController::class, 'forceDelete'])->name('force-delete');

        Route::get('{classroom}/join', [JoinClassroomController::class, 'create'])
            ->middleware('signed')
            ->name('join');
        Route::post('{classroom}/join', [JoinClassroomController::class, 'store'])
            ->name('store-join');
    });

    Route::resource('/classrooms', ClassroomController::class);
});

require __DIR__ . '/auth.php';
