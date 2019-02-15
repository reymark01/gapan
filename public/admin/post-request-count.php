<?php
require_once "../../app/core/newinit.php";

if (Session::exist('admin_sess_id')) {
	if (Input::exist()) {
		if (!empty(Input::get('userpostcount'))) {
			$result = DB::query("SELECT count(*) FROM user_post WHERE u_postverified = 0")->fetch();
			echo $result['count(*)'];
		}
		if (!empty(Input::get('businesspostcount'))) {
			$result = DB::query("SELECT count(*) FROM store_post WHERE b_postverified = 0")->fetch();
			echo $result['count(*)'];
		}
	} else {
		Redirect::to('../');
	}
} else {
	Redirect::to('../');
}