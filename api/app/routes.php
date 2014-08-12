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

// Controller-less route
Route::get('/', function()
{
	return View::make('hello');
});

// JSON Web Token
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
Route::post('auth', 'Tappleby\AuthToken\AuthTokenController@store');
Route::delete('auth', 'Tappleby\AuthToken\AuthTokenController@destroy');


//-- Register
Route::post('api/user/register', 'Api\User\RegisterController@postRegister');

Route::group(array('prefix' => 'api', 'before' => 'auth.token'), function() {
	Route::get('/', function() {
		return "Protected resource";
	});
}); 

//-- Register
Route::get('register', 'User\RegisterController@showRegister');
Route::post('register', 'User\RegisterController@doRegister');

//-- Login
Route::get('login', 'User\LoginController@showLogin');
Route::post('login', 'User\LoginController@doLogin');

//-- Logout
Route::get('logout', 'User\LogoutController@doLogout');

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

Event::listen('auth.token.valid', function($user)
{
	// echo 'auth.token.valid';
	//Token is valid, set the user on auth system.
	Auth::setUser($user);
});

Event::listen('auth.token.created', function($user, $token)
{
	// echo 'auth.token.created';
	$user->load('relation1', 'relation2');
});