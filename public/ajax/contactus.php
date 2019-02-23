<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('email')) && !empty(Input::get('message'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'email' => array(
				'required' => true,
				'pregmatch' => 'email'
			),
			'message' => array(
				'required' => true
			)
		));
		if ($validation->passed()) {
			$sql = "INSERT INTO contact_us (contactus_email, contactus_message) VALUES (:email, :message)";
			if (DB::query($sql, ['email' => htmlspecialchars(Input::get('email')), 'message' => htmlspecialchars(Input::get('message'))])) {
				echo 'success';
			}
		}
	}
}