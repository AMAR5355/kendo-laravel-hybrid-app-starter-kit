<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//------------------------------------------------------------------------------
//-- Web API Routes
//------------------------------------------------------------------------------
Route::group(array('prefix' => 'api/v1'), function() {
	//-- Token Management
	Route::get('token/authorize', 'TokenController@authorized');
	Route::match(['GET', 'POST'], 'token/generate', 'TokenController@generate');

	//-- Tokenized Routes ----------------------------------------------------------
	Route::group(['after' => 'auth.token.injection'], function (Illuminate\Routing\Router $router) {
		Route::group(['prefix' => 'user', 'namespace' => 'Api'], function () {
			Route::post('register', 'UserController@register');
			//-- Login
			Route::post('login', 'UserController@login');
			//-- Logout
			Route::delete('logout', 'UserController@logout');
			//-- Forgot Password
			Route::post('forgot-password', 'UserController@forgotPassword');
		});
	});

	//-- Protected Routes ----------------------------------------------------------
	Route::group(['before' => 'auth.token', 'after' => 'auth.token.injection'], function (Illuminate\Routing\Router $router) {
		Route::group(['prefix' => 'user', 'namespace' => 'Api'], function () {
			Route::get('user', 'UserController@user');
		});
	});
});

//------------------------------------------------------------------------------
//-- Website Routes
//------------------------------------------------------------------------------
// Controller-less route
Route::get('/', function()
{
	return View::make('hello');
});
//-- Register
Route::get('register', 'User\RegisterController@showRegister');
Route::post('register', 'User\RegisterController@doRegister');

//-- Login
Route::get('login', 'User\LoginController@showLogin');
Route::post('login', 'User\LoginController@doLogin');

//-- Logout
Route::get('logout', 'User\LogoutController@doLogout');

//-- Remind Password
Route::get('remind', 'RemindersController@getRemind');
Route::post('remind', 'RemindersController@postRemind');

//-- Reset Password
Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('password/reset', 'RemindersController@postReset');

//-- Contact Us
Route::group(array('prefix' => 'contact-us'), function()
{
	Route::get('/', 'ContactController@index');
	Route::post('/', 'ContactController@process');
	Route::get('/thank-you', 'ContactController@thankYou');
});

Route::resource('contacts', 'ContactsController');

//-- Group them with relative user & protect
Route::group(array('prefix' => 'user', 'before' => 'auth'), function()
{
		Route::get('dashboard', 'User\DashboardController@showDashboard');
});