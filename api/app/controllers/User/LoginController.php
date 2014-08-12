<?php
namespace User;
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 4/18/14
 * Time: 3:55 AM
 */
class LoginController extends \BaseController
{
    /**
     * Setup the login view
     * @return Illuminate\View\View
     */
    public function showLogin()
    {
        return \View::make('user.login');
    }

    /**
     * Get the validation rules
     * @return array
     */
    public function getRules() {
        return [
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
            return \Redirect::to('/login')->withErrors($validator)->withInput();
        } else {
            return true;
        }
    }

    /**
     * Get the allowed input when posted
     * @return array
     */
    public function getAllowedInput()
    {
        return \Input::only('email', 'password', 'remember_me');
    }

    /**
     * Log the registered user in and redirect to the dashboard.
     * @param \Cartalyst\Sentry\Users\Eloquent\User $user
     * @return type
     */
    public function loginUser(\Cartalyst\Sentry\Users\Eloquent\User $user) {
        return \Redirect::to('/user/dashboard');
    }

    /**
     * Login a user
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function doLogin() {
        $valid = $this->isValid();
        if ($valid === true) {
            $data = $this->getAllowedInput();
            $remember_me = !empty($data['remember_me']);
            if (Auth::attempt($data, $remember_me)) {
                return $this->loginUser($user, $remember_me);
            } else {
                return \Redirect::to('/login')->withErrors(\Session::get('errors'))->withInput();
            }
        }
        return $valid;
    }
}