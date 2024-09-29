<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Create resume routes
Route::middleware(['auth'])->group(function () {
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');
    Route::delete('/resume/{resume}', [ResumeController::class, 'destroy'])->name('resume.destroy');
    Route::get('/resume/{resume}', [ResumeController::class, 'edit'])->name('resume.edit');
    Route::put('/resume/{resume}', [ResumeController::class, 'update'])->name('resume.update');
    Route::get('/resume/{resume}/download', [ResumeController::class, 'download'])->name('resume.download');
});

// User auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
