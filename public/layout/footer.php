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
<footer class="footer-distributed footerdiv">
  <div class="container p-5">
    <div class="row">
      <div class="col-sm-4">
        <div style="color:white;">Republic of the Philippines</div>
        <ul>
          <li class="footercolor"><a href="http://www.gov.ph/" class="footercolor">Official Gazette</a></li>
          <li class="footercolor"><a href="http://www.gov.ph/directory/" class="footercolor">Official Directory</a></li>
          <li class="footercolor"><a href="http://www.gov.ph/calendar/" class="footercolor">Official Calendar</a></li>  
        </ul>
        <div style="color:white;">Resources</div>
        <ul>
          <li class="footercolor"><a href="http://noah.dost.gov.ph/" class="footercolor">Project NOAH</a></li>
        </ul>          
        <div style="color:white;">Judiciary</div>
        <ul>
          <li class="footercolor"><a href="http://sc.judiciary.gov.ph/" class="footercolor">Supreme Court</a></li>
          <li class="footercolor"><a href="http://ca.judiciary.gov.ph/" class="footercolor">Court of Appeals</a></li>
          <li class="footercolor"><a href="http://sb.judiciary.gov.ph/" class="footercolor">Sandiganbayan</a></li>
          <li class="footercolor"><a href="http://cta.judiciary.gov.ph/" class="footercolor">Court of Tax Appeals</a></li>
          <li class="footercolor"><a href="http://jbc.judiciary.gov.ph/" class="footercolor">Judicial Bar and Council</a></li>
        </ul>
      </div>
      <div class="col-sm-4">
        <div style="color:white;">Executive</div>
        <ul>  
          <li class="footercolor"><a href="http://www.president.gov.ph/" class="footercolor">Office of the President</a></li>
          <li class="footercolor"><a href="http://www.ovp.gov.ph/" class="footercolor">Office of the Vice President</a></li>
          <li class="footercolor"><a href="http://www.deped.gov.ph/" class="footercolor">Department of Education</a></li>
          <li class="footercolor"><a href="http://www.dilg.gov.ph/" class="footercolor">Department of Interior and Local Government</a></li>
          <li class="footercolor"><a href="http://www.dof.gov.ph/" class="footercolor">Department of Finance</a></li>
          <li class="footercolor"><a href="http://www.doh.gov.ph/" class="footercolor">Department of Health</a></li>
          <li class="footercolor"><a href="http://www.dost.gov.ph/" class="footercolor">Department of Science and Technology</a></li>
          <li class="footercolor"><a href="http://www.dti.gov.ph/" class="footercolor">Department of Trade and Industry</a></li>
        </ul>
        <div style="color:white;">Legislative</div>
        <ul>
          <li class="footercolor"><a href="http://www.senate.gov.ph/" class="footercolor">Senate of the Philippines</a></li>
          <li class="footercolor"><a href="http://www.congress.gov.ph/" class="footercolor">House of Representatives</a></li>
        </ul>
      </div>          
      <div class="col-sm-4">
        <p style="color: white;">Contact Us</p>
        <form id="contactUsForm" action="#" method="post">
          <input type="text" id="contactUsEmail" name="email" placeholder="Email" />
          <textarea id="contactUsMessage" name="message" placeholder="Message"></textarea>
          <button>Send</button>
        </form>
        <div style="margin-left: 50px;color: white;">
          <p>For more information</p>
          <p>Call:</p>
          <ul>
            <li>044-486-0513</li>
            <li>044-486-5544</li>
            <li>044-486-5502</li>
          </ul>
          <br>
          <p>E-mail</p>
          <a href="google.com">emengpascual19@yahoo.com</a>
        </div>
      </div>
    </div>
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