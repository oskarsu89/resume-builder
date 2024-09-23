<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard routes
Route::get('/dashboard', [ResumeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Personal info routes
Route::get('/personal-info', function () {
    return Inertia::render('PersonalInfo/Index');
})->middleware(['auth', 'verified'])->name('personal-info');

// Education routes
Route::get('/education', function () {
    return Inertia::render('Education/Index');
})->middleware(['auth', 'verified'])->name('education');

// Employment history routes
Route::get('/employment-history', function () {
    return Inertia::render('EmploymentHistory/Index');
})->middleware(['auth', 'verified'])->name('employment-history');

// User auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
