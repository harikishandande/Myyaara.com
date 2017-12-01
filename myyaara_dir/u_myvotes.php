<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	
	$nav = "myvotes";
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
		h3 a, h2, td
		{
			font-family: 'Shadows Into Light', cursive;
			font-weight:bold;
			letter-spacing: 1px;
		}
		.latest-news-article a img{
			margin-top:20px;
		}
		td
		{
			font-size:20px;
			padding:30px;
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
                <h2 class="">My votes</h2>
                <p class="section-subtitle">This is the funniest and cool place to kick your friends without hurting them! They don't know to whom you vote but all the votes count up and the majority gets the award! So, have fun.</p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row">
			<div class="alert alert-dismissable alert-danger">
				<center>
					<h4 style="color:orange;">
						Alert!
					</h4>
					<strong style="color:red;">This selection box will unlock once all the members in your specified group are signed up.</strong>
				</center>
			</div>
			<br/>
			<table class="table" style="background-color:#fff;">
				<thead>
					<tr>
						<th>
							<center>#</center>
						</th>
						<th>
							<center>Image</center>
						</th>
						<th>
							<center>Question</center>
						</th>
						<th>
							<center>Your Answer</center>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							<img src="awards/family.gif" />
						</td>
						<td>
							Whom do you think the family pack award should go to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							2
						</td>
						<td>
							<img src="awards/smile.gif" />
						</td>
						<td>
							Who has got the cutest smile?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							3
						</td>
						<td>
							<img src="awards/beautiful.gif" />
						</td>
						<td>
							Who is the most beautiful girl in the class?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							4
						</td>
						<td>
							<img src="awards/handsome.gif" />
						</td>
						<td>
							Who is the handsome stud?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							5
						</td>
						<td>
							<img src="awards/loveguru.gif" />
						</td>
						<td>
							Love guru award should go to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							6
						</td>
						<td>
							<img src="awards/crazy.gif" />
						</td>
						<td>
							Who is the craziest person in the class?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							7
						</td>
						<td>
							<img src="awards/sleep.gif" />
						</td>
						<td>
							Who usually sleeps during class?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							8
						</td>
						<td>
							<img src="awards/bookworm.gif" />
						</td>
						<td>
							Whom do you vote as a bookworm in ur class?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							9
						</td>
						<td>
							<img src="awards/faku.gif" />
						</td>
						<td>
							Whom do you think should get the faku award? The award for one who keep faking always! 
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							10
						</td>
						<td>
							<img src="awards/lazy.gif" />
						</td>
						<td>
							Lazy fellow should be given to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							11
						</td>
						<td>
							<img src="awards/intelligent.gif" />
						</td>
						<td>
							Who is the most intelligent student in your class?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							12
						</td>
						<td>
							<img src="awards/loverboy.gif" />
						</td>
						<td>
							Lover boy award shall be voted for?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							13
						</td>
						<td>
							<img src="awards/crying.gif" />
						</td>
						<td>
							Crying baby award should go to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							14
						</td>
						<td>
							<img src="awards/sportsman.gif" />
						</td>
						<td>
							Sports man award may be given to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							15
						</td>
						<td>
							<img src="awards/beer.gif" />
						</td>
						<td>
							The beer boy award should be given to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							15
						</td>
						<td>
							<img src="awards/6pack.gif" />
						</td>
						<td>
							The GYM boy award goes to?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							15
						</td>
						<td>
							<img src="awards/angry.gif" />
						</td>
						<td>
							The angry man - hulk?
						</td>
						<td>
							<select class="form-control" disabled>
								<option><< Select Your Choice>></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
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