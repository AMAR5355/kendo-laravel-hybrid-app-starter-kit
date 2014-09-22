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
//-- Unprotected API Routes --------------------------------------------------------
//-- Is Logged In?
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
//-- Register
Route::post('api/user/register', 'Api\UserController@register');
//-- Login
Route::post('api/user/login', 'Tappleby\AuthToken\AuthTokenController@store');
//-- Logout
Route::delete('api/user/logout', 'Tappleby\AuthToken\AuthTokenController@destroy');
//-- Forgot Password
Route::post('api/user/forgot-password', 'Api\UserController@forgotPassword');

//-- Protected Routes ----------------------------------------------------------
Route::group(array('prefix' => 'api', 'before' => 'auth.token'), function() {
	Route::get('/', function() {
		return "Protected resource";
	});

	//-- Other protexted routes here...

	//-- JWT Examples
	Route::get('/jwt', function() {
		$authToken = AuthToken::create(Auth::user());
		$publicToken = AuthToken::publicToken($authToken);

		$test = Session::get('test');

		$userData = array_merge(
		  Auth::user()->toArray(),
		  array('auth_token' => $publicToken)
		);

		return Response::json([
			'userData' => $userData, 
			'token' => $publicToken, 
			'test' => $test,
			'authToken' => $authToken->toArray()
		]);
	});
	Route::post('/jwt', function() {
		$authToken = AuthToken::create(Auth::user());
		$publicToken = AuthToken::publicToken($authToken);

		$test = Session::put('test', '23');

		$userData = array_merge(
		  Auth::user()->toArray(),
		  array('auth_token' => $publicToken)
		);

		return Response::json([
			// 'userData' => $userData, 
			'token' => $publicToken,
			'test' => $test,
			// 'authToken' => $authToken->toArray()
		]);
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