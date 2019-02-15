<?php
require_once '../../app/core/newinit.php';

if (Input::exist() && !empty(Input::get('postgetnotifications'))) {
	if (Session::exist('u_sess_id')) {
		$sql = "SELECT count(*) FROM user_notification WHERE user_id = :id AND stat = 0";
		$result = DB::query($sql, [], true, ['id' => Session::get('u_sess_id')])->fetch();
		if ($result['count(*)'] > 0) {
			echo $result['count(*)'];
		} else {
			echo '';
		}
	} elseif (Session::exist('b_sess_id')) {
		$sql = "SELECT count(*) FROM store_notification WHERE store_id = :id AND b_stat = 0";
		$result = DB::query($sql, [], true, ['id' => Session::get('b_sess_id')])->fetch();
		if ($result['count(*)'] > 0) {
			echo $result['count(*)'];
		} else {
			echo '';
		}	
	}
}