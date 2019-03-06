<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('u_sess_id')) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'edittitle' => array(
				'required' => true,
			),
			'editprice' => array(
				'required' => true,
				'pregmatch' => 'e'
			),
			'editqty' => array(
				'pregmatch' => 'c'
			)
		));
		if($validation->passed()) {
			$sql = "UPDATE user_post SET u_title = :title, u_post = :post, u_postprice = :price, u_postqty = :qty, u_postedited = 1 WHERE id = :id AND user_id = :userid";
			DB::query($sql, ['title' => Input::get('edittitle'), 'post' => Input::get('edittext'), 'price' => Input::get('editprice')], true, ['id' => Input::get('postid'), 'userid' => Session::get('u_sess_id'), 'qty' => Input::get('editqty')]);
		} else {
			echo 'error';
		}
	}
} else {
	Redirect::to('/');
}