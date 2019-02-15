<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM events WHERE id = :id";
	$result = DB::query($sql, [], true, ['id' => $id])->fetch();
	if (!empty($result)) {
		echo '<div class="container">
		<h3>'.$result['events_title'].'</h3>
		<p><small class="text-muted">'.Validate::formatDate($result['events_postdate']).'</small></p><hr>';
		if ($result['events_thumbnail'] != 'default') {
			echo '<img class="image img-thumbnail" src="/events_thumbnail/'.$result['events_thumbnail'].'"><hr>';
		}
		echo '<p>'.$result['events_post'].'</p>
		</div>';
	} else {
		Redirect::to('../events');
	}
} else {
	Redirect::to('./events');
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="../js/main.js"></script>
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
require_once 'layout/footer.php';