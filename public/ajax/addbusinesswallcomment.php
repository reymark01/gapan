<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('postcomment'))) {
		if (Session::exist('u_sess_id')) {
			$sql = "INSERT INTO store_wall_post_comments (store_wall_post_id, user_id, bw_comment) VALUES (:postid, :user_id, :comment)";
			if (DB::query($sql, ['comment' => Input::get('commenttext')], true, ['postid' => Input::get('postid'), 'user_id' => Session::get('u_sess_id')])) {
				$newcomment = "SELECT store_wall_post_comments.id, store_wall_post_comments.store_wall_post_id as pid, store_wall_post_comments.bw_comment, store_wall_post_comments.bw_commentdate, users.fname, users.lname, users.username, users.profile FROM (store_wall_post_comments LEFT JOIN users ON store_wall_post_comments.user_id = users.id) WHERE store_wall_post_comments.store_wall_post_id = :postid AND store_wall_post_comments.user_id = :uid ORDER BY store_wall_post_comments.id DESC LIMIT :newlim";
				$row = DB::query($newcomment, [], true, ['postid' => Input::get('postid'), 'uid' => Session::get('u_sess_id'), 'newlim' => 1])->fetch();
				$out = '';
				$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
				$out .= '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
				$out .= '<br><small class="text-muted">'.Validate::formatDate($row['bw_commentdate']).'</small>
				 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['bw_comment'])).'</div>
				  <input type="hidden" class="wcommentid" value="'.$row['id'].'">
				 <input type="hidden" class="wr_count" value="">
				 <a href="#" class="wreply">Reply</a>
				 <div class="wreplies"></div>
				 </div>';
				echo $out;
			}
		} elseif (Session::exist('b_sess_id')) {
			$sql = "INSERT INTO store_wall_post_comments (store_wall_post_id, store_id, bw_comment) VALUES (:postid, :store_id, :comment)";
			if (DB::query($sql, ['comment' => Input::get('commenttext')], true, ['postid' => Input::get('postid'), 'store_id' => Session::get('b_sess_id')])) {
				$newcomment = "SELECT store_wall_post_comments.id, store_wall_post_comments.store_wall_post_id as pid,store_wall_post_comments.bw_comment, store_wall_post_comments.bw_commentdate, stores.b_name, stores.b_profile, stores.b_username FROM (store_wall_post_comments LEFT JOIN stores ON store_wall_post_comments.store_id = stores.id) WHERE store_wall_post_comments.store_wall_post_id = :postid AND store_wall_post_comments.store_id = :bid ORDER BY store_wall_post_comments.id DESC LIMIT :newlim";
				$row = DB::query($newcomment, [], true, ['postid' => Input::get('postid'), 'bid' => Session::get('b_sess_id'), 'newlim' => 1])->fetch();
				$out = '';
				$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
				$out .= '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
				$out .= '<br><small class="text-muted">'.Validate::formatDate($row['bw_commentdate']).'</small>
				 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['bw_comment'])).'</div>
				  <input type="hidden" class="wcommentid" value="'.$row['id'].'">
			 	<input type="hidden" class="wr_count" value="">
			 	<a href="#" class="wreply">Reply</a>
			 	<div class="wreplies"></div>
			 	</div>';
				echo $out;
			}
		}
	} else {
		Redirect::to('../');
	}
} else {
	Redirect::to('../');
}