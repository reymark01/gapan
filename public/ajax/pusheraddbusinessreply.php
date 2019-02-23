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
		$storeid = DB::query("SELECT id FROM stores WHERE b_username = :username", ['username' => Input::get('u_username')])->fetch();
		if (Session::exist('u_sess_id')) {
			$newreply = "SELECT store_reply.id, store_reply.store_post_id as pid, store_reply.store_comment_id as cid, store_reply.b_reply, store_reply.b_replydate, users.fname, users.lname, users.username, users.profile FROM (store_reply LEFT JOIN users ON store_reply.user_id = users.id) WHERE store_reply.store_comment_id = :commentid AND store_reply.user_id = :uid ORDER BY store_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'uid' => Session::get('u_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/user/'.$row['username'].'"><img src="/user_profiles/'.$row['profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['fname'].' '.$row['lname'].'</b></a>';
			$out .= '<br><small class="text-muted">'.Validate::formatDate($row['b_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_reply'])).'</div></div>';
			$pusher->trigger('addBusinessReplyChannel', 'addBusinessReplyEvent', array('output' => $out, 'uid' => Session::get('u_sess_id'), 'cid' => $row['cid']));
			$sql2 = "INSERT INTO store_notification (store_id, b_notif_from, b_from_id, b_notif_type, b_link, b_linkto, b_link_id) VALUES (:store_id, :b_notif_from, :b_from_id, :b_notif_type, :b_link, :b_linkto, :b_link_id)";
			if (DB::query($sql2, ['b_notif_from' => 'user', 'b_notif_type' => 'reply', 'b_link' => 'post', 'b_linkto' => 'post'], true, ['store_id' => $storeid['id'], 'b_from_id' => Session::get('u_sess_id'), 'b_link_id' => $row['pid']])) {
			 	$pusher->trigger('bAddNotifyChannel', 'bAddNotifyEvent', ['b_id' => $storeid['id'], 'count' => 1]);
			}
			$sql3 = "SELECT user_id, store_id FROM store_post_comments WHERE id = :id";
			$result = DB::query($sql3, [], true, ['id' => $row['cid']])->fetch();
			$sql5 = "SELECT b_username FROM stores, store_post WHERE stores.id = store_post.store_id AND store_post.id = :postid";
			$username = DB::query($sql5, [], true, ['postid' => $row['pid']])->fetch();
			if (!empty($result['user_id'])) {
				if ($result['user_id'] != Session::get('u_sess_id')) {
					$sql4 = "INSERT INTO user_notification (user_id, notif_from, from_id, notif_type, linkusertype, link, linkto, link_id) VALUES (:userid, :notif_from, :from_id, :notif_type, :usertype, :link, :linkto, :link_id)";
					DB::query($sql4, ['notif_from' => 'user', 'notif_type' => 'commentreply', 'link' => $username['b_username'], 'usertype' => 'business', 'linkto' => 'post'], true, ['userid' => $result['user_id'], 'from_id' => Session::get('u_sess_id'), 'link_id' => $row['pid']]);
				}
			} elseif (!empty($result['store_id'])) {
				$sql4 = "INSERT INTO store_notification (store_id, b_notif_from, b_from_id, b_notif_type, b_linkusertype, b_link, b_linkto, b_link_id) VALUES (:store_id, :b_notif_from, :b_from_id, :b_notif_type, :b_usertype, :b_link, :b_linkto, :b_link_id)";
				DB::query($sql4, ['b_notif_from' => 'user', 'b_notif_type' => 'commentreply', 'b_link' => $username['b_username'], 'b_usertype' => 'business', 'b_linkto' => 'post'], true, ['store_id' => $result['store_id'], 'b_from_id' => Session::get('u_sess_id'), 'b_link_id' => $row['pid']]);
			}
		} elseif (Session::exist('b_sess_id')) {
			$newreply = "SELECT store_reply.id, store_reply.store_post_id as pid, store_reply.store_comment_id as cid, store_reply.b_reply, store_reply.b_replydate, stores.b_name, stores.b_username, stores.b_profile FROM (store_reply LEFT JOIN stores ON store_reply.store_id = stores.id) WHERE store_reply.store_comment_id = :commentid AND store_reply.store_id = :bid ORDER BY store_reply.id DESC LIMIT :newlim";
			$row = DB::query($newreply, [], true, ['commentid' => Input::get('commentid'), 'bid' => Session::get('b_sess_id'), 'newlim' => 1])->fetch();
			$out = '';
			$out .= '<div class="container border border-dark p-3 rounded" style="margin: 5px;">';
			$out .= '<a href="/business/'.$row['b_username'].'"><img src="/business_profiles/'.$row['b_profile'].'" class="imgsmall border border-dark rounded-circle"><b>'.$row['b_name'].'</b></a>';
			$out .= '<br><small>'.Validate::formatDate($row['b_replydate']).'</small>
			 <br><br><div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_reply'])).'</div></div>';
			$pusher->trigger('addBusinessReplyChannel', 'addBusinessReplyEvent', array('output' => $out, 'bid' => Session::get('b_sess_id'), 'cid' => $row['cid']));
			if (Session::get('b_sess_id') != $storeid['id']) {
				$sql2 = "INSERT INTO store_notification (store_id, b_notif_from, b_from_id, b_notif_type, b_link, b_linkto, b_link_id) VALUES (:store_id, :b_notif_from, :b_from_id, :b_notif_type, :b_link, :b_linkto, :b_link_id)";
				if (DB::query($sql2, ['b_notif_from' => 'store', 'b_notif_type' => 'reply', 'b_link' => 'post', 'b_linkto' => 'post'], true, ['store_id' => $storeid['id'], 'b_from_id' => Session::get('b_sess_id'), 'b_link_id' => $row['pid']])) {
					$pusher->trigger('bAddNotifyChannel', 'bAddNotifyEvent', ['b_id' => $storeid['id'], 'count' => 1]);
				}
			}
			$sql3 = "SELECT user_id, store_id FROM store_post_comments WHERE id = :id";
			$result = DB::query($sql3, [], true, ['id' => $row['cid']])->fetch();
			$sql5 = "SELECT b_username FROM stores, store_post WHERE stores.id = store_post.store_id AND store_post.id = :postid";
			$username = DB::query($sql5, [], true, ['postid' => $row['pid']])->fetch();
			if (!empty($result['user_id'])) {
				$sql4 = "INSERT INTO user_notification (user_id, notif_from, from_id, notif_type, linkusertype, link, linkto, link_id) VALUES (:userid, :notif_from, :from_id, :notif_type, :usertype, :link, :linkto, :link_id)";
				DB::query($sql4, ['notif_from' => 'store', 'notif_type' => 'commentreply', 'link' => $username['b_username'], 'usertype' => 'business', 'linkto' => 'post'], true, ['userid' => $result['user_id'], 'from_id' => Session::get('b_sess_id'), 'link_id' => $row['pid']]);
			} elseif (!empty($result['store_id'])) {
				if ($result['store_id'] != Session::get('b_sess_id')) {
					$sql4 = "INSERT INTO store_notification (store_id, b_notif_from, b_from_id, b_notif_type, b_linkusertype, b_link, b_linkto, b_link_id) VALUES (:store_id, :b_notif_from, :b_from_id, :b_notif_type, :b_usertype, :b_link, :b_linkto, :b_link_id)";
					DB::query($sql4, ['b_notif_from' => 'store', 'b_notif_type' => 'commentreply', 'b_link' => $username['b_username'], 'b_usertype' => 'business', 'b_linkto' => 'post'], true, ['store_id' => $result['store_id'], 'b_from_id' => Session::get('b_sess_id'), 'b_link_id' => $row['pid']]);
				}
			}
		}
	}
}