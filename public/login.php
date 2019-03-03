<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
if (Session::exist('u_sess_id') || Session::exist('b_sess_id') || Session::exist('admin_sess_id')) {
	Redirect::to('./');
}
if (Input::exist()) {
	if (Token::check('loginToken', Input::get('token'))) {
		$sql = "SELECT id, fname, lname, password, username, profile, account_verified FROM users WHERE username = :username";
		$result = DB::query($sql, ['username' => Input::get('username')])->fetch();
		if (isset($result) && !empty($result)) {
			if ($result['account_verified'] == 1) {
				if (password_verify(Input::get('password'), $result['password'])) {
					Session::create('u_sess_id', $result['id']);
					Session::create('u_sess_fname', $result['fname']);
					Session::create('u_sess_lname', $result['lname']);
					Session::create('u_sess_username', $result['username']);
					Session::create('u_sess_profile', $result['profile']);
					Redirect::to('/user/'.$result['username']);
				} else {
					Session::flash('logFail', 'Login Failed');
				}
			} else {
				Session::flash('logFail', 'Login Failed');
			}
		} 	else {
			$sql = "SELECT id, a_username, a_password FROM admins WHERE a_username = :username";
			$result = DB::query($sql, ['username' => Input::get('username')])->fetch();
			if (isset($result) && !empty($result)) {
				if (password_verify(Input::get('password'), $result['a_password'])) {
					Session::create('admin_sess_id', $result['id']);
					Session::create('admin_sess_username', $result['a_username']);
					Redirect::to('admin/dashboard');
				} else {
					Session::flash('logFail', 'Login Failed');
				}
			} else {
				Session::flash('logFail', 'Login Failed');
			}
		}
	}
}
if (Session::exist('logFail')) {
	echo '<div class="alert alert-danger" role="alert">'.Session::flash('logFail').'</div>';
}
?>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">Login</div>
					<div class="card-body">
						<form class="form-signin" action="" method="post">
              		<div class="form-label-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
						<br>
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						<input type="hidden" name="token" value="<?php echo Token::generate('loginToken'); ?>">
						<br>
						<button type="submit" name="login" class="btn btn-md btn-primary btn-block text-uppercase">Login</button>
						<hr class="my-4">
 					</div>
            	</form>
					</div>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
