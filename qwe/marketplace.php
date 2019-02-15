<?php
require_once '../../app/core/newinit.php';
require_once '../layout/newheader.php';
?>
<main>

	
	<div class="container">
	<a href="/marketplace/post" class="btn btn-primary">Post to Marketplace</a> 
</div>
<br>
<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-6"><a href="/marketplace/marketplace" type="submit" name="login" class="btn btn-md btn-primary btn-block text-uppercase active">Business</a></div>
	
			<div class="col-sm-6"><a href="/marketplace/marketplace_user" type="submit" name="" class="btn btn-md btn-primary btn-block text-uppercase ">User</a></div>
		</div>
	</div>
	<br><br>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-sm-9">
								<div class="main-ws-sec">
									

									<div class="posts-section">
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="https://tse2.mm.bing.net/th?id=OIP.O4nS84IuC1Fjr9kBXn90bgHaFj&pid=15.1&P=0&w=244&h=184" class="imgsmall">	
													<div class="usy-name">
														<h3><?=$result["fname"]?></h3>
														<!-- <span><img src="images/clock.png" alt=""><?=Validate::formatDate($post["b_postdate"])?></span> -->
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="template ed-options">
														<li class="template edit-post"><a href="#" postID="<?=$post["postid"]?>" title="">Edit Post</a></li,>
														<li class="template"><a href="#" title="">Mark as sold</a></li>
														<li class="template"><a href="#" title="">Mark as reserved</a></li>
														<li class="template"><a href="#" title="">Delete</a></li>
													</ul>
												</div>
											</div>
											
											<div class="job_descp">
												<form id="edit-form"></form>
												<!--<h3>Senior Wordpress Developer</h3>-->
												<ul class="template job-dt">
													<li class="template"><a style="color:black; font-size: 15px;">Price</a></li>
													<li class="template">₱<span class="b-postprice">121</span></li>
												</ul>
												<p class="b-post">WEW</p>
												<div class="row">
													
												</div>
											</div>
											<div class="edit-buttons">
											</div>
											<div class="job-status-bar">
												<ul class="template like-com">
													<li class="template">
														<a href="#"><i class="la la-heart"></i> Like</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li>
													<li class="template"><a href="#" title="" class="com comment"><img src="images/com.png" alt=""> Comment</a></li>
												</ul>
												<input type="hidden" class="postid" value="">
												<input type="hidden" class="c_count" value="">
												<div class="comments"></div>
											</div>
										</div><!--post-bar end-->
									</div><!--posts-section end-->
									

								</div><!--main-ws-sec end-->
							</div>

							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
									<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Top Jobs</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior PHP Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Developer Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end-->
									<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Most Viewed This Week</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end-->
									<div class="widget suggestions full-width">
										<div class="sd-title">
											<h3>Most Viewed People</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src="images/resources/s1.png" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="images/resources/s2.png" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="images/resources/s3.png" alt="">
												<div class="sgt-text">
													<h4>Poonam</h4>
													<span>Wordpress Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="images/resources/s4.png" alt="">
												<div class="sgt-text">
													<h4>Bill Gates</h4>
													<span>C &amp; C++ Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="images/resources/s5.png" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="images/resources/s6.png" alt="">
												<div class="sgt-text">
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="view-more">
												<a href="#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div>
								</div><!--right-sidebar end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							
						
							<div class="col-lg-12">
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<!-- <i class="la la-dollar"></i> -->
								</div>
							</div>

							
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							
						
							<div class="col-lg-12">
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<!-- <i class="la la-dollar"></i> -->
								</div>
							</div>

							
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->
<?php
if (!empty(Input::get('username'))) {
	$username = $_GET['username'];
	$result = DB::query("SELECT * FROM users WHERE account_verified = 1 AND username = :username", ['username' => $username])->fetch();
	if (!empty($result)) {
		// print_r($post);
		// return;
		echo '<div class="container">

		<div class="row"><div class="col-sm-4"><img class="thumbnail_image" src="/user_profiles/'.$result['profile'].'"><br>'.
			$result['fname'].' '.$result['lname'].'<br>
			'.$result['email'].'<br>
			'.$result['contact'].'</div></div></div>';
	} else {
		Redirect::to('../');
	}
	if (Session::exist('u_sess_id') && Session::get('u_sess_id') != $result['id']) {
		$sql = "SELECT id FROM user_report WHERE reported_id = :reported_id AND user_id = :userid";
		$rid = DB::query($sql, [], true, ['reported_id' => $result['id'], 'userid' => Session::get('u_sess_id')])->fetch();
		if (empty($rid['id'])) {
			echo '<button type="button" id="reportuserbutton" class="btn btn-primary" data-toggle="modal" data-target="#reportUserModal">Report</button>
			<div class="modal fade" id="reportUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	Report <b>'.$result['fname'].' '.$result['lname'].'</b>
			      </div>
			      <div class="modal-footer">
			      	<form id="reportUserForm">
			      		<input type="hidden" id="ureportid" value="'.$result['id'].'">
			        	<button type="submit" name="reportbtn" class="btn btn-primary">Report</button>
			        </form>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      </div>
			    </div>
			  </div>
			</div><h1></1>';
		}
	}
	$sql = "SELECT user_post.id as postid, fname, lname, username, profile, u_post, u_postdate FROM users, user_post WHERE user_post.u_postverified = :veri AND users.id = user_post.user_id AND user_id = :id ORDER BY user_post.id DESC LIMIT 0, 2";
	$res = DB::query($sql, [], true, ['id' => $result['id'], 'veri' => 1]);
	echo '<div class="container">
			<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8" id="appendpost">';
	while ($row = $res->fetch()) {
		echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded"><a href="../business/'.$row['username'].'"><img class="imgsmall rounded-circle" src="/user_profiles/'.$row['profile'].'">
			<b>'.$row['fname'].' '.$row['lname'].'</b></a><br>
			<small><b>'.Validate::formatDate($row['u_postdate']).'</b></small><br><br>
			<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_post'])).'</div>';
			if (!empty($row['u_postphoto'])) {
				echo '<img class="img-fluid img-thumbnail imgbig" src="/user_photos/'.$row['u_postphoto'].'"><br>';
			}
			echo '<input type="hidden" class="upostid" value="'.$row['postid'].'">
			<input type="hidden" class="uc_count" value="">
			<hr><a href="#" class="ucomment">Comment</a>
			<div class="ucomments"></div></div>';
	}
	echo '<div class="col-sm-2"></div></div></div>';
} else {
	Redirect::to('.');
}


