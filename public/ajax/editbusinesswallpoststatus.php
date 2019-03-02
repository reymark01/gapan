<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('wallpostdelete'))) {
		$sql = "DELETE FROM store_wall_post WHERE id = :id AND store_id = :storeid";
		DB::query($sql, [], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id')]);
	}
}