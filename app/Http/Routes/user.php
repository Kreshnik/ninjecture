<?php

Route::get('users', ['as' => 'user.list', 'uses' => 'UserController@index']);
Route::post('users/add', ['as' => 'user.list', 'uses' => 'UserController@store']);
