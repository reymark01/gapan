<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM news WHERE id = :id";
	$result = DB::query($sql, [], true, ['id' => $id])->fetch();
	if (!empty($result)) {
		echo '<div class="container p-4">
				<div class="card">
					<div class="card-header bg-primary">
						<img src="/image/seal.png" style="height: 100px;width: 100px;">
						<h4 style="color:white;">Gapan City</h4>
						<h4 style="color:white;">News</h4>
					</div>
					<div class="card">
						<div class="card-header" style="background-color:white;">
							<h3>'.$result['news_title'].'</h3>
							<p><small class="text-muted">'.Validate::formatDate($result['news_postdate']).'</small></p>';
							if ($result['news_thumbnail'] != 'default') {
								echo '<img class="image img-thumbnail" src="/news_thumbnail/'.$result['news_thumbnail'].'">';
							}
					echo '</div>
						<div class="card-body">
							<p>'.$result['news_post'].'</p>
						</div>
					</div>
				</div>
			</div>';
	} else {
		Redirect::to('../news');
	}
} else {
	Redirect::to('./news');
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
