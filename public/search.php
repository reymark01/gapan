<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (!empty(Input::get('q'))) {
	echo '<br><div class="container">
			Search results for "<b>'.Input::get('q').'</b>"<hr>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="announcements-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Announcements</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="events-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Events</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="news-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">News</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="users-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Users</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="business-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Businesses</a>
			  </li>
			</ul>
		</div><br>';
	echo '<div class="container" id="searchresult" style="min-height: 350px;">';
		$sql = "SELECT * FROM gapan_post WHERE MATCH (post) AGAINST (:q) ORDER BY id DESC LIMIT :lim";
		$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
		$sql2 = "SELECT * FROM gapan_post WHERE post LIKE :q ORDER BY id DESC LIMIT :lim";
		$result2 = DB::query($sql2, ['q' => Input::get('q').'%'], true, ['lim' => 5]);
		$searches = [];
		while ($row = $result->fetch()) {
			array_push($searches, $row);
		}
		while ($row2 = $result2->fetch()) {
			if (!in_array($row2, $searches)) {
				array_push($searches, $row2);
			}
		}
		foreach ($searches as $search) {
			echo '<a class="searchlink" href="/GapanCity"><div class="searchcontainer posttext"><img class="imgsmall" src="/image/seal.png"><b>Gapan City</b><br><small class="text-muted">'.Validate::formatDate($search['post_date']).'</small><br><br>'.$search['post'].'<br>';
			if (!empty($search['post_photo'])) {
				echo '<img class="img-thumbnail" src="/gapan_post_photos/'.$search['post_photo'].'" style="width: 250px; height: 250px;">';
			}
			echo '</div></a><hr>';
		}
	echo '</div>';
} else {
	Redirect::to('.');
}
?>
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
	$('#announcements-tab').on('click', function() {
		$('#searchresult').html('loading..');
		$.ajax({
			url: 'ajax/showsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				announcementTab: true
			},
			success: function(data) {
				if (data != '') {
					$('#searchresult').html(data);
				} else {
					$('#searchresult').html('No results found!');	
				}
			}
		});
	});
	$('#users-tab').on('click', function() {
		$('#searchresult').html('loading..');
		$.ajax({
			url: 'ajax/showsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				usersTab: true
			},
			success: function(data) {
				if (data != '') {
					$('#searchresult').html(data);
				} else {
					$('#searchresult').html('No results found!');	
				}
			}
		});
	});
	$('#events-tab').on('click', function() {
		$('#searchresult').html('loading..');
		$.ajax({
			url: 'ajax/showsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				eventsTab: true
			},
			success: function(data) {
				if (data != '') {
					$('#searchresult').html(data);
				} else {
					$('#searchresult').html('No results found!');	
				}
			}
		});
	});
	$('#news-tab').on('click', function() {
		$('#searchresult').html('loading..');
		$.ajax({
			url: 'ajax/showsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				newsTab: true
			},
			success: function(data) {
				if (data != '') {
					$('#searchresult').html(data);
				} else {
					$('#searchresult').html('No results found!');	
				}
			}
		});
	});
	$('#business-tab').on('click', function() {
		$('#searchresult').html('loading..');
		$.ajax({
			url: 'ajax/showsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				businessTab: true
			},
			success: function(data) {
				if (data != '') {
					$('#searchresult').html(data);
				} else {
					$('#searchresult').html('No results found!');	
				}
			}
		});
	});



	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$(e.target).addClass("bg-lightblue")
		$(e.relatedTarget).removeClass("bg-lightblue");	
})

});
</script>
<?php
require_once 'layout/footer.php';