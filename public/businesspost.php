<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
if (!empty(Input::get('username') && !empty(Input::get('tab') && !empty(Input::get('pid'))))) {
	$result = DB::query("SELECT id FROM stores WHERE b_account_verified = :one AND b_username = :username", ['username' => Input::get('username')], true, ['one' => 1])->fetch();
		if (!empty($result)) {
			if (Input::get('tab') == 'post') {
			$sql = "SELECT store_post.id as postid, b_name, b_username, b_profile, b_post, b_postdate FROM stores, store_post WHERE stores.id = store_post.store_id AND store_post.store_id = :bid AND store_post.id = :id";
			$row = DB::query($sql, [], true, ['id' => Input::get('pid'), 'bid' => $result['id']])->fetch();
			$sql2 = "SELECT * FROM store_post_photos WHERE store_post_id = :postid";
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
							   <div class="card"><div class="card-header searchcontainer searchlink"><a href="/business/'.$row['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'">
									<p class="m-0">'.$row['b_name'].'</p></a>
										<small class="text-muted"><b>'.Validate::formatDate($row['b_postdate']).'</b></small></div><div class="card-body">
										<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_post'])).'</div>';
					if (!empty($photos)) {
						if (count($photos) == 1) {
							echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photos[0]['b_postphoto'].'"></div>';
						} else {
							echo '<div class="row">';
							foreach ($photos as $photo) {
								echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photo['b_postphoto'].'" style="width: 360px; height: 200px;"></div>';
							}
							echo '</div>';
						}
					}
?>
										<input type="hidden" class="postid" value="<?=$row['postid']?>">
										<input type="hidden" class="c_count" value="">
										<hr><a href="#" class="comment">Comment</a>
										<div class="comments">

										</div>
								</div>
							</div>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
<?php
			} 
		} elseif (Input::get('tab') == 'wallpost') {
			$sql = "SELECT store_wall_post.id as postid, b_name, b_username, b_profile, bw_post, bw_postdate FROM stores, store_wall_post WHERE stores.id = store_wall_post.store_id AND store_wall_post.store_id = :bid AND store_wall_post.id = :id";
			$row = DB::query($sql, [], true, ['id' => Input::get('pid'), 'bid' => $result['id']])->fetch();
			$sql2 = "SELECT * FROM store_wall_post_photos WHERE store_wall_post_id = :postid";
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
								<div class="card"><div class="card-header searchcontainer searchlink"><a href="/business/'.$row['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'">
									<p class="m-0">'.$row['b_name'].'</p></a>
									<small class="text-muted"><b>'.Validate::formatDate($row['bw_postdate']).'</b></small></div><div class="card-body">
										<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['bw_post'])).'</div>';
					if (!empty($photos)) {
						if (count($photos) == 1) {
							echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_wall_photos/'.$photos[0]['bw_postphoto'].'"></div>';
						} else {
							echo '<div class="row">';
							foreach ($photos as $photo) {
								echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_wall_photos/'.$photo['bw_postphoto'].'" style="width: 360px; height: 200px;"></div>';
							}
							echo '</div>';
						}
					}
?>
										<input type="hidden" class="wallpostid" value="<?=$row['postid']?>">
										<input type="hidden" class="wc_count" value="">
										<hr><a href="#" class="wcomment">Comment</a>
										<div class="wcomments">

										</div>
								</div>
							</div>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
