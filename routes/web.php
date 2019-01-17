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

// Church geolocation data
Route::namespace('ChurchStructure')->prefix('church-structure')->group(function() {
    Route::get('provinces', 'ProvinceController@index');
    Route::get('provinces/{province}/districts', 'DistrictController@index');
    Route::get('districts/{district}/churches', 'Churchcontroller@index');
    Route::get('churches/{church}/cells', 'CellController@index');
});

// Geolocation data
Route::namespace('GeolocationData')->prefix('geolocation-data')->group(function() {
    Route::get('provinces', 'GeolocationController@getProvinces');
    Route::get('provinces/{province}/districts', 'GeolocationController@getDistricts');
    Route::get('districts/{district}/sub-districts', 'GeolocationController@getSubDistricts');
    Route::get('sub-districts/{subDistrict}/postcode', 'GeolocationController@getPostcode');
});

