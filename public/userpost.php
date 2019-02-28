<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (!empty(Input::get('username') && !empty(Input::get('tab') && !empty(Input::get('pid'))))) {
	$result = DB::query("SELECT id FROM users WHERE account_verified = 1 AND username = :username", ['username' => Input::get('username')])->fetch();
		if (!empty($result)) {
			if (Input::get('tab') == 'post') {
			$sql = "SELECT user_post.id as postid, fname, lname, username, profile, u_title, u_postprice, u_post, u_postdate FROM users, user_post WHERE user_post.u_postverified = :veri AND users.id = user_post.user_id AND user_post.user_id = :uid AND user_post.id = :id";
			$row = DB::query($sql, [], true, ['id' => Input::get('pid'), 'uid' => $result['id'], 'veri' => 1])->fetch();
			$sql2 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :postid";
			$result = DB::query($sql2, [], true, ['postid' => $row['postid']]);
			$photos = [];
			while ($row2 = $result->fetch()) {
				array_push($photos, $row2);
			}
			if (!empty($row)) {
				echo '<div class="container">
					<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-8 p-5">
					<div class="card"><div class="card-header searchcontainer searchlink"><a href="/user/'.$row['username'].'"><img class="imgsmall rounded-circle" src="/user_profiles/'.$row['profile'].'">
					<p class="m-0">'.$row['fname'].' '.$row['lname'].'</p></a>
					<small class="text-muted"><b>'.Validate::formatDate($row['u_postdate']).'</b></small></div><div class="card-body">
					<div><b>'.$row['u_title'].'</b></div><br>
					<div><span class="badge badge-pill badge-success" style="background-color:#53d690;color:black;font-size:15px;">Price</span>₱'.$row['u_postprice'].'.00</div><br>
					<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_post'])).'</div>';
					if (!empty($photos)) {
						if (count($photos) == 1) {
							echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/user_photos/'.$photos[0]['u_postphoto'].'"></div>';
						} else {
							echo '<div class="row">';
							foreach ($photos as $photo) {
								echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/user_photos/'.$photo['u_postphoto'].'" style="width: 360px; height: 200px;"></div>';
							}
							echo '</div>';
						}
					}
?>
					<input type="hidden" class="upostid" value="<?=$row['postid']?>">
					<input type="hidden" class="uc_count" value="">
					<hr><a href="#" class="ucomment">Comment</a>
					<div class="ucomments">
						
					</div></div></div></div>
					<div class="col-sm-2"></div></div></div>
<?php
			} else {
				Redirect::to('/user/'.Input::get('username').'');
			}
		} else {
			Redirect::to('/user/'.Input::get('username').'');
		}
	} else {
		Redirect::to('/');
	}
}

