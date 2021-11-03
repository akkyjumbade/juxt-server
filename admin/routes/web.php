<?php

use Illuminate\Support\Facades\Route;

Route::group([
   'prefix' => 'admin',
   'as' => 'admin.',
   'middleware' => [
      'web', 'auth'
   ]
], function () {
   Route::get('/', [\Admin\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [\Admin\Http\Controllers\DashboardController::class, 'profile'])->name('profile');
   Route::get('/inbox', [\Admin\Http\Controllers\DashboardController::class, 'inbox'])->name('inbox');
   Route::get('/edit', [\Admin\Http\Controllers\DashboardController::class, 'editProfile'])->name('edit');
   Route::get('/logout', [\Admin\Http\Controllers\DashboardController::class, 'logout'])->name('logout');

   // Modules specific

   Route::resource('users', \Admin\Http\Controllers\UserController::class);
});
