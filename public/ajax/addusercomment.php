<?php
require_once '../../app/core/newinit.php';

if (!empty(Input::get('postcomment'))) {
	if (Session::exist('u_sess_id')) {
		$sql = "INSERT INTO user_post_comments (user_post_id, user_id, u_comment) VALUES (:postid, :user_id, :comment)";
		if (DB::query($sql, ['comment' => Input::get('commenttext')], true, ['postid' => Input::get('postid'), 'user_id' => Session::get('u_sess_id')])) {
			$newcomment = "SELECT user_post_comments.id, user_post_comments.user_post_id as pid, user_post_comments.u_comment, user_post_comments.u_commentdate, users.fname, users.lname, users.username, users.profile FROM (user_post_comments LEFT JOIN users ON user_post_comments.user_id = users.id) WHERE user_post_comments.user_post_id = :postid AND user_post_comments.user_id = :uid ORDER BY user_post_comments.id DESC LIMIT :newlim";
			$row = DB::query($newcomment, [], true, ['postid' => Input::get('postid'), 'uid' => Session::get('u_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['u_commentdate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_comment'])).'</div>
			 <input type="hidden" class="ucommentid" value="'.$row['id'].'">
			 <input type="hidden" class="ur_count" value="">
			 <a href="#" class="ureply">Reply</a>
			 <div class="ureplies"></div>
			 </div>';
			echo $out;
		}	 	
	} elseif (Session::exist('b_sess_id')) {
		$sql = "INSERT INTO user_post_comments (user_post_id, store_id, u_comment) VALUES (:postid, :store_id, :comment)";
		if (DB::query($sql, ['comment' => Input::get('commenttext')], true, ['postid' => Input::get('postid'), 'store_id' => Session::get('b_sess_id')])) {
			$newcomment = "SELECT user_post_comments.id, user_post_comments.user_post_id as pid, user_post_comments.u_comment, user_post_comments.u_commentdate, stores.b_name, stores.b_profile, stores.b_username FROM (user_post_comments LEFT JOIN stores ON user_post_comments.store_id = stores.id) WHERE user_post_comments.user_post_id = :postid AND user_post_comments.store_id = :bid ORDER BY user_post_comments.id DESC LIMIT :newlim";
			$row = DB::query($newcomment, [], true, ['postid' => Input::get('postid'), 'bid' => Session::get('b_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['u_commentdate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_comment'])).'</div>
			  <input type="hidden" class="ucommentid" value="'.$row['id'].'">
			 <input type="hidden" class="ur_count" value="">
			 <a href="#" class="ureply">Reply</a>
			 <div class="ureplies"></div>
			 </div>';
			echo $out;
		}
	}
}