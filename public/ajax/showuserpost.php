<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql = "SELECT user_post.id as postid, fname, lname, username, profile, user_id, u_post, u_title, u_postprice, u_postedited, u_poststatus, u_postdate FROM users, user_post WHERE user_post.u_postverified = 1 AND users.id = user_post.user_id AND users.username = :username AND u_poststatus != 2 ORDER BY user_post.id DESC LIMIT :start, :lim";
		$res = DB::query($sql, ['username' => Input::get('username')], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while ($post = $res->fetch()) {
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
										if (Session::exist('u_sess_id') && $post['user_id'] == Session::get('u_sess_id')) {
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
} else {
	Redirect::to('./');
}
