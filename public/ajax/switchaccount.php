<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('u_sess_id')) {
		if (!empty(Input::get('toBusiness'))) {
			$sql = "SELECT id, b_name, b_username, b_profile, user_id FROM stores WHERE b_username = :username AND user_id = :userid AND b_account_verified = 1";
			$result = DB::query($sql, ['username' => Input::get('storeusername')], true, ['userid' => Session::get('u_sess_id')])->fetch();
			Session::delete('u_sess_id');
			Session::delete('u_sess_fname');
			Session::delete('u_sess_lname');
			Session::delete('u_sess_username');
			Session::delete('u_sess_profile');
			Session::create('b_sess_id', $result['id']);
			Session::create('b_sess_b_name', $result['b_name']);
			Session::create('b_sess_b_username', $result['b_username']);
			Session::create('b_sess_profile', $result['b_profile']);
			Session::create('b_sess_userid', $result['user_id']);
			echo '/business/'.$result['b_username'];
		}
	} elseif (Session::exist('b_sess_id')) {
		if (!empty(Input::get('toBusiness'))) {
			$sql = "SELECT id, b_name, b_username, b_profile, user_id FROM stores WHERE b_username = :username AND user_id = :userid AND b_account_verified = 1";
			$result = DB::query($sql, ['username' => Input::get('storeusername')], true, ['userid' => Session::get('b_sess_userid')])->fetch();
			Session::delete('b_sess_id');
			Session::delete('b_sess_b_name');
			Session::delete('b_sess_b_username');
			Session::delete('b_sess_profile');
			Session::delete('b_sess_userid');
			Session::create('b_sess_id', $result['id']);
			Session::create('b_sess_b_name', $result['b_name']);
			Session::create('b_sess_b_username', $result['b_username']);
			Session::create('b_sess_profile', $result['b_profile']);
			Session::create('b_sess_userid', $result['user_id']);
			echo '/business/'.$result['b_username'];
		} elseif (!empty(Input::get('toUser'))) {
			$sql = "SELECT id, fname, lname, username, profile FROM users WHERE id = :id AND account_verified = 1 AND username = :username";
			$result = DB::query($sql, ['username' => Input::get('userusername')], true, ['id' => Session::get('b_sess_userid')])->fetch();
			Session::delete('b_sess_id');
			Session::delete('b_sess_b_name');
			Session::delete('b_sess_b_username');
			Session::delete('b_sess_profile');
			Session::delete('b_sess_userid');
			Session::create('u_sess_id', $result['id']);
			Session::create('u_sess_fname', $result['fname']);
			Session::create('u_sess_lname', $result['lname']);
			Session::create('u_sess_username', $result['username']);
			Session::create('u_sess_profile', $result['profile']);
			echo '/user/'.$result['username'];
		}
	}
} else {
	Redirect::to('./');
}