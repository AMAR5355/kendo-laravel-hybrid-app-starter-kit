<?php
namespace Api\User;

class RegisterController extends \BaseController {

	public function postRegister()
	{
		$data = \Input::only(['first_name', 'last_name', 'email', 'password']);
		$requirements = [
			'first_name' => 'required',
			'last_name' => 'required',
			'password' => 'required',
			'email' => 'required'
		];
		$validator = \Validator::make($data, $requirements);
		if (!$validator->fails()) {
			$data['username'] = $data['email'];
			$user = \User::create($data);
			return \Response::json(['success' => true]);
		} else {
			return \Response::json(['success' => false, 'messages' => $validator->messages()]);
		}
	}
}