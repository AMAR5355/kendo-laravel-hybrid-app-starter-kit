<?php
class TokenController extends BaseController
{
	public function authorized()
	{
		$token = App::make('user\Contracts\Token');

		$status = false;
		if ($token->isAuthorize()) {
			$status = true;
		}

		return Response::json([
			'token' => $token->encode(),
			'status' => $status
		]);
	}

	public function generate($uuid = null)
	{
		$token = App::make('user\Contracts\Token');
		if ($uuid === null) {
			$uuid = Input::get('uuid');
		}

		$token->uuid = $uuid;

		//-- Create a place holder device if it does not exist
		$device = Device::firstOrCreate(array('uuid' => $uuid));

		return Response::json([
			'token' => $token->encode(),
			'status' => true
		]);
	}
}
?>