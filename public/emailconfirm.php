<?php
require_once '../app/core/init.php';
if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
	Redirect::to('./');
}
if (Input::exist('get')) {
	if (!empty(Input::get('email')) && !empty(Input::get('token')) && !empty(Input::get('username'))) {
		$sql = "SELECT count(*) FROM users WHERE email = :email AND token = :token AND username = :username";
		$result = DB::query($sql, ['email' => Input::get('email'), 'token' => Input::get('token'), 'username' => Input::get('username')])->fetch();
		if ($result['count(*)'] == 1) {
			$sql2 = "UPDATE users SET token = NULL, email_verified = 1 WHERE email = :email AND token = :token AND username = :username";
			if (DB::query($sql2, ['email' => Input::get('email'), 'token' => Input::get('token'), 'username' => Input::get('username')])) {
				Session::flash('emailVerifySuc', 'Email Verified<br>Account Application Completed<br>Wait for admin verification');
				Redirect::to('./');
			}
		} else {
			Redirect::to('./');
		}
	} else {
		Redirect::to('./');
	}
} else {
	Redirect::to('./');
}