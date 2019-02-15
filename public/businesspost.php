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
						<div class="row justify-content-center">
							<div class="col-sm-8 offset-sm-2">
								<div class="border border-dark shadow p-3 mb-5 bg-white rounded"><a href="/business/'.$row['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'">
									<b>'.$row['b_name'].'</b></a><br>
										<small><b>'.Validate::formatDate($row['b_postdate']).'</b></small><br><br>
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
<script src="../../../js/main.js"></script>
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