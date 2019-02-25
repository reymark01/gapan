<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	$sql = "SELECT fname, lname, username, email, contact, profile FROM users WHERE account_verified = 1 ORDER BY lname, fname LIMIT :start, :lim";
	$result = DB::query($sql, [], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
	$users = [];
	while($row = $result->fetch()) {
		$data = [
			'profile' => '/user_profiles/'.$row['profile'],
			'link' => '/user/'.$row['username'],
			'name' => $row['fname'].' '.$row['lname'],
			'username' => $row['username'],
			'email' => $row['email'],
			'contact' => $row['contact']
		];
		array_push($users,$data);
	}
	echo json_encode($users);
	return true;
}