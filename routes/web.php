<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Company\Auth\CompanyLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\VacatureController;




Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/vacatures', VacatureController::class);
Route::post('/vacatures', [VacatureController::class, 'store'])->name('vacatures.store');
Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/demands', [ProfileController::class, 'updateDemands'])->name('profile.updateDemands');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('company/login', [CompanyLoginController::class, 'showLoginForm'])->name('company.login');
Route::post('company/login', [CompanyLoginController::class, 'login']);
Route::post('company/logout', [CompanyLoginController::class, 'logout'])->name('company.logout');
Route::middleware('auth:company')->group(function () {
    Route::get('company.dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
    Route::get('/company/profile', [CompanyDashboardController::class, 'profile'])->name('company.profile');
    Route::patch('/company/profile', [CompanyDashboardController::class, 'updateProfile'])->name('company.updateProfile');
});



Route::resource('vacatures', VacatureController::class);

Route::resource('applications', ApplicationController::class);

Route::patch('vacatures.filter', [VacatureController::class, 'filter'])->name('vacatures.filter');

require __DIR__ . '/auth.php';
>>>>>>>>> Temporary merge branch 2
