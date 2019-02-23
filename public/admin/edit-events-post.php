<?php
require_once '../../app/core/newinit.php';
$sql = "SELECT * FROM events WHERE id = :id";
$result = DB::query($sql, [], true, ['id' => Input::get('eid')])->fetch();
if (empty($result)) {
	Redirect::to('/admin/events-post');
}
if (Input::exist()) {
  if (Token::check('eventsPostEditToken', Input::get('token'))) {
    $validate = new Validate;
    $validation = $validate->check($_POST, array(
      'title' => array(
        'required' => true
      ),
      'file' => array(
        'ftype' => array('jpg', 'jpeg', 'png')
      )
    ));
    if ($validation->passed()) {
      if (!empty($_FILES['file']['name'])) {
        $key = Token::uniqKey('events', 'events_thumbnail');
        $tmp_name = $_FILES['file']['tmp_name'];
        $eventsphotos = '../events_thumbnail/'.$key;
      } else {
      	$key = Input::get('thumbnail');
      }
      $sql = "UPDATE events SET events_title = :title, events_post = :post, events_thumbnail = :postphoto WHERE id = :id";
      if (DB::query($sql, ['title' => Input::get('title'), 'post' => Input::get('body'), 'postphoto' => $key], true, ['id' => $result['id']])) {
        if (!empty($_FILES['file']['name'])) {
          if (Input::get('thumbnail') != 'default') {
          	$path = '../events_thumbnail/'.$result['events_thumbnail'];
          	unlink($path);
          }
          move_uploaded_file($tmp_name, $eventsphotos);
        }
        Session::flash('eventsPostEditSuc', 'Success');
      }
      Redirect::to('/admin/events-post');
    }
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
    <link rel="shortcut icon" href="/admin/img/favicon.ico">
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
          <div class="sidenav-header-inner text-center"><img src="/admin/img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">Admin 1</h2><span>Admin Dashboard</span>
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
<br>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10 border border-dark shadow p-3 mb-5 bg-white rounded" style="margin-top: 55px;">
    <form class="form-group" action="" method="post" enctype="multipart/form-data">
      <label><b>Post Title</b></label>
      <input type="text" class="form-control" name="title" value="<?=$result['events_title']?>">
      <label><b>Current Thumbnail:</b></label>
<?php
		if ($result['events_thumbnail'] != 'default') {
			echo '<img src="/events_thumbnail/'.$result['events_thumbnail'].'" style="padding:10px; width: 200px; height: 200px;">';
		} else {
			echo 'no thumbnail';
		}
?>
	  <input type="hidden" name="thumbnail" value="<?=$result['events_thumbnail']?>">
	  <br>
      <label><b>Change Post Thumbnail</b></label>
      <input type="file" class="form-control" name="file">
      <br>
      <label><b>Post Body</b></label>
      <textarea class="form-control" name="body"><?=$result['events_post']?></textarea>
      <br>
      <input type="hidden" name="token" value="<?php echo Token::generate('eventsPostEditToken') ?>">
      <button type="submit" name="submit" class="form-control btn btn-info">Publish</button>
    </form>
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
<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
<script>
     CKEDITOR.replace( 'body' );
 </script>
  </body>
</html>