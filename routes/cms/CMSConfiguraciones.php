<?php

//Configuraciones Module
Route::get('configuraciones',   ['as' => 'admin.configuraciones.index', 'uses' => 'Cms\ConfiguracionesController@index']);

//Ajax Routes
Route::group(['middleware' => ['ajax']], function () {
    // Correo Contacto
    Route::get('configuraciones/get_contacto',  ['as' => 'admin.configuraciones.get_contacto', 'uses' => 'Cms\ConfiguracionesController@getContacto']);
    Route::post('configuraciones/set_contacto', ['as' => 'admin.configuraciones.set_contacto', 'uses' => 'Cms\ConfiguracionesController@setContacto']);

    // Modo Mantenimiento
    Route::get('configuraciones/get_mantenimiento',  ['as' => 'admin.configuraciones.get_mantenimiento', 'uses' => 'Cms\ConfiguracionesController@getMantenimiento']);
    Route::post('configuraciones/set_mantenimiento', ['as' => 'admin.configuraciones.set_mantenimiento', 'uses' => 'Cms\ConfiguracionesController@setMantenimiento']);

    // Login Background Image
    Route::get('configuraciones/get_backgroundlogin',  ['as' => 'admin.configuraciones.get_backgroundlogin', 'uses' => 'Cms\ConfiguracionesController@getBackgroundLogin']);
    Route::post('configuraciones/set_backgroundlogin', ['as' => 'admin.configuraciones.set_backgroundlogin', 'uses' => 'Cms\ConfiguracionesController@setBackgroundLogin']);

    // Temas
    Route::get('configuraciones/get_tema',  ['as' => 'admin.configuraciones.get_tema', 'uses' => 'Cms\ConfiguracionesController@getTema']);
    Route::post('configuraciones/set_tema', ['as' => 'admin.configuraciones.set_tema', 'uses' => 'Cms\ConfiguracionesController@setTema']);
});