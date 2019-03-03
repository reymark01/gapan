<?php
require_once '../../app/core/newinit.php';

if (!Session::exist('admin_sess_id')) {
	Redirect::to('/');
}

$sql = "SELECT * FROM gapan_post WHERE id = :id";
$result = DB::query($sql, [], true, ['id' => Input::get('gpid')])->fetch();
if (empty($result)) {
	Redirect::to('/admin/dashboard');
}
if (Input::exist()) {
	$validate = new Validate;
	$validation = $validate->check($_POST, array(
		'file' => array(
			'ftype' => array('jpg', 'jpeg', 'png')
		)
	));
	if ($validation->passed()) {
		$sql = "UPDATE gapan_post SET post = :post WHERE id = :id";
		if (DB::query($sql, ['post' => Input::get('announcepost')], true, ['id' => $result['id']])) {
			Redirect::to('/admin/announcements');
		}
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
    <link rel="stylesheet" href="/admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="/admin/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="/admin/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="/admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/image/seal.png">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
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
            <li><a href="/admin/dashboard">Notifications</a></li>
            <li><a href="/admin/news-post">News Post</a>
            <li><a href="/admin/events-post">Events Post</a>
            <li><a href="/admin/announce-post">Announcements</a>


            </li>

            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
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
                <li class="nav-item"><form action="/logout" method="post" class="nav-link logout"> <button type="submit" name="logout" class="d-none d-sm-inline-block">Logout</button><i class="fa fa-sign-out"></i></form></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
<div class="container">
 <div class="row">
   <div class="col-sm-2"></div>
	<div class="col-sm-8" id="postappend">
	 <div class="border border-dark shadow p-3 mb-5 bg-white rounded">
	  <form class="form-group" action="" method="post">
	  <a href="GapanCity"><img class="imgsmall" src="/image/seal.png"><b style="color:black;">Gapan City</b></a>
<?php
		echo '<br><small><b>'.Validate::formatDate($result['post_date']).'</b></small><br><br>
		<textarea id="announceEdit" class="posttext rounded form-control" name="announcepost">'.str_replace('  ', ' &nbsp;', nl2br($result['post'])).'</textarea><br>';
		if (!empty($result['post_photo'])) {
			echo '<img class="img-fluid img-thumbnail imgbig" src="/announce_photos/'.$result['post_photo'].'">';
		}
?>
		<br>
		<button class="btn btn-info float-right" type="submit" style="margin-top:10px;">Save</button><br>
	  </form>
	 </div>
  </div>
  <div class="col-sm-1"></div>
</div>
</div>
                    <!-- /.col -->
                </div>
                </div>
        </div>
      
    </div>
    <!-- JavaScript files-->
    <script src="/admin/vendor/jquery/jquery.min.js"></script>
    <script src="/admin/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="/admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/admin/vendor/chart.js/Chart.min.js"></script>
    <script src="/admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/admin/js/charts-home.js"></script>
    <!-- Main File-->
    <script src="/admin/js/front.js"></script>
    <script>
    	$('#announceEdit').on('keyup paste', function() {
	    	var $el = $(this),
	        offset = $el.innerHeight() - $el.height();

	    	if ($el.innerHeight < this.scrollHeight) {
	    	  //Grow the field if scroll height is smaller
	    	  $el.height(this.scrollHeight - offset);
	    	} else {
	     	 //Shrink the field and then re-set it to the scroll height in case it needs to shrink
	     	$el.height(1);
	      	$el.height(this.scrollHeight - offset);
	      	}
     	});
    </script>
  </body>
</html>