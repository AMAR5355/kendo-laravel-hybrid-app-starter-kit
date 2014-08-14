<?php
namespace Api\User;

class RegisterController extends \BaseController {

	public function postRegister()
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
}