<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-4 p-4">
			<form action="/businesses/search" class="form-inline my-lg-0" method="get">
				<div class="input-group px-5 mx-5">
					<input class="form-control" name="q" type="search" placeholder="Search Business" aria-label="Search" style="width:250px">
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit">
							<span class="fas fa-search"></span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row p-2" id="businessescontainer">
		
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/main.js"></script>
<script>
function renderBusinesses(element,data) {
	data.map((item,i)=>{
		let col = $("<div class='col-sm-4 p-2'>");
		let card = $("<div class='card' style='border-radius:0;'>");
		let cardHeader = $('<a href="'+item.link+'" class="card-header searchcontainer searchlink"></a>');
		let profile = $('<img style="height:100px;width:100px;" class="rounded-circle" src="'+item.profile+'">');
		let rate = $('<div>'+item.rate+'</div>');
		let avg = $('<div><small class="text-muted">'+item.avg+'</small></div>');
		let name = $('<p class="m-0"><b>'+item.name+'</b></p><br>');
		let username = $('<div><small class="text-muted">@'+item.username+'</small></div>');
		let type = $('<div>'+item.type+'</div>');
		let address = $('<br><h5>Address</h5><div>'+item.address+'</div><br>');
		let contact = $('<h5>Contact No.</h5><div>'+item.contact+'</div><br>');
		cardHeader.append(profile);
		cardHeader.append(username);
		cardHeader.append(name);
		cardHeader.append(rate);
		cardHeader.append(avg);
		cardHeader.append(type);
		cardHeader.append(address);
		cardHeader.append(contact);
		card.append(cardHeader);
		col.append(card);
		element.append(col);
	});
}
$(document).ready(function() {
	var start = 0;
	var limit = 12;
	$.ajax({
		url: '/ajax/showallbusinesses.php',
		method: 'post',
		data: {
			start: start,
			limit: limit
		},
		dataType: 'json',
		success: function(data) {
			if (data != '') {
				renderBusinesses($('#businessescontainer'),data);
				start += limit;
			}
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
	var getBusinesses = function() {
		$.ajax({
			url: '/ajax/showallbusinesses.php',
			method: 'post',
			data: {
				start: start,
				limit: limit
			},
			dataType: 'json',
			success: function(data) {
				if (data != '') {
					renderBusinesses($('#businessescontainer'),data);
					start += limit;
				}
			}
		});
	}
	$(window).scroll(function() {
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			getBusinesses();
		}
	});
});
</script>
<?php
require_once '../layout/newfooter.php';