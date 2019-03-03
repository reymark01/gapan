<?php
require_once '../../app/core/newinit.php';

if (Input::exist() && !empty(Input::get('postgetnotifications'))) {
	if (Session::exist('u_sess_id')) {
		$sql = "SELECT * FROM user_notification WHERE user_id = :id ORDER BY id DESC LIMIT :start, :lim";
		$results = DB::query($sql, [], true, ['id' => Session::get('u_sess_id'), 'start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while($row = $results->fetch()) {
			$output = '';
			if ($row['notif_from'] == 'admin') {
				if ($row['link'] == 'event') {
					$output .= '<a class="dropdown-item" href="/event/'.$row['link_id'].'"><div class="row"><div class="col-3"><img src="/image/seal.png" class="imgsmall"></div><div class="col-9">Gapan City posted an event<br>';	
				} elseif ($row['link'] == 'news') {
					$output .= '<a class="dropdown-item" href="/news/'.$row['link_id'].'"><div class="row"><div class="col-3"><img src="/image/seal.png" class="imgsmall"></div><div class="col-9">Gapan City posted a news<br>';
				} elseif ($row['link'] == 'GapanCity') {
					$output .= '<a class="dropdown-item" href="/GapanCity"><div class="row"><div class="col-3"><img src="/image/seal.png" class="imgsmall"></div><div class="col-9">Gapan City posted an announcement<br>';
				}
				if ($row['notif_type'] == 'postaccept') {
					$sql3 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :postid LIMIT 1";
					$photo = DB::query($sql3, [], true, ['postid' => $row['link_id']])->fetch();
					$sql4 = "SELECT u_title, u_post FROM user_post WHERE id = :id";
					$upost = DB::query($sql4, [], true, ['id' => $row['link_id']])->fetch();
					$output .= '<a class="dropdown-item" href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row">';
					if (!empty($photo['u_postphoto'])) {
						$output .= '<div class="col-3"><img class="imgsmall rounded-circle my-auto" src="/user_photos/'.$photo['u_postphoto'].'"></div>';
						$output .= '<div class="col-9 m-0 p-0">Your post is approved<br>';
					} else {
						$output .= '<div class="col-12">Your post is approved<br>';
					}
					$output .= $upost['u_title'].'<br>'.$upost['u_post'].'<br>';
				}
			} elseif ($row['notif_from'] == 'user') {
				$res = DB::query("SELECT fname, lname, profile FROM users WHERE id = :uid", [], true, ['uid' => $row['from_id']])->fetch();
				if ($row['notif_type'] == 'comment') {
					$output .= '<a class="dropdown-item" href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' commented on your post<br>';
				} elseif ($row['notif_type'] == 'reply') {
					$output .= '<a class="dropdown-item" href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' replied on your post<br>';
				} elseif ($row['notif_type'] == 'commentreply') {
					$output .= '<a class="dropdown-item" href="/'.$row['linkusertype'].'/'.$row['link'].'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' replied on your comment<br>';
				}
			} elseif ($row['notif_from'] == 'store') {
				$res = DB::query("SELECT b_name, b_profile FROM stores WHERE id = :uid", [], true, ['uid' => $row['from_id']])->fetch();
				if ($row['notif_type'] == 'comment') {
					$output .= '<a class="dropdown-item" href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' commented on your post<br>';
				} elseif ($row['notif_type'] == 'reply') {
					$output .= '<a class="dropdown-item" href="/user/'.Session::get('u_sess_username').'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' replied on your post<br>';
				} elseif ($row['notif_type'] == 'commentreply') {
					$output .= '<a class="dropdown-item" href="/'.$row['linkusertype'].'/'.$row['link'].'/'.$row['linkto'].'/'.$row['link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' replied on your comment<br>';
				}
			}
			$output .= '<small class="text-muted">'.Validate::formatDate($row['notif_date']).'</small></div></div></a><hr>';
			echo $output;
		}
		$sql2 = "UPDATE user_notification SET stat = 1 WHERE user_id = :id";
		DB::query($sql2, [], true, ['id' => Session::get('u_sess_id')]);
	} elseif (Session::exist('b_sess_id')) {
		$sql = "SELECT * FROM store_notification WHERE store_id = :id ORDER BY id DESC LIMIT :start, :lim";
		$results = DB::query($sql, [], true, ['id' => Session::get('b_sess_id'), 'start' => Input::get('start'), 'lim' => Input::get('limit')]);
		while($row = $results->fetch()) {
			$output = '';
			if ($row['b_notif_from'] == 'user') {
				$res = DB::query("SELECT fname, lname, profile FROM users WHERE id = :uid", [], true, ['uid' => $row['b_from_id']])->fetch();
				if ($row['b_notif_type'] == 'comment') {
					$output .= '<a class="dropdown-item" href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' commented on your post<br>';
				} elseif ($row['b_notif_type'] == 'reply') {
					$output .= '<a class="dropdown-item" href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' replied on your post<br>';
				} elseif ($row['b_notif_type'] == 'commentreply') {
					$output .= '<a class="dropdown-item" href="/'.$row['b_linkusertype'].'/'.$row['b_link'].'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['fname'].' '.$res['lname'].' replied on your comment<br>';	
				}
			} else if ($row['b_notif_from'] == 'store') {
				$res = DB::query("SELECT b_name, b_profile FROM stores WHERE id = :uid", [], true, ['uid' => $row['b_from_id']])->fetch();
				if ($row['b_notif_type'] == 'comment') {
					$output .= '<a class="dropdown-item" href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' commented on your post<br>';
				} elseif ($row['b_notif_type'] == 'reply') {
					$output .= '<a class="dropdown-item" href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/user_profiles/'.$res['profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' replied on your post<br>';
				} elseif ($row['b_notif_type'] == 'commentreply') {
					$output .= '<a class="dropdown-item" href="/'.$row['b_linkusertype'].'/'.$row['b_link'].'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row"><div class="col-3"><img class="imgsmall" src="/business_profiles/'.$res['b_profile'].'"></div>';
					$output .= '<div class="col-9">'.$res['b_name'].' replied on your comment<br>';
				}
			} elseif ($row['b_notif_from'] == 'admin') {
				if ($row['b_notif_type'] == 'postaccept') {
					$sql3 = "SELECT b_postphoto FROM store_post_photos WHERE store_post_id = :postid LIMIT 1";
					$photo = DB::query($sql3, [], true, ['postid' => $row['b_link_id']])->fetch();
					$sql4 = "SELECT b_title, b_post FROM store_post WHERE id = :id";
					$bpost = DB::query($sql4, [], true, ['id' => $row['b_link_id']])->fetch();
					$output .= '<a class="dropdown-item" href="/business/'.Session::get('b_sess_b_username').'/'.$row['b_linkto'].'/'.$row['b_link_id'].'"><div class="row">';
					if (!empty($photo['b_postphoto'])) {
						$output .= '<div class="col-3"><img class="imgsmall" src="/business_photos/'.$photo['b_postphoto'].'"></div>';
						$output .= '<div class="col-9">Your post is approved<br>';
					} else {
						$output .= '<div class="col-12">Your post is approved<br>';
					}
					$output .= $bpost['b_title'].'<br>'.$bpost['b_post'].'<br>';
				}
			}
			$output .= '<small class="text-muted">'.Validate::formatDate($row['b_notif_date']).'</small></div></div></a><hr>';
			echo $output; 
		}
		$sql2 = "UPDATE store_notification SET b_stat = 1 WHERE store_id = :id";
		DB::query($sql2, [], true, ['id' => Session::get('b_sess_id')]);
	}
}