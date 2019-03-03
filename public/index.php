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
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="image/1.png" class="carousel-img" alt="First slide">
		</div>
		<div class="carousel-item">	
			<img src="image/2.jpg" class="carousel-img" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img src="image/3.png" class="carousel-img" alt="Third slide">
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
<div class="container">
	<h2 class="p-3"><center>City Mayor's Message</center></h2>
	<div class="row flex-sm-row-reverse">
		<div class="col-sm-9">
			<p style="font-family:arial; font-size:15pt" align="justify">Welcome to the website of Gapan City!<br><br>
					Through this website, the City Government of Gapan would like to report its accomplishments. As public servants, we are accountable to the public and it is our obligation to inform them of what we are doing. This is also our way of implementing the principle of transparency which is one ingredient of good governance.<br>
					<br>
					I encourage all the citizens of Gapan to read the website and provide us with your constructive suggestions and recommendations so that we can further improve our performance as public servants of our city.<br>
					<bR>
					May God continue to bless and guide us all!</p>
					<h3 style="font-family:Monotype Corsiva; font-size:35; color:darkblue" align="right">HON. EMERSON D. PASCUAL</h3>
		</div>
		<div class="col-sm-3">
			<img src="/image/mayor.png" style="width: 100%;height: 90%">
			<audio controls>
				<source src="/image/Government.mp3" type="audio/mpeg">
			</audio>
			<h5>Mayor Emeng New Song</h5>
		</div>
	</div>
</div>
<?php
	echo '<br><br><div class="separator" style="font-size: 30px;">ANNOUNCEMENTS</div><br><br>';
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
	echo '</div></div><br><center><a href="/GapanCity">See all announcements</a></center>';
	echo '<br><br><div class="separator" style="font-size: 30px;">NEWS</div><br><br>';
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
	echo '<div class="container">
			<div class="row">';
				$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1, 3";
				$results = DB::query($sql);
				while ($row = $results->fetch()) {
				echo '<div class="col-md-4">
						<a href="news/'.$row['id'].'" class="custom">
						<div class="card">
							<img class="card-img-top" src="/news_thumbnail/'.$row['news_thumbnail'].'">
   							<div class="card-body">
								<h6 class="card-title">'.$row['news_title'].'</h6>
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
	<div class="separator" style="font-size: 30px;">EVENTS</div>
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
<div class="container">
	<div class="row flex-sm-row-reverse">
		<div class="col-sm-8 embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/iKqRVIss8iE" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<div class="col-sm-4">
			<div class="fb-page" data-href="https://www.facebook.com/Mayor-Emeng-Pascual-Serbisyo-Publiko-1717200598522787/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
				<blockquote cite="https://www.facebook.com/Mayor-Emeng-Pascual-Serbisyo-Publiko-1717200598522787/" class="fb-xfbml-parse-ignore">
					<a href="https://www.facebook.com/Mayor-Emeng-Pascual-Serbisyo-Publiko-1717200598522787/">Mayor Emeng Pascual - Serbisyo Publiko</a>
				</blockquote>
			</div>
		</div>
	</div>
</div>
<div class="container p-3">
	<div class="row">
		<div class="col-sm-6" style="background-color: #f7f7f7">
			<div style="text-align:center;padding:1em 0;"> <h2><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/city/1713226"><br />Gapan, Philippines</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone=Asia%2FManila" width="100%" height="140" frameborder="0" seamless></iframe> </div>
		</div>
		<div class="col-sm-6 d-flex justify-content-center" style="padding:40px;background-color: #f7f7f7">
			<!-- weather widget start --><a target="_blank" href="https://www.booked.net/weather/gapan-w434007"><img src="https://w.bookcdn.com/weather/picture/3_w434007_1_1_137AE9_160_ffffff_333333_08488D_1_ffffff_333333_0_6.png?scode=124&domid=w209&anc_id=6211"  alt="booked.net"/></a><!-- weather widget end -->

		</div>
	</div>
</div>
<div id="fb-root">
</div>
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
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