?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/main.js"></script>
<script>
$(document).ready(function() {
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	var channeladdusercomment = pusher.subscribe('addUserCommentChannel');
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
	$('body').on("click", ".ucomment", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var id = container.find(".upostid").val();
		var comments = container.find(".ucomments");
		container.find(".uc_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showusercomments.php',
			method: 'POST',
			data: {
				first: true,
				postid: id,
			},
			success: function(data) {
				comments.append(data);
			}
		});
	});
	$('body').on("click", ".uviewmorecomments", function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".upostid").val();
		var cstart = parseInt(container.find(".uc_count").val());
		var climit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showusercomments.php',
			method: 'POST',
			data: {
				more: true,
				postid: id,
				cstart: cstart,
				climit: climit
			},
			success: function(data) {
				if (data == '') {
					container.find(".uviewmorecomments").css("visibility", "hidden");
					container.find(".uviewallcomments").css("visibility", "hidden");
				} else {
					container.find(".uappendcomment").append(data);
					container.find(".uc_count").val(cstart+climit);
				}
			}
		});
	});
	$('body').on('click', '.uviewallcomments', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".upostid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showusercomments.php',
			method: 'POST',
			data: {
				all: true,
				postid: id,
			},
			success: function(data) {
				container.find('.uviewmorecomments').css('visibility', 'hidden');
				container.find('.uviewallcomments').css('visibility', 'hidden');
				container.find('.uappendcomment').html(data);
				container.find('.uc_count').val('');
			}
		});
	});
	$('body').on('submit', '.ucomment-form', function(e) {
		var container = $(this).parent().parent().parent();
		var postid = container.find('.upostid').val();
		var commenttext = container.find('.ucommentarea').val();
		var uccount = parseInt(container.find(".uc_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (commenttext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addusercomment.php',
				method: 'POST',
				data: {
					postcomment: true,
					postid: postid,
					commenttext: commenttext
				},
				success: function(data) {
					container.find('.ucommentarea').val('');
					container.find('.uappendcomment').prepend(data);
					container.find(".uc_count").val(uccount+1);
					$.ajax({
						url: '/ajax/pusheraddusercomment.php',
						method: 'POST',
						data: {
							pushcomment: true,
							postid: postid,
							u_username: username
						}
					});
				}
			});
		}
	});
	$('body').on("click", ".ureply", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var commentid = container.find(".ucommentid").val();
		var replies = container.find(".ureplies");
		container.find(".ur_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showuserreplies.php',
			method: 'POST',
			data: {
				first: true,
				commentid: commentid
			},
			success: function(data) {
				replies.append(data);
			}
		});
	});
	$('body').on('click', '.uviewmorereplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".ucommentid").val();
		var rstart = parseInt(container.find(".ur_count").val());
		var rlimit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showuserreplies.php',
			method: 'POST',
			data: {
				more: true,
				commentid: id,
				rstart: rstart,
				rlimit: rlimit
			},
			success: function(data) {
				if (data == '') {
					container.find(".uviewmorereplies").css("visibility", "hidden");
					container.find(".uviewallreplies").css("visibility", "hidden");
				} else {
					container.find(".uappendreply").append(data);
					container.find(".ur_count").val(rstart+rlimit);
				}
			}
		});
	});
	$('body').on('click', '.uviewallreplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".ucommentid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showuserreplies.php',
			method: 'POST',
			data: {
				all: true,
				commentid: id,
			},
			success: function(data) {
				container.find('.uviewmorereplies').css('visibility', 'hidden');
				container.find('.uviewallreplies').css('visibility', 'hidden');
				container.find('.uappendreply').html(data);
				container.find('.ur_count').val('');
			}
		});
	});
	$('body').on('submit', '.ureply-form', function(e) {
		var container = $(this).parent().parent().parent();
		var postid = container.parent().parent().parent().find('.upostid').val();
		var commentid = container.find('.ucommentid').val();
		var replytext = container.find('.ureplyarea').val();
		var urcount = parseInt(container.find(".ur_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (replytext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/adduserreply.php',
				method: 'POST',
				data: {
					postreply: true,
					commentid: commentid,
					postid: postid,
					replytext: replytext
				},
				success: function(data) {
					container.find('.ureplyarea').val('');
					container.find('.uappendreply').prepend(data);
					container.find(".ur_count").val(urcount+1);
					$.ajax({
						url: '/ajax/pusheradduserreply.php',
						method: 'POST',
						data: {
							pushreply: true,
							commentid: commentid,
							u_username: username
						}
					});
				}
			});
		}
	});
	channeladdusercomment.bind('addUserCommentEvent', function(data) {
		var container = $('.upostid[value="'+data['postid']+'"]').parent();
		var uccount = parseInt(container.find(".uc_count").val());
		if (data['uid']) {
			if (data['uid'] != u_sess_id) {
				container.find(".uappendcomment").prepend(data['output']);
				container.find(".uc_count").val(uccount+1);
			}	
		} else if (data['bid']) {
			if (data['bid'] != b_sess_id) {
				container.find(".uappendcomment").prepend(data['output']);
				container.find(".uc_count").val(uccount+1);
			}
		} 
	});
});
</script>
<?php
require_once 'layout/footer.php';
