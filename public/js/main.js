var pusher = new Pusher('be49c320ccd26cd0faa2', {
      cluster: 'ap1',
      forceTLS: true
    });
var addNotifChannel = pusher.subscribe('addNotifChannel');
var bAddNotifyChannel = pusher.subscribe('bAddNotifyChannel');
var uAddNotifyChannel = pusher.subscribe('uAddNotifyChannel');
var nstart = 0;
var nlimit = 5;
addNotifChannel.bind('addNotifEvent', function(data) {
	var notifcount = $(".notif-count").html();
	if (notifcount == '') {
		notifcount = 0;
	}
	var count = parseInt(notifcount)+parseInt(data['count']);
	$(".notif-count").html(count);
});
var getNotifications = function() {
	$.ajax({
		url: '/ajax/shownotifications.php',
		method: 'POST',
		data: {
			postgetnotifications: true,
			start: nstart,
			limit: nlimit
		},
		success: function(data) {
			if (data != '') {
				$(".notiflist").append(data);
				nstart += nlimit;
			} else {
				$('.seemorenotif').hide();
			}
			$('.notif-count').html('');
		}
	});
}
var notifCount = function() {
	$.ajax({
		url: '/ajax/notif-count.php',
		method: 'POST',
		data: {
			postgetnotifications: true
		},
		success: function(data) {
			$(".notif-count").html(data);
		}
	});
}
$(".notif-dropdown").on('click', function() {
	 getNotifications();
});
notifCount();
$('.seemorenotif').on('click', function(e) {
  e.preventDefault();
  e.stopPropagation();
  getNotifications();
});
