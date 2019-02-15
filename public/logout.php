<?php

require_once '../app/core/init.php';

if (Input::exist()) {
	if (Session::exist('u_sess_id')) {
		Session::delete('u_sess_id');
		Session::delete('u_sess_fname');
		Session::delete('u_sess_lname');
		Session::delete('u_sess_username');
		Session::delete('u_sess_profile');
	}
	if (Session::exist('admin_sess_id')) {
		Session::delete('admin_sess_id');
	}
	if (Session::exist('b_sess_id')) {
		Session::delete('b_sess_id');
		Session::delete('b_sess_b_name');
		Session::delete('b_sess_b_username');
		Session::delete('b_sess_profile');
		Session::delete('b_sess_userid');
	}
}
Redirect::to('./');