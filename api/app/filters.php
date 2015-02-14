<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
	Log::info('before', func_get_args());
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if(Auth::check()) {
		// $authToken = AuthToken::create(Auth::user());
		// $publicToken = AuthToken::publicToken($authToken);
	}
	if (!Auth::check()) {
		return Redirect::to('/login');
	}
});

Route::filter('auth.token', function()
{
	$token = App::make('user\Contracts\Token', [
		'token' => Input::get('token', Request::header('X-Token'))
	]);

	$user = $token->getUser();
	
	if(!$user) {
		return Response::json([
			'error_code' => 1,
			'error' => 'Not Authorized'
		], 401);
	}
	else {
		Auth::setUser($user);	
	}
});

Route::filter('auth.token.injection', function(Routing_Route $route, Http_Request $request, Http_JsonResponse $response)
{
	$token = App::make('user\Contracts\Token');

	//-- Merge existing data with new data with token
	$data = $response->getData(true);
	$data = array_merge($data, [
		'token' => $token->encode()
	]);

	$response->setData($data);
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Event::listen('auth.token.valid', function($user)
{
	// echo 'auth.token.valid';
	//Token is valid, set the user on auth system.
	Log::error('auth.token.valid');
	Log::error($user);
	Auth::setUser($user);
});

Event::listen('auth.token.created', function($user, $token)
{
	// echo 'auth.token.created';
	// $user->load('relation1', 'relation2');
	Log::error('auth.token.created');
});
