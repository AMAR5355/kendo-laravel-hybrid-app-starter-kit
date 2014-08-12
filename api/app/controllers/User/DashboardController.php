<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 4/18/14
 * Time: 4:43 AM
 */

namespace User;


class DashboardController extends \BaseController
{
    /**
     * Setup the dashboard view
     * @return Illuminate\View\View
     */
    public function showDashboard()
    {
        return \View::make('user.dashboard');
    }
}