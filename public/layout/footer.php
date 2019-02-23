<div class="modal fade" id="switchAccountModal" tabindex="-1" role="dialog" aria-labelledby="switchAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="switchAccountModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<h4></h4>
      	<form id="switchAccountForm">
      	<input id="b-username" type="hidden" value="">
      	<input id="u-username" type="hidden" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Switch Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
<footer class="footer-distributed">

  <div class="footer-left">

    <h3>Company<span>logo</span></h3>

    <p class="footer-links">
      <a href="#">Home</a>
      ·
      <a href="#">About</a>
      ·
      <a href="#">Faq</a>
      ·
      <a href="#">Contact</a>
    </p>

    <p class="footer-company-name">Company Name &copy; 2015</p>

    <div class="footer-icons">

      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-github"></i></a>

    </div>

  </div>

  <div class="footer-right">

    <p>Contact Us</p>

    <form id="contactUsForm" action="#" method="post">
      <input type="text" id="contactUsEmail" name="email" placeholder="Email" />
      <textarea id="contactUsMessage" name="message" placeholder="Message"></textarea>
      <button>Send</button>
    </form>

  </div>

</footer>
<script>
$('#switchAccountModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var account = button.data('account')
  var b_username = button.data('b-username')
  var u_username = button.data('u-username')
  var modal = $(this)
  modal.find('.modal-title').text('Switch Account')
  modal.find('.modal-body h4').text('Switch to '+account)
  modal.find('.modal-body #b-username').val(b_username)
  modal.find('.modal-body #u-username').val(u_username)
 })

$('body').on('submit', '#switchAccountForm', function(e) {
	e.preventDefault();
	var busername = $(this).find('#b-username').val();
	var uusername = $(this).find('#u-username').val();
	if (busername != '') {
		$.ajax({
			url: '/ajax/switchaccount.php',
			method: 'post',
			data:{
				toBusiness: true,
				storeusername: busername
			},
			success: function(data) {
				window.location.replace(data);
			}
		})
	} else if (uusername != '') {
		$.ajax({
			url: '/ajax/switchaccount.php',
			method: 'post',
			data:{
				toUser: true,
				userusername: uusername
			},
			success: function(data) {
				window.location.replace(data);	
			}
		})
	}
})
$('body').on('submit', '#contactUsForm', function(e) {
  e.preventDefault();
  var email = $(this).find('#contactUsEmail').val();
  var message = $(this).find('#contactUsMessage').val();
  var emailContainer = $(this).find('#contactUsEmail');
  var messageContainer = $(this).find('#contactUsMessage');
  if (email != '' && message != '') {
    $.ajax({
      url: '/ajax/contactus.php',
      method: 'post',
      data: {
        email: email,
        message: message
      },
      success: function (data) {
        if (data == 'success') {
          emailContainer.val('');
          messageContainer.val('');
        }
      }
    });
  }
})
</script>
</body>
</html>