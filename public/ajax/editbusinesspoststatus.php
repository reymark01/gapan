<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('editreserved'))) {
		$sql = "UPDATE store_post SET b_poststatus = :status WHERE id = :id AND store_id = :storeid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id'), 'status' => 1]);	
	} elseif (!empty(Input::get('editavailable'))) {
		$sql = "UPDATE store_post SET b_poststatus = :status WHERE id = :id AND store_id = :storeid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id'), 'status' => 0]);	
	} elseif (!empty(Input::get('editdone'))) {
		$sql = "UPDATE store_post SET b_poststatus = :status WHERE id = :id AND store_id = :storeid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id'), 'status' => 2]);
	}
}