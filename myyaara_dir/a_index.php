<?php 
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	if(isset($_SESSION['popup3']))
	{
		$_SESSION['popup3'] = NULL;
		echo "<script> alert('Your admin details updated successfully!');</script>";
	}
	if(isset($_SESSION['popup10']))
	{
		$_SESSION['popup10'] = NULL;
		echo "<script> alert('Your password updated successfully!');</script>";
	}
	if(isset($_SESSION['admin_session']))
	{
		$admin_email = $_SESSION['admin_email'];
		$query = "select set_password_status from `myyaara_admin` where `admin_email` = '$admin_email'";
		$get_status = mysqli_query($connection,$query);
		$result = mysqli_fetch_assoc($get_status);
		$password_status = $result['set_password_status'];
	
		$nav = "home";
	
	if(isset($_GET['remove']))
	{
		$admin_id = $_GET['admin_id'];
		$user_id = $_GET['user_id'];
						
		$admin_id = $_GET['admin_id'];
		$user_id = $_GET['user_id'];
							
		$sql = "UPDATE myyaara_user_requests SET status = ?, removed_status = ? WHERE ( admin_id = ? && user_id = ? )";
			$query = $pdo->prepare($sql);
			$query->bindValue("1", "removed");
			$query->bindValue("2", 1);
			$query->bindValue("3", $admin_id);
			$query->bindValue("4", $user_id);
			$query->execute();
	}

	if(isset($_GET['accept']))
	{
		$admin_id = $_GET['admin_id'];
		$user_id = $_GET['user_id'];
								
		$sql = "UPDATE myyaara_user_requests SET status = ?, accepted_status = ? WHERE ( admin_id = ? && user_id = ? )";
			$query = $pdo->prepare($sql);
			$query->bindValue("1", "accepted");
			$query->bindValue("2", 1);
			$query->bindValue("3", $admin_id);
			$query->bindValue("4", $user_id);
			$query->execute();
	}
	else if(isset($_GET['decline']))
	{
		$admin_id = $_GET['admin_id'];
		$user_id = $_GET['user_id'];
						
		$sql = "UPDATE myyaara_user_requests SET status = ?, declined_status = ? WHERE ( admin_id = ? && user_id = ? )";
			$query = $pdo->prepare($sql);
			$query->bindValue("1", "declined");
			$query->bindValue("2", 1);
			$query->bindValue("3", $admin_id);
			$query->bindValue("4", $user_id);
			$query->execute();
										
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
		h3 a, h2, h4
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
		
		.verticalLine 
		{	
			border-left: 1px solid #DDDDDD;
			border-right: 1px solid #DDDDDD;
		}
	</style>
	
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
	</script>
</head>

<body role="document">
		<?php
			require_once('admin_primary/admin_navigation.php');
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
										<form role="form" action="a_change_password.php" method="POST" enctype="multipart/form-data">
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<input type="text" class="form-control" name="admin_email" id="admin_email" value="<?php echo $_SESSION['admin_email']; ?>" disabled>
												</div>
												<div class="form-group">
													<label for="exampleInputEmail1">Password</label>
													<input type="password" class="form-control" name="admin_password" id="admin_password" onkeyup="checkoldPass(); return false;">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Confirm Password</label>
													<input type="password" class="form-control" name="confirm_admin_password" id="confirm_admin_password" onkeyup="checkPass(); return false;">
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
                <h2 class="">Group Information</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row">
		<?php
		if(isset($_GET['edit_admin']))
		{
		?>	<div class="col-md-12">
				<div class="col-md-2 column">
				</div>
				<div class="col-md-8 column">
					<?php
						$admin_email = $_SESSION['admin_email'];
						$admin = new Article;
						$admin_values = $admin->fetch_admin_details($admin_email);
						
						$admin_name = $admin_values['admin_name'];
						$admin_email = $admin_values['admin_email'];
						$admin_phone = $admin_values['admin_phone'];
						$admin_password = $admin_values['admin_password'];
						$admin_college = $admin_values['admin_college'];
						$admin_branch = $admin_values['admin_branch'];
						$admin_batch = $admin_values['admin_batch'];
						if(!empty($admin_batch))
						{
							$admin_no = filter_var($admin_batch, FILTER_SANITIZE_NUMBER_INT);
							$array = explode('-', $admin_no);
							$first_year = $array[0];
							$last_year = $array[1];
						}
						$admin_no_of_students = $admin_values['admin_no_of_students'];
					?>
					
					<?php 	
						$admin_email = $_SESSION['admin_email'];
						$admin_pic = new Article;
						$admin_pics = $admin_pic->fetch_admin_profile_pic( $admin_email );
						$admin_profile_pic = $admin_pics['admin_profile_pic'];
					?>
					<div class="row">
						<a href="upload/upload.php?admin_email=<?php echo $admin_email; ?>">
							<center>
								<div class="circle-center" style="background-image: url('admin_profile_pics/<?php echo $admin_profile_pic; ?>')">
									<br><br><br><br><br><br><br><br><br>
									<strong>upload image</strong>		
								</div>
							</center>
						</a>
					</div>
					<br/>
					<br/>
					<hr/>
					<form role="form" action="../intermediate_form.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							 <label for="exampleInputEmail1">Admin Name</label><input type="text" class="form-control" value="<?php if(isset($admin_name)){echo $admin_name; }?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">Admin Email</label><input type="text" class="form-control" value="<?php echo $admin_email; ?>" disabled/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">Admin Phone</label><input type="text" class="form-control" name="admin_phone" value="<?php echo $admin_phone; ?>" required/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">College Name</label><input type="text" class="form-control" name="admin_college" placeholder="Enter Your College Name" value="<?php echo $admin_college; ?>" required/>
						</div>
						<div class="form-group">
							 <label for="exampleInputEmail1">Branch Name</label><input type="text" class="form-control" name="admin_branch" placeholder="Enter Your Branch" value="<?php echo $admin_branch; ?>" required/>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Select Your Batch</label><br/>
							<div class="col-md-12">
							<div class="col-md-5">
								<select class="form-control" name="first_year" required>
						<?php
								if(isset($first_year))
								{
						?>			<option value="<?php echo $first_year; ?>" ><?php echo $first_year; ?></option>
						<?php	}	?>
									<option><< Select year >></option>
									<option value="2000" >2000</option>
									<option value="2001" >2001</option>
									<option value="2002" >2002</option>
									<option value="2003" >2003</option>
									<option value="2004" >2004</option>
									<option value="2005" >2005</option>
									<option value="2006" >2006</option>
									<option value="2007" >2007</option>
									<option value="2008" >2008</option>
									<option value="2009" >2009</option>
									<option value="2010" >2010</option>
									<option value="2011" >2011</option>
									<option value="2012" >2012</option>
									<option value="2013" >2013</option>
									<option value="2014" >2014</option>
									<option value="2015" >2015</option>
									<option value="2016" >2016</option>
									<option value="2017" >2017</option>
									<option value="2018" >2018</option>
									<option value="2019" >2019</option>
									<option value="2020" >2020</option>
								</select>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" name="" value="----------------" disabled/>
							 </div>
							 <div class="col-md-5">
								<select class="form-control" name="last_year" required>
								<?php
								if(isset($first_year))
								{
						?>			<option value="<?php echo $last_year; ?>" ><?php echo $last_year; ?></option>
						<?php	}	?>
									<option><< Select year >></option>
									<option value="2000" >2000</option>
									<option value="2001" >2001</option>
									<option value="2002" >2002</option>
									<option value="2003" >2003</option>
									<option value="2004" >2004</option>
									<option value="2005" >2005</option>
									<option value="2006" >2006</option>
									<option value="2007" >2007</option>
									<option value="2008" >2008</option>
									<option value="2009" >2009</option>
									<option value="2010" >2010</option>
									<option value="2011" >2011</option>
									<option value="2012" >2012</option>
									<option value="2013" >2013</option>
									<option value="2014" >2014</option>
									<option value="2015" >2015</option>
									<option value="2016" >2016</option>
									<option value="2017" >2017</option>
									<option value="2018" >2018</option>
									<option value="2019" >2019</option>
									<option value="2020" >2020</option>
								</select>
							 </div>
							 </div>
						</div>
						<div class="form-group">
							 <label for="exampleInputPassword1">Enter no of students</label>
							 <input type="number" class="form-control" name="admin_no_of_students" placeholder="Enter Number Of Students In Your Batch" value="<?php echo $admin_no_of_students; ?>" required/>
						</div>
						<div class="form-group">
							<center><button type="submit" class="btn btn-primary" name="submit_admin_details" >Submit Admin Details</button></center>
						</div>
					</form>
				</div>
				<div class="col-md-2 column">
				</div>
			</div>
<?php	}
		else
		{
				$admin_email = $_SESSION['admin_email'];
				$admin = new Article;
				$admin_values = $admin->fetch_admin_details($admin_email);
				$admin_name = $admin_values['admin_name'];
				$admin_email = $admin_values['admin_email'];
				$admin_phone = $admin_values['admin_phone'];
				$admin_password = $admin_values['admin_password'];
				$admin_college = $admin_values['admin_college'];
				$admin_branch = $admin_values['admin_branch'];
				$admin_batch = $admin_values['admin_batch'];
				$admin_no_of_students = $admin_values['admin_no_of_students'];
					?>
			<div class="col-md-12">
				<div class="col-md-4 column">
					<?php 	
						$admin_email = $_SESSION['admin_email'];
						$admin_pic = new Article;
						$admin_pics = $admin_pic->fetch_admin_profile_pic( $admin_email );
						$admin_profile_pic = $admin_pics['admin_profile_pic'];
					?>
						<center>
							<div class="circle-center" style="background-image: url('admin_profile_pics/<?php echo $admin_profile_pic; ?>')">
							</div>
						</center>
				</div>
				<div class="col-md-8 column">
					<a href="a_index.php?edit_admin=1" class="btn btn-warning btn-xs pull-right"	>Edit Profile</a>
					<dl class="dl-horizontal">
						<dt>
							Name
						</dt>
						<dd style="padding-top:10px;">
							<?php echo $admin_name; ?>
						</dd>
						<dt>
							Email
						</dt>
						<dd>
							<?php echo $admin_email; ?>
						</dd>
						<dt>
							Phone
						</dt>
						<dd>
							<?php echo $admin_phone; ?>
						</dd>
						<dt>
							College
						</dt>
						<dd>
							<?php echo $admin_college; ?>
						</dd>
						<dt>
							Branch
						</dt>
						<dd>
							<?php echo $admin_branch; ?>
						</dd>
						<dt>
							Batch
						</dt>
						<dd>
							<?php echo $admin_batch; ?>
						</dd>
						<dt>
							No Of Students
						</dt>
						<dd>
							<?php echo $admin_no_of_students . " Students"; ?>
						</dd>
					</dl>
				</div>
			</div>
<?php	}
?>		</div><!-- End Row -->
		<hr/>
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">Complete Your Group</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row">
			<div class="col-md-12 column">
				<div class="col-md-6 column verticalLine">
					<h4 class=""><center>Group Members</center></h4>
					<div class="row">
						
								<table class="table">
									<thead>
										<tr>
											<th>
												<center>#</center>
											</th>
											<th>
												<center>Profile pic</center>
											</th>
											<th>
												<center>Name</center>
											</th>
											<th colspan="2">
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$admin_email = $_SESSION['admin_email'];
											$admin_id_obj = new Article;
											$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
											$admin_id = $admin_id_arr['admin_id'];
											$req = new Article;
											$requests = $req -> fetch_accepted_users($admin_id);
											
											$i = 1;
											foreach($requests as $each_request)
											{
												if(empty($each_request))
												{
											?>		<tr style="margin-top:40px;">
														<td>
															1
														</td>
														<td colspan="3">
															<strong><center>No friend found</center></strong>
														</td>
													</tr>
							<?php	}
									else
									{
													$user_id = $each_request['user_id'];
													$user_info = new Article;
													$user_pictures = $user_info->fetch_user_details($user_id);
													$user_name = $user_pictures['user_name'];
													$user_email = $user_pictures['user_email'];
													$user_picture = $user_pictures['user_picture'];
										?>			
										<tr style="margin-top:40px;">
											<td>
												<center style="margin-top:10px;"><?php echo $i; ?></center>
											</td>
											<td>
												<center><img alt="140x140" src="user_profile_pics/<?php echo $user_picture; ?>" class="img-circle" width="40px" /></center>
											</td>
											<td>
												<center style="margin-top:10px;"><?php echo $user_name; ?></center>
											</td>
											<td>
												<center style="margin-top:10px;"><?php echo $user_email; ?></center>
											</td>
											<td>
												<center style="float:left;"><a href="a_index.php?remove=1&admin_id=<?php echo $admin_id; ?>&user_id=<?php echo $user_id; ?>" onclick="return confirm('Are you sure?');" class="btn btn-xs btn-danger">Remove</a></center>
											</td>
										</tr>
						<?php		}
							$i++;
						}
					?>
									</tbody>
								</table>
							</div>
				</div>
				
				<div class="col-md-6 column verticalLine">
					<h4 class=""><center>Member Requests</center></h4>
						<div class="row">
								<table class="table">
									<thead>
										<tr>
											<th>
												<center>#</center>
											</th>
											<th>
												<center>Profile pic</center>
											</th>
											<th>
												<center>Name</center>
											</th>
											<th colspan="2">
												<center style="margin-left:-20px;">Accept / Decline</center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$admin_email = $_SESSION['admin_email'];
											$admin_id_obj = new Article;
											$admin_id_arr = $admin_id_obj -> fetch_admin_id($admin_email);
											$admin_id = $admin_id_arr['admin_id'];
											$req = new Article;
											$requests = $req -> fetch_user_requests($admin_id);
											
											$i = 1;
											foreach($requests as $each_request)
											{
												if(empty($each_request))
												{
											?>		<tr style="margin-top:40px;">
														<td>
															1
														</td>
														<td colspan="3">
															<strong><center>No friend requests received</center></strong>
														</td>
													</tr>
							<?php	}
									else
									{
													$user_id = $each_request['user_id'];
													$user_info = new Article;
													$user_pictures = $user_info->fetch_user_details($user_id);
													$user_name = $user_pictures['user_name'];
													$user_email = $user_pictures['user_email'];
													$user_picture = $user_pictures['user_picture'];
										?>			
										<tr style="margin-top:40px;">
											<td>
												<center style="margin-top:10px;"><?php echo $i; ?></center>
											</td>
											<td>
												<center><img alt="140x140" src="user_profile_pics/<?php echo $user_picture; ?>" class="img-circle" width="40px" /></center>
											</td>
											<td>
												<center style="margin-top:10px;"><?php echo $user_name; ?></center>
											</td>
											<td>
												<center style="float:right;"><a href="a_index.php?accept=1&admin_id=<?php echo $admin_id; ?>&user_id=<?php echo $user_id; ?>" class="btn btn-xs btn-success">Accept</a></center>
											</td>
											<td>
												<center style="float:left;"><a href="a_index.php?decline=1&admin_id=<?php echo $admin_id; ?>&user_id=<?php echo $user_id; ?>" onclick="return confirm('Are you sure?');" class="btn btn-xs btn-danger">Decline</a></center>
											</td>
										</tr>
						<?php		}
							$i++;
						}
					?>
									</tbody>
								</table>
							</div>
				</div>
		</div>
		</div><!-- End Row -->
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