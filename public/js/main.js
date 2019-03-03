var pusher = new Pusher('be49c320ccd26cd0faa2', {
      cluster: 'ap1',
      forceTLS: true
    });
var addNotifChannel = pusher.subscribe('addNotifChannel');
var bAddNotifyChannel = pusher.subscribe('bAddNotifyChannel');
var uAddNotifyChannel = pusher.subscribe('uAddNotifyChannel');
var nstart = 5;
var nlimit = 5;
addNotifChannel.bind('addNotifEvent', function(data) {
	var notifcount = $(".notif-count").html();
	if (notifcount == '') {
		notifcount = 0;
	}
	var count = parseInt(notifcount)+parseInt(data['count']);
	$(".notif-count").html(count);
});
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
$('body').on('click', '.notif-dropdown', function(e) {
	$.ajax({
		url: '/ajax/shownotifications.php',
		method: 'POST',
		data: {
			postgetnotifications: true,
			start: 0,
			limit: 5
		},
		success: function(data) {
			if (data != '') {
				$(".notiflist").html(data);
			} else {
				$('.seemorenotif').css('visibility', 'hidden');
			}
			nstart = 5;
			nlimit = 5;
			$('.notif-count').html('');
		}
	});
});
notifCount();
$('body').on('click', '.seemorenotif', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var div = $(this);
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
				div.css('visibility', 'hidden');
			}
			$('.notif-count').html('');
		}
	});
});
