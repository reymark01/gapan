<?php
require_once '../../app/core/newinit.php';

if (!Session::exist('admin_sess_id')) {
  Redirect::to('../');
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
          <div class="sidenav-header-logo"><a href="dashboard" class="brand-small text-center"><strong><img src="/image/seal.png"></strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="dashboard">Notifications</a></li>
            <li><a href="news">News</a></li>
            <li><a href="events">Events</a></li>
            <li><a href="announcements">Announcements</a></li>
            <li><a href="news-post">News Post</a>
            <li><a href="events-post">Events Post</a>
            <li><a href="announce-post">Announcements Post</a>


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
      <!-- Counts Section -->
      <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">
            <a href="user-request">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-muted vb">User Account Requests <span id="user-count" class="badge badge-pill badge-danger"></span></h5> 
                </div>
              </a>
            </div>
            </div>
 
            <a href="business-request">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-muted vb">Business Account Requests <span id="business-count" class="badge badge-pill badge-danger"></span></h5> 
              </div>
              </a>
            </div>
          </div>

            <div class="col-sm-4">
            <a href="user-post-request">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-muted vb">User Post Requests <span id="user-post-count" class="badge badge-pill badge-danger"></span></h5> 
              </div>
            </a>
            </div>
          </div>
                
                </div>
                </div>
                    <!-- /.col -->
                     <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-4">
                        <a href="report-business">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="text-muted vb">Report Business <span id="business-report-count" class="badge badge-pill badge-danger"></span></h5> 
                            </div>
                          </a>
                        </div>
                        </div>

                   <div class="col-sm-4">
                        <a href="report-user">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="text-muted vb">User Report<span id="user-report-count" class="badge badge-pill badge-danger"></span></h5> 
                            </div>
                          </a>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <a href="business-post-request">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="text-muted vb">Business Post Requests <span id="business-post-count" class="badge badge-pill badge-danger"></span></h5> 
                          </div>
                        </a>
                        </div>
                </div>
                </div>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">
              <a href="contactus-messages">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-muted vb">Contact Us Messages <span id="contactus-count" class="badge badge-pill badge-danger"></span></h5> 
                </div>
                </a>
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
    <script>
  $(document).ready(function() {
    var userRequestCount = function () {
      $.ajax({
        method: 'post',
        url: 'account-request-count.php',
        data: {usercount: 'usercount'},
        success: function(data) {
          if (data > 0) {
            $("#user-count").html(data);
          } else {
            $("#user-count").html('');
          }
        }
      });
    }
    var businessRequestCount = function () {
      $.ajax({
        method: 'post',
        url: 'account-request-count.php',
        data: {businesscount: 'businesscount'},
        success: function(data) {
          if (data > 0) {
            $("#business-count").html(data);
          } else {
            $("#business-count").html('');
          }
        }
      });
    }
    var userPostRequestCount = function () {
      $.ajax({
        method: 'post',
        url: 'post-request-count.php',
        data: {userpostcount: 'userpostcount'},
        success: function(data) {
          if (data > 0) {
            $("#user-post-count").html(data);
          } else {
            $("#user-post-count").html('');
          }
        }
      });
    }
    var businessPostRequestCount = function () {
      $.ajax({
        method: 'post',
        url: 'post-request-count.php',
        data: {businesspostcount: 'businesspostcount'},
        success: function(data) {
          if (data > 0) {
            $("#business-post-count").html(data);
          } else {
            $("#business-post-count").html('');
          }
        }
      });
    }
    var businessReportCount = function () {
      $.ajax({
        method: 'post',
        url: 'account-report-count.php',
        data: {
          breport: true
        },
        success: function(data) {
          if (data > 0) {
            $("#business-report-count").html(data);
          } else {
            $("#business-report-count").html('');
          }
        } 
      });
    }
    var userReportCount = function () {
      $.ajax({
        method: 'post',
        url: 'account-report-count.php',
        data: {
          ureport: true
        },
        success: function(data) {
          if (data > 0) {
            $("#user-report-count").html(data);
          } else {
            $("#user-report-count").html('');
          }
        } 
      });
    }
    var contactUsCount = function() {
      $.ajax({
        url: 'contactus-count.php',
        method: 'post',
        data: {contactusmessages: true},
        success: function(data) {
          if (data > 0) {
            $("#contactus-count").html(data);
          } else {
            $("#contactus-count").html('');
          }
        }
      });
    }
    userRequestCount();
    businessRequestCount();
    userPostRequestCount();
    businessPostRequestCount();
    businessReportCount();
    userReportCount();
    contactUsCount();
  });
</script>
  </body>
</html>