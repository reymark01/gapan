<?php

class Post {
	public static function renderImages($pid){
		$sql = "SELECT * FROM store_post_photos WHERE store_post_id = :postid";
		$result = DB::query($sql, [], true, ['postid' => $pid]);
		$photos = [];
		while ($row = $result->fetch()) {
			array_push($photos, $row);
		}
		if (!empty($photos)) {
			if (count($photos) == 1) {
				echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photos[0]['b_postphoto'].'"></div>';
			} else {
				echo '<div class="row">';
				if (count($photos) > 4) {
					for ($i=0;$i<4;$i++) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photos[$i]['b_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
					echo '<div class="col-12 text-center">
						<a href="/business/'.Input::get('username').'/post/'.$pid.'"> See More</a>
					</div>';
				} else {
					foreach ($photos as $photo) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photo['b_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
				}
				echo '</div>';
			}
		}
	}

	public static function renderWallImages($pid){
		$sql = "SELECT * FROM store_wall_post_photos WHERE store_wall_post_id = :postid";
		$result = DB::query($sql, [], true, ['postid' => $pid]);
		$photos = [];
		while ($row = $result->fetch()) {
			array_push($photos, $row);
		}
		if (!empty($photos)) {
			if (count($photos) == 1) {
				echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_wall_photos/'.$photos[0]['bw_postphoto'].'"></div>';
			} else {
				echo '<div class="row">';
				if (count($photos) > 4) {
					for ($i=0;$i<4;$i++) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_wall_photos/'.$photos[$i]['bw_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
					echo '<div class="col-12 text-center">
						<a href="/business/'.Input::get('username').'/post/'.$pid.'"> See More</a>
					</div>';
				} else {
					foreach ($photos as $photo) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_wall_photos/'.$photo['bw_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
				}
				echo '</div>';
			}
		}
	}

	public static function renderUserImages($pid){
		$sql = "SELECT * FROM user_post_photos WHERE user_post_id = :postid";
		$result = DB::query($sql, [], true, ['postid' => $pid]);
		$photos = [];
		while ($row = $result->fetch()) {
			array_push($photos, $row);
		}
		if (!empty($photos)) {
			if (count($photos) == 1) {
				echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/user_photos/'.$photos[0]['u_postphoto'].'"></div>';
			} else {
				echo '<div class="row">';
				if (count($photos) > 4) {
					for ($i=0;$i<4;$i++) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/user_photos/'.$photos[$i]['u_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
					echo '<div class="col-12 text-center">
						<a href="/user/'.Input::get('username').'/post/'.$pid.'">See More</a>
					</div>';
				} else {
					foreach ($photos as $photo) {
						echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/user_photos/'.$photo['u_postphoto'].'" style="width: 360px; height: 200px;"></div>';
					}
				}
				echo '</div>';
			}
		}
	}
}