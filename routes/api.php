<?php

use Illuminate\Http\Request;

Route::post('v1/login', 'UserController@login');

//User authentication
Route::group(['prefix' => 'v1', 'middleware' => 'user.auth'], function() {	
	Route::get('me', 'UserController@info');
	Route::put('me', 'UserController@update');
	Route::get('logout', 'UserController@logout');
});
