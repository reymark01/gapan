<!DOCTYPE html>
<html lang="en>">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Gapan City Website</title>
	<link rel="shortcut icon" type="image/x-icon" href="/image/seal.png" />
	<link rel="stylesheet" type="text/css" href="/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/line-awesome.css">
	<link rel="stylesheet" type="text/css" href="/css/line-awesome-font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="/lib/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="/lib/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="/css/style-template.css">
	<link rel="stylesheet" type="text/css" href="/css/responsive.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/style.css">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand toplogo" href="/"><img src="/image/seal.png" class="img-responsive" alt="logo"> <span> Gapan City</span></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/about">About</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/marketplace">Marketplace</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/barangay">Barangay</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/users">Users</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/businesses">Businesses</a>
					</li>
					
					<li class="nav-item">
						<form action="/search" class="form-inline my-2 my-lg-0" method="get">
							<div class="input-group">
								<input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search">
								<div class="input-group-append">
									<button class="btn btn-outline-light my-2 my-sm-0" type="submit">
										<span class="fas fa-search"></span>
									</button>
								</div>
							</div>
						</form>
					</li>
				</ul>
				<ul class="navbar-nav">
					<?php
					if (Session::exist('u_sess_id') || Session::exist('b_sess_id')) {
						?>
						<li class="nav-item dropdown">
							<a href="#" class="btn btn-primary dropdown-toggle notif-dropdown" id="notifdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell"></i><span class="badge badge-pill badge-danger notif-count"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right notif-menu" style="max-height: 400px; overflow-y: scroll; overflow-x: hidden;" aria-labelledby="notifdropdown"><div class="notiflist"></div><a href="#" class="seemorenotif">See more</a></div>
						</li>
						<?php
					} elseif (Session::exist('admin_sess_id')) {
						?>
						<form action="/logout" method="post">
							<button type="submit" name="logout" class="btn btn-primary pull-right ">Logout</button>
						</form>
						<?php
					} else {
						?>
						<li class="nav-item">
							<a class="nav-link" href="/login">Login</a>
						</li>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a href="/signup" class="dropdown-item">User</a>
								<a href="/register" class="dropdown-item">Business</a>
							</div>
						</li>
						<?php
					}
					if (Session::exist('u_sess_id')) {
						$sql = "SELECT b_name, b_profile, b_username FROM stores WHERE user_id = :userid";
						$result = DB::query($sql, [], true, ['userid' => Session::get('u_sess_id')]);
						?>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="width: 40px; height: 40px;" class="rounded-circle" src="/user_profiles/<?=Session::get('u_sess_profile')?>"></a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
								<a href="/user/<?=Session::get('u_sess_username')?>" class="dropdown-item"><b><?=Session::get('u_sess_fname').' '.Session::get('u_sess_lname')?></b></a><hr>
								<?php
								while ($row = $result->fetch()) {
									?>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#switchAccountModal" data-account="<?=$row['b_name']?>" data-u-username="" data-b-username="<?=$row['b_username']?>"><img class="imgsmall" src="/business_profiles/<?=$row['b_profile']?>"><?=$row['b_name']?></a>
									<?php
								}
								?>
								<form action="/logout" method="post">
									<button type="submit" class="dropdown-item" name="logout" style="cursor:pointer;">Logout</button>
								</form>
							</div>
						</li>
						<?php
					}
					if (Session::exist('b_sess_id')) {
						$sql = "SELECT fname, lname, profile, username FROM users WHERE id = :userid";
						$result = DB::query($sql, [], true, ['userid' => Session::get('b_sess_userid')])->fetch();
						$sql2 = "SELECT b_name, b_profile, b_username FROM stores WHERE id != :id AND b_account_verified = 1 AND user_id = :userid";
						$result2 = DB::query($sql2, [], true, ['id' => Session::get('b_sess_id'), 'userid' => Session::get('b_sess_userid')]);
						?>

						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle p-0 m-0" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="width: 40px; height: 40px;" class="rounded-circle" src="/business_profiles/<?=Session::get('b_sess_profile')?>"></a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown" style="min-width: 200px">
								<a href="/business/<?=Session::get('b_sess_b_username')?>" class="dropdown-item"><b><?=Session::get('b_sess_b_name')?></b></a><hr>
								<a href="#" class="dropdown-item" data-toggle="modal" data-target="#switchAccountModal" data-account="<?=$result['fname'].' '.$result['lname']?>" data-u-username="<?=$result['username']?>" data-b-username=""><img class="imgsmall" src="/user_profiles/<?=$result['profile']?>"><?=$result['fname'].' '.$result['lname']?></a><hr>
								<?php
								while ($row = $result2->fetch()) {
									?>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#switchAccountModal" data-account="<?=$row['b_name']?>" data-u-username="" data-b-username="<?=$row['b_username']?>"><img class="imgsmall" src="/business_profiles/<?=$row['b_profile']?>"><?=$row['b_name']?></a>
									<?php
								}
								?>
								<button type="submit" name="logout" form="logoutForm" class="btn btn-primary dropdown-item ">Logout</button>
								<form action="/logout" method="post" id="logoutForm">
									
								</form>
							</div>
						</li>
						<?php
					} 
					?>
				</ul>
			</div>
		</div>
	</nav>

