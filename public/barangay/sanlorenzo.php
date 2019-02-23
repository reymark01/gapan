<?php
require_once '../../app/core/newinit.php';
require_once '../layout/header.php';
?>
   <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-4 my-2">
        <li class="list-group-item active" >Barangay of Gapan City</li>
            <a href="balante" class="list-group-item">1. Balante</a>
            <a href="bayanihan" class="list-group-item">2. Bayanihan</a>
            <a href="bulak" class="list-group-item">3. Bulak</a>
            <a href="bungo" class="list-group-item">4. Bungo</a>
            <a href="kapalangan" class="list-group-item">5. Kapalangan</a>
            <a href="mabuga" class="list-group-item">6. Mabuga</a>
            <a href="maburak" class="list-group-item">7. Maburak</a>
            <a href="macabaklay" class="list-group-item">8. Makabaklay</a>
            <a href="mahipon" class="list-group-item">9. Mahipon</a>
            <a href="malimba" class="list-group-item">10. Malimba</a>
            <a href="mangino" class="list-group-item">11. Mangino</a>
            <a href="marilu" class="list-group-item">12. Marelo</a>
            <a href="pambuan" class="list-group-item">13. Pambuan</a>
            <a href="parcutela" class="list-group-item">14. Parcutela</a>
            <a href="putingtubig" class="list-group-item">15. Puting Tubig</a>
            <a href="sanlorenzo" class="list-group-item">16. San Lorenzo</a>
            <a href="sannicolas" class="list-group-item">17. San Nicolas</a>
            <a href="sannicolas" class="list-group-item">18. San Roque</a>
            <a href="sanvicente" class="list-group-item">19. San Vicente</a>
            <a href="santacruz" class="list-group-item">20. Santa Cruz</a>
            <a href="santocristonorte" class="list-group-item">21. Santo Cristo Norte</a>
            <a href="santocristosur" class="list-group-item">22. Santo Cristo Sur</a>
            <a href="santonino" class="list-group-item">23. Santo Niño</a>
    </div>

    <div class="col-sm-9 col-md-8 col-lg-8 my-2">
        <div class="card">
          <div class="card-header bg-primary text-white">Map of San Lorenzo, Gapan City Nueva Ecija</div>
            <div class="card-body">
            <iframe class="col-sm-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7696.294640768658!2d120.9473812243029!3d15.314227007404657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339721af14b210b7%3A0x80f302ebd2eac673!2sSan+Lorenzo%2C+Gapan+City%2C+Nueva+Ecija!5e0!3m2!1sen!2sph!4v1544966918157" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
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
