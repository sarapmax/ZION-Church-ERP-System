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
})->middleware(['auth', 'churchMember'])->name('home');

Auth::routes(['register' => false]);

// Church member database system
Route::namespace('Membership')->middleware(['auth', 'churchMember'])->name('membership.')->prefix('membership')->group(function() {
   Route::resource('church', 'ChurchController')->middleware('can:manage-church-structure');
   Route::resource('cell', 'CellController')->middleware('can:manage-church-structure');
   Route::resource('area', 'AreaController')->middleware('can:manage-church-structure');
   Route::resource('member', 'MemberController');
});

// Church financial system
Route::namespace('Finance')->middleware(['auth', 'churchMember'])->name('finance.')->prefix('finance')->group(function() {
   Route::resource('service-round', 'ServiceRoundController')->middleware('can:manage-church-finance');
   Route::resource('offering', 'OfferingController')->middleware('can:manage-church-finance');
});

// Church geolocation data
Route::namespace('ChurchStructure')->prefix('church-structure')->group(function() {
    Route::get('provinces', 'ProvinceController@index');
    Route::get('provinces/{province}/districts', 'DistrictController@index');
    Route::get('districts/{district}/churches', 'ChurchController@index');
    Route::get('churches/{church}/areas', 'AreaController@index');
    Route::get('areas/{area}/cells', 'CellController@index');
});

// Geolocation data
Route::namespace('GeolocationData')->prefix('geolocation-data')->group(function() {
    Route::get('provinces', 'GeolocationController@getProvinces');
    Route::get('provinces/{province}/districts', 'GeolocationController@getDistricts');
    Route::get('districts/{district}/sub-districts', 'GeolocationController@getSubDistricts');
    Route::get('sub-districts/{subDistrict}/postcode', 'GeolocationController@getPostcode');
});

