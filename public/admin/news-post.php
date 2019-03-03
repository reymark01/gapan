<?php
require_once '../pusher/vendor/autoload.php';
require_once '../../app/core/newinit.php';

if (!Session::exist('admin_sess_id')) {
  Redirect::to('../');
}
if (Input::exist()) {
  if (Token::check('newsPostToken', Input::get('token'))) {
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
        $key = Token::uniqKey('news', 'news_thumbnail');
        $tmp_name = $_FILES['file']['tmp_name'];
        $newsphotos = '../news_thumbnail/'.$key;
      } else {
        $key = 'default';
      }

      $sql = "INSERT INTO news (news_title, news_post, news_thumbnail) VALUES (:title, :post, :postphoto)";
      if (DB::query($sql, ['title' => Input::get('title'), 'post' => Input::get('body'), 'postphoto' => $key])) {
        $res = DB::query("SELECT id FROM news ORDER BY id DESC LIMIT 1")->fetch();
        if (!empty($_FILES['file']['name'])) {
          move_uploaded_file($tmp_name, $newsphotos);
        }
        $sql2 = "SELECT id FROM users WHERE account_verified = 1";
        $results = DB::query($sql2);
        while($row = $results->fetch()) {
          DB::query("INSERT INTO user_notification (user_id, link, link_id) VALUES (:user_id, 'news', :link_id)", [], true, ['user_id' => $row['id'], 'link_id' => $res['id']]);
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
        $pusher->trigger('addNotifChannel', 'addNotifEvent', ['count' => 1]);
        Session::flash('newsPostSuc', 'Success');
      }
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
      <!-- Counts Section -->
      <div class="container">
          <div class="row">
                    <!--col -->
<?php
if (Session::exist('newsPostSuc')) {
  echo '<div class="alert alert-success">'.Session::flash('newsPostSuc').'</div>';
}
if (Session::exist('newsPostEditSuc')) {
  echo '<div class="alert alert-success">'.Session::flash('newsPostEditSuc').'</div>';
}
?>
<br>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10 border border-dark shadow p-3 mb-5 bg-white rounded" style="margin-top: 55px;">
    <form class="form-group" action="" method="post" enctype="multipart/form-data">
      <label><b>Post Title</b></label>
      <input type="text" class="form-control" name="title">
      <label><b>Post Thumbnail</b></label>
      <input type="file" class="form-control" name="file">
      <br>
      <label><b>Post Body</b></label>
      <textarea class="form-control" name="body"></textarea>
      <br>
      <input type="hidden" name="token" value="<?php echo Token::generate('newsPostToken') ?>">
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
<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
<script>
     CKEDITOR.replace( 'body' );
 </script>
  </body>
</html>