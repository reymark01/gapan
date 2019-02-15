<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (!empty(Input::get('q'))) {
		if (!empty(Input::get('announcementTab'))) {
			$sql = "SELECT * FROM gapan_post WHERE MATCH (post) AGAINST (:q) ORDER BY id DESC LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
			$sql2 = "SELECT * FROM gapan_post WHERE post LIKE :q ORDER BY id DESC LIMIT :lim";
			$result2 = DB::query($sql2, ['q' => Input::get('q').'%'], true, ['lim' => 5]);
			$searches = [];
			while ($row = $result->fetch()) {
				array_push($searches, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searches)) {
					array_push($searches, $row2);
				}
			}
			foreach ($searches as $search) {
				echo '<a class="searchlink" href="/GapanCity"><div class="searchcontainer posttext"><img class="imgsmall" src="/image/seal.png"><b>Gapan City</b><br><small class="text-muted">'.Validate::formatDate($search['post_date']).'</small><br><br>'.$search['post'].'<br>';
				if (!empty($search['post_photo'])) {
					echo '<img class="img-thumbnail" src="/gapan_post_photos/'.$search['post_photo'].'" style="width: 250px; height: 250px;">';
				}
				echo '</div></a><hr>';
			}
		}
		if (!empty(Input::get('usersTab'))) {
			$sql = "SELECT * FROM users WHERE account_verified = 1 AND MATCH (fname, lname, username) AGAINST (:q) LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
			$sql2 = "SELECT * FROM users WHERE account_verified = 1 AND (fname LIKE :qq OR lname LIKE :qq OR username LIKE :qq) LIMIT :lim";
			$result2 = DB::query($sql2, ['qq' => Input::get('q').'%'], true, ['lim' => 5]);
			$searchusers = [];
			while ($row = $result->fetch()) {
				array_push($searchusers, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searchusers)) {
					array_push($searchusers, $row2);
				}
			}
			foreach ($searchusers as $searchuser) {
				echo '<a class="searchlink" href="/user/'.$searchuser['username'].'"><div class="searchcontainer"><img class="img-thumbnail" src="/user_profiles/'.$searchuser['profile'].'" style="width: 100px; height: 100px;"><br><b>'.$searchuser['fname'].' '.$searchuser['lname'].'</b><br><small class="text-muted">@'.$searchuser['username'].'</small></div></a><hr>';
			}
		}
		if (!empty(Input::get('eventsTab'))) {
			$sql = "SELECT * FROM events WHERE MATCH (events_title, events_post) AGAINST (:q) ORDER BY id DESC LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
			$sql2 = "SELECT * FROM events WHERE events_title LIKE :qq OR events_post LIKE :qq ORDER BY id DESC LIMIT :lim";
			$result2 = DB::query($sql2, ['qq' => Input::get('q').'%'], true, ['lim' => 5]);
			$searchevents = [];
			while ($row = $result->fetch()) {
				array_push($searchevents, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searchevents)) {
					array_push($searchevents, $row2);
				}
			}
			foreach ($searchevents as $searchevent) {
				echo '<a class="searchlink" href="/event/'.$searchevent['id'].'"><div class="searchcontainer posttext"><b>'.$searchevent['events_title'].'</b><br><small class="text-muted">'.Validate::formatDate($searchevent['events_postdate']).'</small><br><br>
					'.$searchevent['events_post'].'<img class="img-thumbnail" src="/events_thumbnail/'.$searchevent['events_thumbnail'].'" style="width: 250px; height: 250px;">
				</div></a><hr>';
			}
		}
		if (!empty(Input::get('newsTab'))) {
			$sql = "SELECT * FROM news WHERE MATCH (news_title, news_post) AGAINST (:q) ORDER BY id DESC LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
			$sql2 = "SELECT * FROM news WHERE news_title LIKE :qq OR news_post LIKE :qq ORDER BY id DESC LIMIT :lim";
			$result2 = DB::query($sql2, ['qq' => Input::get('q').'%'], true, ['lim' => 5]);
			$searchnews = [];
			while ($row = $result->fetch()) {
				array_push($searchnews, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searchnews)) {
					array_push($searchnews, $row2);
				}
			}
			foreach ($searchnews as $news) {
				echo '<a class="searchlink" href="/news/'.$news['id'].'"><div class="searchcontainer posttext"><b>'.$news['news_title'].'</b><br><small class="text-muted">'.Validate::formatDate($news['news_postdate']).'</small><br><br>
					'.$news['news_post'].'<img class="img-thumbnail" src="/news_thumbnail/'.$news['news_thumbnail'].'" style="width: 250px; height: 250px;">
				</div></a><hr>';
			}
		}
		if (!empty(Input::get('businessTab'))) {
			$sql = "SELECT * FROM stores WHERE b_account_verified = 1 AND MATCH (b_name, b_username) AGAINST (:q) LIMIT :lim";
			$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 10]);
			$sql2 = "SELECT * FROM stores WHERE b_account_verified = 1 AND b_name LIKE :qq OR b_username LIKE :qq LIMIT :lim";
			$result2 = DB::query($sql2, ['qq' => Input::get('q').'%'], true, ['lim' => 5]);
			$searchbusinesses = [];
			while ($row = $result->fetch()) {
				array_push($searchbusinesses, $row);
			}
			while ($row2 = $result2->fetch()) {
				if (!in_array($row2, $searchbusinesses)) {
					array_push($searchbusinesses, $row2);
				}
			}
			foreach ($searchbusinesses as $searchbusiness) {
				echo '<a class="searchlink" href="/business/'.$searchbusiness['b_username'].'"><div class="searchcontainer"><img class="img-thumbnail" src="/business_profiles/'.$searchbusiness['b_profile'].'" style="width: 100px; height: 100px;"><br><b>'.$searchbusiness['b_name'].'</b><br><small class="text-muted">@'.$searchbusiness['b_username'].'</small></div></a><hr>';
			}
		}
	}
} else {
	Redirect::to('.');
}