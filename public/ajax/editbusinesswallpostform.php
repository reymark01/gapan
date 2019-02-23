<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('b_sess_id')) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'edittext' => array(
				'required' => true,
			)
		));
		if($validation->passed()) {
			$sql = "UPDATE store_wall_post SET bw_post = :post, bw_postedited = :edited WHERE id = :id AND store_id = :storeid";
			DB::query($sql, ['post' => Input::get('edittext')], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id'), 'edited' => 1]);
		} else {
			echo 'error';
		}
	}
} else {
	Redirect::to('/');
}