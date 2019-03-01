<?php
require_once '../app/core/init.php';
require_once 'layout/header.php';
?>
<div class="container p-3">
	<table class="table table-bordered table-striped">
	 	<thead style="background-color: #007bff;color:white;">
	    	<tr>
	    		<th scope="col">PANGUNAHING SERBISYO</th>
	    		<th scope="col">TANGGAPAN</th>
	    		<th scope="col">DOKUMENTONG DAPAT DALHIN AT PROSESO</th>
	    	</tr>
	  	</thead>
		<tbody>
	    	<tr>
	    		<th scope="row">Pagkuha ng Business Permit</th>
	    		<th>Business Permit and Licensing Office</th>
	    		<th></th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Zoning Certificate para sa Business Permit</th>
	    		<th>One Stop Shop</th>
	    		<th>
	    			PARA SA RENEWAL:<br>
					1.Ipakita ang application form galing sa tanggapan ng Business Permit<br>
					2.Lalagyan ng kaukulang halaga ng babayaran<br>
					3.Approval ng clearance
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Building Inspection Clearance para sa Business Permit</th>
	    		<th>City Engineer's Office</th>
	    		<th>
	    			PARA SA RENEWAL:<br>
				  1. Ipakita ang application form galing saTanggapan ng Business Permit<br>
				  2. Lalagyan ng kaukulang halaga ng babayaran<br>
				  3. Approval ng clearance
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Health at Sanitary Clearance para sa Business Permit</th>
	    		<th>City Health Office</th>
	    		<th>1. Magkakaroon ng inspeksyon bago ang nakatakdang pagkuha ng clearance<br>
  					2. Ibigay ang datus na may kaugnayan sa tauhan ng negosyo tulad ng pangalan, edad, at designasyon nito<br>
 				 	3. Ibigay lamang ang mga sumusunod :<br><br>
    				&nbsp;&nbsp;&nbsp;&nbsp;Food Handlers :<br>
      				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Laboratory Result ng Fecalysis, Chest X-ray (plaka, orighinal na resulta at xerox copy, 1 x 1 ID picture)<br><br>
   					&nbsp;&nbsp;&nbsp;&nbsp;Non-Food Handlers:<br>
      				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chest X-ray (plaka, orighinal na resulta at xerox copy
      			</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Fire Safety Clearance para sa Business Permit</th>
	    		<th>One Stop Shop</th>
	    		<th>
	    			1. Ipakita ang aplikasyon na galing sa Tanggapan ng Business Permit<br>
				    2. Kuhanin ang ibibigay na Temporary Clearance<br>
				    3. Isasagawa ang inspection<br>
				</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Zoning Certificate / Locational Clearance</th>
	    		<th>CPDC Office</th>
	    		<th>
					1. Sulat kahilingan ng nakapangalan sa Zoning Administrator<br>
				    2. Lot Plan at Vicinity Map na may pirma ng Geodetic Engineer<br>
				    3. Titulo ng Lupa o Deed of Sale<br>
				    4. Deklarasyon ng lupa<br>
				    5. Resibo ng amilyar at Tax Clearance<br>
				    6. Special Power of Attorney ng may-ari ng lupa (kung kinakailangan)<br>
				    * Karagdagang Dokumento na Kailangan para sa Piggery/Poultry Clearance<br>
				    1. ECC<br>
				    2. Conversion Order form DAR<br>
				    3. Site Clearance from Local Health Officer<br>
				    4. consent of non-objection from majority of occupants and owners of properties
				</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Occupancy Permit</th>
	    		<th>City Engineer's Office</th>
	    		<th>
	    			1. Certificate of completion galing sa Building Official
					<br>2. As Built Plans kung may pagbabago sa plano
					<br>3. Certificate of Final Electrical Inspection
					<br>4. Magsasagawa ng inspeksyon
					<br>5. Magsasagawa ng kaukulang report
					<br>6. Pagbibigay ng clearance
					<br>7. Magbayad sa Treasurer's Office
					<br>8. Pagbibigay ng clearance
					<br>9. Final Fire Safety Inspection Report by Bureau of Fire Protection
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagbabayad ng Buwis</th>
	    		<th>City Treasurer's Office</th>
	    		<th> 
	    			1. Certificate of completion galing sa Building Official
					<br>2. As Built Plans kung may pagbabago sa plano
					<br>3. Certificate of Final Electrical Inspection
					<br>4. Magsasagawa ng inspeksyon
					<br>5. Magsasagawa ng kaukulang report
					<br>6. Pagbibigay ng clearance
					<br>7. Magbayad sa Treasurer's Office
					<br>8. Pagbibigay ng clearance
					<br>9. Final Fire Safety Inspection Report by Bureau of Fire Protection
				</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Tax Clearance</th>
	    		<th>City Treasurer's Office</th>
	    		<th>
	    			1. Magbayad ng certification fee
					<br>2. Ipakita ang resibo sa gagawa ng sertipikasyon
					<br>3. Kasama ang individual property card, susuriin ang katumpakan ng naisagawang sertipikasyon
					<br>4. Approval ng certification
					<br>5. Releasing
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">PAGKUHA NG SEDULA</th>
	    		<th>City Treasurer's Office</th>
	    		<th>
	    			Kinakailangan pong magsadya ang sinuman nais kumuha ng sedula sa Tanggapang ito
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Pagkuha ng Tax Declaration</th>
	    		<th>City Assessor's Office</th>
	    		<th>
	    			1. Kopya ng Titulo ng Lupa
					<br>2. Ipakita ang resibo ng buwis
					<br>3. Magbayad ng Tax Declaration Fee
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row">Paglilipat ng Tax Declaration</th>
	    		<th>City Assessor's Office</th>
	    		<th>
	    			1. Xerox copy ng resibo ng buwis
					<br>2. Xerox copy ng titulo ng lupa
					<br>3. Transfer Fee
					<br>4. Transfer Tax
					<br>5. Sedula ng may-ari
					<br>6. Certified xerox copy ng CAR na galing sa BIR
					<br>7. Aprubadong Plano
	    		</th>
	    	</tr>
	    	<tr>
	    		<th scope="row"></th>
	    		<th></th>
	    		<th></th>
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