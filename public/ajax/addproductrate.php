<?php
require_once '../../app/core/newinit.php';

if (Session::exist('u_sess_id')) {
	if (Input::exist()) {
		$sql2 = "SELECT count(*) FROM store_product_rate WHERE product_id = :productid AND user_id = :userid";
		$result = DB::query($sql2, [], true, ['productid' => Input::get('prod_id'),'userid' => Session::get('u_sess_id')])->fetch();
		if ($result['count(*)'] > 0) {
			$sql = "UPDATE store_product_rate SET product_rate = :rate WHERE product_id = :id AND user_id = :user";
			DB::query($sql, [], true, ['id' => Input::get('prod_id'), 'user' => Session::get('u_sess_id'), 'rate' => Input::get('rate')]);

		} else {
			$sql = "INSERT INTO store_product_rate (product_id, user_id, product_rate) VALUES (:id, :user, :rate)";
			DB::query($sql, [], true, ['id' => Input::get('prod_id'), 'user' => Session::get('u_sess_id'), 'rate' => Input::get('rate')]);
		}
	}
}
