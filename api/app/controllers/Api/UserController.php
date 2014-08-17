<?php
namespace Api;

use Controller;

class UserController extends Controller {

	public function register()
	{
		$response = \User::createNewUser(
			\Input::only(['first_name', 'last_name', 'email', 'password'])
		);
		$json = ['success' => $response->isSuccessful()];
		if (!$json['success']) {
			$json['messages'] = $response->getMessages();
		}

		return \Response::json($json);
	}

	public function forgotPassword()
	{

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