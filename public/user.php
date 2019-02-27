<?php
require_once '../app/core/init.php';


if (Input::exist()) {
	if (isset($_FILES['file']['size']) && !empty($_FILES['file']['size'])) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'file' => array(
				'ftype' => array('jpg', 'jpeg', 'png')
			)
		));
		if($validation->passed()) {
			$key = Token::uniqKey('users', 'profile');
			$tmp_name = $_FILES['file']['tmp_name'];
			$userprofiles = 'user_profiles/'.$key;
			if (Session::get('u_sess_profile') != 'default') {
				$filename = 'user_profiles/'.Session::get('u_sess_profile');
				unlink($filename);
			}
			$sql = "UPDATE users SET profile = :profile WHERE id = :id";
			if (DB::query($sql, ['profile' => $key], true, ['id' => Session::get('u_sess_id')])) {
				move_uploaded_file($tmp_name, $userprofiles);
			}
			Session::delete('u_sess_profile');
			Session::create('u_sess_profile', $key);
		}
	}
}
function changeProfileModal() {
?>
	<div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="changeProfileModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="changeProfileModalLabel">Change Profile</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="" method="post" enctype="multipart/form-data">
	        	<input type="file" name="file">
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary" name="save" value="save">Save changes</button>
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>
<?php
}

function renderReportModal($resultid, $fname, $lname){
?>
	<div class="modal fade" id="reportUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #007bff;">
	        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Report <?=$fname.' '.$lname?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	Are you sure you want to report <span style="font-weight: bold"><?=$fname.' '.$lname?></span>?
	      </div>
	      <div class="modal-footer">
	      	<form id="reportUserForm">
	      		<input type="hidden" id="ureportid" value="<?=$resultid?>">
	      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        	<button type="submit" name="reportbtn" class="btn btn-primary">Report</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<?php
}

require_once 'layout/newheader.php';

$posts = [];

