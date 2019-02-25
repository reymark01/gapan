<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('q'))) {
		if (Input::get('type') == 'user' && Input::get('tab') == 'user') {
			/*$sql = "SELECT fname, lname, username, profile, u_title, user_post.id as postid, u_post, u_postprice, u_postdate FROM users, user_post WHERE MATCH (u_title, u_post) AGAINST (:q) AND users.id = user_post.user_id AND u_postverified = 1 AND u_poststatus != 2 ORDER BY user_post.id DESC LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 20]);
			$sql2 = "SELECT fname, lname, username, profile, u_title, user_post.id as postid, u_post, u_postprice, u_postdate FROM user_post JOIN users ON user_post.user_id = users.id WHERE user_post.u_postverified = 1 AND user_post.u_poststatus != 2 AND (u_title LIKE :q OR u_post LIKE :q) ORDER BY user_post.id DESC LIMIT :lim";*/
			$sql = "SELECT fname, lname, username, profile, u_title, user_post.id as postid, u_post, u_postprice, u_postdate FROM users, user_post WHERE (MATCH (u_title, u_post) AGAINST (:q) OR u_title LIKE :qq OR u_post LIKE :qq) AND users.id = user_post.user_id AND u_postverified = 1 AND u_poststatus != 2 ORDER BY user_post.id DESC LIMIT :start, :lim";
			$result = DB::query($sql, ['q' => Input::get('q'), 'qq' => Input::get('q').'%'], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
			$users = [];
			while ($row = $result->fetch()) {
				$sql2 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :id LIMIT :lim";
					$photo = DB::query($sql2, [], true, ['id' => $row['postid'], 'lim' => 1])->fetch();
					if (!empty($photo)) {
						$image = '/user_photos/'.$photo['u_postphoto'];
					} else {
						$image = '';
					}
					$data = [
					"searchlink"=>"/user/".$row['username']."/post/".$row['postid'],
					"link"=>"/user/".$row['username'],
					"profile_img"=>'/user_profiles/'.$row['profile'],
					"name"=>$row['fname'].' '.$row['lname'],
					"postdate"=>Validate::formatDate($row['u_postdate']),
					"title"=>$row['u_title'],
					"price"=>$row['u_postprice'],
					"image"=>$image
					];
					array_push($users,$data);
			}
		echo json_encode($users);
		return true;
			//$searches = [];
			/*while ($row = $result->fetch()) {
				array_push($searches, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searches)) {
					array_push($searches, $row2);
				}
			}
			foreach ($searches as $search) {
				echo '<a class="searchlink" href="/user/'.$search['username'].'/post/'.$search['postid'].'"><div class="searchcontainer posttext"><img class="imgsmall rounded-circle" src="/user_profiles/'.$search['profile'].'"><b>'.$search['fname'].' '.$search['lname'].'</b><br><small class="text-muted">'.Validate::formatDate($search['u_postdate']).'</small><br><br>
					Title: '.$search['u_title'].'<br>
					Price: '.$search['u_postprice'].'<br><br>';
				$sql2 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :id LIMIT :lim";
				$photo = DB::query($sql2, [], true, ['id' => $search['postid'], 'lim' => 1])->fetch();
				if (!empty($photo)) {
					echo '<img class="img-thumbnail" src="/user_photos/'.$photo['u_postphoto'].'" style="width: 250px; height: 250px;">';
				}
				echo '</div></a><hr>';
			}*/
		} elseif (Input::get('type') == 'business' && Input::get('tab') == 'business') {
			$sql = "SELECT b_name, b_username, b_profile, b_title, store_post.id as postid, b_post, b_postprice, b_postdate FROM stores, store_post WHERE (MATCH (b_title, b_post) AGAINST (:q) OR b_title LIKE :qq OR b_post LIKE :qq)AND stores.id = store_post.store_id AND b_postverified = 1 AND b_poststatus != 2 ORDER BY store_post.id DESC LIMIT :start, :lim";
			$result = DB::query($sql, ['q' => Input::get('q'), 'qq' => Input::get('q').'%'], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
			$businesses = [];
			while($row = $result->fetch()) {
				$sql2 = "SELECT b_postphoto FROM store_post_photos WHERE store_post_id = :id LIMIT :lim";
				$photo = DB::query($sql2, [], true, ['id' => $row['postid'], 'lim' => 1])->fetch();
				if (!empty($photo)) {
					$image = '/business_photos/'.$photo['b_postphoto'];
				} else {
					$image = '';
				}
				$data = [
				"searchlink"=>"/business/".$row['b_username']."/post/".$row['postid'],
				"link"=>"/business/".$row['b_username'],
				"profile_img"=>'/business_profiles/'.$row['b_profile'],
				"name"=>$row['b_name'],
				"postdate"=>Validate::formatDate($row['b_postdate']),
				"title"=>$row['b_title'],
				"price"=>$row['b_postprice'],
				"image"=>$image
				];
				array_push($businesses,$data);
			}
		echo json_encode($businesses);
		return true;

		}
	}
}