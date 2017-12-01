<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
	$nav = "mypics";
	
	if(isset($_SESSION['popup6']))
	{
		$_SESSION['popup6'] = NULL;
		echo "<script> alert('Your Picture information updated successfully!');</script>";
	}
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
		
		.verticalLine 
		{	
			border-left: 1px solid #DDDDDD;
			border-right: 1px solid #DDDDDD;
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
                <h2 class="">My pics</h2>
                <p class="section-subtitle">Please Upload the profile pic for your selected template here. 

Also, you have to upload any 2 pics of you with your friends. <br/>These pics can be from college tours to hangouts!</p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row">
			<div class="row clearfix">
				<?php
					if(isset($_GET['delete']))
					{
						$id = $_GET['id'];
						$query = $pdo->prepare('DELETE FROM myyaara_user_pictures WHERE id = ?');
							$query->bindValue(1, $id);
							$query->execute();
					}
				?>
				<div class="col-md-6 column verticalLine">
					<?php
						$user_email = $_SESSION['user_email'];
						$user_id_obj = new Article;
						$user_id_arr = $user_id_obj -> fetch_userids($user_email);
						$user_id = $user_id_arr['user_id'];
						
						$user_data = new Article;
						$user_info = $user_data -> fetch_user_details($user_id);
						$user_picture = $user_info['user_picture'];
					?>
					
						<center>
							<div class="circle-center" style="background-image: url('user_story_pics/<?php echo $user_picture; ?>')">
							<br><br><br><br><br><br><br><br><br>
							<a href="upload_user_profile/upload.php?user_email=<?php echo $user_email; ?>">
							<strong>upload profile pic</strong>	
							</a>							
							</div>
						</center>
					
					<br/><br/><br/><br/>
				</div>
				<div class="col-md-6 column verticalLine">
					<?php 	
						$user_email = $_SESSION['user_email'];
						$user_id_obj = new Article;
						$user_id_arr = $user_id_obj -> fetch_userids($user_email);
						$user_id = $user_id_arr['user_id'];
						$user_info = new Article;
						$user_pictures = $user_info->fetch_personal_pictures( $user_id);
						
				?>		
							
								<center>
									<img class="img-thumbnail" src="user_personal_pics/upload_photo.png" style="margin-top:20px;" />
									<br/>
									<a href="upload_user_personal_pics/upload.php?user_id=<?php echo $user_id; ?>">
									<strong>upload Other Photos</strong>
									</a>
								</center>
							
			<?php		if(!empty($user_pictures))
						{
							$i = 1;
							foreach($user_pictures as $single_user_picture)
							{
								$user_picture_id = $single_user_picture['id'];
								$user_picture = $single_user_picture['user_picture'];
								if (!file_exists("user_personal_pics/" . $user_picture)) 
								{
									$query = $pdo->prepare('DELETE FROM myyaara_user_pictures WHERE id = ?');
										$query->bindValue(1, $user_picture_id);
										$query->execute();
									continue;									
								}
								$user_picture_description = $single_user_picture['user_picture_description'];
								if($i % 2 == 1)
								{
			?>						<div class="col-md-12">
									<div class="col-md-6">
										<form role="form" action="../intermediate_form.php?user_id=<?php echo $user_id; ?>&id=<?php echo $user_picture_id; ?>" method="POST" enctype="multipart/form-data">
											<a href="u_mypics.php?delete=1&user_id=<?php echo $user_id; ?>&id=<?php echo $user_picture_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
											<img class="img-thumbnail" src="user_personal_pics/<?php echo $user_picture; ?>" style="margin-top:-33px;" width="100%"/>
											<input class="form-control" name="user_picture_description" value="<?php echo $user_picture_description; ?>" placeholder="Enter above picture information" />
											<div class="form-group">
												<center><button type="submit" class="btn btn-primary" name="submit_user_picture_description" >Submit Picture Description</button></center>
											</div>
										</form>
									</div>
			<?php				}
								else
								{	
			?>						<div class="col-md-6">
										<form role="form" action="../intermediate_form.php?user_id=<?php echo $user_id; ?>&id=<?php echo $user_picture_id; ?>" method="POST" enctype="multipart/form-data">
											<a href="u_mypics.php?delete=1&user_id=<?php echo $user_id; ?>&id=<?php echo $user_picture_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
											<img class="img-thumbnail" src="user_personal_pics/<?php echo $user_picture; ?>" style="margin-top:-33px;" width="100%"/>
											<input class="form-control" name="user_picture_description" value="<?php echo $user_picture_description; ?>" placeholder="Enter above picture information" />
											<div class="form-group">
												<center><button type="submit" class="btn btn-primary" name="submit_user_picture_description" >Submit Picture Description</button></center>
											</div>
										</form>
									</div>
									</div>
			<?php				}
								$i++;
							}
						}
				?>	<br/><br/><br/><br/>
				</div>
			</div>
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