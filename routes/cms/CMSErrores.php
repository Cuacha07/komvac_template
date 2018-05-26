<?php

//Errores Module
Route::get('errores',   ['as' => 'admin.errores.index', 'uses' => 'Cms\ErroresController@index']);

//Ajax Routes
Route::group(['middleware' => ['ajax']], function () {
    Route::get('errores/get',  ['as' => 'admin.errores.get', 'uses' => 'Cms\ErroresController@getLogErrores']);
});