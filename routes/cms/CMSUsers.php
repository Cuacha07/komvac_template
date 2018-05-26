<?php

//User Module
Route::get('users',   ['as' => 'admin.users.index', 'uses' => 'Cms\UserController@index']);

//Ajax Routes
Route::group(['middleware' => ['ajax']], function () {
    Route::get('users/get',       ['as' => 'admin.users.get',      'uses' => 'Cms\UserController@getUsers']);
    Route::post('users/set',      ['as' => 'admin.users.set',      'uses' => 'Cms\UserController@setUser']);
    Route::post('users/update',   ['as' => 'admin.users.update',   'uses' => 'Cms\UserController@updateUser']);
    Route::post('users/password', ['as' => 'admin.users.password', 'uses' => 'Cms\UserController@updatePassword']);
    Route::get('users/delete',    ['as' => 'admin.users.delete',   'uses' => 'Cms\UserController@deleteUser']);
    Route::get('users/block',     ['as' => 'admin.users.block',    'uses' => 'Cms\UserController@toggleBlock']);
});
