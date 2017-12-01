<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
	if(isset($_SESSION['popup7']))
	{
		$_SESSION['popup7'] = NULL;
		echo "<script> alert('Your teacher information updated successfully!');</script>";
	}
	if(isset($_SESSION['admin_session']))
	{
	$nav = "ourteachers";
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
                <h2 class="">Teachers page</h2>
                <p class="section-subtitle">Please collect the necessary information from the teachers and fill in the same in the given fields with their photo.</p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<?php
					if(isset($_GET['delete']))
					{
						$id = $_GET['id'];
						$query = $pdo->prepare('DELETE FROM myyaara_teacher_information WHERE id = ?');
							$query->bindValue(1, $id);
							$query->execute();
					}
				?>
		<?php 	
			$admin_email = $_SESSION['admin_email'];
			$admin_id_obj = new Article;
			$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
			$admin_id = $admin_id_arr['admin_id'];
			$teachers_info = new Article;
			$teachers_pictures = $teachers_info->fetch_teachers_information( $admin_id);
		?>			
		<a href="upload_teacher_pics/upload.php?admin_id=<?php echo $admin_id; ?>">
			<center>
				<img class="img-thumbnail" src="college_teacher_pics/upload_photo.png" style="margin-top:20px;" />
				<br/>
				<strong>upload image</strong>
			</center>
		</a>
			<div class="row">
			<?php		if(!empty($teachers_pictures))
						{
							$i = 1; 
							$j = 0;
							$k = 1;
							foreach($teachers_pictures as $single_teacher_info)
							{
								$teacher_id = $single_teacher_info['id'];
								$teacher_name = $single_teacher_info['teacher_name'];
								$teacher_picture = $single_teacher_info['teacher_picture'];
								if (!file_exists("college_teacher_pics/" . $teacher_picture)) 
								{
									$query = $pdo->prepare('DELETE FROM myyaara_teacher_information WHERE id = ?');
										$query->bindValue(1, $teacher_id);
										$query->execute();
									continue;									
								}
								$teacher_subject = $single_teacher_info['teacher_subject'];
								$teacher_opinion = $single_teacher_info['teacher_opinion'];
								$teacher_advice = $single_teacher_info['teacher_advice'];
								if( $i % 4 == 1 )
								{	
			?>						<div class="col-md-12">
										<div class="col-md-3">
											<form role="form" action="../intermediate_form.php?admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" method="POST" enctype="multipart/form-data">
												<a href="a_our_teachers.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
												<img class="img-thumbnail" src="college_teacher_pics/<?php echo $teacher_picture; ?>" style="margin-top:-33px;" />
												<input class="form-control" name="teacher_name" value="<?php echo $teacher_name; ?>" placeholder="Enter Teacher Name" />
												<input class="form-control" name="teacher_subject" value="<?php echo $teacher_subject; ?>" placeholder="Enter Teacher Subject" />
												<input class="form-control" name="teacher_opinion" value="<?php echo $teacher_opinion; ?>" placeholder="Enter Teacher Opinion" />
												<input class="form-control" name="teacher_advice" value="<?php echo $teacher_advice; ?>" placeholder="Enter Teacher Advice" />
												<div class="form-group">
													<center><button type="submit" class="btn btn-primary" name="submit_teacher_information" >Submit Teacher Information</button></center>
												</div>
											</form>
										</div>
			<?php				}
								else if(($i % 2 == 0))
								{	
				?>						<div class="col-md-3">
											<form role="form" action="../intermediate_form.php?admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" method="POST" enctype="multipart/form-data">
												<a href="a_our_teachers.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
												<img class="img-thumbnail" src="college_teacher_pics/<?php echo $teacher_picture; ?>" style="margin-top:-33px;" />
												<input class="form-control" name="teacher_name" value="<?php echo $teacher_name; ?>" placeholder="Enter Teacher Name" />
												<input class="form-control" name="teacher_subject" value="<?php echo $teacher_subject; ?>" placeholder="Enter Teacher Subject" />
												<input class="form-control" name="teacher_opinion" value="<?php echo $teacher_opinion; ?>" placeholder="Enter Teacher Opinion" />
												<input class="form-control" name="teacher_advice" value="<?php echo $teacher_advice; ?>" placeholder="Enter Teacher Advice" />
												<div class="form-group">
													<center><button type="submit" class="btn btn-primary" name="submit_teacher_information" >Submit Teacher Information</button></center>
												</div>
											</form>
										</div>
			<?php				}
								else if($i % 3 == $j)
								{		$j++;
				?>						<div class="col-md-3">
											<form role="form" action="../intermediate_form.php?admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" method="POST" enctype="multipart/form-data">
												<a href="a_our_teachers.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
												<img class="img-thumbnail" src="college_teacher_pics/<?php echo $teacher_picture; ?>" style="margin-top:-33px;" />
												<input class="form-control" name="teacher_name" value="<?php echo $teacher_name; ?>" placeholder="Enter Teacher Name" />
												<input class="form-control" name="teacher_subject" value="<?php echo $teacher_subject; ?>" placeholder="Enter Teacher Subject" />
												<input class="form-control" name="teacher_opinion" value="<?php echo $teacher_opinion; ?>" placeholder="Enter Teacher Opinion" />
												<input class="form-control" name="teacher_advice" value="<?php echo $teacher_advice; ?>" placeholder="Enter Teacher Advice" />
												<div class="form-group">
													<center><button type="submit" class="btn btn-primary" name="submit_teacher_information" >Submit Teacher Information</button></center>
												</div>
											</form>
										</div>
			<?php				}
								else if($i % 4 == 0)
								{
			?>							<div class="col-md-3">
											<form role="form" action="../intermediate_form.php?admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" method="POST" enctype="multipart/form-data">
												<a href="a_our_teachers.php?delete=1&admin_id=<?php echo $admin_id; ?>&id=<?php echo $teacher_id; ?>" onclick="return confirm('Do you really want to delete the pic?');" class="btn btn-xs btn-danger" style="float:right;z-index:1;position: relative;margin-right:0px;">x</a>
												<img class="img-thumbnail" src="college_teacher_pics/<?php echo $teacher_picture; ?>" style="margin-top:-33px;" />
												<input class="form-control" name="teacher_name" value="<?php echo $teacher_name; ?>" placeholder="Enter Teacher Name" />
												<input class="form-control" name="teacher_subject" value="<?php echo $teacher_subject; ?>" placeholder="Enter Teacher Subject" />
												<input class="form-control" name="teacher_opinion" value="<?php echo $teacher_opinion; ?>" placeholder="Enter Teacher Opinion" />
												<input class="form-control" name="teacher_advice" value="<?php echo $teacher_advice; ?>" placeholder="Enter Teacher Advice" />
												<div class="form-group">
													<center><button type="submit" class="btn btn-primary" name="submit_teacher_information" >Submit Teacher Information</button></center>
												</div>
											</form>
										</div>
									</div>
			<?php				}
								$i++;
							}
						}
	?>		</div>
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