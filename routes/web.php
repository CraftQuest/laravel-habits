<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HabitController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('habits.index'));

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('habits', [HabitController::class, 'index'])->name('habits.index');
    Route::post('habits', [HabitController::class, 'store'])->name('habits.store');
    Route::patch('habits/{habit}', [HabitController::class, 'update'])->name('habits.update');
    Route::delete('habits/{habit}', [HabitController::class, 'destroy'])->name('habits.destroy');
    Route::post('habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habits.toggle');
});
