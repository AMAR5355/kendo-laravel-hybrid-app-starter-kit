<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use RemindableTrait;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = [
		'first_name', 
		'last_name',
		'email',
		'username',
		'password'
	];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public static function validateNewUser($data)
	{
		$requirements = [
			'first_name' => 'required',
			'last_name' => 'required',
			'password' => 'required',
			'email' => 'required'
		];
		$validator = \Validator::make($data, $requirements);

		return $validator;
	}

	/**
	 * Create a new user
	 * @return NewUserResponse
	 */
	public static function createNewUser($data) {
		$validator = self::validateNewUser($data);
		$response = new NewUserResponse();
		$response->validator = $validator;

		if (!$validator->fails()) {
			$data['username'] = $data['email'];
			$user = self::create($data);
			$response->user = $user;
		}

		return $response;
	}
}

class NewUserResponse {
	public $validator;
	public $user;

	public function isSuccessful() {
		return !$this->validator->fails() && $this->user != false;
	}

	public function getMessages() {
		return $this->validator->messages();
	} 
}