<?php
require_once "../../app/core/newinit.php";

if (Session::exist('admin_sess_id')) {
	if (Input::exist()) {
		if (!empty(Input::get('contactusmessages'))) {
			$sql = "SELECT count(*) FROM contact_us WHERE contactus_status = 0";
			$result = DB::query($sql)->fetch();
			echo $result['count(*)'];
		}
	}
}