<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql = "SELECT store_wall_post.id as wallpostid, NULL as postid, store_id as store_id, NULL as b_title, bw_post as b_post, NULL as b_postprice, bw_postdate as b_postdate, bw_postedited as b_postedited, NULL as b_poststatus, NULL as b_postverified, stores.b_name, stores.b_profile, stores.b_username FROM store_wall_post, stores WHERE store_wall_post.store_id = stores.id AND stores.b_username = :username
			UNION ALL
			SELECT NULL as wallpostid, store_post.id as postid, store_id as store_id, b_title as b_title, b_post as b_post, b_postprice as b_postprice, b_postdate as b_postdate, b_postedited as b_postedited, b_poststatus as b_poststatus, b_postverified as b_postverified, stores.b_name, stores.b_profile, stores.b_username FROM store_post, stores WHERE store_post.store_id = stores.id AND stores.b_username = :username AND  b_postverified = 1 AND b_poststatus != 2 ORDER BY b_postdate DESC LIMIT :start, :lim";
		$res = DB::query($sql, ['username' => Input::get('username')], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while ($post = $res->fetch()) {
?>			
			<div class="posts-section">
								<div class="post-bar">
									<div class="post_topbar">
										<div class="usy-dt">
											<img src="/business_profiles/<?=$post['b_profile']?>" class="imgsmall">	
											<div class="usy-name">
												<h3><?=$post['b_name']?></h3>
												<span><?=Validate::formatDate($post['b_postdate'])?></span>
											</div>
										</div>
									<div class="ed-opts">
<?php
									if ($post['b_postedited'] == 1) {
										echo '<span class="post-edited p-1 badge badge-pill badge-dark" style="font-size:12px;">Edited</span>';
									} else {
										echo '<span class="post-edited p-1" style="font-size:12px;"></span>';
									}
									if ($post['b_poststatus'] == 1) {
											echo '<span class="post-reserved p-1 badge badge-pill badge-danger" style="font-size:12px;">Reserved</span>';
									} else {
										echo '<span class="post-reserved p-1" style="font-size:12px;"></span>';
									}
									if (Session::exist('b_sess_id') && $post['store_id'] == Session::get('b_sess_id')) {
										if (!empty($post['postid'])) {
											echo '<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
												<ul class="template ed-options">
													<li class="template edit-post"><a href="#" postID="'.$post['postid'].'">Edit Post</a></li>';
											if ($post['b_poststatus'] == 1) {
												echo '<li class="template mark-available"><a href="#" postID="'.$post['postid'].'">Mark as Available</a></li>';
											} elseif ($post['b_poststatus'] == 0) {
												echo '<li class="template mark-reserved"><a href="#" postID="'.$post['postid'].'">Mark as Reserved</a></li>';
											}
											echo '<li class="template post-sold"><a href="#" postID="'.$post['postid'].'">Done/Sold</a></li>';
										} elseif (!empty($post['wallpostid'])) {
											echo '<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
												<ul class="template ed-options">
													<li class="template edit-wallpost"><a href="#" postID="'.$post['wallpostid'].'">Edit Post</a></li>';	
										}

?>
											</ul>
<?php
									}
?>
									</div>
								</div>
									
									<div class="job_descp">
										<form id="edit-form"></form>
<?php
									if (!empty($post['postid'])) {
?>
										<h3 class="b-posttitle"><?=$post['b_title']?></h3><br>
										<ul class="template job-dt">
											<li class="template"><a style="color:black; font-size: 15px;">Price</a></li>
											<li class="template">₱<span class="b-postprice"><?=$post['b_postprice']?></span></li>
										</ul>
										<p class="b-post"><?=$post['b_post']?></p>
										<div class="row">
											<?php  Post::renderImages($post['postid']); ?>
										</div>
									</div>
									<div class="edit-buttons">
									</div>
									<div class="job-status-bar">
										<ul class="template like-com">
											<li class="template"><a href="#" title="" class="com comment"><img src="images/com.png" alt=""> Comment</a></li>
										</ul>
										<input type="hidden" class="postid" value="<?=$post['postid']?>">
										<input type="hidden" class="c_count" value="">
										<div class="comments"></div>
									</div>
<?php
									} elseif (!empty($post['wallpostid'])) {
?>
										<p class="b-post"><?=$post['b_post']?></p>
										<div class="row">
											<?php  Post::renderWallImages($post['wallpostid']); ?>
										</div>
										</div>
										<div class="edit-buttons">
										</div>
										<div class="job-status-bar">
											<ul class="template like-com">
												<li class="template"><a href="#" title="" class="com wcomment"><img src="images/com.png" alt=""> Comment</a></li>
											</ul>
											<input type="hidden" class="wallpostid" value="<?=$post['wallpostid']?>">
											<input type="hidden" class="wc_count" value="">
											<div class="wcomments"></div>
										</div>
<?php
									}
?>
								</div><!--post-bar end-->
							</div><!--posts-section end-->
<?php
		}
} else {
	Redirect::to('./');
}
?>
