<?php
require_once '../app/core/init.php';

if (Input::exist()) {
	if (Session::exist('admin_sess_id')) {
		$sql = "DELETE FROM news WHERE id = :id";
		DB::query($sql, [], true, ['id' => Input::get('newsid')]);
	} else {
		Redirect::to('/');
	}
}

require_once 'layout/header.php';
$sql = "SELECT * FROM news ORDER BY id DESC";
$results = DB::query($sql);
echo '<br><br>
	<center><h1>News</h1></center>
	<div class="container-fluid">
	<div class="row">';
while($row = $results->fetch()) {
	echo '<div class="col-sm-4"><div class="card-container"><a href="news/'.$row['id'].'">
	<img class="img-thumbnail thumbnail" src="/news_thumbnail/'.$row['news_thumbnail'].'">';
	if (Session::exist('admin_sess_id')) {
		echo '<a href="/admin/news-post/edit/'.$row['id'].'" class="btn btn-primary btn-sm float-right" style="position: absolute;margin-left:-43px;">Edit</a>
			<div id="news-'.$row['id'].'" news-title="'.$row['news_title'].'"><a href="#" class="btn btn-danger btn-sm float-right deleteNews">Delete</a></div>';
	}
	echo '<h3 class="card-title">'.$row['news_title'].'</h3>
	<small class="text-muted">'.Validate::formatDate($row['news_postdate']).'</small></a></div><hr></div>';
}
echo '</div></div>';
?>
<div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteNewsModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Delete <b><span id="newsTitle"></span></b>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      	<form action="" method="post">
      		<input id="newsID" type="hidden" name="newsid" value="<?=$row['id']?>">
        	<button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	if (u_sess_id != '') {
		uAddNotifyChannel.bind('uAddNotifyEvent', function(data) {
			if (u_sess_id == data['u_id']) {
				var notifcount = $(".notif-count").html();
				if (notifcount == '') {
					notifcount = 0;
				}
				var count = parseInt(notifcount)+parseInt(data['count']);
				$(".notif-count").html(count);
			}
		});
	} else if (b_sess_id != '') {
		bAddNotifyChannel.bind('bAddNotifyEvent', function(data) {
			if (b_sess_id == data['b_id']) {
				var notifcount = $(".notif-count").html();
				if (notifcount == '') {
					notifcount = 0;
				}
				var count = parseInt(notifcount)+parseInt(data['count']);
				$(".notif-count").html(count);
			}
		});
	}
	$('body').on('click', '.deleteNews', function (e) {
		e.preventDefault();
		var newsID = $(this).parent().attr('id').split("-")[1];
		var newsTitle = $(this).parent().attr('news-title');
		$('#newsID').val(newsID);
		$('#newsTitle').html(newsTitle);
		$('#deleteNewsModal').modal('show');
	});
});
</script>
<?php
require_once 'layout/footer.php';