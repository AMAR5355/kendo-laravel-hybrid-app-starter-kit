<?php
namespace User;
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 4/18/14
 * Time: 3:55 AM
 */
class LogoutController extends \BaseController
{
    /**
     * Logout a user
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function doLogout() {
        \Auth::logout();
        return \Redirect::to('/login');
    }
}