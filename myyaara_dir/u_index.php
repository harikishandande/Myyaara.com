<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
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
		
		if(isset($_POST['submit_password']))
		{ 
			$user_password = $_POST['user_password'];

			$sql = "UPDATE myyaara_user SET set_password_status = ?, user_password = ? WHERE ( user_email = ? )";
				$query = $pdo->prepare($sql);
				$query->bindValue("1", 1);
				$query->bindValue("2", $user_password);
				$query->bindValue("3", $user_email);
				$query->execute();
			
			$_SESSION['popup10'] = 1;	
			header('Location: ../index.php');
		}
		if(isset($_POST['change_password']))
		{ 
			$user_password = $_POST['user_password'];

			$sql = "UPDATE myyaara_user SET user_password = ? WHERE ( user_email = ? )";
				$query = $pdo->prepare($sql);
				$query->bindValue("1", $user_password);
				$query->bindValue("2", $user_email);
				$query->execute();
			
			$_SESSION['popup10'] = 1;	
			header('Location: ../index.php');
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
	
	function checkPass()
	{
		//Store the password field objects into variables ...
		var user_password = document.getElementById('user_password');
		var confirm_user_password = document.getElementById('confirm_user_password');
		//Store the Confimation Message Object ...
		var message = document.getElementById('confirmMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field 
		//and the confirmation field
		if(user_password.value == confirm_user_password.value){
			//The passwords match. 
			//Set the color to the good color and inform
			//the user that they have entered the correct password 
			confirm_user_password.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			confirm_user_password.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}  
	<?php
			$user_email = $_SESSION['user_email'];
			$user_id_obj = new Article;
			$user_id_arr = $user_id_obj -> fetch_user_id($user_email);
			$user_id = $user_id_arr['user_id'];
			$user_info = new Article;
			$user_pictures = $user_info->fetch_user_details($user_id);
			$user_password = $user_pictures['user_password'];
	?>
	function checkoldPass()
	{
		var o_user_password = <?php echo json_encode($user_password); ?>;
		var old_user_password = document.getElementById('old_user_password');
		//Store the Confimation Message Object ...
		var message = document.getElementById('oldMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field 
		//and the confirmation field
		if(o_user_password == old_user_password.value){
			//The passwords match. 
			//Set the color to the good color and inform
			//the user that they have entered the correct password 
			old_user_password.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			old_user_password.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}  
	</script>
</head>

<body role="document">
	
	<?php
		require_once('user_primary/navigation.php');
	?>

<section class="featured-area">
    <div class="container">
		<div class="row">
		<?php 
			if($password_status == 0)
			{	
		?>		<div class="modal fade show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Change Your Password</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<form role="form" action="u_index.php" method="POST" enctype="multipart/form-data">
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $_SESSION['user_email']; ?>" disabled>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Password</label>
													<input type="password" class="form-control" name="user_password" id="user_password" onkeyup="checkoldPass(); return false;">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Confirm Password</label>
													<input type="password" class="form-control" name="confirm_user_password" id="confirm_user_password" onkeyup="checkPass(); return false;">
												</div>
												<div class="form-group">
													<span id="confirmMessage" class="confirmMessage"></span>
												</div>
												<button type="submit" class="btn btn-primary" name="submit_password">Save</button>
										</form>
									</div>
									<div class="col-md-1"></div>
								</div>
							</div>
							<div class="modal-footer">
								
							</div>
						</div>
					</div>
				</div>
	<?php	}
		?>
            <div class="col-sm-12 text-center">
                <h2 class="">My Profile</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<?php
			$user_email = $_SESSION['user_email'];
			$user_id_obj = new Article;
			$user_id_arr = $user_id_obj -> fetch_user_id($user_email);
			$user_id = $user_id_arr['user_id'];
			$user_info = new Article;
			$user_pictures = $user_info->fetch_user_details($user_id);
			$user_name = $user_pictures['user_name'];
			$user_email = $user_pictures['user_email'];
			$user_password = $user_pictures['user_password'];
		?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<form role="form" action="u_index.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							 <label for="exampleInputEmail1">Name</label>
							 <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">Email</label>
							 <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputPassword1">Old Password</label>
							 <input type="password" class="form-control" name="old_user_password" id="old_user_password" placeholder="Enter Old Password" onkeyup="checkoldPass(); return false;"/>
						</div>
						<div class="form-group">
							<span id="oldMessage" class="oldMessage"></span>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">New Password</label>
							<input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter New Password">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_user_password" id="confirm_user_password" placeholder="Enter New Password Again" onkeyup="checkPass(); return false;">
						</div>
						<div class="form-group">
							<span id="confirmMessage" class="confirmMessage"></span>
						</div>
						<div class="form-group">
							<center><button type="submit" class="btn btn-success" name="change_password"  >Change Password </button></center>
						</div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
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