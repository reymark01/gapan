<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('editreserved'))) {
		$sql = "UPDATE user_post SET u_poststatus = :status WHERE id = :id AND user_id = :userid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'userid' => Session::get('u_sess_id'), 'status' => 1]);	
	} elseif (!empty(Input::get('editavailable'))) {
		$sql = "UPDATE user_post SET u_poststatus = :status WHERE id = :id AND user_id = :userid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'userid' => Session::get('u_sess_id'), 'status' => 0]);	
	} elseif (!empty(Input::get('editdone'))) {
		$sql = "UPDATE user_post SET u_poststatus = :status WHERE id = :id AND user_id = :userid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'userid' => Session::get('u_sess_id'), 'status' => 2]);
	}
}