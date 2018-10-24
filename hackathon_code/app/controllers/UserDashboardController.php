<?php

class UserDashboardController extends Controller {
    protected function showDashBoard() {
        $issues = DB::table('issues')->select('*')->get();
        return View::make('user_dashboard', array('users' => $issues));
    }
}

?>