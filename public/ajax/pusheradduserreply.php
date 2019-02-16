<?php
require_once '../pusher/vendor/autoload.php';
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('pushreply'))) {
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
			'be49c320ccd26cd0faa2',
			'27e2b94390ec18ab305d',
			'681832',
			$options
		);
		$userid = DB::query("SELECT id FROM users WHERE username = :username", ['username' => Input::get('u_username')])->fetch();
		if (Session::exist('u_sess_id')) {
			$newreply = "SELECT user_reply.id, user_reply.user_comment_id as cid, user_reply.u_reply, user_reply.u_replydate, users.fname, users.lname, users.username, users.profile FROM (user_reply LEFT JOIN users ON user_reply.user_id = users.id) WHERE user_reply.user_comment_id = :commentid AND user_reply.user_id = :uid ORDER BY user_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'uid' => Session::get('u_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
			$out .= '<br><small class="text-muted">'.Validate::formatDate($row['u_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_reply'])).'</div></div>';
			$pusher->trigger('addUserReplyChannel', 'addUserReplyEvent', array('output' => $out, 'uid' => Session::get('u_sess_id'), 'cid' => $row['cid']));
			if (Session::get('u_sess_id') != $userid['id']) {
				$sql2 = "INSERT INTO user_notification (user_id, notif_from, from_id, notif_type, link, link_id) VALUES (:user_id, :notif_from, :from_id, :notif_type, :link, :link_id)";
				if (DB::query($sql2, ['notif_from' => 'user', 'notif_type' => 'reply', 'link' => 'post'], true, ['user_id' => $userid['id'], 'from_id' => Session::get('u_sess_id'), 'link_id' => $row['pid']])) {
				 	$pusher->trigger('uAddNotifyChannel', 'uAddNotifyEvent', ['u_id' => $userid['id'], 'count' => 1]);
				}
			}	
		} elseif (Session::exist('b_sess_id')) {
			$newreply = "SELECT user_reply.id, user_reply.user_comment_id as cid, user_reply.u_reply, user_reply.u_replydate, stores.b_name, stores.b_username, stores.b_profile FROM (user_reply LEFT JOIN stores ON user_reply.store_id = stores.id) WHERE user_reply.user_comment_id = :commentid AND user_reply.store_id = :bid ORDER BY user_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'bid' => Session::get('b_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/user/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['u_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['u_reply'])).'</div></div>';
			$pusher->trigger('addUserReplyChannel', 'addUserReplyEvent', array('output' => $out, 'bid' => Session::get('b_sess_id'), 'cid' => $row['cid']));
			$sql2 = "INSERT INTO user_notification (user_id, notif_from, from_id, notif_type, link, link_id) VALUES (:user_id, :notif_from, :from_id, :notif_type, :link, :link_id)";
			if (DB::query($sql2, ['notif_from' => 'store', 'notif_type' => 'reply', 'link' => 'post'], true, ['user_id' => $userid['id'], 'from_id' => Session::get('b_sess_id'), 'link_id' => $row['pid']])) {
				$pusher->trigger('uAddNotifyChannel', 'uAddNotifyEvent', ['u_id' => $userid['id'], 'count' => 1]);
			}
		}
	}
}