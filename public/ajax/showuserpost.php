<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql = "SELECT user_post.id as postid, fname, lname, username, profile, u_post, u_postphoto, u_postdate FROM users, user_post WHERE users.id = user_post.user_id AND users.username = :username ORDER BY user_post.id DESC LIMIT :start, :lim";
		$res = DB::query($sql, ['username' => Input::get('username')], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while ($row = $res->fetch()) {
			echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded comment-container">
			 	<a href="/business/'.$row['username'].'"><img class="imgsmall rounded-circle" src="/user_profiles/'.$row['profile'].'">
				<b>'.$row['fname'].' '.$row['lname'].'</b></a><br>
				<small><b>'.Validate::formatDate($row['u_postdate']).'</b></small><br><br>
				<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_post'])).'</div>';
				if (!empty($row['u_postphoto'])) {
					echo '<img class="img-fluid img-thumbnail imgbig" src="/user_photos/'.$row['u_postphoto'].'"><br>';
				}
				echo '<input type="hidden" class="upostid" value="'.$row['postid'].'">
				<input type="hidden" class="uc_count" value="">
				<hr><a href="#" class="ucomment">Comment</a>
				<div class="ucomments"></div>
				</div>';
		}
} else {
	Redirect::to('./');
}
?>
