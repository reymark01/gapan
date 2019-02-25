<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (Session::exist('signSuc')) {
	echo '<div class="alert alert-success" role="alert">'.Session::flash('signSuc').'</div>';
}
if (Session::exist('regSuc')) {
	echo '<div class="alert alert-success" role="alert">'.Session::flash('regSuc').'</div>';
}
if (Session::exist('emailVerifySuc')) {
	echo '<div class="alert alert-success" role="alert">'.Session::flash('emailVerifySuc').'</div>';
}
if (Session::exist('noUserReg')) {
	echo '<div class="alert alert-danger" role="alert">'.Session::flash('noUserReg').'</div>';
}
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="image/1.jpg" class="carousel-img" alt="First slide">
		</div>
		<div class="carousel-item">	
			<img src="image/2.jpg" class="carousel-img" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img src="image/3.jpg" class="carousel-img" alt="Third slide">
		</div>
		<div class="carousel-item">
			<img src="image/4.jpg" class="carousel-img"alt="Fourth slide">
		</div>
		<div class="carousel-item">
			<img src="image/5.jpg" class="carousel-img" alt="Fifth slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<?php
	echo '<br><br><div class="separator">Announcements</div><br><br>';
	$sql2 = "SELECT * FROM gapan_post ORDER BY id DESC LIMIT 3";
	$result2 = DB::query($sql2);
	echo '<div class="container"><div class="row">';
	while ($row2 = $result2->fetch()) {
		echo '<div class="col-md-4">
					<a href="/GapanCity" class="custom">
					<div class="card">';
					if (!empty($row2['post_photo'])) {
        				echo '<img class="card-img-top" src="/announce_photos/'.$row2['post_photo'].'">';
    				} else {
    					echo '<img class="card-img-top" src="/image/seal.png">';
    				}
						echo '<div class="card-body d-flex justify-content-center">
							<b>'.Validate::formatDate($row2['post_date']).'</b>
						</div>
					</div>
					</a>
				</div>';
	}
	echo '</div></div>';
	echo '<br><br><div class="separator">NEWS</div><br><br>';
	$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
	$result = DB::query($sql)->fetch();
	if (!empty($result)) {
		echo '<a href="news/'.$result['id'].'" class="custom">
			<div class="container">
				<div class="row">
	 				<div class="card col-md-12 p-3">
	    				<div class="row ">
	    					<div class="col-md-4">
	        					<img class="w-100" src="/news_thumbnail/'.$result['news_thumbnail'].'">
	      					</div>
	      					<div class="col-md-8">
	        					<div class="card-block">
	          					<h6 class="card-title">'.$result['news_title'].'</h6>
	          					<p class="card-text"><small class="text-muted">'.Validate::formatDate($result['news_postdate']).'</small></p>
	        					<p class="card-text text-justify">'.$result['news_post'].'</p>
	        					</div>
	      					</div>
	    				</div>
	  				</div>
	  			</div>
			</div>
		</a><br><br><br><br>';
	}
	echo '<div class="container-fluid">
			<div class="row">';
				$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1, 3";
				$results = DB::query($sql);
				while ($row = $results->fetch()) {
				echo '<div class="col-md-4">
						<a href="news/'.$row['id'].'" class="custom">
						<div class="card">
							<img class="card-img-top" src="/news_thumbnail/'.$row['news_thumbnail'].'">
   							<div class="card-body">
								<h5 class="card-title">'.$row['news_title'].'</h5>
								<small class="text-muted">'.Validate::formatDate($row['news_postdate']).'</small>
							</div>
						</div>
						</a>
					</div>';
			}

			echo '</div></div></div><br><br>';


	echo '<center><a href="news" class="showmore">See all news</a></center>
	<br>
	<br>
	<br>		
	<div class="separator">EVENTS</div>
	<br>
	<br>';

	echo '<div class="container">
			<div class="row">';
		$sql = "SELECT * FROM events ORDER BY id DESC LIMIT 0, 3";
		$results = DB::query($sql);
		while ($row = $results->fetch()) {
			echo '
			<div class="col-md-4">
				<a href="event/'.$row['id'].'" class="custom">
				<div class="card">
					<img class="card-img-top" src="/events_thumbnail/'.$row['events_thumbnail'].'">
					<div class="body">
						<h5 class="card-title">'.$row['events_title'].'</h5>
						<small class="text-muted">'.Validate::formatDate($row['events_postdate']).'</small>
					</div>
				</div>
				</a>
			</div>';
		}

	echo '</div></div><br>';

	echo '<center><a href="events" class="showmore">See all events</a></center><br><br><br><br><br><br>';
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/main.js"></script>
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
