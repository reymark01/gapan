<?php
require_once '../../app/core/newinit.php';

if (!Session::exist('admin_sess_id')) {
  Redirect::to('/');
}
if (Input::exist()) {
  if (!empty(Input::get('delete'))) {
    $sql = "DELETE FROM stores WHERE id = :id";
    DB::query($sql, [], true, ['id' => Input::get('id')]);
  } elseif (!empty(Input::get('reset'))) {
    $sql = "UPDATE stores SET b_report = :zero WHERE id = :id";
    DB::query($sql, [], true, ['zero' => 0, 'id' => Input::get('id')]);
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
            <h2><?=Session::get('admin_sess_username')?></h2><span>Admin Dashboard</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>A</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="dashboard">Notifications</a></li>
            <li><a href="news-post">News Post</a></li>
            <li><a href="events-post">Events Post</a></li>
            <li><a href="announce-post">Announcements</a></li>



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
                <li class="nav-item"><form action="../logout" method="post" class="nav-link logout"> <button type="submit" name="logout" class="d-none d-sm-inline-block">Logout</button><i class="fa fa-sign-out"></i></form></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Counts Section -->
      <div class="container-fluid">
          <div class="row">
<?php
$sql2 = "SELECT * FROM stores WHERE b_report >= :report";
$results =  DB::query($sql2, [], true, ['report' => 5]);
while ($row = $results->fetch()) {
  echo '     <div class="col-sm-4">
            <div class="card" style="margin: 15px; ">
              <div class="card-body">
                <form action="" method="post">
                <a href="#">
                  <img src="/business_profiles/'.$row['b_profile'].'" style="height:200px; width:250px;"><br>
                  Business Name: '.$row['b_name'].'<br>
                  Username: '.$row['b_username'].'<br>
                  E-mail: '.$row['b_email'].'<br>
                  Contact No.: '.$row['b_contact'].'</a><br>
                  <input type="hidden" name="id" value="'.$row['id'].'">
                  <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                  <button type="submit" class="btn btn-primary" name="reset" value="reset">Reset reports</button>
                </form></div>
              </div>
            </div>';
}
?>
        </div>
        </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>