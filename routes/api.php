<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
   ApiController,
};
use Modules\LaravelPreset\Http\Controllers\GeoLocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
});


Route::get('/', [ ApiController::class, 'index']);
Route::get('/geo-locations', [ ApiController::class, 'geoLocations']);

Route::group([
   'prefix' => 'geo'
], function () {
   Route::get('/locations', [ GeoLocationController::class, 'geoQueryLocations']);
   Route::get('/countries/{id?}', [ GeoLocationController::class, 'getCountries']);
   Route::get('/states/{id?}', [ GeoLocationController::class, 'getStates']);
   Route::get('/cities/{id?}', [ GeoLocationController::class, 'getCities']);

});


Route::group([
   'middleware' => [
      \App\Http\Middleware\JwtMiddleware::class
   ]
], function () {
   Route::post('post-requirements/accept', [\App\Http\Controllers\Api\PostRequirementController::class, 'accept']);
   Route::resource('post-requirements', \App\Http\Controllers\Api\PostRequirementController::class);
});

Route::get('/posted-requirements', [\App\Http\Controllers\Api\PostRequirementController::class, 'listPublic']);

