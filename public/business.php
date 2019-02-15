<?php
require_once 'pusher/vendor/autoload.php';
require_once '../app/core/init.php';

function renderImages($pid){
	$sql = "SELECT * FROM store_post_photos WHERE store_post_id = :postid";
	$result = DB::query($sql, [], true, ['postid' => $pid]);
	$photos = [];
	while ($row = $result->fetch()) {
		array_push($photos, $row);
	}
	if (!empty($photos)) {
		if (count($photos) == 1) {
			echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photos[0]['b_postphoto'].'"></div>';
		} else {
			echo '<div class="row">';
			if (count($photos) > 4) {
				for ($i=0;$i<4;$i++) {
					echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photos[$i]['b_postphoto'].'" style="width: 360px; height: 200px;"></div>';
				}
				echo '<div class="col-12 text-center">
					<a href="/business/'.Input::get('username').'/post/'.$pid.'"> See More</a>
				</div>';
			} else {
				foreach ($photos as $photo) {
					echo '<div class="col-md-6 p-1"><img class="img-fluid img-thumbnail" src="/business_photos/'.$photo['b_postphoto'].'" style="width: 360px; height: 200px;"></div>';
				}
			}
			echo '</div>';
		}
	}
}

if (Input::exist()) {
	if (!empty(Input::get('addproduct'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
			),
			'price' => array(
				'required' => true,
				'pregmatch' => 'f'
			),
			'file' => array(
				'ftype' => array('jpg', 'jpeg', 'png')
			)
		));
		if ($validation->passed()) {
			if (!empty($_FILES['file']['name'])) {
				$key = Token::uniqKey('store_products', 'product_photo');
				$tmp_name = $_FILES['file']['tmp_name'];
				$productsphoto = 'product_photos/'.$key;
			} else {
				$key = '';
			}
			$sql = "INSERT INTO store_products (store_id, product_name, product_price, product_photo) VALUES (:id, :name, :price, :photo)";
			if (DB::query($sql, ['name' => Input::get('name'), 'photo' => $key], true, ['id' => Session::get('b_sess_id'), 'price' => Input::get('price')])) {
				if (!empty($_FILES['file']['name'])) {
					move_uploaded_file($tmp_name, $productsphoto);
				}
			}
		}
	} else {
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
		if (Token::check('bPostToken', Input::get('token'))) {
			$keys = '';
			if ($_FILES['file']['size'][0] > 0) {
				$files = Validate::arrageArray($_FILES['file']);
				for ($i=0; $i<count($files); $i++) {
					if ($files[$i]['error']) {
						Redirect::to('/');
					}
					$allowed = array('jpg', 'jpeg', 'png');
					$file_ext = explode('.', $files[$i]['name']);
					$fileactualext = strtolower(end($file_ext));
					if (!in_array($fileactualext, $allowed)) {
						Redirect::to('/');
					}
				}
			}
			$sql = "INSERT INTO store_wall_post (store_id, bw_post) VALUES (:id, :post)";
			if (DB::query($sql, ['post' => htmlspecialchars(Input::get('post'))], true, ['id' => Session::get('b_sess_id')])) {
				if ($_FILES['file']['size'][0] > 0) {
					$sql2 = "SELECT id FROM store_wall_post WHERE store_id = :id ORDER BY id DESC LIMIT :lim";
					$postid = DB::query($sql2, [], true, ['id' => Session::get('b_sess_id'), 'lim' => 1])->fetch();
					$files = Validate::arrageArray($_FILES['file']);
					for ($i=0; $i<count($files); $i++) {
						$key = Token::uniqKey('store_wall_post_photos', 'bw_postphoto');
						if (move_uploaded_file($files[$i]['tmp_name'], 'business_wall_photos/'.$key)) {
							$sql3 = "INSERT INTO store_wall_post_photos (store_wall_post_id, bw_postphoto) VALUES (:postid, :key)";
							DB::query($sql3, ['key' => $key], true, ['postid' => $postid['id']]);
						}
					}
				}
			    /*$newpost = "SELECT store_wall_post.id as postid, b_name, b_username, b_profile, bw_post, bw_postdate FROM stores, store_wall_post WHERE stores.id = store_wall_post.store_id AND store_id = :id ORDER BY store_wall_post.id DESC LIMIT 1";
			    $newrow = DB::query($newpost, [], true, ['id' => Session::get('b_sess_id')])->fetch();
			    $sql4 = "SELECT * FROM store_post_photos WHERE store_post_id = :postid";
			    $res = DB::query($sql4, [], true, ['postid' => $newrow['postid']]);
			    $bprof = $newrow['b_username'];
			    $output = '';
				$output .= '
					<div class="border border-dark shadow p-3 mb-5 bg-white rounded comment-container">
				 	<a href="../business/'.$newrow['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$newrow['b_profile'].'">
					<b>'.$newrow['b_name'].'</b></a><br>
					<small><b>'.Validate::formatDate($newrow['b_postdate']).'</b></small><br><br>
					<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($newrow['b_post'])).'</div>';
					if (!empty($newrow['b_postphoto'])) {
						$output .= '<img class="img-fluid img-thumbnail imgbig" src="/business_photos/'.$newrow['b_postphoto'].'"><br>';
					}
					$output .= '<input type="hidden" class="postid" value="'.$newrow['postid'].'">
					<input type="hidden" class="c_count" value="">
					<hr><a href="#" class="comment">Comment</a>
					<div class="comments"></div></div>';
			    $pusher->trigger('postChannel', 'postEvent', array('output' => $output, 'bprof' => $bprof));*/
			}
		}
	}
}
require_once 'layout/newheader.php';

