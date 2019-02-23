<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql2 = "SELECT id, b_rate FROM store_rate WHERE store_id = :storeid AND user_id = :userid";
	$result = DB::query($sql2, [], true, ['storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')])->fetch();
	if (!empty($result)) {
		$sql = "UPDATE store_rate SET b_rate = :rate, b_review = :review WHERE store_id = :storeid AND user_id = :userid";
		DB::query($sql, ['review' => htmlspecialchars(Input::get('review'))], true, ['rate' => Input::get('rate'), 'storeid' => Input::get('storeid'), 'userid' => Session::get('u_sess_id')]);
		$rate = Validate::rate($result['b_rate']);
		$sql3 = "UPDATE stores SET b_rating = b_rating - :rate WHERE id = :id";
		DB::query($sql3, [], true, ['rate' => $rate, 'id' => Input::get('storeid')]);
		$newrate = Validate::rate(Input::get('rate'));
		$sql4 = "UPDATE stores SET b_rating = b_rating + :newrate WHERE id = :sid";
		DB::query($sql4, [], true, ['newrate' => $newrate, 'sid' => Input::get('storeid')]);
	} else {
		$sql = "INSERT INTO store_rate (store_id, user_id, b_rate, b_review) VALUES (:storeid, :user_id, :b_rate, :b_review)";
		DB::query($sql, ['b_review' => Input::get('review')], true, ['storeid' => Input::get('storeid'), 'user_id' => Session::get('u_sess_id'), 'b_rate' => Input::get('rate')]);
		$rate = Validate::rate(Input::get('rate'));
		$sql3 = "UPDATE stores SET b_rating = b_rating + :rate WHERE id = :id";
		DB::query($sql3, [], true, ['rate' => $rate, 'id' => Input::get('storeid')]);
	}
} else {
	Redirect::to('./');
}