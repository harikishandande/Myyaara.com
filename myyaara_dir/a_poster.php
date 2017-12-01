<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	if(isset($_SESSION['admin_session']))
	{
	$nav = "poster";
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
    <link href="css/custom.css" rel="stylesheet">	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls|Shadows+Into+Light|Architects+Daughter|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="js/search/modernizr.custom.js"></script>	<script src="js/jquery.min.js"></script> <!-- jQuery Script -->	 <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>		.selected{			border: 4px solid #4390df;			display:block;		}		.selected::before {		  color: #fff;		  content: "\f00c";		  display: block;		  font-family: "FontAwesome";		  font-size: 10pt;		  font-weight: normal;		  position: absolute;		  right: 2px;		  top: 0;		  z-index: 102;		}		.selected::after {		  border-left: 32px solid transparent;		  border-top: 32px solid #4390df;		  content: "";		  display: block;		  position: absolute;		  right: 0;		  top: 0;		  z-index: 101;		}		.mfp-title{			text-align:center !important;		}
		.category span
		{
			font-family: 'Shadows Into Light', cursive;
			font-weight:bold;
			letter-spacing: 1px;
		}
		h3 a, h2,h3 
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
                <h3 class="">Cover book selection</h3>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<br/>
		<div class="col-md-1"></div>
		<div class="col-md-10 clearfix">
			<div class="owl-carousel cover_select vartha-animation" data-animation="fadeIn">
				<a href="img/demo/videos/comingsoon.jpg" class="cover_template" data-button="<button class='btn btn-danger  selectedTheme' id='comingsoon'>Select</button>">
                    <img alt="Video 6" src="img/demo/videos/comingsoon.jpg" class="video-item">
                </a>
                <a href="img/demo/videos/cover1-thumb.jpg" class="cover_template " data-button="<button class='btn btn-danger  selectedTheme' id='cover1-thumb'>Select</button>">
                    <img alt="Video 6" src="img/demo/videos/cover1-thumb.jpg" class="video-item">
                </a>                <a href="img/demo/videos/comingsoon.jpg" class="cover_template" data-button="<button class='btn btn-danger  selectedTheme' id='comingsoon'>Select</button>" >
                    <img alt="Video 6" src="img/demo/videos/comingsoon.jpg" class="video-item">
                </a>
            </div><!-- End Owl Carousel Latest Videos -->			<script>			$(function(){				$('.cover_template').magnificPopup({					type: 'image',					gallery: {					  enabled: true					},					image: {						titleSrc: 'data-button'					},					callbacks: {						open: function() {							$('.selectedTheme').click(function(){								var selectedTheme = $(this).attr('id')+'.jpg';								console.log(selectedTheme);								/*$('#user_template_selection').val(selectedTheme);*/								$.magnificPopup.close();								$('.cover_select').find('.selected').removeClass('selected');								$('a[href*="'+selectedTheme+'"]').addClass('selected');							});						}					}				});			});			</script>
			<div class="row">
				 <div class="col-sm-12 text-center">
					<h2 class="">Wall Poster</h2>
					<p class="section-subtitle">Here is where you have to Upload an image of the highest resolution with all the members together. <br/>This image shall be printed and given as a wall poster.</p>
				</div><!-- End 12 Columns -->
				<div class="col-md-12 column">
					<?php 	
						$admin_email = $_SESSION['admin_email'];
						$admin_id_obj = new Article;
						$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
						$admin_id = $admin_id_arr['admin_id'];
						$admin_info = new Article;
						$admin_information = $admin_info->fetch_wall_poster( $admin_id);
						if(!empty($admin_information))
						{
							$id = $admin_information['id'];
							$wall_poster = $admin_information['wall_poster'];
					
							if (!file_exists("wall_poster_pics/" . $wall_poster)) 
							{
								$query = $pdo->prepare('DELETE FROM myyaara_poster WHERE id = ?');
									$query->bindValue(1, $id);
									$query->execute();
									continue;									
							}
					?>		<img class="img-thumbnail" src="wall_poster_pics/<?php echo $wall_poster; ?>" alt="3508X4961" width="100%"/>
							<a href="upload_wall_poster/upload.php?admin_id=<?php echo $admin_id; ?>" style="float:right;font-size:12px;">Change Pic</a>
			<?php		}
						else
						{
			?>				<a href="upload_wall_poster/upload.php?admin_id=<?php echo $admin_id; ?>">
								<center>
									<div class="poster-center" style="background-image: url('college_cover_pics/<?php echo "college_wall_poster.png";	 ?>')">
										<br><br><br><br><br><br><br><br><br><br><br>
										<strong>upload image</strong>		
									</div>
								</center>
							</a>
							<br/>
			<?php		}
					?>
				</div>
		</div>
		<div class="col-md-1"></div>
    </div><!-- End Container -->
</section><!-- End Featured Area Section -->

<?php
			require_once('admin_primary/admin_footer.php');
		?>


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
	jQuery(".cover_select").owlCarousel({
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