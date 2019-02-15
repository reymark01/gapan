<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('business'))) {
		$sql = "INSERT INTO store_report (store_id, user_id) VALUES (:storeid, :userid)";
		if (DB::query($sql, [], true, ['storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')])) {
			$sql2 = "UPDATE stores SET b_report = b_report + :one WHERE id = :bid";
			DB::query($sql2, [], true, ['one' => 1, 'bid' => Input::get('storeid')]);
		}
	} elseif (!empty(Input::get('user'))) {
		$sql = "INSERT INTO user_report (reported_id, user_id) VALUES (:reportedid, :userid)";
		if (DB::query($sql, [], true, ['reportedid' => Input::get('reportedid'), 'userid' => Session::get('u_sess_id')])) {
			$sql2 = "UPDATE users SET report = report + :one WHERE id = :uid";
			DB::query($sql2, [], true, ['one' => 1, 'uid' => Input::get('reportedid')]);
		}
	}
}