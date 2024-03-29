<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['json.response']], function () {

    // Unauthenticated Routes
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('reset-password', [VerificationController::class, 'sendResetPasswordCode'])->name('password.code.request');
    Route::post('verify-password-code', [VerificationController::class, 'verifyPasswordCode'])->name('verify-password-code');
    Route::post('reset-password-mobile', [PasswordController::class, 'resetPasswordMobile'])->name('password.reset.mobile');
    // Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('resend-verification-email', [VerificationController::class, 'resendVerificationEmail'])->name('verification.resend');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('verify-code', [VerificationController::class, 'verifyCode'])->name('verify-code');
    Route::post('resend-verify-code', [VerificationController::class, 'resendVerifyCode'])->name('resend-verify-code');

    Route::get('/login/{provider}', [SocialController::class,'redirectToProvider'])->where('provider', 'google|facebook');
    Route::get('/login/{provider}/callback', [SocialController::class,'handleProviderCallback'])->where('provider', 'google|facebook');;

    // Get users by their profile type
    Route::get('users/{role_id}', [UserController::class, 'getUsersByRole'] )->where('role_id', '9|18|27|36|45|54|63|72|81|90');


    //Authenticated Routes
    Route::group(['prefix' => 'account',  'middleware' => ['auth:api', 'verified', 'json.response']], function(){

        Route::get('validate', [UserController::class, 'validateUser']);
        Route::get('user/{id}', [UserController::class, 'getUserById'] );

        // Profile update for various profile types
        Route::put('patient/profile/{id}', [PatientController::class, 'update']);
        Route::put('doctor/profile/{id}', [DoctorController::class, 'update']);
        Route::put('pharmacist/profile/{id}', [PharmacistController::class, 'update']);
        Route::put('driver/profile/{id}', [DriverController::class, 'update']);

        //Get Pharmacist around me
        Route::get('pharmacists/nearme', [PharmacistController::class, 'pharmacistNearme']);

        //Get Drivers around me
        Route::get('drivers/nearme', [DriverController::class, 'driverNearme']);
    });

});
