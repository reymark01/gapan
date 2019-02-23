<?php
require_once '../pusher/vendor/autoload.php';
require_once '../../app/core/newinit.php';

if (Input::exist()) {
	if (Token::check('adminPostToken', Input::get('token'))) {
		$validate = new Validate;
		$validation = $validate->check($_POST, array(
				'file' => array(
					'ftype' => array('jpg', 'jpeg', 'png')
				)
		));
		if ($validation->passed()) {
				if (!empty($_FILES['file']['name'])) {
					$key = Token::uniqKey('gapan_post', 'post_photo');
					$tmp_name = $_FILES['file']['tmp_name'];
					$photo = '../announce_photos/'.$key;
				} else {
					$key = '';
				}
				$sql = "INSERT INTO gapan_post (post, post_photo) VALUES (:post, :postphoto)";
				if (DB::query($sql, ['post' => htmlspecialchars(Input::get('post')), 'postphoto' => $key])) {
					if (!empty($_FILES['file']['name'])) {
						move_uploaded_file($tmp_name, $photo);
					}
					$sql3 = "SELECT * FROM gapan_post ORDER BY id DESC LIMIT :lim2";
			  		$newres = DB::query($sql3, [], true, ['lim2' => 1])->fetch();
			  		$output = '';
			  		$output .= '<div class="border border-dark shadow p-3 mb-5 bg-white rounded">
								<a href="/GapanCity"><img class="imgsmall" src="image/seal.png">
								<b>Gapan City</b></a><br>
								<small><b>'.Validate::formatDate($newres['post_date']).'</b></small><br><br>
								<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($newres['post'])).'</div>';
								if (!empty($newres['post_photo'])) {
								$output .= '<img class="img-fluid img-thumbnail imgbig" src="/announce_photos/'.$newres['post_photo'].'">';
								}
								$output .= '</div>';
					$sql2 = "SELECT id FROM users WHERE account_verified = :one";
					$res = DB::query($sql2, [], true, ['one' => 1]);
					while ($row = $res->fetch()) {
						DB::query("INSERT INTO user_notification (user_id, link) VALUES (:user_id, 'GapanCity')", [], true, ['user_id' => $row['id']]);
					}
					$options = array(
			    		'cluster' => 'ap1',
			    		'useTLS' => true
			   		);
			  		$pusher = new Pusher\Pusher(
			    		'be49c320ccd26cd0faa2',
			    		'27e2b94390ec18ab305d',
			    		'681832',
			    		$options
			  		);
					$pusher->trigger('gapanPostChannel', 'gapanPostEvent', ['output' => $output]);
					$pusher->trigger('addNotifyChannel', 'addNotifyEvent', ['count' => 1]);
				}
		} else {
			Redirect::to('/GapanCity');
		}
	} else {
		Redirect::to('/GapanCity');
	}
}
if (!Session::exist('admin_sess_id')) {
  Redirect::to('../');
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
          <div class="sidenav-header-inner text-center"><img src="img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
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
            <li><a href="news-post">News Post</a>
            <li><a href="events-post">Events Post</a>
            <li><a href="announce-post">Announcements</a>


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
                <li class="nav-item"><form action="../logout" method="post" class="nav-link logout"> <button type="submit" name="logout" class="d-none d-sm-inline-block">Logout</button><i class="fa fa-sign-out"></i></form></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 border border-dark shadow p-3 mb-5 bg-white rounded" style="padding: 10px; margin: 10px;">
			<form action="" method="post" class="form-group" enctype="multipart/form-data">
			<textarea class="form-control" name="post"></textarea>
			<input type="file" name="file">
			<input type="hidden" name="token" value="<?=Token::generate('adminPostToken')?>"><br>
			<button type="submit" class="btn btn-primary" style="float:right;">Post</button>
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>