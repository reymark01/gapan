<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (!Session::exist('u_sess_id')) {
	Session::flash('noUserReg', 'Need to be logged-in as user to register business account');
	Redirect::to('./');
}

if (Input::exist()) {
	if (Token::check('regToken', Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'bname' => array(
				'required' => true,
				'max' => 50,
				'prematch' => 'd'
			),
			'username' => array(
				'required' => true,
				'min' => 6,
				'max' => 30,
				'unique' => true,
				'pregmatch' => 'd'
			),
			'option' => array(
				'required' => true
			),
			'file' => array(
				'ftype' => array('jpg', 'jpeg', 'png')
			),
			'address' => array(
				'required' => true
			),
			'contact' => array(
				'required' => true,
				'pregmatch' => 'c'
			),
			'email' => array(
				'pregmatch' => 'email'
			)
		));
		if ($validation->passed()) {
			if (!empty($_FILES['file']['name'])) {
				$key = Token::uniqKey('stores', 'b_profile');
				$tmp_name = $_FILES['file']['tmp_name'];
				$bprofiles = 'business_profiles/'.$key;
			} else {
				$key = 'default';
			}
			$hash = password_hash(Input::get('password'), PASSWORD_DEFAULT);
			$sql = "INSERT INTO stores (b_name, b_username, b_type, b_profile, b_address, b_contact, b_email, user_id) VALUES (:b_name, :b_username, :b_type, :b_profile, :b_address, :b_contact, :b_email, :user_id)";
			if (DB::query($sql, ['b_name' => htmlspecialchars(Input::get('bname')), 'b_username' => htmlspecialchars(Input::get('username')), 'b_type' => Input::get('option'), 'b_profile' => $key, 'b_address' => htmlspecialchars(Input::get('address')), 'b_contact' => htmlspecialchars(Input::get('contact')), 'b_email' => htmlspecialchars(Input::get('email')), 'user_id' => Session::get('u_sess_id')])) {
				if (!empty($_FILES['file']['name'])) {
					move_uploaded_file($tmp_name, $bprofiles);
				}
				Session::flash('regSuc', 'Business Registration Success');
				Redirect::to('./');
			}

		} else {
			$errors = '';
			foreach($validation->errors() as $err) {
				foreach($err as $field => $error) {
					if ($field == 'bname') {
						$errors .= 'Business Name '.$error.'<br>';
					} elseif ($field == 'username') {
						$errors .= 'Username '.$error.'<br>';
					} elseif ($field == 'password') {
						$errors .= 'Password '.$error.'<br>';
					} elseif ($field == 'file') {
						$errors .= 'Profile '.$error.'<br>';
					} elseif ($field == 'email') {
						$errors .= 'Email '.$error.'<br>';
					} elseif ($field == 'option') {
						$errors .= 'Business Type '.$error.'<br>';
					} elseif ($field == 'select') {
						$errors .= 'Barangay '.$error.'<br>';
					} elseif ($field == 'contact') {
						$errors .= 'Contact No. '.$error.'<br>';
					} elseif ($field == 'street') {
						$errors .= 'No. & Street '.$error.'<br>';
					}
				}
			}
			Session::flash('regFail', $errors);
		}
	}
}
if (Session::exist('regFail')) {
	echo '<div class="alert alert-danger" role="alert">'.Session::flash('regFail').'</div>';
}
?>

	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header">Business Registration</div>
					<div class="card-body">
						<form class="form-group" action="" method="post" enctype="multipart/form-data">
						<label>Business Name</label>
						<input type="text" name="bname" class="form-control" value="<?php echo htmlspecialchars(Input::get('bname'))?>">
						<br>
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars(Input::get('username'))?>">
						<br>
						<div class="row">
							<div class="col-sm-6">
								<label>Type of Business</label>
								<select name="option" class="form-control">
									<option selected disabled>Choose...</option>
									<option>Manufacturing Business</option>
									<option>Merchandising Business</option>								
									<option>Service Business</option>
									<option disabled>___________________________________</option>
									<option>Appliance Store</option>
									<option>Auto Repair Shop/Car and Motor Service</option>
									<option>Bakery/Bake Shop</option>
									<option>Bank</option>
									<option>Barber Shop</option>
									<option>Canteen/Eatery</option>
									<option>Clinic</option>
									<option>Clothing Store</option>
									<option>Department Store</option>
									<option>Drug Store/Pharmacy</option>
									<option>Food Stall/Food Stand/Food Booth</option>
									<option>Gadget Store</option>
									<option>Grocery Store</option>
									<option>Hardware Store</option>
									<option>Money Transfer Service</option>
									<option>Pawn Shop</option>
									<option>Restaurant</option>
									<option>Salon</option>
									<option>Supermarket</option>
									<option>Water Refilling Station</option>
								</select>
							</div>
							<div class="col-sm-6">
								<label>Business Profile <sup>(optional)</sup></label>
								<input type="file" name="file" class="form-control">
							</div>
						</div>
						<br>
						<label>Address</label>
						<input class="form-control" type="text" name="address" value="<?=htmlspecialchars(Input::get('address'))?>">
						<!--<div class="row">
							<div class="col-sm-6">
								<label>No. & Street <sup>(ex. #01, Tramo Drive)</sup></label>
								<input type="text" name="street" class="form-control" value="<?php //echo htmlspecialchars(Input::get('street'))?>">
							</div>
							<div class="col-sm-6">
								<label>Barangay</label>
								<select name="select" id="barangay" class="form-control">
									<option selected disabled>Choose...</option>
									<option>Balante</option>
									<option>Bayanihan</option>
									<option>Bulak</option>
									<option>Bungo</option>
									<option>Kapalangan</option>
									<option>Mabuga</option>
									<option>Maburak</option>
									<option>Macabaklay</option>
									<option>Mahipon</option>
									<option>Malimba</option>
									<option>Mangino</option>
									<option>Marilu</option>
									<option>Pambuan</option>
									<option>Parcutela</option>
									<option>Puting Tubig</option>
									<option>San Lorenzo</option>
									<option>San Nicolas</option>
									<option>San Roque</option>
									<option>San Vicente</option>
									<option>Sta. Cruz</option>
									<option>Sto. Cristo Norte</option>
									<option>Sto. Cristo Sur</option>
									<option>Sto. Niño</option>
								</select>
							</div>
						</div>-->
						<br>
						<label>Contact Number</label>
						<input type="text" name="contact" class="form-control" value="<?php echo htmlspecialchars(Input::get('contact'))?>">
						<br>
						<label>Email <sup>(optional)</sup></label>
						<input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars(Input::get('email'))?>">
						<br>
						<br>
						<input type="hidden" name="token" value="<?php echo Token::generate('regToken'); ?>">
						<button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Register</button>
					</form>
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	if (u_sess_id != '') {
		uAddNotifyChannel.bind('uAddNotifyEvent', function(data) {
			if (u_sess_id == data['u_id']) {
				var notifcount = $(".notif-count").html();
				if (notifcount == '') {
					notifcount = 0;
				}
				var count = parseInt(notifcount)+parseInt(data['count']);
				$(".notif-count").html(count);
			}
		});
	}
});
</script>
</body>
</html>

