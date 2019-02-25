<?php
require_once '../../app/core/newinit.php';
if (Input::exist()) {
	if (Input::get('type') == 'business' && Input::get('tab') == 'business') {
		$sql = "SELECT stores.b_name, stores.b_profile, stores.b_username, store_post.id, store_post.b_title, store_post.b_post, store_post.b_postprice, store_post.b_postdate FROM stores, store_post WHERE stores.id = store_post.store_id AND store_post.b_postverified = 1 AND store_post.b_poststatus != 2 ORDER BY store_post.id DESC LIMIT :start, :lim";
		$result = DB::query($sql, [], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);

		$businesses = [];
		// echo '<div class="container">';
			while($row = $result->fetch()) {

				// echo '<a class="searchlink" href="/business/'.$row['b_username'].'/post/'.$row['id'].'"><div class="searchcontainer posttext"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'"><b>'.$row['b_name'].'</b><br><small class="text-muted">'.Validate::formatDate($row['b_postdate']).'</small>
				// 	<br><br>
				// 	Title: '.$row['b_title'].'<br>
				// 	Price: '.$row['b_postprice'].'<br><br>';
					$image = "";
					$sql2 = "SELECT b_postphoto FROM store_post_photos WHERE store_post_id = :id LIMIT :lim";
					$photo = DB::query($sql2, [], true, ['id' => $row['id'], 'lim' => 1])->fetch();
					if (!empty($photo)) {
						// echo '<img class="img-thumbnail" src=
						$image = '/business_photos/'.$photo['b_postphoto'];
						// " style="width: 250px; height: 250px;">';
					}

					$data = [
					"searchlink"=>"/business/".$row['b_username']."/post/".$row['id'],
					"link"=>"/business/".$row['b_username'],
					"profile_img"=>'/business_profiles/'.$row['b_profile'],
					"name"=>$row['b_name'],
					"postdate"=>Validate::formatDate($row['b_postdate']),
					"title"=>$row['b_title'],
					"price"=>$row['b_postprice'],
					"image"=>$image
					];
					array_push($businesses,$data);
					// echo '</div></a><hr>';
			}
		echo json_encode($businesses);
		return true;
		// echo '</div>';
	} elseif (Input::get('type') == 'user' && Input::get('tab') == 'user') {
		$sql = "SELECT users.fname, users.lname, users.username, users.profile, user_post.id, user_post.u_title, user_post.u_post, user_post.u_postprice, user_post.u_postdate FROM users, user_post WHERE users.id = user_post.user_id AND user_post.u_postverified = :one AND user_post.u_poststatus != 2 ORDER BY user_post.id DESC LIMIT :start, :lim";
		$result = DB::query($sql, [], true, ['one' => 1, 'start' => Input::get('start'), 'lim' => Input::get('limit')]);
		// echo '<div class="container">';
		$users = [];

			while($row = $result->fetch()) {
				//echo '<a class="searchlink" href="/user/'.$row['username'].'/post/'.$row['id'].'"><div class="searchcontainer posttext"><img class="imgsmall rounded-circle" src="/user_profiles/'.$row['profile'].'"><b>'.$row['fname'].' '.$row['lname'].'</b><br><small class="text-muted">'.Validate::formatDate($row['u_postdate']).'</small>
					//<br><br>
					//Title: '.$row['u_title'].'<br>
					//Price: '.$row['u_postprice'].'<br><br>';
					$sql2 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :id LIMIT :lim";
					$photo = DB::query($sql2, [], true, ['id' => $row['id'], 'lim' => 1])->fetch();
					if (!empty($photo)) {
						//echo '<img class="img-thumbnail" src="/user_photos/'.$photo['u_postphoto'].'" style="width: 250px; height: 250px;">';
						$image = '/user_photos/'.$photo['u_postphoto'];
					} else {
						$image = '';
					}
					//echo '</div></a><hr>';
					$data = [
					"searchlink"=>"/user/".$row['username']."/post/".$row['id'],
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
		//echo '</div>';
		echo json_encode($users);
		return true;
	}
}