?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="../../js/main.js"></script>
<script>
$(document).ready(function() {
	var start = 2;
	var limit = 1;
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	var pusher = new Pusher('be49c320ccd26cd0faa2', {
      cluster: 'ap1',
      forceTLS: true
    });
    var channeladdusercomment = pusher.subscribe('addUserCommentChannel');
    var channeladduserreply = pusher.subscribe('addUserReplyChannel');
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
	var getUserPosts = function () {
		var username = '<?php echo Input::get('username'); ?>';
		$.ajax({
			url: '/ajax/showuserpost.php',
			method: 'POST',
			data: {
				username: username,
				start: start,
				limit: limit
			},
			success: function(data) {
				if (data != '') {
					$("#appendpost").append(data);
					start += limit;
				}
			}
		});
	}
	$(window).scroll(function() {
			if ($(window).scrollTop() == $(document).height() - $(window).height())
				getUserPosts();
	});
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
	$('body').on('submit', '#reportUserForm', function(e) {
		e.preventDefault();
		var id = $(this).find('#ureportid').val();
		$.ajax({
			url: '/ajax/addreport.php',
			method: 'post',
			data: {
				user: true,
				reportedid: id,
				userid: u_sess_id
			},
			success: function(data) {
				$('#reportUserModal').modal('hide');
				$('#reportuserbutton').hide();
			}
		});
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
	channeladduserreply.bind('addUserReplyEvent', function(data) {
		var container = $('.ucommentid[value="'+data['cid']+'"]').parent();
		var urcount = parseInt(container.find(".ur_count").val());
		if (data['uid']) {
			if (data['uid'] != u_sess_id) {
				container.find(".uappendreply").prepend(data['output']);
				container.find(".ur_count").val(urcount+1);
			}	
		} else if (data['bid']) {
			if (data['bid'] != b_sess_id) {
				container.find(".uappendreply").prepend(data['output']);
				container.find(".ur_count").val(urcount+1);
			}
		} 
	});	
});
</script>

			</div>
		</div>
	</div>