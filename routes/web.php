<?php

use App\Http\Controllers\ProfileController;
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



use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarController;





Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');
});

require __DIR__.'/auth.php';

