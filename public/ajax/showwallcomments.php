<?php

require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('postid'))) {
		if (!empty(Input::get('first'))) {
			if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
				echo '<div class="container row">
						<div class="col-sm-2">';
						if (Session::exist('u_sess_id')) {
							echo '<img class="imgsmall rounded-circle" src="/user_profiles/'.Session::get('u_sess_profile').'">';
						} elseif (Session::exist('b_sess_id')) {
							echo '<img class="imgsmall rounded-circle" src="/business_profiles/'.Session::get('b_sess_profile').'">';
						}
				echo '</div>
					    <div class="col-sm-10">
							<form class="form-group wcomment-form">
							<textarea class="form-control wcommentarea" name="comment"></textarea>
							<button type="submit" class="btn btn-primary btn-sm float-right">Post comment</button><br>
							</form>
						</div>
					</div><hr>';
			} else {
				echo '<a href="/login">Login</a><hr>';
			}
			$sql = "SELECT  store_wall_post_comments.id, store_wall_post_comments.bw_comment, store_wall_post_comments.bw_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_wall_post_comments LEFT JOIN stores ON store_wall_post_comments.store_id = stores.id) LEFT JOIN users ON store_wall_post_comments.user_id = users.id) WHERE store_wall_post_comments.store_wall_post_id = :postid ORDER BY store_wall_post_comments.id DESC LIMIT 0, 2";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid')]);
			echo '<div class="wappendcomment">';
		} elseif (!empty(Input::get('more'))) {
			$sql = "SELECT  store_wall_post_comments.id, store_wall_post_comments.bw_comment, store_wall_post_comments.bw_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_wall_post_comments LEFT JOIN stores ON store_wall_post_comments.store_id = stores.id) LEFT JOIN users ON store_wall_post_comments.user_id = users.id) WHERE store_wall_post_comments.store_wall_post_id = :postid ORDER BY store_wall_post_comments.id DESC LIMIT :start, :lim";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid'), 'start' => Input::get('cstart'), 'lim' => Input::get('climit')]);
		} elseif (!empty(Input::get('all'))) {
			$sql = "SELECT  store_wall_post_comments.id, store_wall_post_comments.bw_comment, store_wall_post_comments.bw_commentdate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_wall_post_comments LEFT JOIN stores ON store_wall_post_comments.store_id = stores.id) LEFT JOIN users ON store_wall_post_comments.user_id = users.id) WHERE store_wall_post_comments.store_wall_post_id = :postid ORDER BY store_wall_post_comments.id DESC";
			$results = DB::query($sql, [], true, ['postid' => Input::get('postid')]);
		}
		while($row = $results->fetch()) {
				echo '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
				if (!empty($row['b_username'])) {
					echo '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
				} elseif (!empty($row['username'])) {
					echo '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
				}
				 echo '<br><small class="text-muted">'.Validate::formatDate($row['bw_commentdate']).'</small>
				 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['bw_comment'])).'<hr></div>
				<input type="hidden" class="wcommentid" value="'.$row['id'].'">
				<input type="hidden" class="wr_count" value="">
				<a href="#" class="wreply">Reply</a>
				<div class="wreplies"></div>
				 </div>';
		}
		if (!empty(Input::get('first'))) {
			echo '</div>
				<a href="#" class="wviewmorecomments">view more comments</a>
				<a href="#" class="wviewallcomments float-right">view all comments</a>';
		}
	} else {
		Redirect::to('./');
	}
} else {
	Redirect::to('./');
}