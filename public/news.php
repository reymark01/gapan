<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
?>
<div class="container p-4">
	<div class="card">
		<div class="card-header bg-primary">
			<img src="/image/seal.png" style="height: 100px;width: 100px;">
			<h4 style="color:white;">Gapan City</h4>
			<h4 style="color:white;">News</h4>
		</div>
<?php
		$sql = "SELECT * FROM news ORDER BY id DESC";
		$results = DB::query($sql);
		echo '<div class="container p-3">
			   <div class="row">';
		while($row = $results->fetch()) {
			echo '<div class="col-sm-3"><div class="card"><div class="card-header card-container" style="background-color:white;"><a href="news/'.$row['id'].'">
			<img class="thumbnail" src="/news_thumbnail/'.$row['news_thumbnail'].'">';
			echo '<h3 class="card-title">'.$row['news_title'].'</h3>
			<small class="text-muted">'.Validate::formatDate($row['news_postdate']).'</small></a></div></div></div>';
		}
		echo '</div>
			</div>';
?>
	</div>
</div>
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
require_once 'layout/footer.php';