<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	if(isset($_SESSION['popup3']))
	{
		$_SESSION['popup3'] = NULL;
		echo "<script> alert('Your user story updated successfully!');</script>";
	}
	if(isset($_SESSION['user_session']))
	{
		$nav = "mystory";
		
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
</head>

<body role="document">

	<?php
		require_once('user_primary/navigation.php');
	?>
	
<section class="featured-area">
    <div class="container">
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">My story</h2>
                <p class="section-subtitle">This is where we want you to open your heart and speak out. Here, you can write about your best friend or parents or best day or any article and absolutely anything you want us to publish in your book. </p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row">
			<?php
				$user_email = $_SESSION['user_email'];
				$user_id_obj = new Article;
				$user_id_arr = $user_id_obj -> fetch_userids($user_email);
				$user_id = $user_id_arr['user_id'];
				
				$user_data = new Article;
				$user_info = $user_data -> fetch_userstory($user_id);
				$user_mystory = $user_info['user_mystory'];
				
			if(empty($user_mystory))
			{
				$_GET['edit_story'] = 1;
			}
			
			if(isset($_GET['edit_story']))
			{
				$user_email = $_SESSION['user_email'];
				$user_id_obj = new Article;
				$user_id_arr = $user_id_obj -> fetch_userids($user_email);
				$user_id = $user_id_arr['user_id'];
				
				$user_data = new Article;
				$user_info = $user_data -> fetch_userstory($user_id);
				$user_mystory_title = $user_info['user_mystory_title'];
				$user_mystory = $user_info['user_mystory'];
				$user_mystory_picture = $user_info['user_mystory_picture'];
			
			?>	<div class="col-md-12">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<form role="form" action="../intermediate_form.php?id=<?php echo $user_id; ?>" method="POST" enctype="multipart/form-data">
						<a href="upload_user_story/upload.php?user_email=<?php echo $user_email; ?>">
							<center>
								<div class="circle-center" style="background-image: url('user_story_pics/<?php echo $user_mystory_picture; ?>')">
									<br><br><br><br><br><br><br><br><br>
									<strong>upload image</strong>		
								</div>
							</center>
						</a>
						<br>
						<div class="form-group">
							 <label for="exampleInputEmail1">Story Title</label>
							 <input type="text" class="form-control" name="user_mystory_title" value="<?php echo $user_mystory_title; ?>" placeholder="Add your story title" />
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Enter Your Own Story</label>
								<textarea class="form-control" name="user_mystory" id="user_mystory" rows="15" height="500px"><?php echo $user_mystory; ?></textarea>
								<script>
									CKEDITOR.replace( 'user_mystory', {});
								</script>
						</div>
						<div class="form-group">
							<center><button type="submit" class="btn btn-primary" name="submit_user_story">Submit Your Story</button></center>
						</div>
					</form>
				</div>
					<div class="col-md-2"></div>
				</div>
	<?php	}
			else
			{
					$user_email = $_SESSION['user_email'];
					$user_id_obj = new Article;
					$user_id_arr = $user_id_obj -> fetch_userids($user_email);
					$user_id = $user_id_arr['user_id'];
					
					$user_data = new Article;
					$user_info = $user_data -> fetch_userstory($user_id);
					$user_name = $user_info['user_name'];
					$user_mystory_title = $user_info['user_mystory_title'];
					$user_mystory = $user_info['user_mystory'];
					$user_mystory_picture = $user_info['user_mystory_picture'];
						?>
				<div class="col-md-12">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<a href="u_mystory.php?edit_story=1" class="btn btn-warning btn-xs pull-right"	>Edit Story</a>
						<h3><center><?php if(empty($user_mystory_title)){;
						}else{ echo $user_mystory_title; } ?></center></h3>			
						<img  class="img-circle" src="user_story_pics/<?php echo $user_mystory_picture; ?>" width="10%" style="float:left;margin:10px;" />	
						<span style="margin:;"><?php if(empty($user_mystory)){	}else{ echo $user_mystory; } ?></span>	
						<div class="row">
							<p style="float:right;font-size:20px;">by</p>
						</div>
						<div class="row">
							<p style="float:right;font-size:18px;"><?php echo $user_name; ?></p>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
	<?php	}	?>
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