<?php
namespace User;

class RegisterController extends \BaseController {

	/**
	 * Setup the registration view
	 * @return Illuminate\View\View
	 */
	public function showRegister() {
		return \View::make('user.register');
	}

	/**
	 * Get the validation rules
	 * @return array
	 */
	public function getRules() {
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'password' => 'required',
			'email' => 'required|email'
		];
	}

	/**
	 * Validate allowed input
	 * @return boolean
	 */
	public function isValid() {
		$validator = \Validator::make($this->getAllowedInput(), $this->getRules());
		if ($validator->fails()) {
			return \Redirect::to('/register')->withErrors($validator)->withInput();
		} else {
			return true;
		}
	}

	/**
	 * Get the allowed input when posted
	 * @return array
	 */
	public function getAllowedInput() {
		return \Input::only(
						'first_name', 'last_name', 'email', 'password'
		);
	}

	/**
	 * Try to register the user
	 * @param array $data
	 * @return boolean|\Cartalyst\Sentry\Users\Eloquent\User
	 */
	public function addUser($data) {
		try {
			return \Sentry::register($data, true);
		} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
			\Session::flash('errors', array('email' => array('An email address is required.')));
		} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
			\Session::flash('errors', array('password' => array('A password is required.')));
		} catch (Cartalyst\Sentry\Users\UserExistsException $e) {
			\Session::flash('errors', array('email' => array('A user with this email address already exists.')));
		}
		return false;
	}
	
	/**
	 * Log the registered user in and redirect to the dashboard.
	 * @param \Cartalyst\Sentry\Users\Eloquent\User $user
	 * @return type
	 */
	public function loginUser(\User $user) {
		\Auth::login($user);
		return \Redirect::to('user/dashboard');
	}

	/**
	 * Register a user
	 * @return \Illuminate\Support\Facades\Redirect
	 */
	public function doRegister() {
		$valid = $this->isValid();
		if ($valid === true) {
			$user = \User::create($this->getAllowedInput());
			if ($user === false) {
				return \Redirect::to('/register')->withErrors($this->setupErrors())->withInput();
			} else {
				return $this->loginUser($user);
			}
		}
		return $valid;
	}
}