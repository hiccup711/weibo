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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/help', 'StaticPagesController@help')->name('help');

Route::resource('/users', 'UsersController');

// 激活账号
Route::get('/users/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// 找回密码
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/update', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');