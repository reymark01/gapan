<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	$sql = "SELECT store_post.id as postid, b_name, b_username, b_profile, b_post, b_postphoto, b_postdate FROM stores, store_post WHERE stores.id = store_post.store_id AND stores.b_username = :username ORDER BY store_post.id DESC LIMIT :start, :lim";
		$res = DB::query($sql, ['username' => Input::get('username')], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while ($row = $res->fetch()) {
			echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded comment-container">
			 	<a href="/business/'.$row['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'">
				<b>'.$row['b_name'].'</b></a><br>
				<small><b>'.Validate::formatDate($row['b_postdate']).'</b></small><br><br>
				<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_post'])).'</div>';
				if (!empty($row['b_postphoto'])) {
					echo '<img class="img-fluid img-thumbnail imgbig" src="/business_photos/'.$row['b_postphoto'].'"><br>';
				}
				echo '<input type="hidden" class="postid" value="'.$row['postid'].'">
				<input type="hidden" class="c_count" value="">
				<hr><a href="#" class="comment">Comment</a>
				<div class="comments"></div>
				</div>';
		}
} else {
	Redirect::to('./');
}
?>
