<?php

require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('postid'))) {
		if (!empty(Input::get('first'))) {
			if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
				echo '<div class="container">
						<form class="form-group comment-form">
						<textarea class="form-control commentarea" name="comment"></textarea>
						<button type="submit" class="btn btn-primary btn-sm float-right">Post comment</button><br>
						</form>
						</div><hr>
					</div>';
			} else {
				echo '<a href="../login">Login</a><hr>';
			}
			$sql = "SELECT  store_post_comments.id, store_post_comments.b_comment, store_post_comments.b_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_post_comments LEFT JOIN stores ON store_post_comments.store_id = stores.id) LEFT JOIN users ON store_post_comments.user_id = users.id) WHERE store_post_comments.store_post_id = :postid ORDER BY store_post_comments.id DESC LIMIT 0, 2";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid')]);
			echo '<div class="appendcomment">';
		} elseif (!empty(Input::get('more'))) {
			$sql = "SELECT  store_post_comments.id, store_post_comments.b_comment, store_post_comments.b_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_post_comments LEFT JOIN stores ON store_post_comments.store_id = stores.id) LEFT JOIN users ON store_post_comments.user_id = users.id) WHERE store_post_comments.store_post_id = :postid ORDER BY store_post_comments.id DESC LIMIT :start, :lim";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid'), 'start' => Input::get('cstart'), 'lim' => Input::get('climit')]);
		} elseif (!empty(Input::get('all'))) {
			$sql = "SELECT  store_post_comments.id, store_post_comments.b_comment, store_post_comments.b_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_post_comments LEFT JOIN stores ON store_post_comments.store_id = stores.id) LEFT JOIN users ON store_post_comments.user_id = users.id) WHERE store_post_comments.store_post_id = :postid ORDER BY store_post_comments.id DESC";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid')]);
		}
		while($row = $results->fetch()) {
				echo '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
				if (!empty($row['b_username'])) {
					echo '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
				} elseif (!empty($row['username'])) {
					echo '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
				}
				 echo '<br><small>'.Validate::formatDate($row['b_commentdate']).'</small>
				 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_comment'])).'<hr></div>
				<input type="hidden" class="commentid" value="'.$row['id'].'">
				<input type="hidden" class="r_count" value="">
				<a href="#" class="reply">Reply</a>
				<div class="replies"></div>
				 </div>';
		}
		if (!empty(Input::get('first'))) {
			echo '</div>
				<a href="#" class="viewmorecomments">view more comments</a>
				<a href="#" class="viewallcomments">view all comments</a>';
		}
	} else {
		Redirect::to('./');
	}
} else {
	Redirect::to('./');
}