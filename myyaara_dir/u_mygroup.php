<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	if(isset($_SESSION['popup1']))
	{
		$_SESSION['popup1'] = NULL;
		echo "<script> alert('Please enter group email address.');</script>";
	}
	if(isset($_SESSION['popup2']))
	{
		$_SESSION['popup2'] = NULL;
		echo "<script> alert('Your group email address not found.');</script>";
	}
	if(isset($_SESSION['popup3']))
	{
		$_SESSION['popup2'] = NULL;
		echo "<script> alert('Your group email address not found.');</script>";
	}
	if(isset($_SESSION['popup4']))
	{
		$_SESSION['popup4'] = NULL;
		echo "<script> alert('Successfully removed');</script>";
	}
	$user_email = $_SESSION['user_email'];
	$query = "select set_password_status from `myyaara_user` where `user_email` = '$user_email'";
	$get_status = mysqli_query($connection,$query);
	$result = mysqli_fetch_assoc($get_status);
	$password_status = $result['set_password_status'];
	
	$nav = "home";
	
	if(isset($_SESSION['user_session']))
	{
		$user_email = $_SESSION['user_email'];
		$user_id_obj = new Article;
		$user_id_arr = $user_id_obj -> fetch_userids($user_email);
		$user_id = $user_id_arr['user_id'];
				
		$user_data = new Article;
		$user_info = $user_data -> fetch_group_status($user_id);
		$accepted_status = $user_info['accepted_status'];
		$declined_status = $user_info['declined_status'];
		$removed_status = $user_info['removed_status'];
		
		if(!empty($user_info))
		{
			if($accepted_status == 1)
			{
				$sql = "UPDATE myyaara_user_requests SET accepted_status = ? WHERE user_id = ?";
					$query = $pdo->prepare($sql);
					$query->bindValue("1", 0);
					$query->bindValue("2", $user_id);
					$query->execute();
				echo "<script> alert('You are accepted by the requested admin!');</script>";
			}
			
			if($declined_status == 1)
			{
				$sql = "UPDATE myyaara_user_requests SET declined_status = ? WHERE user_id = ?";
					$query = $pdo->prepare($sql);
					$query->bindValue("1", 0);
					$query->bindValue("2", $user_id);
					$query->execute();
					
				$query = $pdo->prepare('DELETE FROM myyaara_user_requests WHERE user_id = ?');
					$query->bindValue(1, $user_id);
					$query->execute();
				echo "<script> alert('You are declined by the requested admin!');</script>";
			}
			
			if($removed_status == 1)
			{
				$sql = "UPDATE myyaara_user_requests SET removed_status = ? WHERE user_id = ?";
					$query = $pdo->prepare($sql);
					$query->bindValue("1", 0);
					$query->bindValue("2", $user_id);
					$query->execute();
					
				$query = $pdo->prepare('DELETE FROM myyaara_user_requests WHERE user_id = ?');
					$query->bindValue(1, $user_id);
					$query->execute();
				echo "<script> alert('You are removed by the admin!');</script>";
			}
		}
		
		if(isset($_GET['remove_group']))
		{ 
			$user_id = $_GET['remove_group'];

			$query = $pdo->prepare('DELETE FROM myyaara_user_requests WHERE user_id = ?');
				$query->bindValue(1, $user_id);
				$query->execute();
			
			$_SESSION['popup4'] = 1;	
			header('Location: u_mygroup.php');
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Myyaara - Memories Preserved Forever</title>

    <!-- Bootstrap core CSS and Skin -->
	<link href="css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls|Shadows+Into+Light|Architects+Daughter|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="js/search/modernizr.custom.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.category span
		{
			font-family: 'Shadows Into Light', cursive;
			font-weight:bold;
			letter-spacing: 1px;
		}
		h3 a, h2
		{
			font-family: 'Shadows Into Light', cursive;
			font-weight:bold;
			letter-spacing: 1px;
		}
		.latest-news-article a img{
			margin-top:20px;
		}
	</style>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/styles.js"></script>
	
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script> 
	<script>
	$(function(){
		$('#myModal').modal('show');
	});
	</script>
</head>

<body role="document">
	
	<?php
		require_once('user_primary/navigation.php');
	?>

	<section class="container">
			<div class="col-sm-12 text-center">
				<h2 class="">My Group</h2>
				<p class="section-subtitle"></p>
			</div><!-- End 12 Columns -->
			<?php
			if(isset($_GET['send_request']))
			{	
				$admin_id = $_GET['send_request'];
				$user_email = $_SESSION['user_email'];
				
				$user = new Article;
				$users = $user->fetch_user_id($user_email);
				$user_id = $users['user_id'];
				
				$check = new Article;
				$check_status = $check -> fetch_status($admin_id, $user_id);
				
				if(empty($check_status))
				{
					$query = $pdo->prepare('INSERT into myyaara_user_requests(admin_id, user_id, status, timestamp)values(?,?,?,?)');
					$query->bindValue(1, $admin_id);
					$query->bindValue(2, $user_id);
					$query->bindValue(3, "requested");
					$query->bindValue(4, date('Y-m-d'));
					$query->execute();
		?>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4" style="float:left;margin-top:30px;">
							<div class="alert alert-dismissable alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<h4>
									Alert!
								</h4> <strong>Success!</strong> You are Successfully requested.
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>
		<?php	}
				else
				{
		?>			<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4" style="float:left;margin-top:30px;">
							<div class="alert alert-dismissable alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<h4>
									Alert!
								</h4> <strong>Warning!</strong> You are already requested to join an available group.
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>
		<?php	}
				$admin_id = $_GET['send_request'];
				
		?>		<div class="row">
					
				</div>
	<?php	}			
				$user_email = $_SESSION['user_email'];
				
				$user = new Article;
				$users = $user->fetch_user_id($user_email);
				$user_id = $users['user_id'];
				
				$req = new Article;
				$req_total = $req->fetch_group_status($user_id);
				
				if(empty($req_total))
				{
			?>		<div class="col-md-12">
						<div class="col-md-6">
							<form role="form" action="u_mygroup.php" method="POST" enctype="multipart/form-data">
								<div class="input-group">
									<input class="form-control input-lg" type="email" placeholder="Search Your Group By Email" name="email" required/>
									<span class="input-group-btn">
										<button type="submit" style="margin-top:0px;" class="btn btn-lg btn-success" name="search_by_email" >Search Email!</button>
									</span>
								</div><!-- /input-group -->
							</form>
						</div>
						<div class="col-md-6">
							<form role="form" action="u_mygroup.php" method="POST" enctype="multipart/form-data">
								<div class="input-group">
									<input class="form-control input-lg" type="text" placeholder="Search Your Group By GroupID" name="admin_id" required/>
									<span class="input-group-btn">
										<button type="submit" style="margin-top:0px;" class="btn btn-lg btn-success" name="search_by_admin_id" >Search GroupID</button>
									</span>
								</div><!-- /input-group -->
							</form>
						</div>
					</div>
		<?php	}
				else
				{	
					$admin_id = $req_total['admin_id'];
					$user_id = $req_total['user_id'];
					$status = $req_total['status'];
					if($status == "accepted")
					{
						$admin = new Article;
						$admins = $admin -> fetch_admin_detail($admin_id);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_email = $admins['admin_email'];
						$admin_phone = $admins['admin_phone'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
		?>				
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Admin Email
										</dt>
										<dd>
											<?php echo $admin_email; ?>
										</dd>
										<dt>
											Admin Phone
										</dt>
										<dd>
											<?php echo $admin_phone; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-danger btn-xs btn-block" href="u_mygroup.php?remove_group=<?php echo $user_id; ?>" style="float:right;" onclick="return confirm('Do you really want to remove?');">Remove From Group</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
					else if($status == "declined")
					{
						$admin = new Article;
						$admins = $admin -> fetch_admin_detail($admin_id);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
		?>			
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-warning btn-xs btn-block" href="u_mygroup.php?send_request=<?php echo $admin_id; ?>" style="float:right;" disabled>Request Declined</a>
										<a class="btn btn-info btn-xs btn-block" href="u_mygroup.php?remove_group=<?php echo $user_id; ?>" style="float:right;">Check For New Group</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
					else if($status == "requested")
					{	
						$admin = new Article;
						$admins = $admin -> fetch_admin_detail($admin_id);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
		?>			
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-warning btn-xs btn-block" href="u_mygroup.php?send_request=<?php echo $admin_id; ?>" style="float:right;" disabled>Request Sent</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
					else if($status == "removed")
					{
						$admin = new Article;
						$admins = $admin -> fetch_admin_detail($admin_id);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
		?>			
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-warning btn-xs btn-block" href="u_mygroup.php?send_request=<?php echo $admin_id; ?>" style="float:right;" disabled>Request Removed</a>
										<a class="btn btn-info btn-xs btn-block" href="u_mygroup.php?remove_group=<?php echo $user_id; ?>" style="float:right;">Check For New Group</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
				}

			if(isset($_POST['search_by_email']))
			{
				$email = $_POST['email'];
				if(empty($email))
				{
					$_SESSION['popup1'] = 1;	
					header('Location: u_mygroup.php');
				}
				else
				{
					$count=mysqli_query($connection,"SELECT id FROM myyaara_admin WHERE admin_email = '$email'");
				
					if(mysqli_num_rows($count) < 1)
					{	
		?>				<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4" style="float:left;margin-top:30px;">
								<div class="alert alert-dismissable alert-danger">
									 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
									<h4>
										Alert!
									</h4> <strong>Warning!</strong> The group you are searching for is not found.
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
		<?php		}
					else
					{	
						$admin = new Article;
						$admins = $admin -> fetch_admin_details($email);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_email = $admins['admin_email'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
						$admin_no_of_students = $admins['admin_no_of_students'];
		?>				
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-info btn-xs" href="u_mygroup.php?send_request=<?php echo $admin_id; ?>" style="float:right;" >Send Request</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
				}
			}
			if(isset($_POST['search_by_admin_id']))
			{
				$admin_id = $_POST['admin_id'];
				if(empty($admin_id))
				{
					$_SESSION['popup1'] = 1;	
					header('Location: u_mygroup.php');
				}
				else
				{
					$count=mysqli_query($connection,"SELECT id FROM myyaara_admin WHERE admin_id = '$admin_id'");
				
					if(mysqli_num_rows($count) < 1)
					{	
		?>				<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4" style="float:left;margin-top:30px;">
								<div class="alert alert-dismissable alert-danger">
									 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
									<h4>
										Alert!
									</h4> <strong>Warning!</strong> The group you are searching for is not found.
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
		<?php		}
					else
					{	
						$admin = new Article;
						$admins = $admin -> fetch_admin_details_by_id($admin_id);
						
						$admin_id = $admins['admin_id'];
						$admin_name = $admins['admin_name'];
						$admin_profile_pic = $admins['admin_profile_pic'];
						$admin_email = $admins['admin_email'];
						$admin_college = $admins['admin_college'];
						$admin_branch = $admins['admin_branch'];
						$admin_batch = $admins['admin_batch'];
						$admin_no_of_students = $admins['admin_no_of_students'];
		?>				
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="float:left;margin-top:30px;">
								<div class="col-md-4">
									<img style="float:left;" src="admin_profile_pics/<?php echo $admin_profile_pic; ?>" width="100%" />
								</div>
								<div class="col-md-8">
									<dl class="dl-horizontal">
										<dt>
											Group ID
										</dt>
										<dd>
											<?php echo $admin_id; ?>
										</dd>
										<dt>
											Admin Name
										</dt>
										<dd>
											<?php echo $admin_name; ?>
										</dd>
										<dt>
											Admin College
										</dt>
										<dd>
											<?php echo $admin_college; ?>
										</dd>
										<dt>
											Branch & Batch
										</dt>
										<dd>
											<?php echo $admin_branch . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $admin_batch; ?>
										</dd>
										<a class="btn btn-info btn-xs" href="u_mygroup.php?send_request=<?php echo $admin_id; ?>" style="float:right;" >Send Request</a>
									</dl>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
		<?php		}
				}
			}
		?>
		<!-- End Row -->
    </div><!-- End Container -->
</section><!-- End Featured Area Section -->


<br/>
	<?php
		require_once('user_primary/footer.php');
	?>

<script src="js/jquery.min.js"></script> <!-- jQuery Script -->
<script src="js/bootstrap.js"></script> <!-- Bootstrap JS -->
<script src="js/news-ticker/news-ticker.js"></script> <!-- Search JS -->
<script src="js/menu/jquery.smartmenus.js"></script> <!-- MegaMenu JS -->
<script src="js/menu/jquery.smartmenus.bootstrap.js"></script> <!-- MegaMenu Bootstrap JS -->
<script src="js/search/classie.js"></script> <!-- Search JS -->
<script src="js/search/uisearch.js"></script> <!-- Search JS -->
<script src="js/waypoint/waypoints.min.js"></script> <!-- Waypoint JS -->
<script src="js/isotope/isotope.pkgd.min.js"></script> <!-- Isotope JS -->
<script src="js/owl-carousel/owl.carousel.min.js"></script> <!-- Owl Carousel JS -->
<script src="js/colorbox/jquery.colorbox-min.js"></script> <!-- Colorbox JS -->
<script src="js/scripts.js"></script> <!-- Custom Script JS -->

<script>
(function($) {
  "use strict";
	//Initalize Search
	new UISearch( document.getElementById( 'sb-search' ) );

	//Owl Carousel - Main Slider
	$(".home-carousel").owlCarousel({
		items:1,
		nav:true,
		mouseDrag: false,
		navText:    ['<i class="fa fa-angle-left fa-5x"></i>','<i class="fa fa-angle-right fa-5x"></i>'],
		loop:true,
		responsiveClass:true,
		responsive:{
			0:{
				dots: false
			},
			480:{
				dots: false
			},
			768:{
				dots: true
			}
		}
	});

	//Owl Carousel - Videos
	jQuery(".latest-videos").owlCarousel({
		lazyLoad:true,
		dots:false,
		items: 1,
		loop:true,
		margin:20,
		mouseDrag: true,
		nav: false,
		navText: ['<i class="fa fa-angle-left fa-3x"></i>','<i class="fa fa-angle-right fa-3x"></i>'],
		stagePadding: 100,
		responsiveClass:true,
		responsive:{
			480:{
				items:2
			},
			768:{
				items:3,
				nav: true,
				stagePadding: 150
			}
		}
	});

	//Waypoint.js and Animate.css - On Scroll Animations - On Scroll Animations
	jQuery(".vartha-animation").waypoint(function(direction) {
		var varthaAnimationClass = jQuery(this).attr('data-animation');
		jQuery(this).addClass("animated").addClass(varthaAnimationClass);
	}, { 
		offset: "75%", 
		triggerOnce: false 
	});


	//Colorbox function
	jQuery(document).ready(function () {
		$.colorbox.settings.opacity = 0.75;
		$.colorbox.settings.maxWidth = "90%";
		$.colorbox.settings.maxHeight = "90%";
		jQuery('.video-gallery').colorbox({
			current: '',
			iframe: true,
			innerWidth:640,
			innerHeight:390,
			rel: 'video-gallery'
		});

		jQuery('.watch-now-discover').colorbox({
			current: '',
			iframe: true,
			innerWidth:640,
			innerHeight:390
		});
	});
  
})(jQuery);
</script>

</body>
</html>
<?php
	}
	else
	{
		header('Location: 404.html');
	}
?>