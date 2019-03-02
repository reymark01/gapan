<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';
?>
  <div class="container">
    <div class="row flex-sm-row-reverse">
      <div class="col-sm-8">
        <div class="card" style="margin-top: 20px;">
          <div class="card-header bg-primary text-white text-center">Primark</div>
            <div class="card-body">
              <div class="img"><img src="/tourism/image2/16.jpg" class="img-fluid" style="height: 400px;"></div>
            </div>
        </div>
        <div class="card" style="margin-top: 20px;">
          <div class="card-header bg-primary text-white text-center">Primark</div>
            <div class="card-body">
              <iframe class="col-sm-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3537.6085336958768!2d120.94378471499313!3d15.307147389355661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339721197d191789%3A0xf48ff7abd6dadb86!2sMcDonald&#39;s+Primark+Town+Center+Gapan!5e1!3m2!1sen!2sph!4v1551450303626" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
      <div class="col-sm-4" style="margin-top: 20px;">
        <li class="list-group-item active">Dining Places</li>
            <a href="/tourism/bayanihanresto" class="list-group-item">1. Bayanihan Resto Grill</a>
            <a href="/tourism/luz" class="list-group-item">2. Luz Kitchenette</a>
            <a href="/tourism/rustica" class="list-group-item">3. Rustica</a>
            <a href="/tourism/patio" class="list-group-item">4. Patio de Liz Restobar & Grill</a>
            <a href="/tourism/sushimaster" class="list-group-item">5. Sushi Master</a>
            <a href="/tourism/gracia" class="list-group-item">6. Gracia's House of Pasta Gapan Branch</a>
            <a href="/tourism/cafephora" class="list-group-item">7. Cafephora</a>
            <a href="/tourism/ponciana" class="list-group-item">8. Ponciana Kitchen Restaurant</a>
            <a href="/tourism/razon" class="list-group-item">9. Razon's</a>
            <a href="/tourism/jjerrbee" class="list-group-item">10. JJERRBEE's Restaurant</a>
            <a href="/tourism/jolibee" class="list-group-item">11. Jollibee</a>
            <a href="/tourism/melting" class="list-group-item">12. Melting Pot Shabu-Shabu, Seafoods and Dimsum</a>
            <a href="/tourism/oldhauz" class="list-group-item">13. Old Hauz Sizzlers</a>
            <a href="/tourism/sizzlers" class="list-group-item">14. Sizzlers</a>
            <a href="/tourism/juliets" class="list-group-item">15. Juliet's Restaurant + Events</a>
            <a href="/tourism/shakeys" class="list-group-item">16. Shakeys</a>                      
<br>
<br>
            <li class="list-group-item active" >Malls, Grocery Store and Sports Facilities</li>
            <a href="/tourism/waltermart" class="list-group-item">1. Walter Mart Gapan</a>
            <a href="/tourism/puregold" class="list-group-item">2. Puregold</a>
            <a href="/tourism/savemore" class="list-group-item">3. Savemore</a>
            <a href="/tourism/unitop" class="list-group-item">4. UNITOP</a>
            <a href="/tourism/primark" class="list-group-item">5. PRIMARK</a>
            <a href="/tourism/stm" class="list-group-item">6. STM Drug Mart</a>
            <a href="/tourism/a&s" class="list-group-item">7. A&S Drug Mart</a>
            <a href="/tourism/gym" class="list-group-item">8. Gapan City Gymnasium</a>
            <a href="/tourism/cockpit" class="list-group-item">9. Gapan Coliseum & Cockpit Arena</a>
            
    </div>
  </div>
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
});
</script>
<?php
require_once '../layout/footer.php';