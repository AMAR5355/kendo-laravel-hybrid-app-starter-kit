<?php
namespace Api;

use Input;
use Auth;
use Response;
use user\User;
use RegisterModel;

class UserController extends \BaseController {
	function register() {
		$resp = RegisterModel::register(Input::all());

		if ($resp['success'] === true) {
			Auth::setUser($resp['user']);
		}

		return Response::json($resp);
	}

	function login() {
		$email = Input::get('email');
		$password = Input::get('password');
		$resp = ['success' => false, 'message' => null];

		if (Auth::attempt(array('email' => $email, 'password' => $password))) {
			$resp['success'] = true;
			$resp['message'] = '';

			$user = Auth::getUser();

			//-- Token
			$token = App::make('user\Contracts\Token');
			$token->setUserId($user->id);
		}
		else {
			$resp['success'] = false;
			$resp['message'] = 'Invalid email or password';
		}

		return Response::json($resp);
	}

	function forgotPassword() {

		$response = Password::remind(Input::only('email'), function($message)
		{
		    $message->subject('Password Reminder');
		});

		switch ($response) {
			case Password::REMINDER_SENT:
				$success = true;
				$message = 'Please check your email for a reset link';
				break;
			case Password::INVALID_USER:
				$success = false;
				$message = 'No account found matching this email';
				break;
		}

		return Response::json(['success' => $success, 'message' => $message]);
	}
}