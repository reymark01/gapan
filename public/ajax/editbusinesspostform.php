<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Session::exist('b_sess_id')) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'edittitle' => array(
				'required' => true,
			),
			'editprice' => array(
				'required' => true,
				'pregmatch' => 'e'
			)
		));
		if($validation->passed()) {
			$sql = "UPDATE store_post SET b_title = :title, b_post = :post, b_postprice = :price, b_postqty = :qty, b_postedited = :edited WHERE id = :id AND store_id = :storeid";
			DB::query($sql, ['title' => Input::get('edittitle'), 'post' => Input::get('edittext'), 'price' => Input::get('editprice')], true, ['id' => Input::get('postid'), 'storeid' => Session::get('b_sess_id'), 'edited' => 1, 'qty' => Input::get('editqty')]);
		} else {
			echo 'error';
		}
	}
} else {
	Redirect::to('/');
}