<?php
require_once "../../app/core/newinit.php";

if (Session::exist('admin_sess_id')) {
	if (Input::exist()) {
		if (!empty(Input::get('breport'))) {
			$sql = "SELECT count(*) FROM stores WHERE b_report > 0";
			$result = DB::query($sql)->fetch();
			echo $result['count(*)'];
		}
		elseif (!empty(Input::get('ureport'))) {
			$sql = "SELECT count(*) FROM users WHERE report > 0";
			$result = DB::query($sql)->fetch();
			echo $result['count(*)'];
		}
	}
} else {
	Redirect::to('/');
}