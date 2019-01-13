<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth']);

//Route('')

Auth::routes(['register' => false]);

// Church member database system
Route::namespace('Membership')->name('membership.')->prefix('membership')->group(function() {
   Route::resource('church', 'ChurchController');

   Route::resource('cell', 'CellController');
});

// Geolocation data
Route::namespace('Data')->group(function() {
    Route::get('regions', 'GeolocationController@getRegions');
    Route::get('provinces/{region}/districts', 'GeolocationController@getProvinces');
    Route::get('districts/{province}/sub-districts', 'GeolocationController@getDistricts');
    Route::get('sub-districts/{district}/postcodes', 'GeolocationController@getSubDistricts');
    Route::get('churches/{district}/cells', 'GeolocationController@getChurches');
});

