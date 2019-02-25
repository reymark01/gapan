<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';
if (!Session::exist('u_sess_id') && !Session::exist('b_sess_id')) {
	Redirect::to('../');
}
if (Input::exist()) {
	if (Token::check('uPostToken', Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'title' => array(
				'required' => true,
			),
			'price' => array(
				'required' => true,
				'pregmatch' => 'e'
			)
		));
		if (Session::exist('u_sess_id')) {
			if ($validation->passed()) {
				if ($_FILES['file']['size'][0] > 0) {
					$files = Validate::arrageArray($_FILES['file']);
					for ($i=0; $i<count($files); $i++) {
						if ($files[$i]['error']) {
							Session::flash('postFail', 'File/s upload error');
							Redirect::to('/marketplace/post');
						}
						$allowed = array('jpg', 'jpeg', 'png');
						$file_ext = explode('.', $files[$i]['name']);
						$fileactualext = strtolower(end($file_ext));
						if (!in_array($fileactualext, $allowed)) {
							Session::flash('postFail', 'Invalid file type');
							Redirect::to('/marketplace/post');
						}
					}
				}
				$sql = "INSERT INTO user_post (user_id, u_title, u_post, u_postprice) VALUES (:user_id, :title, :post, :postprice)";
				if (DB::query($sql, ['title' => htmlspecialchars(Input::get('title')), 'postprice' => Input::get('price'), 'post' => htmlspecialchars(Input::get('post'))], true, ['user_id' => Session::get('u_sess_id')])) {
					if ($_FILES['file']['size'][0] > 0) {
						$sql2 = "SELECT id FROM user_post WHERE user_id = :id ORDER BY id DESC LIMIT :lim";
						$postid = DB::query($sql2, [], true, ['id' => Session::get('u_sess_id'), 'lim' => 1])->fetch();
						$files = Validate::arrageArray($_FILES['file']);
						for ($i=0; $i<count($files); $i++) {
							$key = Token::uniqKey('user_post_photos', 'u_postphoto');
							if (move_uploaded_file($files[$i]['tmp_name'], '../user_photos/'.$key)) {
								$sql3 = "INSERT INTO user_post_photos (user_post_id, u_postphoto) VALUES (:postid, :key)";
								DB::query($sql3, ['key' => $key], true, ['postid' => $postid['id']]);
							}
						}
					}
					Session::flash('postSuc', "Success! Wait for Admin's approval");
					Redirect::to('');
				}
			} else {
				$errors = '';
				foreach($validation->errors() as $err) {
					foreach($err as $field => $error) {
						if ($field == 'price') {
							$errors .= 'Price '.$error.'<br>';
						} elseif ($field == 'title') {
							$errors .= 'Title'.$error.'<br>';
						}
					}
				}
				Session::flash('postFail', $errors);
			}
		} elseif (Session::exist('b_sess_id')) {
			if ($validation->passed()) {
				if ($_FILES['file']['size'][0] > 0) {
					$files = Validate::arrageArray($_FILES['file']);
					for ($i=0; $i<count($files); $i++) {
						if ($files[$i]['error']) {
							Session::flash('postFail', 'File/s upload error');
							Redirect::to('/marketplace/post');
						}
						$allowed = array('jpg', 'jpeg', 'png');
						$file_ext = explode('.', $files[$i]['name']);
						$fileactualext = strtolower(end($file_ext));
						if (!in_array($fileactualext, $allowed)) {
							Session::flash('postFail', 'Invalid file type');
							Redirect::to('/marketplace/post');
						}
					}
				}
				$sql = "INSERT INTO store_post (store_id, b_title, b_post, b_postprice) VALUES (:id, :title, :post, :postprice)";
				if (DB::query($sql, ['title' => htmlspecialchars(Input::get('title')), 'postprice' => Input::get('price'), 'post' => htmlspecialchars(Input::get('post'))], true, ['id' => Session::get('b_sess_id')])) {
					if ($_FILES['file']['size'][0] > 0) {
						$sql2 = "SELECT id FROM store_post WHERE store_id = :id ORDER BY id DESC LIMIT :lim";
						$postid = DB::query($sql2, [], true, ['id' => Session::get('b_sess_id'), 'lim' => 1])->fetch();
						$files = Validate::arrageArray($_FILES['file']);
						for ($i=0; $i<count($files); $i++) {
							$key = Token::uniqKey('store_post_photos', 'b_postphoto');
							if (move_uploaded_file($files[$i]['tmp_name'], '../business_photos/'.$key)) {
								$sql3 = "INSERT INTO store_post_photos (store_post_id, b_postphoto) VALUES (:postid, :key)";
								DB::query($sql3, ['key' => $key], true, ['postid' => $postid['id']]);
							}
						}
					}
					Session::flash('postSuc', "Success! Wait for Admin's approval");
					Redirect::to('');
				}
			} else {
				$errors = '';
				foreach($validation->errors() as $err) {
					foreach($err as $field => $error) {
						$errors .= 'Image '.$error.'<br>';
					}
				}
				Session::flash('postFail', $errors);
			}
		}
	}
} else {
	Redirect::to('');
}
if (Session::exist('postFail')) {
	echo '<div class="container alert alert-danger" role="alert">'.Session::flash('postFail').'</div>';
}
if (Session::exist('postSuc')) {
	echo '<div class="container alert alert-success" role="alert">'.Session::flash('postSuc').'</div>';
}
?>
<br>
<div class="container"><div class="row"><div class="col-sm-3"></div><div class="col-sm-6">
<div class="card">
	<div class="card-body">
		<form action="" class="form-group" method="post" enctype="multipart/form-data">
			<label>Title</label>
			<input class="form-control" type="text" name="title" placeholder="Title"><br>
			<label>Description</label><textarea class="form-control" name="post" placeholder="Description"></textarea><br>
			<label>Price</label><br>
			<input class="form-control" type="text" name="price" placeholder="Price"><br>
			<input type="file" name="file[]" multiple>
			<input type="hidden" name="token" value="<?php echo Token::generate('uPostToken'); ?>">
			<button type="submit" class="btn btn-primary btn-sm" style="float: right;">Submit Post</button>
		</form>
	</div>
</div>
</div></div></div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
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
	} else if (b_sess_id != '') {
		bAddNotifyChannel.bind('bAddNotifyEvent', function(data) {
			if (b_sess_id == data['b_id']) {
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
<?php
require '../layout/footer.php';