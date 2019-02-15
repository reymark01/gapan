<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('b_sess_id')) {
		$sql = "UPDATE store_post SET b_post = :post, b_postprice = :price WHERE id = :id AND store_id = :storeid";
		DB::query($sql, ['post' => Input::get('edittext')], true, ['id' => Input::get('postid'), 'price' => Input::get('editprice'), 'storeid' => Session::get('b_sess_id')]);
	}
} else {
	Redirect::to('/');
}