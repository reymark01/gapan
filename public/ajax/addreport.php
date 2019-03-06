<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('business'))) {
		$sql = "INSERT INTO store_report (store_id, user_id, reporttext) VALUES (:storeid, :userid, :report)";
		if (DB::query($sql, ['report' => Input::get('report')], true, ['storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')])) {
			$sql2 = "UPDATE stores SET b_report = b_report + :one WHERE id = :bid";
			DB::query($sql2, [], true, ['one' => 1, 'bid' => Input::get('storeid')]);
		}
	} elseif (!empty(Input::get('user'))) {
		$sql = "INSERT INTO user_report (reported_id, user_id, reporttext) VALUES (:reportedid, :userid, :report)";
		if (DB::query($sql, ['report' => Input::get('report')], true, ['reportedid' => Input::get('reportedid'), 'userid' => Session::get('u_sess_id')])) {
			$sql2 = "UPDATE users SET report = report + :one WHERE id = :uid";
			DB::query($sql2, [], true, ['one' => 1, 'uid' => Input::get('reportedid')]);
		}
	}
}