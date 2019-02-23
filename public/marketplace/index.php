<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';
?>
<div class="container">
	<a href="/marketplace/post" class="btn btn-primary">Post to Marketplace</a>
	<div class="row">
		<div class="col-sm-4"></div>
		<form action="/marketplace/search" class="form-inline my-2 my-lg-0" method="get">
			<div class="input-group">
				<input class="form-control" name="q" type="search" placeholder="Marketplace Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-primary my-2 my-sm-0" type="submit">
						<span class="fas fa-search"></span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<br>
<div class="container">
	<input id="mptab" type="hidden" value="business">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="marketbusiness-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Businesses</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="marketuser-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Users</a>
	  </li>
	</ul>
</div>
<div class="container" id="mpcontainer"></div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="../js/main.js"></script>
<script>
$(document).ready(function() {
	var start = 5;
	var limit = 5;
	$.ajax({
		url: '/ajax/showmarketpost.php',
		method: 'post',
		data: {
			tab: 'business',
			type: 'business',
			start: 0,
			limit: limit
		},
		success: function(data) {
			$('#mpcontainer').html(data);
		}
	});
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	if (u_sess_id != '') {
		$(".notif-dropdown").on('click', function() {
			getNotifications(u_sess_id);
			$(".notif-count").html('');
		});
		notifCount(u_sess_id);
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
		$(".notif-dropdown").on('click', function() {
			getNotifications(b_sess_id, 'store');
			$(".notif-count").html('');
		});
		notifCount(b_sess_id, 'store');
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
	var getMarketPosts = function (type = 'business') {
		var tab = $('#mptab').val();
		$.ajax({
			url: '/ajax/showmarketpost.php',
			method: 'POST',
			data: {
				tab: tab,
				type: type,
				start: start,
				limit: limit
			},
			success: function(data) {
				if (data != '') {
					$("#mpcontainer").append(data);
					start += limit;
				}
			}
		});
	}
	$(window).scroll(function() {
			if ($(window).scrollTop() == $(document).height() - $(window).height()) {
				var tab = $('#mptab').val();
				if (tab == 'business') {
					getMarketPosts();
				} else if (tab == 'user') {
					getMarketPosts('user');
				}
			}
	});
	$('#marketuser-tab').on('click', function() {
		$('#mpcontainer').html('Loading...');
		start = 5;
		$.ajax({
			url: '/ajax/showmarketpost.php',
			method: 'post',
			data: {
				tab: 'user',
				type: 'user',
				start: 0,
				limit: limit
			},
			success: function(data) {
				$('#mptab').val('user');
				$('#mpcontainer').html(data);
			}
		});
	});
	$('#marketbusiness-tab').on('click', function() {
		$('#mpcontainer').html('Loading...');
		start = 5;
		$.ajax({
			url: '/ajax/showmarketpost.php',
			method: 'post',
			data: {
				tab: 'business',
				type: 'business',
				start: 0,
				limit: limit
			},
			success: function(data) {
				$('#mptab').val('business');
				$('#mpcontainer').html(data);
			}
		});
	});
});
</script>
<?php
require_once '../layout/footer.php';
