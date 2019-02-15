<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
	Redirect::to('./');
}
	if(Input::exist()) {
		if (Token::check('signupToken', Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'fname' => array(
					'required' => true,
					'min' => 1,
					'max' => 30,
					'pregmatch' => 'a'
				),
				'lname' => array(
					'required' => true,
					'min' => 1,
					'max' => 30,
					'pregmatch' => 'a'
				),
				'username' => array(
					'required' => true,
					'min' => 6,
					'max' => 50,
					'unique' => true,
					'pregmatch' => 'd'
				),
				'password' => array(
					'required' => true,
					'min' => 6,
					'max' => 50
				),
				'cpass' => array(
					'matches' => 'password'
				),
				'file' => array(
					'ftype' => array('jpg', 'jpeg', 'png')
				),
				'email' => array(
					'required' => true,
					'pregmatch' => 'email'
				),
				'option' => array(
					'required' => true
				),
				'contact' => array(
					'required' => true,
					'pregmatch' => 'c'
				)
			));
			if($validation->passed()) {
				$etoken = Token::generateKey();
				require 'vendor/autoload.php';

			    $mail = new PHPMailer();
			    $mail->isSMTP();
			    $mail->SMTPAuth = true;
			    $mail->SMTPSecure = 'ssl';
			    $mail->Host = 'smtp.gmail.com';
			    $mail->Port = '465';
			    $mail->isHTML();
			    $mail->Username = 'gapanwebsitetest@gmail.com';
			    $mail->Password = 'testwebsite123';
			    $mail->setFrom('gapanwebsitetest@gmail.com', 'Gapan Website E-mail Verification');
			    $mail->Subject = 'Gapan Website E-mail Verification';
			    $mail->Body    = 'Verify E-mail to complete your account application<br>
			    Click this <a href=gapancity.ml/emailconfirm.php?email='.Input::get('email').'&token='.$etoken.'&username='.Input::get('username').'>link</a>';
			    $mail->addAddress(Input::get('email'));
			    if ($mail->send()) {
			    	if (!empty($_FILES['file']['name'])) {
						$key = Token::uniqKey('users', 'profile');
						$tmp_name = $_FILES['file']['tmp_name'];
						$userprofiles = 'user_profiles/'.$key;
					} else {
						$key = 'default';
					}
			    	$fname = ucfirst(strtolower(Input::get('fname')));
			    	$lname = ucfirst(strtolower(Input::get('lname')));
			   		$hash = password_hash(Input::get('password'), PASSWORD_DEFAULT);
					$sql = "INSERT INTO users (fname, lname, username, password, email, contact, gender, profile, token) VALUES (:fname, :lname, :username, :password, :email, :contact, :gender, :profile, :token)";
					if (DB::query($sql, ['fname' => htmlspecialchars($fname), 'lname' => htmlspecialchars($lname), 'username' => htmlspecialchars(Input::get('username')), 'password' => $hash, 'email' => htmlspecialchars(Input::get('email')), 'contact' => htmlspecialchars(Input::get('contact')), 'gender' => Input::get('option'), 'profile' => $key, 'token' => $etoken])) {
						if (!empty($_FILES['file']['name'])) {
							move_uploaded_file($tmp_name, $userprofiles);
						}
						Session::flash('signSuc', 'Sign Up Success<br>Verify your e-mail to complete your account application');
						Redirect::to('./');	   		
			    	} 
			    }
			    else {
			    	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			    }
				
			} else {	
				$errors = '';
				/*foreach($validation->errors() as $error) {
					$errors .= $error.'<br>';
				}
				Session::flash('regFail', $errors);*/
				foreach($validation->errors() as $err) {
					foreach($err as $field => $error) {
						if ($field == 'fname') {
							$errors .= 'Firstname '.$error.'<br>';
						} elseif ($field == 'lname') {
							$errors .= 'Lastname '.$error.'<br>';
						} elseif ($field == 'email') {
							$errors .= 'E-mail '.$error.'<br>';
						} elseif ($field == 'username') {
							$errors .= 'Username '.$error.'<br>';
						} elseif ($field == 'password') {
							$errors .= 'Password '.$error.'<br>';
						} elseif ($field == 'contact') {
							$errors .= 'Contact No. '.$error.'<br>';
						} elseif ($field == 'option') {
							$errors .= 'Gender '.$error.'<br>';
						}
					}
				}
				Session::flash('signFail', $errors);
			}
		}
	}
	if (Session::exist('signFail')) {
		echo '<div class="alert alert-danger" role="alert">'.Session::flash('signFail').'</div>';
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">Sign Up</div>
				<div class="card-body">
					<form class="form-label-group" action="" method="post" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<label>Firstname</label>
							<input type="text" name="fname" id="fname" class="form-control" value="<?php echo Input::get('fname'); ?>" placeholder="First Name">
						</div>
						<div class="col-sm-6">
							<label>Lastname</label>
							<input type="text" name="lname" class="form-control" value="<?php echo Input::get('lname'); ?>" placeholder="Last Name">
						</div>
					</div>
					<br>
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?php echo Input::get('username'); ?>" placeholder="Username">
					<br>
					<div class="row">
						<div class="col-sm-6">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="col-sm-6">
							<label>Confirm Password</label>
							<input type="password" name="cpass" class="form-control" placeholder="Re-type Password">
						</div>
					</div>
					<br>
					<label>Profile</label>
					<input type="file" name="file" class="form-control">
					<br>
					<label>E-mail</label>
					<input type="text" name="email" class="form-control" value="<?php echo Input::get('email'); ?>" placeholder="E-mail">
					<br>
					<label>Contact No.</label>
					<input type="text" name="contact" class="form-control" value="<?php echo Input::get('contact'); ?>" placeholder="Contact Number">
					<br>
					<label>Gender</label>
					<div class="container form-row">	
						<div class="col">
							<div class="form-check form-check-inline">
  								<input id="rad-m" class="form-check-input" type="radio" name="option" value="male">
  								<label class="form-check-label" for="rad-m">Male</label>
							</div>
						</div>
						<div class="col">
							<div class="form-check form-check-inline">
  								<input id="rad-f" class="form-check-input" type="radio" name="option" value="female">
  								<label class="form-check-label" for="rad-f">Female</label>
							</div>
						</div>
					</div>
					<br>
					<input type="hidden" name="token" value="<?php echo Token::generate('signupToken'); ?>">
					<button type="submit" id="signup" name="signup" class="btn btn-primary btn-block">Sign Up</button>
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