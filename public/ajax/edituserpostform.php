<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('u_sess_id')) {
		$sql = "UPDATE user_post SET u_title = :title, u_post = :post, u_postprice = :price WHERE id = :id AND user_id = :userid";
		DB::query($sql, ['title' => Input::get('edittitle'), 'post' => Input::get('edittext')], true, ['id' => Input::get('postid'), 'price' => Input::get('editprice'), 'userid' => Session::get('u_sess_id')]);
	}
} else {
	Redirect::to('/');
}