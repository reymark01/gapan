<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';

if (!empty(Input::get('username')) && !empty(Input::get('tab')) && Input::get('tab') == 'offers') {
	$result = DB::query("SELECT * FROM stores WHERE b_account_verified = :one AND b_username = :username", ['username' => Input::get('username')], true, ['one' => 1])->fetch();
	if (!empty($result)) {
			$sql = "SELECT * FROM store_products WHERE store_id = :id";
			$result = DB::query($sql, [], true, ['id' => $result['id']]);
?>
			<div class="row">
<?php
			while($row = $result->fetch()) {
?>			
				<div class="col-sm-3">
            		<div class="card" style="margin: 15px; ">
            			<div class="card-body">
 <?php
 						if (!empty($row['product_photo'])) {
							echo '<img src="/product_photos/'.$row['product_photo'].'" style="width: 100px; height: 100px;"><br>';
						}
						$sql = "SELECT ROUND(AVG(product_rate), 2) as 'rate' FROM store_product_rate WHERE product_id = :product_id";
						$avg = DB::query($sql, [], true, ['product_id' => $row['id']])->fetch();
						$newavg = explode('.', $avg['rate'])[0];
						for($i=0;$i<5;$i++) {
							if ($i < $newavg) {
								echo '<span style="font-size:15px; color: yellow;" class="fa fa-star"></span>';
							} else {
								echo '<span style="font-size:15px;" class="fa fa-star"></span>';
							}
						}
						if (empty($avg['rate'])) {
							echo '<br><br>';
						} else {
							echo '<br><span class="text-muted">'.$avg['rate'].'</span><br>';
						}
						if (Session::exist('u_sess_id')) {
							$sql = "SELECT product_rate FROM store_product_rate WHERE product_id = :id AND user_id = :userid";
							$rate = DB::query($sql, [], true, ['id' => $row['id'], 'userid' => Session::get('u_sess_id')])->fetch();
?>
							Your rate: <?=$rate['product_rate']?>
							<div id="prod-<?=$row['id']?>" prodname="<?=$row['product_name']?>">
								<a href="#" class="ratings">Rate</a>
							</div>
<?php
						}
?>
						<hr>
            			<span style="text-align:center; font-size: 30px;"><?=$row['product_name']?></span><br>
            			Price: <?=$row['product_price']?><br>
            			<div class="card-footer">
            			</div>
					</div>
				</div>
			</div>
<?php
		}
?>
	</div>
	<div class="modal fade" id="ratingsModal" tabindex="-1" role="dialog" aria-labelledby="ratingsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	    			<div class="modal-title"></div>
		        	<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
		        		<span aria-hidden="true">&times;</span>
		        	</button>
	      		</div>
	    		<div class="modal-body">
	    			<h3>Rate <span id="prod_name"></span></h3><br>
	      			<form id="rateProductForm">
						<span id="rate1" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
						<span id="rate2" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
						<span id="rate3" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
						<span id="rate4" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
						<span id="rate5" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
	      				<input id="rate" type="hidden" value="">
	      				<input id="prod_id" type="hidden" value="">
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        		<button type="submit" class="btn btn-primary">Submit</button>
	      			</form>
	      		</div>
	    	</div>
	  	</div>
	</div>
<?php
	}
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/main.js"></script>
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
	$('body').on('submit', '#rateProductForm', function(e) {
		e.preventDefault();
		var rate = $('#rate').val();
		var prod_id = $('#prod_id').val();
		$.ajax({
			url: '/ajax/addproductrate.php',
			method: 'post',
			data: {
				rate: rate,
				prod_id: prod_id
			},
			success: function(data) {
				$('#ratingsModal').modal('hide');
			}
		});
	});
	$('body').on('click', '.ratings', function() {
		let prodId = $(this).parent().attr('id').split("-")[1];
		var prodName = $(this).parent().attr('prodname');
		$('#prod_id').val(prodId);
		$('#prod_name').html(prodName);
		$('#ratingsModal').modal('show');
	});
	$('.rates').on('click', function() {
		$('.rates').removeClass('checked');
		var rate = $(this).prevAll().length + 1;
		$('#rate').val(rate);
		$(this).addClass('checked');
		$(this).prevAll().addClass('checked');
	});
	var rating = 0;
	$('.rates').hover(function() {
		$(this).toggleClass('hovered',)
		$(this).prevAll().toggleClass('hovered')
		rating = $(this).prevAll().length + 1;
	})
});
</script>
<?php
require_once 'layout/footer.php';