<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
	if(isset($_SESSION['popup4']))
	{
		$_SESSION['popup4'] = NULL;
		echo "<script> alert('Your college information updated successfully!');</script>";
	}
	if(isset($_SESSION['popup6']))
	{
		$_SESSION['popup6'] = NULL;
		echo "<script> alert('Your Picture information updated successfully!');</script>";
	}
	if(isset($_SESSION['admin_session']))
	{
	$nav = "ourcollege";
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
		
		dt{
			margin-top:10px;
		}
		dd{
			margin-top:10px;
		}
	</style>
</head>

<body role="document">
	<?php
		require_once('admin_primary/admin_navigation.php');
	?>

<section class="featured-area">
    <div class="container">
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">College page</h2>
                <p class="section-subtitle">Please upload the college building photo with the highest resolution possible and also fill in the text about the college in the text box given below.<br/> After completing the above, upload other pics
of the college such as library, ground, basketball court, lobby, entrance, laboratory and like.</p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row clearfix">
				<div class="col-md-6 column">
					<?php 	
						$admin_email = $_SESSION['admin_email'];
						$admin_id_obj = new Article;
						$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
						$admin_id = $admin_id_arr['admin_id'];
						$admin_info = new Article;
						$admin_information = $admin_info->fetch_college_information( $admin_id);
						if(!empty($admin_information))
						{
							$college_id = $admin_information['id'];
							$college_cover = $admin_information['college_cover'];
							$college_information = $admin_information['college_information'];
					
							if (!file_exists("college_cover_pics/" . $college_cover)) 
							{
								$query = $pdo->prepare('DELETE FROM myyaara_college_information WHERE id = ?');
									$query->bindValue(1, $college_id);
									$query->execute();
									continue;									
							}
					?>		
								<img class="img-thumbnail" src="college_cover_pics/<?php echo $college_cover; ?>" />
								<a href="upload_cover/upload.php?admin_id=<?php echo $admin_id; ?>" style="float:right;font-size:12px;">Change Pic</a>
			
			<?php		}
						else
						{
			?>				<a href="upload_cover/upload.php?admin_id=<?php echo $admin_id; ?>&">
								<center>
									<div class="cover-center" style="background-image: url('college_cover_pics/<?php echo "college_cover_pic.png";	 ?>')">
										<br><br><br><br><br><br><br><br><br><br><br>
										<strong>upload image</strong>		
									</div>
								</center>
							</a>
			<?php		}
					?>
					<br/>
					<form role="form" action="../intermediate_form.php?admin_id=<?php echo $admin_id; ?>&id=<?php if(isset($college_id)) { echo $college_id; }?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1">Enter College Information</label>
							<textarea class="form-control" rows="15" name="college_information" placeholder="Enter College Information" required><?php if(isset($college_information)) { echo $college_information; }	?></textarea>
						</div>
						<div class="form-group">
							<center><button type="submit" class="btn btn-primary" name="submit_college_information" >Submit College Information</button></center>
						</div>
					</form>
				</div>
				<?php
					if(isset($_GET['delete']))
					{
						$id = $_GET['id'];
						$query = $pdo->prepare('DELETE FROM myyaara_college_pictures WHERE id = ?');
							$query->bindValue(1, $id);
							$query->execute();
					}
				?>
				<div class="col-md-6 column">
				<?php 	
						$admin_email = $_SESSION['admin_email'];
						$admin_id_obj = new Article;
						$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
						$admin_id = $admin_id_arr['admin_id'];
						$admin_info = new Article;
						$admin_pictures = $admin_info->fetch_college_pictures( $admin_id);
						
				?>		
							<a href="upload_college_pics/upload.php?admin_id=<?php echo $admin_id; ?>">
								<center>
									<img class="img-thumbnail" src="college_campus_pics/upload_photo.png" style="margin-top:20px;" />
									<br/>
									<strong>upload image</strong>
								</center>
							</a>
						<div class="row">
			<?php		if(!empty($admin_pictures))
						{
							$i = 1;
							foreach($admin_pictures as $single_college_picture)
							{
								$college_picture_id = $single_college_picture['id'];
								$college_picture = $single_college_picture['college_picture'];
								if (!file_exists("college_campus_pics/" . $college_picture)) 
								{
									$query = $pdo->prepare('DELETE FROM myyaara_college_pictures WHERE id = ?');
										$query->bindValue(1, $college_picture_id);
										$query->execute();
									continue;									
								}
								$college_picture_description = $single_college_picture['college_picture_description'];
								if($i % 2 == 1)
								{
			?>						<div class="col-md-12">
									<div class="col-md-6">
									<form role="form" action="../intermediate_form.php?delete=1&id=<?php echo $college_picture_id; ?>" method="POST" enctype="multipart/form-data">
										<a href="a_our_college.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $college_picture_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
										<img class="img-thumbnail" src="college_campus_pics/<?php echo $college_picture; ?>" style="margin-top:-33px;" />
										<input class="form-control" name="college_picture_description" value="<?php echo $college_picture_description; ?>" placeholder="Enter above picture information" />
										<div class="form-group">
											<center><button type="submit" class="btn btn-primary" name="submit_picture_description" >Submit Picture Description</button></center>
										</div>
									</form>
									</div>
			<?php				}
								else
								{	
			?>						
									<div class="col-md-6">
									<form role="form" action="../intermediate_form.php?delete=1&id=<?php echo $college_picture_id; ?>" method="POST" enctype="multipart/form-data">
										<a href="a_our_college.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $college_picture_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
										<img class="img-thumbnail" src="college_campus_pics/<?php echo $college_picture; ?>" style="margin-top:-33px;" />
										<input class="form-control" name="college_picture_description" value="<?php echo $college_picture_description; ?>" placeholder="Enter above picture information" />
										<div class="form-group">
											<center><button type="submit" class="btn btn-primary" name="submit_picture_description" >Submit Picture Description</button></center>
										</div>
									</form>
									</div>	
									</div>
			<?php				}
								$i++;
							}
						}
				?>		</div>
				</div>
			</div>
    </div><!-- End Container -->
</section><!-- End Featured Area Section -->

<?php
			require_once('admin_primary/admin_footer.php');
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