<?php
require_once '../../app/core/newinit.php';

if (!empty(Input::get('postreply'))) {
	if (Session::exist('u_sess_id')) {
		$sql = "INSERT INTO store_reply (store_comment_id, user_id, b_reply) VALUES (:commentid, :user_id, :reply)";
		if (DB::query($sql, ['reply' => Input::get('replytext')], true, ['commentid' => Input::get('commentid'), 'user_id' => Session::get('u_sess_id')])) {
			$newreply = "SELECT store_reply.id, store_reply.store_comment_id as cid, store_reply.b_reply, store_reply.b_replydate, users.fname, users.lname, users.username, users.profile FROM (store_reply LEFT JOIN users ON store_reply.user_id = users.id) WHERE store_reply.store_comment_id = :commentid AND store_reply.user_id = :uid ORDER BY store_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'uid' => Session::get('u_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['b_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_reply'])).'</div></div>';
			echo $out;
		}	 	
	} elseif (Session::exist('b_sess_id')) {
		$sql = "INSERT INTO store_reply (store_comment_id, store_id, b_reply) VALUES (:commentid, :store_id, :reply)";
		if (DB::query($sql, ['reply' => Input::get('replytext')], true, ['commentid' => Input::get('commentid'), 'store_id' => Session::get('b_sess_id')])) {
			$newreply = "SELECT store_reply.id, store_reply.store_comment_id as cid, store_reply.b_reply, store_reply.b_replydate, stores.b_name, stores.b_username, stores.b_profile FROM (store_reply LEFT JOIN stores ON store_reply.store_id = stores.id) WHERE store_reply.store_comment_id = :commentid AND store_reply.store_id = :bid ORDER BY store_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'bid' => Session::get('b_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['b_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_reply'])).'</div></div>';
			echo $out;
		}
	}
}