$errors = [];
$result=  [];
$posts = [];


function ratings($b_rate,$b_review){
	for ($i=0; $i<5; $i++) {
			if ($i < $b_rate) {
				echo '<span style="font-size:25px; color:yellow;" class="fa fa-star"></span>';	
			} else {
				echo '<span style="font-size:25px;" class="fa fa-star"></span>';
			}
		}
	echo '<div>'.$b_review.'</div>';
}

function renderRateModal($resultid) {
	$sql = "SELECT id, b_rate, b_review FROM store_rate WHERE store_id = :storeid AND user_id = :userid";
	$rateid = DB::query($sql, [], true, ['storeid' => $resultid, 'userid' => Session::get('u_sess_id')])->fetch();
	$bname = DB::query("SELECT b_name FROM stores WHERE id = :id", [], true, ['id' => $resultid])->fetch();
?>
		<div class="modal fade" id="ratingsModal" tabindex="-1" role="dialog" aria-labelledby="ratingsModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header" style="background-color: #007bff;">
		    			<div class="modal-title" style="color: white;"></div>
			        	<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
			        		<span aria-hidden="true">&times;</span>
			        	</button>
		      		</div>
		    		<div class="modal-body">
		    			<div class="p-2" style="font-weight: bold;">Rate <?=$bname['b_name']?></div>
		      			<hr>
		      			<label>Rate</label><br><br>
		      			<form class="container form-group" id="rateBusinessForm">
<?php
						if (empty($rateid)) {
?>
						<div class="form-control">
							<span id="rate1" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
							<span id="rate2" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
							<span id="rate3" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
							<span id="rate4" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
							<span id="rate5" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>
						</div>
<?php
						} else {
							for($i=0;$i<5;$i++) {
								if ($i<$rateid['b_rate']) {
									echo '<span id="rate1" style="font-size:20px;cursor:pointer;" class="fa fa-star rates checked"></span>';
								} else {
									echo '<span id="rate1" style="font-size:20px;cursor:pointer;" class="fa fa-star rates"></span>';
								}
							}
						}
?>
						<br>
						<br>
						<label>Review</label><br><br>
						<textarea id="rateTextArea" class="form-control"><?=$rateid['b_review']?></textarea>
						<input type="hidden" id="rate" value="<?=$rateid['b_rate']?>">
						<input type="hidden" id="b_rateid" value="<?=$resultid?>">
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		        		<button type="submit" class="btn btn-primary">Submit</button>
		      			</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
<?php
}

function renderReportModal($resultid, $bname){
?>
	<div class="modal fade" id="reportBusinessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #007bff;">
	        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Report <?=$bname?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	Are you sure you want to report <span style="font-weight: bold"><?=$bname?></span>?
	      </div>
	      <div class="modal-footer">
	      	<form id="reportBusinessForm">
	      		<input type="hidden" id="breportid" value="<?=$resultid?>">
	      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        	<button type="submit" name="reportbtn" class="btn btn-primary">Report</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<?php
}

