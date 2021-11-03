<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\Api\OtpController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');


/* JWT Auth */
Route::group([
      'prefix' => 'api',
   ], function() {
   Route::post('/login', [ JWTAuthController::class, 'login' ]);
   Route::group([
      'middleware' => [
         \App\Http\Middleware\JwtMiddleware::class,
      ]
   ], function ( ) {
      Route::get('/me', [ JWTAuthController::class, 'me' ]);
      Route::post('/me/update', [ \App\Http\Controllers\Auth\ProfileController::class, 'update' ]);
      Route::post('/profile', [ \App\Http\Controllers\Auth\ProfileController::class, 'update']);
      Route::post('/address', [ \App\Http\Controllers\Auth\ProfileController::class, 'updateAddress']);
      Route::post('/profile-photo', [ \App\Http\Controllers\Auth\ProfileController::class, 'updateProfilePhoto']);
      Route::get('/notifications', [ \App\Http\Controllers\Auth\ProfileController::class, 'notifications']);
      Route::post('/notifications/mark_as_read', [ \App\Http\Controllers\Auth\ProfileController::class, 'markAsReadNotification']);
   });

   Route::post('/send-otp', [ OtpController::class, 'sendOtp' ]);
});