if (!empty(Input::get('username'))) {
	$username = $_GET['username'];
	$result = DB::query("SELECT * FROM users WHERE account_verified = 1 AND username = :username", ['username' => $username])->fetch();
	if (!empty($result)) {
		$sql = "SELECT user_post.id as postid, fname, lname, username, profile, u_post, u_title, u_postprice, u_postedited, u_poststatus, u_postdate FROM users, user_post WHERE user_post.u_postverified = :veri AND users.id = user_post.user_id AND user_id = :id AND u_poststatus != 2 ORDER BY user_post.id DESC LIMIT 0, 5";
		$res = DB::query($sql, [], true, ['id' => $result['id'], 'veri' => 1]);
		while ($row = $res->fetch()) {
				array_push($posts,$row);
		}
?>
<main>
	<div class="main-section">
		<div class="container">
			<div class="main-section-data">
				<div class="row">
					<div class="col-lg-3 col-md-4 pd-left-none no-pd">
						<div class="main-left-sidebar no-margin">
							<div class="user-data full-width">
								<div class="user-profile">
									<div class="username-dt">
										<div class="usr-pic">
											 <img src="/user_profiles/<?=$result['profile']?>" alt="">
										</div>
									</div><!--username-dt end-->
									<div class="user-specs">
<?php
									if (Session::exist('u_sess_id') && $result['id'] == Session::get('u_sess_id')) {
										echo '<a href="#" id="changeprofile">Change Profile</a>';
										changeProfileModal();
									}
?>
										<h3><?=$result["fname"]." ".$result['lname']?></h3>
										<span>@<?=$result['username']?></span>
									</div>
								</div><!--user-profile end-->
								<ul class="template user-fw-status">
									<li class="template">
										<h4>E-mail</h4>
										<p><?=$result['email']?></p>
									</li>
									<li class="template">
										<h4>Contact No.</h4>
										<p><?=$result['contact']?></p>
									</li>
<?php
								if (Session::exist('u_sess_id') && $result['id'] != Session::get('u_sess_id')) {
									$sql = "SELECT id FROM user_report WHERE reported_id = :reportedid AND user_id = :userid";
									$rid = DB::query($sql, [], true, ['reportedid' => $result['id'], 'userid' => Session::get('u_sess_id')])->fetch();
									if (empty($rid)) {
										echo '<li id="user-report-li" class="template"><a href="#" id="user-report">Report</a></li>';
										renderReportModal($result['id'], $result['fname'], $result['lname']);
									}
								}
?>
								</ul>
							</div><!--user-data end-->
						</div><!--main-left-sidebar end-->
					</div>
					<div class="col-lg-6 col-md-8 no-pd">
						<div class="main-ws-sec">
							<div id="appendpost">
<?php
						if(count($posts) > 0){

							foreach($posts as $post){
?>
							<div class="posts-section">
								<div class="post-bar">
									<div class="post_topbar">
										<div class="usy-dt">
											<img src="/user_profiles/<?=$post['profile']?>" class="imgsmall">	
											<div class="usy-name">
												<h3><?=$post['fname'].' '.$post['lname']?></h3>
												<span><img src="images/clock.png" alt=""><?=Validate::formatDate($post["u_postdate"])?></span>
											</div>
										</div>
										<div class="ed-opts">
<?php
										if ($post['u_postedited'] == 1) {
											echo '<span class="post-edited p-1 badge badge-pill badge-dark" style="font-size:12px;">Edited</span>';
										} else {
											echo '<span class="post-edited p-1" style="font-size:12px;"></span>';
										}
										if ($post['u_poststatus'] == 1) {
											echo '<span class="post-reserved p-1 badge badge-pill badge-danger" style="font-size:12px;">Reserved</span>';
										} else {
											echo '<span class="post-reserved p-1" style="font-size:12px;"></span>';
										}
										if (Session::exist('u_sess_id') && $result['id'] == Session::get('u_sess_id')) {
?>
											<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
											<ul class="template ed-options">
												<li class="template edit-post"><a href="#" postID="<?=$post["postid"]?>" title="">Edit Post</a></li>
<?php
										if ($post['u_poststatus'] == 1) {
											echo '<li class="template mark-available"><a href="#" postID="'.$post['postid'].'">Mark as Available</a></li>';
										} elseif ($post['u_poststatus'] == 0) {
											echo '<li class="template mark-reserved"><a href="#" postID="'.$post['postid'].'">Mark as Reserved</a></li>';
										}
?>
												<li class="template post-sold"><a href="#" postID="<?=$post['postid']?>">Done/Sold</a></li>
											</ul>
<?php
										}
?>
									</div>											
									</div>
									<div class="job_descp">
										<form id="edit-form"></form>
										<!--<h3>Senior Wordpress Developer</h3>-->
										<h3 class="u-posttitle"><?=$post['u_title']?></h3><br>
										<ul class="template job-dt">
											<li class="template"><a style="color:black; font-size: 15px;">Price</a></li>
											<li class="template">₱<span class="u-postprice"><?=$post['u_postprice']?></span></li>
										</ul>
										<p class="u-post"><?=$post['u_post']?></p>
										<div class="row">
											<?php  Post::renderUserImages($post['postid']); ?>
										</div>
									</div>
									<div class="edit-buttons">
									</div>
									<div class="job-status-bar">
										<ul class="template like-com">
											<li class="template"><a href="#" title="" class="com ucomment"><img src="images/com.png" alt=""> Comment</a></li>
										</ul>
										<input type="hidden" class="upostid" value="<?=$post['postid']?>">
										<input type="hidden" class="uc_count" value="">
										<div class="ucomments"></div>
									</div>
								</div><!--post-bar end-->
							</div><!--posts-section end-->
<?php
							}
						}
?>
						</div>
<?php
						if (count($posts) == 5) {
							echo '<a href="#" id="useemore">See More</a>';
						}
?>
						</div><!--main-ws-sec end-->
					</div>

					<div class="col-lg-3 pd-right-none no-pd">
						<div class="right-sidebar">
<?php
						if (Session::exist('u_sess_id') && $result['id'] == Session::get('u_sess_id')) {
?>
							<div class="widget widget-jobs">
								<div class="sd-title" style="text-align: center;">
									<a href="/register" class="btn btn-primary">Add Business Account</a>
								</div>
							</div>
<?php
						}
?>
							<div class="widget widget-jobs">
								<div class="sd-title">
									<h3><?=$result['fname'].' '.$result['lname']?>'s Businesses</h3>
								</div>
								<div class="jobs-list">
<?php
								$sql2 = "SELECT b_name, b_username, b_profile FROM stores WHERE user_id = :userid AND b_account_verified = 1 LIMIT :lim";
								$result2 = DB::query($sql2, [], true, ['userid' => $result['id'], 'lim' => 10]);
								while ($row2 = $result2->fetch()) {
?>
									<div class="job-info p-1">
										<a href="/business/<?=$row2['b_username']?>" style="color:black;">
										<img class="rounded-circle p-1" src="/business_profiles/<?=$row2['b_profile']?>" style="width: 50px; height: 50px;">
										<h5 style="margin-top: 5px;font-weight:bold;"><?=$row2['b_name']?></h5>
										</a>
										<!--<div class="job-details">
											<h3>Senior Product Designer</h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
										</div>
										<div class="hr-rate">
											<span>$25/hr</span>
										</div>-->
									</div><!--job-info end-->
<?php
								}
?>
								</div><!--jobs-list end-->
							</div><!--widget-jobs end-->
						</div><!--right-sidebar end-->
					</div>
				</div>
			</div><!-- main-section-data end-->
		</div> 
	</div>
</main>
<?php
	}
}
?>
<div class="modal fade" id="postDoneModal" tabindex="-1" role="dialog" aria-labelledby="postDoneModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postDoneModalLabel">Mark as Done/Sold</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    	This post will be erased!<br>
        Are you sure you want to mark this post as Done/Sold?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form class="postDoneForm">
        	<input type="hidden" id="postDoneID" value="">
        	<button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script type="text/javascript" src="/js/popper.js"></script>
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="/js/scrollbar.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
<script src="/js/main.js"></script>
<script>
$(document).ready(function() {
	var start = 5;
	var limit = 5;
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
				} else {
					$('#useemore').hide();
				}
			}
		});
	}
	/*$(window).scroll(function() {
			if ($(window).scrollTop() == $(document).height() - $(window).height())
				getUserPosts();
	});*/
	$('body').on('click', '#useemore', function(e) {
		e.preventDefault();
		getUserPosts();
	});
	$('body').on("click", ".ucomment", function(e) {
		e.preventDefault();
		var container = $(this).parent().parent().parent();
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
	$('body').on('click', '#changeprofile', function(e) {
		e.preventDefault();
		$('#changeProfileModal').modal('show');
	});
	$('body').on('click', '#user-report', function(e) {
		e.preventDefault();
		$('#reportUserModal').modal('show');
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
			},
			success: function(data) {
				$('#reportUserModal').modal('hide');
				$('#user-report-li').hide();
			}
		});
	});
	$('body').on('click', '.edit-post', function(e) {
		e.preventDefault();
		var editdiv = $(this);
		editdiv.hide();
		var postID = e.target.attributes[1].value;
		var postpriceID = "price-"+postID;
		var postTextID  = "text-"+postID;
		var postTitleID = "title-"+postID;
		var editBtnID = "edit-"+postID;
		var cancelBtnID = "cancel-"+postID;

		var div = $(this).parent().parent().parent().parent();
		var uposttitle = div.find('.u-posttitle');
		var uposttitleval = div.find('.u-posttitle').html();
		var upost = div.find('.u-post');
		var uposttext = div.find('.u-post').html();
		var upostprice = div.find('.u-postprice');
		var upostpriceval = div.find('.u-postprice').html();
		//bpostprice = replaceWith('<input type="text" value="'+bpostpriceval+'">');
		uposttitle.replaceWith('<input class="edit-post-title" id="'+postTitleID+'" form="edit-form" type="text" value="'+uposttitleval+'">');
		upostprice.replaceWith('<input class="edit-post-price" id="'+postpriceID+'" form="edit-form" type="text" value="'+upostpriceval+'">');
		upost.replaceWith('<textarea form="edit-form" id="'+postTextID+'"class="edit-post-text">'+uposttext+'</textarea>');
		div.find('.edit-buttons').append('<button form="edit-form" id="'+editBtnID+'" class="btn btn-primary float-right edit-post-save" type="submit" name="save" value="edit-save">Save</button><button form="edit-form" id="'+cancelBtnID+'" class="btn btn-danger float-right edit-post-cancel" type="submit" value="edit-cancel">Cancel</button></form>');
		var editsave = div.find('.edit-post-save');
		var editcancel = div.find('.edit-post-cancel');

		$('body').on('click', '#'+editBtnID, function(e) {
			e.preventDefault();
			var editprice = $("#"+postpriceID).val();
			var edittext = $("#"+postTextID).val();
			var edittitle = $("#"+postTitleID).val();
			$.ajax({
				url: '/ajax/edituserpostform.php',
				method: 'post',
				data:{
					postid: postID,
					edittitle: edittitle,
					edittext: edittext,
					editprice: editprice
				},
				success: function(data) {
					if (data == 'error') {
						$("#"+postpriceID).replaceWith('<span class="u-postprice">'+upostpriceval+'</span>');
						$("#"+postTextID).replaceWith('<p class="u-post">'+uposttext+'</p>');
						$("#"+postTitleID).replaceWith('<h3 class="u-posttitle">'+uposttitleval+'</h3>');
						div.find('.edit-buttons').html('');
						editdiv.show();
					} else {
						$("#"+postpriceID).replaceWith('<span class="u-postprice">'+editprice+'</span>');
						$("#"+postTextID).replaceWith('<p class="u-post">'+edittext+'</p>');
						$("#"+postTitleID).replaceWith('<h3 class="u-posttitle">'+edittitle+'</h3>');
						div.find('.edit-buttons').html('');
						div.find('.post-edited').html('Edited');
						div.find('.post-edited').addClass('badge badge-pill badge-dark');
						editdiv.show();
					}
				}
			});
		})
		$('body').on('click', '#'+cancelBtnID, function(e) {
			e.preventDefault();
			$("#"+postpriceID).replaceWith('<span class="u-postprice">'+upostpriceval+'</span>');
			$("#"+postTextID).replaceWith('<p class="u-post">'+uposttext+'</p>');
			$("#"+postTitleID).replaceWith('<h3 class="u-posttitle">'+uposttitleval+'</h3>');
			div.find('.edit-buttons').html('');
			editdiv.show();
		})
	});
	$('body').on('click', '.mark-reserved', function (e) {
		e.preventDefault();
		$(this).parent().parent().parent().find('.ed-options').removeClass('active');
		var div = $(this).parent().parent();
		var parent = $(this).parent();
		var qwe = $(this).find('a');
		var postID = e.target.attributes[1].value;
		$.ajax({
			url: '/ajax/edituserpoststatus.php',
			method: 'post',
			data: {
				editreserved: true,
				postid: postID
			},
			success: function() {
				div.find('.post-reserved').html('Reserved');
				div.find('.post-reserved').addClass('badge badge-pill badge-danger');
				parent.find('.mark-reserved').removeClass("mark-reserved").addClass("mark-available");
				qwe.html('Mark as Available');
			}
		});
	});
	$('body').on('click', '.mark-available', function (e) {
		e.preventDefault();
		$(this).parent().parent().parent().find('.ed-options').removeClass('active');
		var div = $(this).parent().parent();
		var parent = $(this).parent();
		var qwe = $(this).find('a');
		var postID = e.target.attributes[1].value;
		$.ajax({
			url: '/ajax/edituserpoststatus.php',
			method: 'post',
			data: {
				editavailable: true,
				postid: postID
			},
			success: function() {
				div.find('.post-reserved').html('');
				parent.find('.mark-available').removeClass("mark-available").addClass("mark-reserved");
				qwe.html('Mark as Reserved');
			}
		});
	});
	$('body').on('click', '.post-sold', function(e) {
		e.preventDefault();
		$(this).parent().parent().parent().find('.ed-options').removeClass('active');
		var div = $(this).parent().parent();
		var postID = e.target.attributes[1].value;
		$('#postDoneID').val(postID);
		$('#postDoneModal').modal('show');
		$('body').on('submit', '.postDoneForm', function(e) {
			e.preventDefault();
			var postDoneID = $('#postDoneID').val();
			$.ajax({
				url: '/ajax/edituserpoststatus.php',
				method: 'post',
				data: {
					editdone: true,
					postid: postDoneID
				},
				success: function() {
					div.find('.post-reserved').html('Done');
					$('#postDoneModal').modal('hide');
					div.find('.ed-opts-open').hide();
				}
			});
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

<?php
require_once 'layout/footer.php';
