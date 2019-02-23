<?php
require_once '../../app/core/newinit.php';

if (Input::exist() && !empty(Input::get('postgetnotifications'))) {
	if (Session::exist('u_sess_id')) {
		$sql = "SELECT * FROM user_notification WHERE user_id = :id ORDER BY id DESC LIMIT :start, :lim";
		$results = DB::query($sql, [], true, ['id' => Session::get('u_sess_id'), 'start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while($row = $results->fetch()) {
			$output = '';
			$output .= '<div class="container">';
			if ($row['notif_from'] == 'admin') {
				if ($row['link'] == 'event') {
					$output .= '<a href="/event/'.$row['link_id'].'"><li class="dropdown-item"><img src="/image/seal.png" class="imgsmall">Gapan City posted an event<br>';	
				} elseif ($row['link'] == 'news') {
					$output .= '<a href="/news/'.$row['link_id'].'"><li class="dropdown-item"><img src="/image/seal.png" class="imgsmall">Gapan City posted a news<br>';
				} elseif ($row['link'] == 'GapanCity') {
					$output .= '<a href="/GapanCity"><li class="dropdown-item"><img src="/image/seal.png" class="imgsmall">Gapan City posted an announcement<br>';
				}
			} elseif ($row['notif_from'] == 'user') {
				$res = DB::query("SELECT fname, lname, profile FROM users WHERE id = :uid", [], true, ['uid' => $row['from_id']])->fetch();
				if ($row['notif_type'] == 'comment') {
					$output .= '<a href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' commented on your post<br>';
				} elseif ($row['notif_type'] == 'reply') {
					$output .= '<a href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' replied on your post<br>';
				} elseif ($row['notif_type'] == 'commentreply') {
					$output .= '<a href="/'.$row['linkusertype'].'/'.$row['link'].'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' replied on your comment<br>';
				}
			} elseif ($row['notif_from'] == 'store') {
				$res = DB::query("SELECT b_name, b_profile FROM stores WHERE id = :uid", [], true, ['uid' => $row['from_id']])->fetch();
				if ($row['notif_type'] == 'comment') {
					$output .= '<a href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'">';
					$output .= $res['b_name'].' commented on your post<br>';
				} elseif ($row['notif_type'] == 'reply') {
					$output .= '<a href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'">';
					$output .= $res['b_name'].' replied on your post<br>';
				} elseif ($row['notif_type'] == 'commentreply') {
					$output .= '<a href="/'.$row['linkusertype'].'/'.$row['link'].'/'.$row['linkto'].'/'.$row['link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'">';
					$output .= $res['b_name'].' replied on your comment<br>';
				}
			}
			$output .= '<small class="text-muted">'.Validate::formatDate($row['notif_date']).'</small></li></a><hr></div>';
			echo $output;
		}
		$sql2 = "UPDATE user_notification SET stat = 1 WHERE user_id = :id";
		DB::query($sql2, [], true, ['id' => Session::get('u_sess_id')]);
	} elseif (Session::exist('b_sess_id')) {
		$sql = "SELECT * FROM store_notification WHERE store_id = :id ORDER BY id DESC LIMIT :start, :lim";
		$results = DB::query($sql, [], true, ['id' => Session::get('b_sess_id'), 'start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while($row = $results->fetch()) {
			$output = '';
			$output .= '<div class="container">';
			if ($row['b_notif_from'] == 'user') {
				$res = DB::query("SELECT fname, lname, profile FROM users WHERE id = :uid", [], true, ['uid' => $row['b_from_id']])->fetch();
				if ($row['b_notif_type'] == 'comment') {
					$output .= '<a href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' commented on your post<br>';
				} elseif ($row['b_notif_type'] == 'reply') {
					$output .= '<a href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' replied on your post<br>';
				} elseif ($row['b_notif_type'] == 'commentreply') {
					$output .= '<a href="/'.$row['b_linkusertype'].'/'.$row['b_link'].'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['fname'].' '.$res['lname'].' replied on your comment<br>';	
				}
			} else if ($row['b_notif_from'] == 'store') {
				$res = DB::query("SELECT b_name, b_profile FROM stores WHERE id = :uid", [], true, ['uid' => $row['b_from_id']])->fetch();
				if ($row['b_notif_type'] == 'comment') {
					$output .= '<a href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['b_name'].' commented on your post<br>';
				} elseif ($row['b_notif_type'] == 'reply') {
					$output .= '<a href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'">';
					$output .= $res['b_name'].' replied on your post<br>';
				} elseif ($row['b_notif_type'] == 'commentreply') {
					$output .= '<a href="/'.$row['b_linkusertype'].'/'.$row['b_link'].'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><li class="dropdown-item"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'">';
					$output .= $res['b_name'].' replied on your comment<br>';
				}
			}
			$output .= '<small class="text-muted">'.Validate::formatDate($row['b_notif_date']).'</small></li></a><hr></div>';
			echo $output; 
		}
		$sql2 = "UPDATE store_notification SET b_stat = 1 WHERE store_id = :id";
		DB::query($sql2, [], true, ['id' => Session::get('b_sess_id')]);
	}
}