<?php
require_once "../../app/core/newinit.php";

if (Session::exist('admin_sess_id')) {
	if (Input::exist()) {
		if (!empty(Input::get('breport'))) {
			$sql = "SELECT count(*) FROM stores WHERE b_report >= :rep";
			$result = DB::query($sql, [], true, ['rep' => 5])->fetch();
			echo $result['count(*)'];
		}
		elseif (!empty(Input::get('ureport'))) {
			$sql = "SELECT count(*) FROM users WHERE report >= :rep";
			$result = DB::query($sql, [], true, ['rep' => 5])->fetch();
			echo $result['count(*)'];
		}
	}
} else {
	Redirect::to('/');
}