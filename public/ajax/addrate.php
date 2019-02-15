<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql2 = "SELECT count(*) FROM store_rate WHERE store_id = :storeid AND user_id = :userid";
	$result = DB::query($sql2, [], true, ['storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')])->fetch();
	if ($result['count(*)'] > 0) {
		$sql = "UPDATE store_rate SET b_rate = :rate, b_review = :review WHERE store_id = :storeid AND user_id = :userid";
		DB::query($sql, ['review' => htmlspecialchars(Input::get('review'))], true, ['rate' => Input::get('rate'), 'storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')]);
	} else {
		$sql = "INSERT INTO store_rate (store_id, user_id, b_rate, b_review) VALUES (:storeid, :user_id, :b_rate, :b_review)";
		DB::query($sql, ['b_review' => Input::get('review')], true, ['storeid' => Input::get('storeid'), 'user_id' => Session::get('u_sess_id'), 'b_rate' => Input::get('rate')]);
	}
} else {
	Redirect::to('./');
}