if (Session::exist('bPostFail')) {
	array_push($errors,'<div class="alert alert-danger" role="alert">'.Session::flash('bPostFail').'</div>');
}
if (!empty(Input::get('username'))) {
	$sql = "SELECT * FROM stores WHERE b_account_verified = 1 AND b_username = :username";
	$result = DB::query($sql, ['username' => Input::get('username')])->fetch();
	if (!empty($result)) {
	// 	echo '<div class="container"><div class="row"><div class="col-sm-4">
	// 		<img class="thumbnail_image" src="/business_profiles/'.$result['b_profile'].'"><br>'.$result['b_name'].'<br>'
	// 		.$result['b_type'].'<br>'
	// 		.$result['b_address'].'<br>'
	// 		.$result['b_type'].'<br>'
	// 		.$result['b_contact'].'<br>'
	// 		.$result['b_email'].'<br></div></div></div>';
	// 		if (Session::exist('b_sess_id') && Session::get('b_sess_id') == $result['id']) {
	// 		echo '<div class="container"><div class="row"><div class="col-sm-4"></div><div class="col-sm-5 border border-dark shadow p-3 mb-5 bg-white rounded" style="padding: 10px; margin: 10px;">
	// 			<form action="" method="post" class="form-group" enctype="multipart/form-data">
	// 			<textarea id="postText" class="form-control" name="post"></textarea>
	// 			<input type="file" name="file[]" multiple>
	// 			<input type="hidden" name="token" value="'.Token::generate('bPostToken').'">
	// 			<input type="hidden" name="id" value="'.$result['id'].'">
	// 			<br>
	// 			<button type="submit" class="btn btn-primary" style="float: right;">Post</button>
	// 			</form>
	// 			</div>
	// 			<div class="col-sm-3"></div>
	// 			</div></div>';
	// 		}
			$sql2 = "SELECT store_post.id as postid, store_id, b_name, b_username, b_profile, b_post, b_title, b_postprice, b_postdate FROM stores, store_post WHERE stores.id = store_post.store_id AND store_id = :id AND store_post.b_postverified = 1 ORDER BY store_post.id DESC LIMIT 0, 2";
			$res = DB::query($sql2, [], true, ['id' => $result['id']]);
			// echo '<div class="container">
			// 		<div class="row">
			// 		<div class="col-sm-2"></div>
			// 		<div class="col-sm-8" id="appendpost">';
			while ($row = $res->fetch()) {
				array_push($posts,$row);
				// echo '<div class="border border-dark shadow p-3 mb-5 bg-white rounded comment-container"><a href="../business/'.$row['b_username'].'"><img class="imgsmall rounded-circle" src="/business_profiles/'.$row['b_profile'].'">
				// 	<b>'.$row['b_name'].'</b></a><br>
				// 	<small><b>'.Validate::formatDate($row['b_postdate']).'</b></small><br><br>s
				// 	<div class="posttext">'.str_replace('  ', ' &nbsp;', nl2br($row['b_post'])).'</div>';
					
				// 	echo '<input type="hidden" class="postid" value="'.$row['postid'].'">
				// 	<input type="hidden" class="c_count" value="">
				// 	<hr><a href="#" class="comment">Comment</a>
				// 	<div class="comments"></div></div>';
			}
			// echo '<div class="col-sm-2"></div></div></div>';
			$sql3 = "SELECT ROUND(AVG(b_rate), 2) as brate FROM store_rate WHERE store_id = :storeid";
			$brate = DB::query($sql3, [], true, ['storeid' => $result['id']])->fetch();
?>
	<main>
	<div class="main-section">
		<div class="container">
			<div class="main-section-data">
				<div class="row">
					<div class="col-lg-3 col-md-4 pd-left-none no-pd">
						<div class="main-left-sidebar no-margin">
							<div class="user-data full-width">
								<div class="user-profile">
									<div class="username-dt">
										<div class="usr-pic">
											<img src="/business_profiles/<?=$result['b_profile']?>" alt="">
										</div>
									</div><!--username-dt end-->
									<div class="user-specs">
										<h3><?=$result['b_name']?></h3>
<?php
										if (!empty($brate['brate'])) {
											$newavg = explode('.', $brate['brate'])[0];
											for($i=0; $i<5; $i++) {
												if ($i < $newavg) {
													echo '<span style="font-size:15px; color: yellow;" class="fa fa-star"></span>';
												} else {
													echo '<span style="font-size:15px;" class="fa 	fa-star"></span>';
												}
											}
											echo '<br><span class="text-muted">'.$brate['brate'].'</span><br><br>';
										}
?>												
										<span><?=$result['b_type']?></span>
									</div>
								</div><!--user-profile end-->
								<ul class="template user-fw-status">
									<li class="template">
										<h4>Address</h4>
										<p><?=$result['b_address']?></p>
									</li>
									<li class="template">
										<h4>Contact No.</h4>
										<p><?=$result['b_contact']?></p>
									</li>
<?php
									if (!empty($result['b_email'])) {
										echo '<li class="template"><h4>E-mail</h4><p>'.$result['b_email'].'</p></li>';
									}
									if (Session::exist('u_sess_id')) {
										echo '<li class="template"><a href="#" id="store-rate">Rate</a></li>';
										renderRateModal($result['id']);
										$sql7 = "SELECT id FROM store_report WHERE store_id = :storeid AND user_id = :userid";
										$rid = DB::query($sql7, [], true, ['storeid' => $result['id'], 'userid' => Session::get('u_sess_id')])->fetch();
										if (empty($rid['id'])) {
											echo '<li id="store-report-li" class="template"><a href="#" id="store-report">Report</a></li>';
											renderReportModal($result['id'], $result['b_name']);
										}
									}
?>
								</ul>
							</div><!--user-data end-->
						</div><!--main-left-sidebar end-->
					</div>

					<div class="col-lg-6 col-md-8 no-pd">
						<div class="main-ws-sec">
<?php
						if (Session::exist('b_sess_id') && $result['id'] == Session::get('b_sess_id')) {
?>
							<div class="post-topbar">
								<div class="user-picy">
									<img src="images/resources/user-pic.png" alt="">
								</div>
								<div class="post-st">
									<ul class="template">
										<li class="template"><a class="post-jb active" href="#">Post</a></li>
									</ul>
								</div><!--post-st end-->
							</div><!--post-topbar end-->


<?php
						}
							if(count($posts) > 0){

							foreach($posts as $post){
							?>

							<div class="posts-section">
								<div class="post-bar">
									<div class="post_topbar">
										<div class="usy-dt">
											<img src="/business_profiles/<?=$post['b_profile']?>" class="imgsmall">	
											<div class="usy-name">
												<h3><?=$post['b_name']?></h3>
												<span><img src="images/clock.png" alt=""><?=Validate::formatDate($post['b_postdate'])?></span>
											</div>
										</div>
<?php
									if (Session::exist('b_sess_id') && $post['store_id'] == Session::get('b_sess_id')) {
?>															
										<div class="ed-opts">
											<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
											<ul class="template ed-options">
												<li class="template edit-post"><a href="#" postID="<?=$post['postid']?>" title="">Edit Post</a></li>
												<li class="template"><a href="#" title="">Mark as sold</a></li>
												<li class="template"><a href="#" title="">Mark as reserved</a></li>
												<li class="template"><a href="#" title="">Delete</a></li>
											</ul>
										</div>
<?php
									}
?>
									</div>
									
									<div class="job_descp">
										<form id="edit-form"></form>
										<!--<h3>Senior Wordpress Developer</h3>-->
										<b><h3><?=$post['b_title']?></h3></b>
										<ul class="template job-dt">
											<li class="template"><a style="color:black; font-size: 15px;">Price</a></li>
											<li class="template">₱<span class="b-postprice"><?=$post['b_postprice']?></span></li>
										</ul>
										<p class="b-post"><?=$post['b_post']?></p>
										<div class="row">
											<?php  renderImages($post['postid']); ?>
										</div>
									</div>
									<div class="edit-buttons">
									</div>
									<div class="job-status-bar">
										<ul class="template like-com">
											<li class="template"><a href="#" title="" class="com comment"><img src="images/com.png" alt=""> Comment</a></li>
										</ul>
										<input type="hidden" class="postid" value="<?=$post['postid']?>">
										<input type="hidden" class="c_count" value="">
										<div class="comments"></div>
									</div>
								</div><!--post-bar end-->
							</div><!--posts-section end-->
<?php
											}
									}
?>
						</div><!--main-ws-sec end-->
					</div>

					<div class="col-lg-3 pd-right-none no-pd">
						<div class="right-sidebar">
							<div class="widget widget-jobs">
								<div class="sd-title">
									<h3>Other Products/Services</h3>
<?php
									if (Session::exist('b_sess_id') && Session::get('b_sess_id') == $result['id']) {
?>
									<a id="store-addoffer" href="#"><span class="float-right"><i class="la la-plus" style="background-color: #f2f2f2;"></i></span></a>
									<div class="modal fade" id="addOfferModal" tabindex="-1" role="dialog" aria-labelledby="addOfferModalLabel" aria-hidden="true">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header" style="background-color: #007bff;">
									        <h5 class="modal-title" id="addOfferModalLabel" style="color:white;">Add Products/Services</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									      <div class="container">
										<form id="addOfferForm" class="form-group" action="" method="post" enctype="multipart/form-data">
										<input class="form-control" type="text" name="name" placeholder="Name"><br>
										<input class="form-control" type="text" name="price" placeholder="Price"><br>
										<input class="form-control" type="file" name="file">
										</div>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									        <button type="submit" name="addproduct" class="btn btn-primary" value="addproduct">Add</button>
									    </form>
									      </div>
									    </div>
									  </div>
									</div>
<?php
									}
?>
								</div>
								<div class="jobs-list">
									<div class="job-info">
<?php
									$sql5 = "SELECT * FROM store_products WHERE store_id = :id LIMIT :lim";
									$res = DB::query($sql5, [], true, ['id' => $result['id'], 'lim' => 5]);
									while ($row2 = $res->fetch()) {
?>
										<a href="/business/<?=$result['b_username']?>/products"><div class="job-details">
											<h3><?=$row2['product_name']?></h3>
										</div>
										<div class="hr-rate">
											<span>₱<?=$row2['product_price']?>.00</span>
										</div></a>
<?php
									}
?>
									</div><!--job-info end-->
								</div><!--jobs-list end-->
							</div><!--widget-jobs end-->
							<div class="widget widget-jobs">
								<div class="sd-title">
									<h3>Rates and Reviews</h3><br>
								</div>
								<div class="jobs-list">
<?php
								$sql6 = "SELECT fname, lname, profile, username, b_rate, b_review, b_ratedate FROM users, store_rate WHERE store_rate.user_id = users.id AND store_id = :store_id";
								$result2 = DB::query($sql6, [], true, ['store_id' => $result['id']]);
								while ($row3 = $result2->fetch()) {

?>
								<div class="jobs-info p-1">
									<a href="/user/<?=$row3['username']?>" style="color:black;">
									<img class="rounded-circle p-1" src="/user_profiles/<?=$row3['profile']?>" style="width: 50px; height: 50px;">
									<h5 style="margin-top: 5px;font-weight:bold;"><?=$row3['fname'].' '.$row3['lname']?></h5>
									</a>
									<p class="text-muted"><?=Validate::formatDate($row3['b_ratedate'])?></p>
									<br>
									<div style="text-align: center;">
<?php
								$newavg = explode('.', $row3['b_rate'])[0];
								for($i=0;$i<5;$i++) {
									if ($i < $newavg) {
										echo '<span style="font-size:10px; color: yellow;" class="fa fa-star"></span>';
									} else {
										echo '<span style="font-size:10px;" class="fa fa-star"></span>';
									}
								}
?>											
									</div>
									<p><?=$row3['b_review']?></p>
								</div>
								<hr>
<?php
								}
?>
								</div><!--jobs-list end-->
								<div style="margin-bottom: 20px;text-align: center;">
									<a href="#">See more</a>
								</div>
							</div><!--widget-jobs end-->
						</div><!--right-sidebar end-->
					</div>
				</div>
			</div><!-- main-section-data end-->
		</div> 
	</div>
</main>
<?php
	} else {
		Redirect::to('./');	
	}
} else {
	Redirect::to('./');
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff;">
        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="form-group" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-12 p-3">
					<textarea class="form-control" id="postText" name="post" placeholder="Your post"></textarea>
				</div>
				<div class="col-lg-12 p-3">
					<input class="form-control" type="file" name="file[]" multiple>
				</div>
				<input type="hidden" name="token" value="<?=Token::generate('bPostToken')?>">
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>-->
				<!--</div>--><!--post-project-fields end-->
				<!--<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div>--><!--post-project end-->
		<!--</div>--><!--post-project-popup end-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script type="text/javascript" src="/js/popper.js"></script>
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="/js/scrollbar.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
<script src="/js/main.js"></script>
<script>
$(document).ready(function() {
	var start = 2;
	var limit = 1;
	var pusher = new Pusher('be49c320ccd26cd0faa2', {
      cluster: 'ap1',
      forceTLS: true
    });
    var channelpost = pusher.subscribe('postChannel');
 	var channeladdbusinesscomment = pusher.subscribe('addBusinessCommentChannel');
 	var channeladdbusinessreply = pusher.subscribe('addBusinessReplyChannel');
	var u_sess_id = "<?php echo Session::exist('u_sess_id') ? Session::get('u_sess_id') : '' ?>";
	var b_sess_id = "<?php echo Session::exist('b_sess_id') ? Session::get('b_sess_id') : '' ?>";
	var username = "<?php echo Input::get('username'); ?>";
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
 	var getPosts = function () {
		$.ajax({
			url: '/ajax/showpost.php',
			method: 'POST',
			data: {
				username: username,
				start: start,
				limit: limit
			},
			success: function(data) {
				if (data != '') {
					$("#appendpost").append(data);
					start += limit;
				}
			}
		});
	}
	$(window).scroll(function() {
			if ($(window).scrollTop() == $(document).height() - $(window).height())
				getPosts();
	});
	$('.post-jb').on('click', function(e) {
		e.preventDefault();
		$('#exampleModal').modal('show');
	});
	$('#postText').on('keyup paste', function() {
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
	$('#rateTextArea').on('keyup paste', function() {
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
	$('body').on('keyup paste', '.commentarea', function() {
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
	$('body').on("click", ".comment", function(e) {
		e.preventDefault();
		var container = $(this).parent().parent().parent();
		var id = container.find(".postid").val();
		var comments = container.find(".comments");
		container.find(".c_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showcomments.php',
			method: 'POST',
			data: {
				first: true,
				postid: id,
			},
			success: function(data) {
				comments.append(data);
			}
		});
	});
	$('body').on("click", ".viewmorecomments", function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".postid").val();
		var cstart = parseInt(container.find(".c_count").val());
		var climit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showcomments.php',
			method: 'POST',
			data: {
				more: true,
				postid: id,
				cstart: cstart,
				climit: climit
			},
			success: function(data) {
				if (data == '') {
					container.find(".viewmorecomments").css("visibility", "hidden");
					container.find(".viewallcomments").css("visibility", "hidden");
				} else {
					container.find(".appendcomment").append(data);
					container.find(".c_count").val(cstart+climit);
				}
			}
		});
	});
	$('body').on('click', '.viewallcomments', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".postid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showcomments.php',
			method: 'POST',
			data: {
				all: true,
				postid: id,
			},
			success: function(data) {
				container.find('.viewmorecomments').css('visibility', 'hidden');
				container.find('.viewallcomments').css('visibility', 'hidden');
				container.find('.appendcomment').html(data);
				container.find('.c_count').val('');
			}
		});
	});
	$('body').on('submit', '.comment-form', function(e) {
		var container = $(this).parent().parent().parent();
		var postid = container.find('.postid').val();
		var commenttext = container.find('.commentarea').val();
		var ccount = parseInt(container.find(".c_count").val());
		e.preventDefault();
		if (commenttext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinesscomment.php',
				method: 'POST',
				data: {
					postcomment: true,
					postid: postid,
					commenttext: commenttext
				},
				success: function(data) {
					container.find('.commentarea').val('');
					container.find('.appendcomment').prepend(data);
					container.find(".c_count").val(ccount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinesscomment.php',
						method: 'POST',
						data: {
							pushcomment: true,
							postid: postid,
							b_username: username
						}
					});
				}
			});
		}
	});
	$('body').on("click", ".reply", function(e) {
		e.preventDefault();
		var container = $(this).parent();
		var commentid = container.find(".commentid").val();
		var replies = container.find(".replies");
		container.find(".r_count").val(2);
		$(this).css("visibility", "hidden");
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
			method: 'POST',
			data: {
				first: true,
				commentid: commentid
			},
			success: function(data) {
				replies.append(data);
			}
		});
	});
	$('body').on('click', '.viewmorereplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".commentid").val();
		var rstart = parseInt(container.find(".r_count").val());
		var rlimit = 1;
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
			method: 'POST',
			data: {
				more: true,
				commentid: id,
				rstart: rstart,
				rlimit: rlimit
			},
			success: function(data) {
				if (data == '') {
					container.find(".viewmorereplies").css("visibility", "hidden");
					container.find(".viewallreplies").css("visibility", "hidden");
				} else {
					container.find(".appendreply").append(data);
					container.find(".r_count").val(rstart+rlimit);
				}
			}
		});
	});
	$('body').on('click', '.viewallreplies', function(e) {
		var container = $(this).parent().parent();
		var id = container.find(".commentid").val();
		e.preventDefault();
		$.ajax({
			url: '/ajax/showbusinessreplies.php',
			method: 'POST',
			data: {
				all: true,
				commentid: id,
			},
			success: function(data) {
				container.find('.viewmorereplies').css('visibility', 'hidden');
				container.find('.viewallreplies').css('visibility', 'hidden');
				container.find('.appendreply').html(data);
				container.find('.r_count').val('');
			}
		});
	});
	$('body').on('submit', '.reply-form', function(e) {
		var container = $(this).parent().parent().parent();
		var commentid = container.find('.commentid').val();
		var replytext = container.find('.replyarea').val();
		var rcount = parseInt(container.find(".r_count").val());
		var username = '<?php echo Input::get('username'); ?>';
		e.preventDefault();
		if (replytext == '') {
				
		} else {
			$.ajax({
				url: '/ajax/addbusinessreply.php',
				method: 'POST',
				data: {
					postreply: true,
					commentid: commentid,
					replytext: replytext
				},
				success: function(data) {
					container.find('.replyarea').val('');
					container.find('.appendreply').prepend(data);
					container.find(".r_count").val(rcount+1);
					$.ajax({
						url: '/ajax/pusheraddbusinessreply.php',
						method: 'POST',
						data: {
							pushreply: true,
							commentid: commentid,
							u_username: username
						}
					});
				}
			});
		}
	});
	$('body').on('submit', '#reportBusinessForm', function(e) {
		e.preventDefault();
		var id = $(this).find('#breportid').val();
		$.ajax({
			url: '/ajax/addreport.php',
			method: 'post',
			data: {
				business: true,
				storeid: id,
			},
			success: function(data) {
				$('#reportBusinessModal').modal('hide');
				$('#store-report-li').hide();
			}
		});
	});
	$('body').on('submit', '#rateBusinessForm', function(e) {
		e.preventDefault();
		var rate = $(this).find('#rate').val()
		var review = $(this).find('#rateTextArea').val();
		var rateid = $(this).find('#b_rateid').val();
		$.ajax({
			url: '/ajax/addrate.php',
			method: 'post',
			data: {
				rate: rate,
				review: review,
				storeid: rateid
			},
			success: function(data) {
				$('#ratingsModal').modal('hide');
			}
		});
	});
	$('body').on('click', '#store-rate', function() {
		$('#ratingsModal').modal('show');
	});
	$('.rates').on('click', function() {
		$('.rates').removeClass('checked');
		var rate = $(this).prevAll().length + 1;
		$('#rate').val(rate);
		$(this).addClass('checked');
		$(this).prevAll().addClass('checked');
	});
	$('.rates').hover(function() {
		$(this).toggleClass('hovered')
		$(this).prevAll().toggleClass('hovered')
		rating = $(this).prevAll().length + 1;
	})
	$('body').on('click', '#store-report', function(e) {
		e.preventDefault();
		$('#reportBusinessModal').modal('show');
	});
	$('body').on('click', '#store-addoffer', function(e) {
		e.preventDefault();
		$('#addOfferModal').modal('show');
	});
	$('.edit-post').on('click', function(e) {
		var editdiv = $(this);
		editdiv.hide();
		var postID = e.target.attributes[1].value;
		var postpriceID = "price-"+postID;
		var postTextID  = "text-"+postID;
		var editBtnID = "edit-"+postID;
		var cancelBtnID = "cancel-"+postID;

		var div = $(this).parent().parent().parent().parent();
		var bpost = div.find('.b-post');
		var bposttext = div.find('.b-post').html();
		var bpostprice = div.find('.b-postprice');
		var bpostpriceval = div.find('.b-postprice').html();
		//bpostprice = replaceWith('<input type="text" value="'+bpostpriceval+'">');
		bpostprice.replaceWith('<input class="edit-post-price" id="'+postpriceID+'"" form="edit-form" type="text" value="'+bpostpriceval+'">');
		bpost.replaceWith('<textarea form="edit-form" id="'+postTextID+'"class="edit-post-text">'+bposttext+'</textarea>');
		div.find('.edit-buttons').append('<button form="edit-form" id="'+editBtnID+'" class="btn btn-primary float-right edit-post-save" type="submit" name="save" value="edit-save">Save</button><button form="edit-form" id="'+cancelBtnID+'" class="btn btn-danger float-right edit-post-cancel" type="submit" value="edit-cancel">Cancel</button></form>');
		var editsave = div.find('.edit-post-save');
		var editcancel = div.find('.edit-post-cancel');

		$("#"+editBtnID).click(function(e) {
			e.preventDefault();
			var editprice = parseInt($("#"+postpriceID).val());
			var edittext = $("#"+postTextID).val();
			$.ajax({
				url: '/ajax/editbusinesspostform',
				method: 'post',
				data:{
					postid: postID,
					edittext: edittext,
					editprice: editprice
				},
				success: function(data) {
					$("#"+postpriceID).replaceWith('<span class="b-postprice">'+editprice+'</span>');
					$("#"+postTextID).replaceWith('<p class="b-post">'+edittext+'</p>');
					div.find('.edit-buttons').html('');
					editdiv.show();
				}
			});
		})
		$("#"+cancelBtnID).click(function(e){
			e.preventDefault();
			$("#"+postpriceID).replaceWith('<span class="b-postprice">'+bpostpriceval+'</span>');
			$("#"+postTextID).replaceWith('<p class="b-post">'+bposttext+'</p>');
			div.find('.edit-buttons').html('');
			editdiv.show();
		})
	});
	channelpost.bind('postEvent', function(data) {
		var username = "<?php echo Input::get('username'); ?>"
		if (username == data['bprof']) {
			$("#appendpost").prepend(data['output']);
			start += 1;
		}
	});
	channeladdbusinesscomment.bind('addBusinessCommentEvent', function(data) {
		var container = $('.postid[value="'+data['postid']+'"]').parent();
		var ccount = parseInt(container.find(".c_count").val());
		if (data['uid']) {
			if (data['uid'] != u_sess_id) {
				container.find(".appendcomment").prepend(data['output']);
				container.find(".c_count").val(ccount+1);
			}	
		} else if (data['bid']) {
			if (data['bid'] != b_sess_id) {
				container.find(".appendcomment").prepend(data['output']);
				container.find(".c_count").val(ccount+1);
			}
		}
	});
	channeladdbusinessreply.bind('addBusinessReplyEvent', function(data) {
		var container = $('.commentid[value="'+data['cid']+'"]').parent();
		var ccount = parseInt(container.find(".r_count").val());
		if (data['uid']) {
			if (data['uid'] != u_sess_id) {
				container.find(".appendreply").prepend(data['output']);
				container.find(".r_count").val(ccount+1);
			}	
		} else if (data['bid']) {
			if (data['bid'] != b_sess_id) {
				container.find(".appendreply").prepend(data['output']);
				container.find(".r_count").val(ccount+1);
			}
		}
	});
});
</script>
<?php
require_once 'layout/footer.php';