<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	$sql = "SELECT * FROM gapan_post ORDER BY id DESC LIMIT :start, :lim";
	$result = DB::query($sql, [], true, ['start' => Input::get('start'), 'lim' => Input::get('limit')]);
	while ($row = $result->fetch()) {
		echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded">
			<a href="/GapanCity"><img class="imgsmall" src="/image/seal.png">
			<b>Gapan City</b></a><br>
			<small><b>'.Validate::formatDate($row['post_date']).'</b></small><br><br>
			<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['post'])).'</div>';
			if (!empty($row['post_photo'])) {
				echo '<img class="img-fluid img-thumbnail imgbig" src="/gapan_post_photos/'.$row['post_photo'].'">';
			}
			echo '</div>';
	}
} 