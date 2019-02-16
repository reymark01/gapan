<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('commentid'))) {
		if (!empty(Input::get('first'))) {
			if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
				echo '<div class="container">
						<form class="form-group reply-form">
						<textarea class="form-control replyarea" name="reply"></textarea>
						<button type="submit" class="btn btn-primary btn-sm float-right">Post reply</button><br>
						</form>
						</div><hr>
					</div>';
			} else {
				echo '<a href="#">Login</a><hr>';
			}
			$sql = "SELECT store_reply.id, store_reply.b_reply, store_reply.b_replydate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_reply LEFT JOIN stores ON store_reply.store_id = stores.id) LEFT JOIN users ON store_reply.user_id = users.id) WHERE store_reply.store_comment_id = :commentid ORDER BY store_reply.id DESC LIMIT 0, 2";
			$results = DB::query($sql, [], true, ['commentid' => Input::get('commentid')]);
			echo '<div class="appendreply">';
		} elseif (!empty(Input::get('more'))) {
			$sql = "SELECT store_reply.id, store_reply.b_reply, store_reply.b_replydate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_reply LEFT JOIN stores ON store_reply.store_id = stores.id) LEFT JOIN users ON store_reply.user_id = users.id) WHERE store_reply.store_comment_id = :commentid ORDER BY store_reply.id DESC LIMIT :start, :lim";
			$results = DB::query($sql, [], true, ['commentid' => Input::get('commentid'), 'start' => Input::get('rstart'), 'lim' => Input::get('rlimit')]);
		} elseif (!empty(Input::get('all'))) {
			$sql = "SELECT store_reply.id, store_reply.b_reply, store_reply.b_replydate, stores.b_name, stores.b_profile, stores.b_username, users.fname, users.lname, users.username, users.profile FROM ((store_reply LEFT JOIN stores ON store_reply.store_id = stores.id) LEFT JOIN users ON store_reply.user_id = users.id) WHERE store_reply.store_comment_id = :commentid ORDER BY store_reply.id DESC";
			$results = DB::query($sql, [], true, ['commentid' => Input::get('commentid')]);
		}
		while($row = $results->fetch()) {
			echo '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			if (!empty($row['b_username'])) {
				echo '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
			} elseif (!empty($row['username'])) {
				echo '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
			}
			 echo '<br><small class="text-muted">'.Validate::formatDate($row['b_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_reply'])).'<hr></div>
			 </div>';
		}
		if (!empty(Input::get('first'))) {
			echo '</div>
				<a href="#" class="viewmorereplies">view more replies</a>
				<a href="#" class="viewallreplies">view all replies</a>';
		}
	}
}