<?php
require_once 'pusher/vendor/autoload.php';
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (Input::exist()) {
	if (Token::check('adminPostToken', Input::get('token'))) {
		$validate = new Validate;
		$validation = $validate->check($_POST, array(
				'file' => array(
					'ftype' => array('jpg', 'jpeg', 'png')
				)
		));
		if ($validation->passed()) {
				if (!empty($_FILES['file']['name'])) {
					$key = Token::uniqKey('gapan_post', 'post_photo');
					$tmp_name = $_FILES['file']['tmp_name'];
					$photo = 'announce_photos/'.$key;
				} else {
					$key = '';
				}
				$sql = "INSERT INTO gapan_post (post, post_photo) VALUES (:post, :postphoto)";
				if (DB::query($sql, ['post' => htmlspecialchars(Input::get('post')), 'postphoto' => $key])) {
					if (!empty($_FILES['file']['name'])) {
						move_uploaded_file($tmp_name, $photo);
					}
					$sql3 = "SELECT * FROM gapan_post ORDER BY id DESC LIMIT :lim2";
			  		$newres = DB::query($sql3, [], true, ['lim2' => 1])->fetch();
			  		$output = '';
			  		$output .= '<div class="border border-dark shadow p-3 mb-5 bg-white rounded">
								<a href="GapanCity"><img class="imgsmall" src="image/seal.png">
								<b>Gapan City</b></a><br>
								<small><b>'.Validate::formatDate($newres['post_date']).'</b></small><br><br>
								<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($newres['post'])).'</div>';
								if (!empty($newres['post_photo'])) {
								$output .= '<img class="img-fluid img-thumbnail imgbig" src="gapan_post_photos/'.$newres['post_photo'].'">';
								}
								$output .= '</div>';
					$sql2 = "SELECT id FROM users WHERE account_verified = :one";
					$res = DB::query($sql2, [], true, ['one' => 1]);
					while ($row = $res->fetch()) {
						DB::query("INSERT INTO user_notification (user_id, link) VALUES (:user_id, 'GapanCity')", [], true, ['user_id' => $row['id']]);
					}
					$options = array(
			    		'cluster' => 'ap1',
			    		'useTLS' => true
			   		);
			  		$pusher = new Pusher\Pusher(
			    		'be49c320ccd26cd0faa2',
			    		'27e2b94390ec18ab305d',
			    		'681832',
			    		$options
			  		);
					$pusher->trigger('gapanPostChannel', 'gapanPostEvent', ['output' => $output]);
					$pusher->trigger('addNotifyChannel', 'addNotifyEvent', ['count' => 1]);
				}
		} else {
			Redirect::to('GapanCity');
		}
	} else {
		Redirect::to('GapanCity');
	}
}

if (Session::exist('admin_sess_id')) {
	echo '<div class="container">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 border border-dark shadow p-3 mb-5 bg-white rounded" style="padding: 10px; margin: 10px;"">
					<form action="" method="post" class="form-group" enctype="multipart/form-data">
					<textarea class="form-control" name="post"></textarea>
					<input type="file" name="file">
					<input type="hidden" name="token" value="'.Token::generate('adminPostToken').'"><br>
					<button type="submit" class="btn btn-primary" style="float:right;">Post</button>
					</form>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>';
}

$sql = "SELECT * FROM gapan_post ORDER BY id DESC LIMIT :lim";
$results = DB::query($sql, [], true, ['lim' => 3]);
echo '<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
				<div class="col-sm-8" id="postappend">';
					while($row = $results->fetch()) {
						echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded">
								<a href="GapanCity"><img class="imgsmall" src="image/seal.png">
								<b>Gapan City</b></a>';
						if (Session::exist('admin_sess_id')) {
							echo '<a href="/admin/announcements/edit/'.$row['id'].'" class="btn btn-primary btn-sm float-right" style="position: absolute;margin-left:540px;">Edit</a>';
						}
						echo '<br><small><b>'.Validate::formatDate($row['post_date']).'</b></small><br><br>
							<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['post'])).'</div>';
						if (!empty($row['post_photo'])) {
						echo '<img class="img-fluid img-thumbnail imgbig" src="announce_photos/'.$row['post_photo'].'">';
						}
						echo '</div>';
					}
echo '</div>
	<div class="col-sm-2"></div>
	</div>
	</div>';
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
	var gpstart = 3;
	var gplimit = 1;

	var channelgapanpost = pusher.subscribe('gapanPostChannel');
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
	channelgapanpost.bind('gapanPostEvent', function(data) {
		$("#postappend").prepend(data['output']);
	});
	var getGapanPosts = function() {
		$.ajax({
			url: 'ajax/showgapanpost.php',
			method: 'POST',
			data: {
				start: gpstart,
				limit: gplimit
			},
			success: function(data) {
				if (data != '') {
					$("#postappend").append(data);
					gpstart += gplimit;
				}
			}
		});
	}
	$(window).scroll(function() {
			if ($(window).scrollTop() == $(document).height() - $(window).height())
				getGapanPosts();

	});
});
</script>
</body>
</html>