<?php 
	session_start();
	include_once('includes/connection.php');
	include_once('includes/article.php');
	
	if(isset($_SESSION['popup1']))
	{
		$_SESSION['popup1'] = NULL;
		echo "<script> alert('You are successfully registered, Your credentials are sent to your email address.');</script>";
	}
	if(isset($_SESSION['popup2']))
	{
		$_SESSION['popup2'] = NULL;
		echo "<script> alert('This email is already taken, please try new. or attempt forgot password to get your credentials.');</script>";
	}
	if(isset($_SESSION['popup5']))
	{
		$_SESSION['popup5'] = NULL;
		echo "<script> alert('Incorrect login details !');</script>";
	}
	if(isset($_SESSION['popup6']))
	{
		$_SESSION['popup6'] = NULL;
		echo "<script> alert('Thank you for your feedback, we will get back to you soon!');</script>";
	}
	if(isset($_SESSION['popup7']))
	{
		$_SESSION['popup7'] = NULL;
		echo "<script> alert('Please enter your email address!');</script>";
	}
	if(isset($_SESSION['popup8']))
	{
		$_SESSION['popup8'] = NULL;
		echo "<script> alert('Your email address is not found!');</script>";
	}
	if(isset($_SESSION['popup9']))
	{
		$_SESSION['popup9'] = NULL;
		echo "<script> alert('The password is sent to your registered email address!');</script>";
	}
	if(isset($_SESSION['popup10']))
	{
		$_SESSION['popup10'] = NULL;
		session_destroy();
		echo "<script> alert('Your password updated successfully!');</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	 <link rel="icon" href="img/favicon.ico">
    <title>Myyaara - Memories Preserved Forever</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls|Shadows+Into+Light|Architects+Daughter|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.section-heading
		{
			font-family: 'Shadows Into Light', cursive;
		}
		@media(max-width:768px) {
			
			.timeline .timeline-body>p,
			.timeline .timeline-body>ul {
				font-weight:bold;
				font-family: 'Shadows Into Light', cursive;	
				text-align:justify;
				margin-top:15%;
				margin-left:0px;
			}
			
			.timeline .timeline-heading h4.subheading {
				font-family: 'Shadows Into Light', cursive;	
				margin-top:10%;
				text-transform: none;
			}
			header
			{
				margin-top:50px;
			}
		}
	</style>
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Myyaara</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<center>
				<ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					<li>
                        <a class="page-scroll" href="#promo" style="font-family: 'Shadows Into Light', cursive;font-size:20px;"><b>Promo</b></a>
                    </li>
					<li>
                        <a class="page-scroll" href="#howitworks" style="font-family: 'Shadows Into Light', cursive;font-size:20px;"><b>How It Works</b></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#highlights" style="font-family: 'Shadows Into Light', cursive;font-size:20px;"><b>Highlights</b></a>
                    </li>
       <!--         <li>
                        <a class="page-scroll" href="#team" style="font-family: 'Shadows Into Light', cursive;font-size:20px;"><b>Team</b></a>
                    </li>
		-->
					<li>
                        <a class="page-scroll" href="#contact" style="font-family: 'Shadows Into Light', cursive;font-size:20px;"><b>Connect Us</b></a>
                    </li>
                </ul>
				</center>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
			<div class="carousel slide" id="carousel-961757">
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#carousel-961757">
					</li>
					<li data-slide-to="1" data-target="#carousel-961757">
					</li>
					<li data-slide-to="2" data-target="#carousel-961757">
					</li>
					<li data-slide-to="3" data-target="#carousel-961757">
					</li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<center><img alt="" width="100%" src="slider/1.png" /></center>
					</div>
					<div class="item ">
						<center><img alt="" width="100%" src="slider/4.png" /></center>
					</div>
					<div class="item ">
						<center><img alt="" width="100%" src="slider/3.png" /></center>
					</div>
					<div class="item ">
						<center><img alt="" width="100%" src="slider/2.png" /></center>
					</div>
				</div> 
				<div class="intro-text" style="background-color:#fff;">
								<a id="modal-1234" href="#modal-container-1234" role="button" data-toggle="modal" class="page-scroll btn btn-xl">LET ME IN</a>
								<div class="modal fade" id="modal-container-1234" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content" style="color:black;" >
											<div class="modal-header">
												 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h4 class="modal-title" id="myModalLabel">
													Sign Up
												</h4>
											</div>
											<div class="modal-body">
												<div class="row clearfix">
													<div class="col-md-6 column">
														<h5 style="text-align:center;">Admin Login</h5>
														<form role="form" action="intermediate_form.php" method="POST" enctype="multipart/form-data">
															<div class="form-group form-group-lg">
																<input type="email" class="form-control" name="admin_email" placeholder="Enter Your Email" required/>
															</div>
															<div class="form-group form-group-lg">
																<input type="password" class="form-control" name="admin_password" placeholder="Enter Your Password" required/>
															</div>
															<a id="modal-1" href="#modal-container-1" role="button" data-toggle="modal" class="btn" style="float:left;font-size:12px;">forgot password?</a>
															<button type="submit" class="btn btn-success" style="padding:6px 50px;" name="admin_login" >LOGIN</button>
															<a id="modal-2" href="#modal-container-2" role="button" data-toggle="modal" class="btn btn-info" style="float:right;">New Admin?</a>
														</form>
													</div>
													<div class="col-md-6 column">
														<h5 style="text-align:center;">User Login</h5>
														<form role="form" action="intermediate_form.php" method="POST" enctype="multipart/form-data">
															<div class="form-group form-group-lg">
																<input type="email" class="form-control" name="user_email" placeholder="Enter Your Email" />
															</div>
															<div class="form-group form-group-lg">
																<input type="password" class="form-control" name="user_password" placeholder="Enter Your Password" />
															</div>
															<a id="modal-3" href="#modal-container-3" role="button" data-toggle="modal" class="btn" style="float:left;font-size:12px;">forgot password?</a>
															<button type="submit" class="btn btn-success" style="padding:6px 50px;" name="user_login" >LOGIN</button>
															<a id="modal-4" href="#modal-container-4" role="button" data-toggle="modal" class="btn btn-info" style="float:right;">New User?</a>
														</form>
													</div>
												</div>
											</div>
											<!-- ******************** Models code ******************** -->
														<div class="modal fade" id="modal-container-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																		<h4 class="modal-title" id="myModalLabel">
																			<b style="color:#DC3515;" >Did you forget your PASSWORD ?</b>
																		</h4>
																	</div>
																	<div class="modal-body">
																		<p style="color:#000;margin-bottom:30px;">Friend, Please enter your registered email only</p>
																		<form action="intermediate_form.php" role="form" method="POST">
																			<div class="input-group">
																			  <input type="email" class="form-control" style="height:36px;" placeholder="Your Email Address" name="admin_email"/>
																			  <span class="input-group-btn">
																				<button class="btn" type="submit" style="height:36px;" name="admin_forget_password">Submit Email</button>
																			  </span>
																			</div>
																		</form>
																	</div>
																	<div class="modal-footer">
																	</div>
																</div>
															</div>
														</div>
														<!-- ***** Admin New User ***** -->
														<div class="modal fade" id="modal-container-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog" style="width:90%;">
																<div class="modal-content">
																	<div class="modal-header">
																		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
																		<h4 class="modal-title" id="myModalLabel">
																			Admin Sign Up
																		</h4>
																	</div>
																	<div class="modal-body">
																		<div class="row clearfix">
																			<div class="col-md-6 column">
																				<h5>
																					Admin has the following responsibilities
																				</h5>
																				<ol style="text-align:left;">
																					<li>
																						To collect the information about the institution
																					</li>
																					<li>
																						To collect professors information
																					</li>
																					<li>
																						To select few common pages
																					</li>
																					<li>
																						Payments
																					</li>
																				</ol>
																				<p>
																					Any one person from your class is required to become an admin, are you the one?
																				</p>
																			</div>
																			<div class="col-md-6 column">
																				<form role="form" action="intermediate_form.php" method="POST" enctype="multipart/form-data">
																					<div class="form-group">
																						<input type="text" class="form-control" name="admin_name" placeholder="Enter Your Name" required/>
																					</div>
																					<div class="form-group">
																						 <input type="email" class="form-control" name="admin_email" placeholder="Enter Your Email" required/>
																					</div>
																					<div class="form-group">
																						 <input type="text" class="form-control" name="admin_phone" placeholder="Enter Your Mobile No." required/>
																					</div>
																					<button type="submit" class="btn btn-success btn-lg" name="admin_signup" >Admin Sign Up</button>
																				</form>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																	</div>
																</div>
															</div>
														</div>
														<!-- ***** User forgot password ***** -->
														<div class="modal fade" id="modal-container-3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																		<h4 class="modal-title" id="myModalLabel">
																			<b style="color:#DC3515;" >Did you forget your PASSWORD ?</b>
																		</h4>
																	</div>
																	<div class="modal-body">
																		<p style="color:#000;margin-bottom:30px;">Friend, Please enter your registered email only</p>
																		<form action="intermediate_form.php" role="form" method="POST">
																			<div class="input-group">
																			  <input type="email" class="form-control" style="height:36px;" placeholder="Your Email Address" name="user_email"/>
																			  <span class="input-group-btn">
																				<button class="btn" type="submit" style="height:36px;" name="user_forget_password">Submit Email</button>
																			  </span>
																			</div>
																		</form>
																	</div>
																	<div class="modal-footer">
																	</div>
																</div>
															</div>
														</div>
														<!-- ***** New User ***** -->
														<div class="modal fade" id="modal-container-4" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-md">
																<div class="modal-content">
																	<div class="modal-header">
																		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
																		<h4 class="modal-title" id="myModalLabel">
																			User Sign Up
																		</h4>
																	</div>
																	<div class="modal-body">
																		<div class="row clearfix">
																		<div class="col-md-12">
																			<div class="col-md-2"></div>
																			<div class="col-md-8">
																				<form role="form" action="intermediate_form.php" method="POST" enctype="multipart/form-data">
																					<div class="form-group">
																							<input type="text" class="form-control" name="user_name" placeholder="Enter Your Name" required/>
																						</div>
																						<div class="form-group">
																							 <input type="email" class="form-control" name="user_email" placeholder="Enter Your Email" required/>
																						</div>
																						<div class="form-group">
																							 <input type="text" class="form-control" name="user_phone" placeholder="Enter Your Mobile No." required/>
																						</div>
																						<button type="submit" class="btn btn-success btn-lg" name="user_signup">Sign Up</button>
																				</form>
																			</div>
																			<div class="col-md-2"></div>
																		</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																	</div>
																</div>
															</div>
														</div>
											<!-- ******************** Models code ******************** -->
											<div class="modal-footer">
												<p style="text-align:center;">Welcome to myyaara</p>
											</div>
										</div>
									</div>
								</div>
								<br/>
								<ul class="list-inline social-buttons" style="">
									<li style="margin-top:20px;"><a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li style="margin-top:20px;"><a href="#"><i class="fa fa-facebook"></i></a>
									</li>
									<li style="margin-top:20px;"><a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
							</div>
				<a style="margin-top:-10px;" class="left carousel-control" href="#carousel-961757" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-961757" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
    </header>
	
	<section id="promo" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Hey Folks! Check This Out</h2>
					<h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
				<center><iframe width="80%" height="500px" src="https://www.youtube.com/embed/BvMfv1XEKmo" frameborder="0" allowfullscreen></iframe></center>
			<!--	<center><img src="img/video-player.jpg" width="60%"/></center> -->
            </div>
        </div>
    </section>
	
    <section id="howitworks">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">how It Works</h2>
                    <h3 class="section-subheading text-muted">Hey! We can grab some knowledge here.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">What's myyaara?</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_001.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-body">
                                    <p class="text-muted">My friends! Myyaara is a simple one stop place for printing all your college memories with ease. </p>
                                </div>
                            </div>
                        </li>
						<li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">How do I start?</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_007.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-body" style="margin-top:-20px;">
                                    <p class="text-muted">Well, just sign up using user log in and finish off the process. Between, don't forget to connect to your group by email or group id in connect bar. That's it! You are done.</p>
                                </div>
                            </div>
                        </li>
						<li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">What's admin for?</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_004.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-body" style="margin-top:-40px;">
                                    <p class="text-muted">Admin is a person who groups all your class members and has little more simple tasks to do like collecting college information and professor's information along with selection of cover photo and responsibility of payments. So, it's any one of your class  friends who will become the admin.</p>
                                </div>
                            </div>
                        </li>
						<li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">I see that I have to upload some photos too?</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_006.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-body" style="margin-top:-0px;">
                                    <p class="text-muted">Yes! It's actually fun. Upload pics taken with your friends in mypics tab. But one thing, get a good resolution photos, okay?</p>
                                </div>
                            </div>
                        </li>
						<li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">What's my story for?</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_008.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-body"style="margin-top:-10px;">
                                    <p class="text-muted">My story is where you can express yourself about anything you like. It can be anything! But remember, i'm gonna publish it in your magazine <img title="wink" alt="wink" width="23" height="23" src="http://localhost/myyaara/myyaara_dir/ckeditor/plugins/smiley/images/wink_smile.png" /></p>
                                </div>
                            </div>
                        </li>
                        <li >
							<div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">Ok myyaara!</h4>
                                </div>
                            </div>
							<div class="timeline-image">
                                <img class="img-circle img-responsive" src="characters/rsz_009.png" alt="">
                            </div>
							<div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading" style="margin-right:170px;">Thank you</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

	<!-- highlights Section -->
    <section id="highlights">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">high Lights</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
				<div class="col-md-12">
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/print.png" width="90%"/>
						</span>
						<h4 class="service-heading">Print captured photos</h4>
						<p class="text-muted">It's fun to Print the Captured moments along with your friends to where and with whom you have been. Pages dedicated for photos. Interesting!</p>
					</div>
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/customised.png" width="90%"/>
						</span>
						<h4 class="service-heading">Customised designs</h4>
						<p class="text-muted">It's an absolute joy to discover that every page in the book can be customised with handful of themes and templates that we offer.</p>
					</div>
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/memorable.png" width="90%"/>
						</span>
						<h4 class="service-heading">Memorable books for life</h4>
						<p class="text-muted">Nothing more is precious than the moments and laughter that we share with our friends. Keep it intact with your loved ones that you will cherish when you reopen it. </p>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/best.png" width="90%"/>
						</span>
						<h4 class="service-heading">Best quality </h4>
						<p class="text-muted">Have you ever imagined yourself with your friends stacked together in one book with abosulte finish and print? Yes, we provide highest quality print.</p>
					</div>
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/wall.png" width="90%"/>
						</span>
						<h4 class="service-heading">Centre page wall photo</h4>
						<p class="text-muted">Get a centre page full size group photo and stick it to your wall at home. It is an easy way to fall back in memories!.</p>
					</div>
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<img src="icons/easy.png" width="90%"/>
						</span>
						<h4 class="service-heading">Easy buy</h4>
						<p class="text-muted">It's very easy and friendly to have a book. With designing and printing taken care of, it takes just 15 days to deliver the ultimate book of your life so far.</p>
					</div>
				</div>
            </div>
        </div>
    </section>
	
    <!-- Team Section 
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.png" class="img-responsive img-circle" alt="">
                        <h4>Tarun Jain</h4>
                        <p class="text-muted">Chief Executive Officer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Narein Kumar</h4>
                        <p class="text-muted">Chief Financial Officer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/3.png" class="img-responsive img-circle" alt="">
                        <h4>Hari Kishan</h4>
                        <p class="text-muted">Web Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"></p>
                </div>
            </div>
        </div>
    </section>
	-->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"></h3>
					
					<address style="color:white;margin-top:-50px;"> <h4>Office Address</h4><strong>Myyaara Pvt. Ltd. - Tirupati</strong><br /> 18-3-58/6D, Prashanthi Nagar<br /> Tirupathi, AP-517507<br /> <abbr title="Phone">P:</abbr> +91 9618012109<br/><abbr title="Email Address">Email:</abbr> tarunkumarranka@gmail.com</address>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" action="intermediate_form.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" name="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" name="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" name="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" name="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl" name="submit_message" >Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="col-md-12">
                <span class="copyright">Copyright &copy; <a href="http://www.myyaara.com">Myyaara</a> 2015,  Designed and developed by <a href="http://www.codingworld.in">Coding World</a></span>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>