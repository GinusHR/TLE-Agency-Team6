<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacatureController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/vacatures', VacatureController::class);
Route::post('/vacatures', [VacatureController::class, 'store'])->name('vacatures.store');
Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('vacatures', VacatureController::class);
Route::patch('vacatures.filter', [VacatureController::class, 'filter'])->name('vacatures.filter');

require __DIR__.'/auth.php';
