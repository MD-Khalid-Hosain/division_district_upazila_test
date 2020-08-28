<?php

use Illuminate\Support\Facades\Route;



/*==========Resource Controllers Strat==========*/
Route::resource('division','DivisionController');
Route::resource('district','DistrictController');
Route::resource('upazila','UpazilaController');
/*==========Resource Controllers Strat==========*/
//ajax route
Route::post('get/city/list','UpazilaController@get_city_list');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
