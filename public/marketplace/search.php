<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';

if (!Input::exist('get') || empty(Input::get('q'))) {
	Redirect::to('/');
}
?>
<div class="container">
	<a href="/marketplace/post" class="btn btn-primary">Post to Marketplace</a>
	<div class="row">
		<div class="col-sm-4"></div>
		<form action="/marketplace/search" class="form-inline my-2 my-lg-0" method="get">
			<div class="input-group">
				<input class="form-control" name="q" type="search" placeholder="Marketplace Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-primary my-2 my-sm-0" type="submit">
						<span class="fas fa-search"></span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<br>
<div class="container">
	<input id="mpSearchTab" type="hidden" value="business">
	<ul class="nav nav-tabs" id="mpSearchTab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="marketSearchUser-tab" data-toggle="tab" href="#" role="tab" aria-selected="true">Users</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="marketSearchBusiness-tab" data-toggle="tab" href="#" role="tab" aria-selected="false">Businesses</a>
	  </li>
	</ul>
</div>
<br>
<div class="container" id="marketsearchresults">
<?php
	$sql = "SELECT fname, lname, username, profile, u_title, user_post.id as postid, u_post, u_postprice, u_postdate FROM users, user_post WHERE MATCH (u_title, u_post) AGAINST (:q) AND users.id = user_post.user_id AND u_postverified = 1 AND u_poststatus != 2 ORDER BY user_post.id DESC LIMIT :lim";
	$result = DB::query($sql, ['q' => Input::get('q')], true, ['lim' => 20]);
	$sql2 = "SELECT fname, lname, username, profile, u_title, user_post.id as postid, u_post, u_postprice, u_postdate FROM user_post JOIN users ON user_post.user_id = users.id WHERE user_post.u_postverified = 1 AND user_post.u_poststatus != 2 AND (u_title LIKE :q OR u_post LIKE :q) ORDER BY user_post.id DESC LIMIT :lim";
	$result2 = DB::query($sql2, ['q' => Input::get('q').'%'], true, ['lim' => 15]);
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
		echo '<a class="searchlink" href="/user/'.$search['username'].'/post/'.$search['postid'].'"><div class="searchcontainer posttext"><img class="imgsmall rounded-circle" src="/user_profiles/'.$search['profile'].'"><b>'.$search['fname'].' '.$search['lname'].'</b><br><small class="text-muted">'.Validate::formatDate($search['u_postdate']).'</small><br><br>
			Title: '.$search['u_title'].'<br>
			Price: '.$search['u_postprice'].'<br><br>';
		$sql2 = "SELECT u_postphoto FROM user_post_photos WHERE user_post_id = :id LIMIT :lim";
		$photo = DB::query($sql2, [], true, ['id' => $search['postid'], 'lim' => 1])->fetch();
		if (!empty($photo)) {
			echo '<img class="img-thumbnail" src="/user_photos/'.$photo['u_postphoto'].'" style="width: 250px; height: 250px;">';
		}
		echo '</div></a><hr>';
	}
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="../js/main.js"></script>
<script>
$(document).ready(function() {
	$('#marketSearchUser-tab').on('click', function() {
		$('#marketsearchresults').html('loading..');
		$.ajax({
			url: '/ajax/showmarketsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				marketUser: true
			},
			success: function(data) {
				$('#marketsearchresults').html(data);
			}
		});
	});
	$('#marketSearchBusiness-tab').on('click', function() {
		$('#marketsearchresults').html('loading..');
		$.ajax({
			url: '/ajax/showmarketsearchresults.php',
			method: 'post',
			data: {
				q: '<?php echo Input::get('q') ?>',
				marketBusiness: true
			},
			success: function(data) {
				$('#marketsearchresults').html(data);
			}
		});
	});
});
</script>
