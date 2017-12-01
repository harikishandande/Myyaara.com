<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
	$admin_email = $_SESSION['admin_email'];
	$query = "select set_password_status from `myyaara_admin` where `admin_email` = '$admin_email'";
	$get_status = mysqli_query($connection,$query);
	$result = mysqli_fetch_assoc($get_status);
	$password_status = $result['set_password_status'];
	$nav = "home";
	if(isset($_SESSION['admin_session']))
	{
		if(isset($_POST['submit_password']))
		{ 
			$admin_password = $_POST['admin_password'];

			$sql = "UPDATE myyaara_admin SET set_password_status = ?, admin_password = ? WHERE ( admin_email = ? )";
				$query = $pdo->prepare($sql);
				$query->bindValue("1", 1);
				$query->bindValue("2", $admin_password);
				$query->bindValue("3", $admin_email);
				$query->execute();
			
			$_SESSION['popup10'] = 1;	
			header('Location: a_index.php');
		}
		if(isset($_POST['change_password']))
		{ 
			$admin_password = $_POST['admin_password'];

			$sql = "UPDATE myyaara_admin SET admin_password = ? WHERE ( admin_email = ? )";
				$query = $pdo->prepare($sql);
				$query->bindValue("1", $admin_password);
				$query->bindValue("2", $admin_email);
				$query->execute();
			
			$_SESSION['popup10'] = 1;	
			header('Location: a_index.php');
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
		var admin_password = document.getElementById('admin_password');
		var confirm_admin_password = document.getElementById('confirm_admin_password');
		//Store the Confimation Message Object ...
		var message = document.getElementById('confirmMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field 
		//and the confirmation field
		if(admin_password.value == confirm_admin_password.value){
			//The passwords match. 
			//Set the color to the good color and inform
			//the user that they have entered the correct password 
			confirm_admin_password.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			confirm_admin_password.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}  
	<?php
			$admin_email = $_SESSION['admin_email'];
			$admin_id_obj = new Article;
			$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
			$admin_id = $admin_id_arr['admin_id'];
			$admin_info = new Article;
			$admin_pictures = $admin_info->fetch_admin_detail($admin_id);
			$admin_password = $admin_pictures['admin_password'];
	?>
	function checkoldPass()
	{
		var o_admin_password = <?php echo json_encode($admin_password); ?>;
		var old_admin_password = document.getElementById('old_admin_password');
		//Store the Confimation Message Object ...
		var message = document.getElementById('oldMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field 
		//and the confirmation field
		if(o_admin_password == old_admin_password.value){
			//The passwords match. 
			//Set the color to the good color and inform
			//the user that they have entered the correct password 
			old_admin_password.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}else{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			old_admin_password.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}  
	</script>
</head>

<body role="document">
	
	<?php
		require_once('admin_primary/admin_navigation.php');
	?>

<section class="featured-area">
    <div class="container">
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">My Profile</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<?php
			$admin_email = $_SESSION['admin_email'];
			$admin_id_obj = new Article;
			$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
			$admin_id = $admin_id_arr['admin_id'];
			$admin_info = new Article;
			$admin_pictures = $admin_info->fetch_admin_detail($admin_id);
			$admin_name = $admin_pictures['admin_name'];
			$admin_email = $admin_pictures['admin_email'];
			$admin_password = $admin_pictures['admin_password'];
		?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<form role="form" action="a_change_password.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							 <label for="exampleInputEmail1">Name</label>
							 <input type="text" class="form-control" name="admin_name" value="<?php echo $admin_name; ?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">Email</label>
							 <input type="email" class="form-control" name="admin_email" value="<?php echo $admin_email; ?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputPassword1">Old Password</label>
							 <input type="password" class="form-control" name="old_admin_password" id="old_admin_password" placeholder="Enter Old Password" onkeyup="checkoldPass(); return false;"/>
						</div>
						<div class="form-group">
							<span id="oldMessage" class="oldMessage"></span>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">New Password</label>
							<input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Enter New Password">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_admin_password" id="confirm_admin_password" placeholder="Enter New Password Again" onkeyup="checkPass(); return false;">
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