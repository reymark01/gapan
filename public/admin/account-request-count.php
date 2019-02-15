<?php
require_once "../../app/core/newinit.php";

if (Session::exist('admin_sess_id')) {
	if (Input::exist()) {
		if (!empty(Input::get('usercount'))) {
			$sql = "SELECT count(*) FROM users WHERE email_verified = :one AND account_verified = :zero";
			$result = DB::query($sql, [], true, ['one' => 1, 'zero' => 0])->fetch();
			echo $result['count(*)'];
		} elseif (!empty(Input::get('businesscount'))) {
			$sql = "SELECT count(*) FROM stores WHERE b_account_verified = :zero";
			$result = DB::query($sql, [], true, ['zero' => 0])->fetch();
			echo $result['count(*)'];
		}
	} else {
		Redirect::to('../');
	}
} else {
	Redirect::to('../');
}