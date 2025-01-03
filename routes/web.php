<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Company\Auth\CompanyLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RatingController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/info', function () {
    return view('info');
});

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');


Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::resource('/vacatures', VacatureController::class);
Route::get('/vacatures/{vacature}/preview', [VacatureController::class, 'preview'])->name('vacatures.preview');
Route::post('/vacatures/{vacature}/publish', [VacatureController::class, 'publish'])->name('vacatures.publish');

Route::delete('/sollicitatie/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

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

    Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [CompanyDashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile/{company}', [CompanyDashboardController::class, 'update'])->name('update');
    Route::post('/{vacature}/toggle-visibility', [CompanyDashboardController::class, 'openCloseVacature'])->name('toggleVisibility');
    Route::delete('/{application}/rejectApplicant', [CompanyDashboardController::class, 'rejectApplicantForDemands'])->name('rejectApplicant');
    Route::post('/{vacature}/acceptApplicants', [CompanyDashboardController::class, 'acceptApplicants'])->name('acceptApplicants');
    Route::post('/{invitation}/acceptNewDate', [CompanyDashboardController::class, 'acceptNewDate'])->name('acceptNewDate');
    Route::post('/{invitation}/chooseNewDate', [CompanyDashboardController::class, 'chooseNewDate'])->name('chooseNewDate');
    Route::delete('/{invitation}/removeApplicantFromList', [CompanyDashboardController::class, 'removeApplicantFromList'])->name('removeApplicantFromList');
});


Route::get('/invitations/{hash}/{invitation}', [InvitationController::class, 'show'])->name('invitations.show');
Route::post('/invitations/{hash}/{invitation}/acceptInvitation', [InvitationController::class, 'acceptInvitation'])->name('invitations.acceptInvitation');
Route::post('/invitations/{hash}/{invitation}/declineInvitation', [InvitationController::class, 'declineInvitation'])->name('invitations.declineInvitation');
Route::post('/invitations/{hash}/{invitation}/changeInvitation', [InvitationController::class, 'changeInvitation'])->name('invitations.changeInvitation');


Route::resource('vacatures', VacatureController::class);
Route::resource('applications', ApplicationController::class);
Route::patch('vacatures', [VacatureController::class, 'filter'])->name('vacatures.filter');

Route::prefix('ratings')->name('ratings.')->group(function () {
    Route::get('/create/{vacature}', [RatingController::class, 'create'])->name('create');
    Route::post('/store/{vacature}', [RatingController::class, 'store'])->name('store');
    Route::get('/{rating}/edit', [RatingController::class, 'edit'])->name('edit');
    Route::put('/{rating}', [RatingController::class, 'update'])->name('update');
    Route::delete('/{rating}', [RatingController::class, 'destroy'])->name('destroy');
});


require __DIR__ . '/auth.php';
