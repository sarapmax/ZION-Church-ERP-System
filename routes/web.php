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

   Route::resource('user', 'UserController');
});

// Geolocation data
Route::namespace('Data')->group(function() {
    Route::get('provinces', 'GeolocationController@getProvinces');
    Route::get('provinces/{province}/districts', 'GeolocationController@getDistricts');
    Route::get('districts/{district}/churches', 'GeolocationController@getChurches');
    Route::get('churches/{church}/cells', 'GeolocationController@getCells');
    Route::get('districts/{district}/sub-districts', 'GeolocationController@getSubDistricts');
    Route::get('sub-districts/{subDistrict}/postcode', 'GeolocationController@getPostcode');
});