<?php
			}
		}
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
	var channeladdbusinesscomment = pusher.subscribe('addBusinessCommentChannel');
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
	$('body').on("click", ".wcomment", function(e) {
		e.preventDefault();
		var container = $(this).parent().parent().parent();
		var id = container.find(".wallpostid").val();
		var comments = container.find(".wcomments");
		container.find(".wc_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showwallcomments.php',
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
	$('body').on("click", ".wviewmorecomments", function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".wallpostid").val();
		var cstart = parseInt(container.find(".wc_count").val());
		var climit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showwallcomments.php',
			method: 'POST',
			data: {
				more: true,
				postid: id,
				cstart: cstart,
				climit: climit
			},
			success: function(data) {
				if (data == '') {
					container.find(".wviewmorecomments").css("visibility", "hidden");
					container.find(".wviewallcomments").css("visibility", "hidden");
				} else {
					container.find(".wappendcomment").append(data);
					container.find(".wc_count").val(cstart+climit);
				}
			}
		});
	});
	$('body').on('click', '.wviewallcomments', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".wallpostid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showwallcomments.php',
			method: 'POST',
			data: {
				all: true,
				postid: id,
			},
			success: function(data) {
				container.find('.wviewmorecomments').css('visibility', 'hidden');
				container.find('.wviewallcomments').css('visibility', 'hidden');
				container.find('.wappendcomment').html(data);
				container.find('.wc_count').val('');
			}
		});
	});
	$('body').on('submit', '.wcomment-form', function(e) {
		var container = $(this).parent().parent().parent();
		var postid = container.find('.wallpostid').val();
		var commenttext = container.find('.wcommentarea').val();
		var ccount = parseInt(container.find(".wc_count").val());
		e.preventDefault();
		if (commenttext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinesswallcomment.php',
				method: 'POST',
				data: {
					postcomment: true,
					postid: postid,
					commenttext: commenttext
				},
				success: function(data) {
					container.find('.wcommentarea').val('');
					container.find('.wappendcomment').prepend(data);
					container.find(".wc_count").val(ccount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinesswallcomment.php',
						method: 'POST',
						data: {
							pushcomment: true,
							postid: postid,
							b_username: username
						}
					});
				}
			});
		}
	});
	$('body').on("click", ".wreply", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var commentid = container.find(".wcommentid").val();
		var replies = container.find(".wreplies");
		container.find(".wr_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showbusinesswallreplies.php',
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
	$('body').on('click', '.wviewmorereplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".wcommentid").val();
		var rstart = parseInt(container.find(".wr_count").val());
		var rlimit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinesswallreplies.php',
			method: 'POST',
			data: {
				more: true,
				commentid: id,
				rstart: rstart,
				rlimit: rlimit
			},
			success: function(data) {
				if (data == '') {
					container.find(".wviewmorereplies").css("visibility", "hidden");
					container.find(".wviewallreplies").css("visibility", "hidden");
				} else {
					container.find(".wappendreply").append(data);
					container.find(".wr_count").val(rstart+rlimit);
				}
			}
		});
	});
	$('body').on('click', '.wviewallreplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".wcommentid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinesswallreplies.php',
			method: 'POST',
			data: {
				all: true,
				commentid: id,
			},
			success: function(data) {
				container.find('.wviewmorereplies').css('visibility', 'hidden');
				container.find('.wviewallreplies').css('visibility', 'hidden');
				container.find('.wappendreply').html(data);
				container.find('.wr_count').val('');
			}
		});
	});
	$('body').on('submit', '.wreply-form', function(e) {
		var container = $(this).parent().parent().parent();
		var commentid = container.find('.wcommentid').val();
		var replytext = container.find('.wreplyarea').val();
		var rcount = parseInt(container.find(".wr_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (replytext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinesswallreply.php',
				method: 'POST',
				data: {
					postreply: true,
					commentid: commentid,
					replytext: replytext
				},
				success: function(data) {
					container.find('.wreplyarea').val('');
					container.find('.wappendreply').prepend(data);
					container.find(".wr_count").val(rcount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinesswallreply.php',
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
	$('body').on("click", ".comment", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var id = container.find(".postid").val();
		var comments = container.find(".comments");
		container.find(".c_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showcomments.php',
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
	$('body').on("click", ".viewmorecomments", function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".postid").val();
		var cstart = parseInt(container.find(".c_count").val());
		var climit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showcomments.php',
			method: 'POST',
			data: {
				more: true,
				postid: id,
				cstart: cstart,
				climit: climit
			},
			success: function(data) {
				if (data == '') {
					container.find(".viewmorecomments").css("visibility", "hidden");
					container.find(".viewallcomments").css("visibility", "hidden");
				} else {
					container.find(".appendcomment").append(data);
					container.find(".c_count").val(cstart+climit);
				}
			}
		});
	});
	$('body').on('click', '.viewallcomments', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".postid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showcomments.php',
			method: 'POST',
			data: {
				all: true,
				postid: id,
			},
			success: function(data) {
				container.find('.viewmorecomments').css('visibility', 'hidden');
				container.find('.viewallcomments').css('visibility', 'hidden');
				container.find('.appendcomment').html(data);
				container.find('.c_count').val('');
			}
		});
	});
	$('body').on('submit', '.comment-form', function(e) {
		var container = $(this).parent().parent().parent();
		var postid = container.find('.postid').val();
		var commenttext = container.find('.commentarea').val();
		var ccount = parseInt(container.find(".c_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (commenttext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinesscomment.php',
				method: 'POST',
				data: {
					postcomment: true,
					postid: postid,
					commenttext: commenttext
				},
				success: function(data) {
					container.find('.commentarea').val('');
					container.find('.appendcomment').prepend(data);
					container.find(".c_count").val(ccount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinesscomment.php',
						method: 'POST',
						data: {
							pushcomment: true,
							postid: postid,
							b_username: username
						}
					});
				}
			});
		}
	});
	$('body').on("click", ".reply", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var commentid = container.find(".commentid").val();
		var replies = container.find(".replies");
		container.find(".r_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
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
	$('body').on('click', '.viewmorereplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".commentid").val();
		var rstart = parseInt(container.find(".r_count").val());
		var rlimit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
			method: 'POST',
			data: {
				more: true,
				commentid: id,
				rstart: rstart,
				rlimit: rlimit
			},
			success: function(data) {
				if (data == '') {
					container.find(".viewmorereplies").css("visibility", "hidden");
					container.find(".viewallreplies").css("visibility", "hidden");
				} else {
					container.find(".appendreply").append(data);
					container.find(".r_count").val(rstart+rlimit);
				}
			}
		});
	});
	$('body').on('click', '.viewallreplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".commentid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
			method: 'POST',
			data: {
				all: true,
				commentid: id,
			},
			success: function(data) {
				container.find('.viewmorereplies').css('visibility', 'hidden');
				container.find('.viewallreplies').css('visibility', 'hidden');
				container.find('.appendreply').html(data);
				container.find('.r_count').val('');
			}
		});
	});
	$('body').on('submit', '.reply-form', function(e) {
		var container = $(this).parent().parent().parent();
		var commentid = container.find('.commentid').val();
		var postid = container.parent().parent().parent().find('.postid').val();
		var replytext = container.find('.replyarea').val();
		var rcount = parseInt(container.find(".r_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (replytext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinessreply.php',
				method: 'POST',
				data: {
					postreply: true,
					commentid: commentid,
					postid: postid,
					replytext: replytext
				},
				success: function(data) {
					container.find('.replyarea').val('');
					container.find('.appendreply').prepend(data);
					container.find(".r_count").val(rcount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinessreply.php',
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
	channeladdbusinesscomment.bind('addBusinessCommentEvent', function(data) {
		var container = $('.postid[value="'+data['postid']+'"]').parent();
		var ccount = parseInt(container.find(".c_count").val());
		if (data['uid']) {
			if (data['uid'] != u_sess_id) {
				container.find(".appendcomment").prepend(data['output']);
				container.find(".c_count").val(ccount+1);
			}	
		} else if (data['bid']) {
			if (data['bid'] != b_sess_id) {
				container.find(".appendcomment").prepend(data['output']);
				container.find(".c_count").val(ccount+1);
			}
		}
	});
});
</script>
<?php
require_once 'layout/footer.php';