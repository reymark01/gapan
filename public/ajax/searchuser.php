<?php
require_once '../../app/core/newinit.php';

if (Input::exist() && !empty(Input::get('q'))) {
	$sql = "SELECT fname, lname, username, email, contact, profile FROM users WHERE (MATCH (fname, lname, username) AGAINST (:q) OR fname LIKE :qq OR lname LIKE :qq OR username LIKE :qq) AND account_verified = 1 LIMIT :start, :lim";
	$result = DB::query($sql, ['q' => Input::get('q'), 'qq' => Input::get('q').'%'], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
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