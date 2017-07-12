<?php

//User Module
Route::get('users',   ['as' => 'admin.users.index', 'uses' => 'Cms\UserController@index']);