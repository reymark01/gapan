<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
?>
<div class="container p-3">
	<table class="table table-bordered table-striped">
	 	<thead>
	    	<tr>
	    		<th scope="col">Serbisyo</th>
	    		<th scope="col">Tanggapan</th>
	    		<th scope="col">Dokumentong dapat dalhin at proseso</th>
	    	</tr>
	  	</thead>
		<tbody>
	    	<tr>
	    		<th scope="row">Pagkuha ng Business Permit</th>
	    		<td>Business Permit and Licensing Office</td>
	    	</tr>
	    	<tr>
	    		<th scope="row"> PAGKUHA NG ZONING CERTIFICATE PARA SA BUSUINESS PERMIT</th>
	    		<td>One Stop Shop</td>
	    		<td>
	    			PARA SA RENEWAL:<br>
					1.Ipakita ang application form galing sa tanggapan ng business permit<br>
					2.Lalagyan ng kaukulang halaga ng babayaran<br>
					3.Approval ng clearance
	    		</td>
	    	</tr>
	    	<tr>
	    		<th scope="row">PAGKUHA NG BUILDING INSPECTION CLEARANCE PARA SA BUSINESS PERMIT</th>
	    		<td>City Engineer's Office</td>
	    		<td>
	    			PARA SA RENEWAL:<br>
				  1. Ipakita ang application form galing saTanggapan ng Business Permit<br>
				  2. Lalagyan ng kaukulang halaga ng babayaran<br>
				  3. Approval ng clearance
	    		</td>
	    	</tr>
	  	</tbody>
	</table>	
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/main.js"></script>
<script>
$(document).ready(function() {
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	if (u_sess_id != '') {
		$(".notif-dropdown").on('click', function() {
			getNotifications(u_sess_id);
			$(".notif-count").html('');
		});
		notifCount(u_sess_id);
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
		$(".notif-dropdown").on('click', function() {
			getNotifications(b_sess_id, 'store');
			$(".notif-count").html('');
		});
		notifCount(b_sess_id, 'store');
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
});
</script>
<?php
require_once 'layout/footer.php';