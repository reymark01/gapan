$('#star1').hover(function() {
	$('.rates').removeClass('checked');
	$(this).addClass('hovered');
}, function() {
	$(this).removeClass('hovered');
});
$('#star2').hover(function() {
	$('.rates').removeClass('checked');
	$('#star1').addClass('hovered');
	$(this).addClass('hovered');
}, function() {
	$('#star1').removeClass('hovered');
	$(this).removeClass('hovered');
});
$('#star3').hover(function() {
	$('.rates').removeClass('checked');
	$('#star1').addClass('hovered');
	$('#star2').addClass('hovered');
	$(this).addClass('hovered');
}, function() {
	$('#star1').removeClass('hovered');
	$('#star2').removeClass('hovered');
	$(this).removeClass('hovered');
});
$('#star4').hover(function() {
	$('.rates').removeClass('checked');
	$('#star1').addClass('hovered');
	$('#star2').addClass('hovered');
	$('#star3').addClass('hovered');
	$(this).addClass('hovered');
}, function() {
	$('#star1').removeClass('hovered');
	$('#star2').removeClass('hovered');
	$('#star3').removeClass('hovered');
	$(this).removeClass('hovered');
});
$('#star5').hover(function() {
	$('.rates').removeClass('checked');
	$('#star1').addClass('hovered');
	$('#star2').addClass('hovered');
	$('#star3').addClass('hovered');
	$('#star4').addClass('hovered');
	$(this).addClass('hovered');
}, function() {
	$('#star1').removeClass('hovered');
	$('#star2').removeClass('hovered');
	$('#star3').removeClass('hovered');
	$('#star4').removeClass('hovered');
	$(this).removeClass('hovered');
});

$('.rates').on('click', function() {
	var rateid = $(this).attr('id');
	var subid = rateid.substring(4);
	var modal = $('#ratingsModal');
	for(var i = 1; i<=subid; i++) {
		$("#star"+i).addClass('checked');
	}
	modal.find('.modal-body #rate').val(subid);
	modal.find('.modal-body #ratenum').text(subid+" Stars");
	$('#ratingsModal').modal('show');
});