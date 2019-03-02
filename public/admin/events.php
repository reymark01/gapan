<?php
require_once '../../app/core/newinit.php';

if (Input::exist()) {
  if (Session::exist('admin_sess_id')) {
    $sql = "DELETE FROM events WHERE id = :id";
    DB::query($sql, [], true, ['id' => Input::get('eventid')]);
  } else {
    Redirect::to('/');
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/image/seal.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="/image/seal.png" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">Admin 1</h2><span>Admin Dashboard</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="dashboard" class="brand-small text-center"><strong><img src="/image/seal.png"></strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="dashboard">Notifications</a></li>
            <li><a href="news-post">News Post</a>
            <li><a href="events-post">Events Post</a>
            <li><a href="announce-post">Announcements</a>


            </li>

            
          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Admin Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                
               
                <!-- Log out-->
                <li class="nav-item"><form action="../logout" method="post" class="nav-link logout"> <button type="submit" name="logout" class="btn btn-primary d-none d-sm-inline-block">Logout</button></form></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
<?php
$sql = "SELECT * FROM events ORDER BY id DESC";
$results = DB::query($sql);
echo '<br><br>
	<center><h1>Events</h1></center>
	<div class="container">
	<div class="row">';
while ($row = $results->fetch()) {
	echo '<div class="col-sm-3"><div class="card"><a href="event/'.$row['id'].'">
	<img src="/events_thumbnail/'.$row['events_thumbnail'].'" style="height:250px;width:250px;">';
	echo '<div class="card-body"><h3>'.$row['events_title'].'</h3>
	<small class="text-muted">'.Validate::formatDate($row['events_postdate']).'</small></div></a>
	<div class="card-footer">
		<div id="event-'.$row['id'].'" event-title="'.$row['events_title'].'"><a href="#" class="btn btn-danger float-right deleteEvent">Delete</a></div>
		<a href="/admin/events-post/edit/'.$row['id'].'" class="btn btn-primary">Edit</a>
	</div>
  </div>
	</div>';
}
echo '</div></div>';
?>
</div>
<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEventModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Delete <b><span id="eventTitle"></span></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="" method="post">
          <input id="eventID" type="hidden" name="eventid" value="<?=$row['id']?>">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
	$('body').on('click', '.deleteEvent', function (e) {
    e.preventDefault();
    var eventID = $(this).parent().attr('id').split("-")[1];
    var eventTitle = $(this).parent().attr('event-title');
    $('#eventID').val(eventID);
    $('#eventTitle').html(eventTitle);
    $('#deleteEventModal').modal('show');
  });
});
</script>
</body>
</html>