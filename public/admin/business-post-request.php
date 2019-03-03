<?php
require_once '../../app/core/newinit.php';

if (!Session::exist('admin_sess_id')) {
  Redirect::to('../');
}

if (Input::exist()) {
  if (!empty(Input::get('accept'))) {
    $sql = "UPDATE store_post SET b_postdate = NOW(), b_postverified = 1 WHERE id = :id";
    DB::query($sql, [], true, ['id' => Input::get('id')]);
    $sql2 = "INSERT INTO store_notification (store_id, b_notif_type, b_linkto, b_link_id) VALUES (:storeid, :type, :linkto, :linkid)";
    DB::query($sql2, ['type' => 'postaccept', 'linkto' => 'post'], true, ['storeid' => Input::get('storeid'), 'linkid' => Input::get('id')]);
  } elseif (!empty(Input::get('reject'))) {
    $sql = "DELETE FROM store_post WHERE id = :id";
    DB::query($sql, [], true, ['id' => Input::get('id')]);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
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
    <link rel="shortcut icon" href="img/favicon.ico">
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
                  <div class="brand-text d-none d-md-inline-block"><span>Bootstrap </span><strong class="text-primary">Dashboard</strong></div></a></div>
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
$results =  DB::query("SELECT * FROM store_post WHERE b_postverified = 0");
  while ($row = $results->fetch()) {
	  $sql = "SELECT b_name, b_username, b_profile FROM stores WHERE id = :id";
	  $result = DB::query($sql, [], true, ['id' => $row['store_id']])->fetch();
    $sql2 = "SELECT * FROM store_post_photos WHERE store_post_id = :postid";
    $result2 = DB::query($sql2, [], true, ['postid' => $row['id']]);
    $photos = [];
    while ($row2 = $result2->fetch()) {
      array_push($photos, $row2);
    }
  ?>

<div class="col-sm-4 p-0">
  <div class="card" style="margin: 15px; min-height: 375px;">
  <div class="card-body">
    <form action="" method="post">
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="hidden" name="storeid" value="<?=$row['store_id']?>">
      <a href="/business/<?=$result['b_username']?>"><img style="height: 50px;
  width: 50px;" src="/business_profiles/<?=$result['b_profile']?>"><b><?=$result['b_name'];?></b></a>
      <br>
      <small class="text-muted"><?=Validate::formatDate($row['b_postdate'])?></small>
      <br>
      <br>
      <?=$row['b_title']?><br>
      <?=$row['b_postprice']?><br>
      <?=$row['b_post']?><br>
<?php
      if (empty($photos)) {	 
        echo 'No Image<br>';
      } else {
        echo '<div class="row">';
        foreach($photos as $photo) {
          echo '<img class="img-thumbnail" src="/business_photos/'.$photo['b_postphoto'].'" style="width: 160px; height: 160px;">';
        }
        echo '</div>';
      }
      ?>
    </div>
    <div class="card-footer">
      <div class="float-right">
        <button type="submit" class="btn btn-primary" name="accept" value="accept">Accept</button>
        <button type="submit" class="btn btn-danger" name="reject" value="reject">Reject</button>
    </div>
    </form>
      </div>
    </div>
</div>
<?php
}
?>
</div>
</div>
</body>
</html>