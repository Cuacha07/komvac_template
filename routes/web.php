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

//Index
Route::get('/', function () { return view('welcome'); });

//Auth Routes
Auth::routes();

//User Home/Dashboard
Route::get('/home', 'HomeController@index');

//CMS
Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {

    //Auth Routes
    Route::get('/',      ['as' => 'admin.home',   'uses' => 'Cms\AdminController@home']);
    Route::get('login',  ['as' => 'admin.login',  'uses' => 'Cms\Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'admin.login',  'uses' => 'Cms\Auth\LoginController@login']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Cms\Auth\LoginController@logout']);

    // Password reset link request routes & Password reset routes
    Route::get('password/email',         ['as' => 'admin.recover-password', 'uses' => 'Cms\Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',        ['as' => 'admin.recover-password', 'uses' => 'Cms\Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'admin.reset-password',   'uses' => 'Cms\Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',        ['as' => 'admin.reset-password',   'uses' => 'Cms\Auth\ResetPasswordController@reset']);

    //User Password Update link (NO LO EH CHECADO!!!!)
    Route::get('users/update-my-password',   ['as' => 'admin.users.update-my-password', 'uses' => 'Cms\UserController@editMyPassword']);
    //Route::put('users/update-my-password',   ['as' => 'admin.users.update-my-password', 'uses' => 'Cms\UserController@updateMyPassword']);

    //User Module
    Route::get('users',   ['as' => 'admin.users.index', 'uses' => 'Cms\UserController@index']);
});