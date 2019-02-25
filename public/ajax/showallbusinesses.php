<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	$sql = "SELECT id, b_name, b_username, b_address, b_type, b_contact, b_email, b_profile FROM stores WHERE b_account_verified = 1 ORDER BY b_name LIMIT :start, :lim";
	$result = DB::query($sql, [], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
	$businesses = [];
	while($row = $result->fetch()) {
		$sql2 = "SELECT ROUND(AVG(b_rate),2) as b_rate FROM store_rate WHERE store_id = :id";
		$avg = DB::query($sql2, [], true, ['id' => $row['id']])->fetch();
		$rate = '';
		$newavg = explode('.', $avg['b_rate'])[0];
		for($i=0;$i<5;$i++) {
			if ($i < $newavg) {
				$rate .= '<span style="font-size:15px; color: yellow;" class="fa fa-star"></span>';
			} else {
				$rate .= '<span style="font-size:15px;" class="fa fa-star"></span>';
			}
		}
		$data = [
			'profile' => '/business_profiles/'.$row['b_profile'],
			'link' => '/business/'.$row['b_username'],
			'name' => $row['b_name'],
			'username' => $row['b_username'],
			'address' => $row['b_address'],
			'type' => $row['b_type'],
			'email' => $row['b_email'],
			'contact' => $row['b_contact'],
			'rate' => $rate,
			'avg' => $avg['b_rate']
		];
		array_push($businesses,$data);
	}
	echo json_encode($businesses);
	return true;
}