<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Company\Auth\CompanyLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Company\CompanyDashboardController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/vacatures', VacatureController::class);
Route::get('/vacatures/{vacature}/preview', [VacatureController::class, 'preview'])->name('vacatures.preview');
Route::post('/vacatures/{vacature}/publish', [VacatureController::class, 'publish'])->name('vacatures.publish');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/demands', [ProfileController::class, 'updateDemands'])->name('profile.updateDemands');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('company')->name('company.')->group(function () {
    Route::get('login', [CompanyLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CompanyLoginController::class, 'login']);
    Route::post('logout', [CompanyLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:company'])->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [CompanyDashboardController::class, 'profile'])->name('profile');
        Route::patch('/profile/{company}', [CompanyDashboardController::class, 'update'])->name('update');
        Route::post('/{vacature}/toggle-visibility', [CompanyDashboardController::class, 'openCloseVacature'])->name('toggleVisibility');
    });
});


Route::resource('vacatures', VacatureController::class);
Route::resource('applications', ApplicationController::class);
Route::patch('vacatures.filter', [VacatureController::class, 'filter'])->name('vacatures.filter');

require __DIR__ . '/auth.php';
