<?php
require_once 'pusher/vendor/autoload.php';
require_once '../app/core/init.php';
if (Input::exist()) {
	if (!empty(Input::get('announceid'))) {
		$sql = "DELETE FROM gapan_post WHERE id = :id";
		DB::query($sql, [], true, ['id' => Input::get('announceid')]);
	}
}
require_once 'layout/header.php';
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
							echo '<a href="/admin/announcements/edit/'.$row['id'].'" class="btn btn-primary btn-sm float-right" style="position: absolute;margin-left:470px;">Edit</a>
								<div id="announce-'.$row['id'].'" class="float-right"><a href="#" class="btn btn-danger btn-sm deleteAnnounce">Delete</a></div>';
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
<div class="modal fade" id="deleteAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="deleteAnnounceModalLabel"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAnnounceModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this?
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      	<form action="" method="post">
      		<input id="announceID" type="hidden" name="announceid" value="<?=$row['id']?>">
        	<button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
	$('body').on('click', '.deleteAnnounce', function (e) {
		e.preventDefault();
		var announceID = $(this).parent().attr('id').split("-")[1];
		$('#announceID').val(announceID);
		$('#deleteAnnounceModal').modal('show');
	});
});
</script>
</body>
</html>