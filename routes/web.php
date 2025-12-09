<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;

// ======================
// LANDING PAGE
// ======================
Route::get('/', function () {
    return view('landing_page');
})->name('landing');


// ======================
// LOGIN & REGISTER PAGE
// ======================
Route::view('/seeker_login', 'seeker_login')->name('seeker.login');
Route::view('/seeker_register', 'seeker_register')->name('seeker.register');

Route::view('/employer_login', 'employer_login')->name('employer.login');
Route::view('/employer_register', 'employer_register')->name('employer.register');


// ======================
// AUTH PROCESS
// ======================
Route::post('/register-seeker', [AuthController::class, 'registerSeeker']);
Route::post('/register-company', [AuthController::class, 'registerCompany']);

Route::post('/login-seeker', [AuthController::class, 'loginSeeker']);
Route::post('/login-company', [AuthController::class, 'loginCompany']);


// ======================
// LOGIN WITH GOOGLE
// ======================
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


// ==========================================
// ROLE: PELAMAR
// ==========================================
Route::middleware(['auth', 'role:pelamar'])->group(function () {

    // Profile
    Route::get('/profile_seeker', [ProfileController::class, 'showSeeker'])
        ->name('seeker.profile');

    // Upload photo & CV
    Route::post('/seeker/upload-photo', [ProfileController::class, 'uploadPhoto']);
    Route::post('/seeker/upload-cv', [ProfileController::class, 'uploadCV']);

    // Edit profile
    Route::get('/edit_profile_seeker', [EditProfileController::class, 'editSeeker']);
    Route::post('/edit_profile_seeker/update', [EditProfileController::class, 'updateSeeker']);

    // Saved Jobs (khusus pelamar)
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved.index');
    Route::post('/saved-jobs/{id}', [SavedJobController::class, 'save'])->name('saved.save');
    Route::delete('/saved-jobs/{id}', [SavedJobController::class, 'remove'])->name('saved.remove');
});


// ==========================================
// ROLE: PERUSAHAAN
// ==========================================
Route::middleware(['auth', 'role:perusahaan'])->group(function () {

    // Profile perusahaan
    Route::get('/profile_employer', [ProfileController::class, 'employerProfile'])
        ->name('employer.profile');

    // Upload logo
    Route::post('/company/upload-logo', [ProfileController::class, 'uploadLogo']);

    // Edit profile perusahaan
    Route::get('/edit_profile_employer', [EditProfileController::class, 'editEmployer']);
    Route::post('/edit_profile_employer/update', [EditProfileController::class, 'updateEmployer']);

    // Posting Job
    Route::get('/formpostingjob', [JobListingController::class, 'create']);
    Route::post('/job/store', [JobListingController::class, 'store'])->name('job.store');

    Route::get('/list-jobs', [JobListingController::class, 'index'])->name('job.list');

});


Route::get('/search', [JobListingController::class, 'search'])->name('job.search');

// ======================
// PUBLIC JOB LISTING (guest & auth)
// ======================
Route::get('/job/{id}', [JobListingController::class, 'show'])->name('job.show');

// ======================
// CHANGE PASSWORD (semua role boleh)
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/change_password', [ProfileController::class, 'changePasswordPage']);
    Route::post('/change_password', [ProfileController::class, 'changePassword']);
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});


// ======================
// FORGOT PASSWORD
// ======================
Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->name('password.email');


Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])
    ->name('password.update');
