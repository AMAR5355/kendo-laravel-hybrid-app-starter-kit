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
// Is Logged In?
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
//-- Register
Route::post('api/user/register', 'Api\User\RegisterController@postRegister');
//-- Login
Route::post('api/user/login', 'Tappleby\AuthToken\AuthTokenController@store');
//-- Logout
Route::delete('api/user/logout', 'Tappleby\AuthToken\AuthTokenController@destroy');
//-- Forgot Password
//-- TODO: This needs to be in its controller not here
Route::post('api/user/forgot-password', function () {
	$response = Password::remind(Input::only('email'), function($message)
	{
	    $message->subject('Password Reminder');
	});

	switch ($response) {
		case Password::REMINDER_SENT:
			$success = true;
			break;
		case Password::INVALID_USER:
			$success = false;
			break;
	}

	if ($success) {
		$message = 'Please check your email for a reset link';
	} else {
		$message = 'No account found matching this email';
	}

	return Response::json(['success' => $success, 'message' => $message]);
});

Route::group(array('prefix' => 'api', 'before' => 'auth.token'), function() {
	Route::get('/', function() {
		return "Protected resource";
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

Event::listen('auth.token.valid', function($user)
{
	// echo 'auth.token.valid';
	//Token is valid, set the user on auth system.
	Auth::setUser($user);
});

Event::listen('auth.token.created', function($user, $token)
{
	// echo 'auth.token.created';
	// $user->load('relation1', 'relation2');
});