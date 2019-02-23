<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	$sql = "SELECT fname, lname, profile, username, b_rate, b_review, b_ratedate FROM users, stores, store_rate WHERE store_rate.user_id = users.id AND store_rate.store_id = stores.id AND stores.b_username = :username ORDER BY store_rate.id DESC LIMIT :start, :lim";
	$result = DB::query($sql, ['username' => Input::get('username')], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
	while ($row = $result->fetch()) {
?>
		<div class="jobs-info p-1">
		<a href="/user/<?=$row['username']?>" style="color:black;">
		<img class="rounded-circle p-1" src="/user_profiles/<?=$row['profile']?>" style="width: 50px; height: 50px;">
		<h5 style="margin-top: 5px;font-weight:bold;"><?=$row['fname'].' '.$row['lname']?></h5>
		</a>
		<p class="text-muted"><?=Validate::formatDate($row['b_ratedate'])?></p>
		<br>
		<div style="text-align: center;">
<?php
		$newavg = explode('.', $row['b_rate'])[0];
		for($i=0;$i<5;$i++) {
			if ($i < $newavg) {
				echo '<span style="font-size:10px; color: yellow;" class="fa fa-star"></span>';
			} else {
				echo '<span style="font-size:10px;" class="fa fa-star"></span>';
			}
		}
?>											
		</div>
		<p><?=$row['b_review']?></p>
	</div>
	<hr>
<?php
	}
}