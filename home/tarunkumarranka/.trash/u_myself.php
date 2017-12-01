<?php 
	session_start();	
	include_once('../includes/connection.php');
	include_once('../includes/article.php');
	if($_SESSION['user_session'])
	{
		$user_email = $_SESSION['user_email'];
		$query = "select * from `myyaara_user` where `user_email` = '$user_email'";
		if($get_user = mysqli_query($connection,$query))
			$userData = mysqli_fetch_array($get_user,MYSQL_ASSOC);
	
		$nav = "myself";
	
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
    <link href="css/custom.css" rel="stylesheet">	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls|Shadows+Into+Light|Architects+Daughter|Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">-->
	<script src="js/jquery.min.js"></script> <!-- jQuery Script -->	
    <script type="text/javascript" src="js/search/modernizr.custom.js"></script>	 <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
<script src="js/bootstrap.js"></script> 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>		.selected{			border: 4px solid #4390df;		}		.selected::before {		  color: #fff;		  content: "\f00c";		  display: block;		  font-family: "FontAwesome";		  font-size: 10pt;		  font-weight: normal;		  position: absolute;		  right: 2px;		  top: 0;		  z-index: 102;		}		.selected::after {		  border-left: 32px solid transparent;		  border-top: 32px solid #4390df;		  content: "";		  display: block;		  position: absolute;		  right: 0;		  top: 0;		  z-index: 101;		}		.mfp-title{			text-align:center !important;		}
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
		.pQuestion{
			word-wrap:break-word;
		}
		.charCount {
		  background: none repeat scroll 0 0 #ff723d;
		  bottom: 0;
		  color: white;
		  float: right;
		  height: 22px;
		  position: absolute;
		  right: 0;
		  text-align: center;
		  width: 24px;
		}
		textarea{
			resize:none;
		}
		.inputArea{
			position:relative;
		}
		.inputArea textarea {
		  padding-right: 24px;
		}
		.tabbable{
			cursor: all-scroll;
			z-index:1;
		}
		.tabbable li , .tabbable div{
			background:white;
		}
		.fixed{
			position:fixed !important;
			top:70px;
			width:21%;
		}
		#paraTab{
			width:25%;
			position:absolute;
			right:0;
		}
		.bottom{
			bottom:0;
		}
		#parasec{
			position:relative;
		}
		.button-overlay {
	  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.65);
	  bottom: 0;
	  display: none;
	  height: 100%;
	  position: absolute;
	  width: 100%;
	}
	</style>
	 <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script type="text/javascript">
//Counter for input text areafunction charCount(ele,remainingCount){	$(ele).closest('.inputArea').find('span').html(remainingCount);}jQuery(function($) {	//Creating para using input	$('.inputArea textarea').bind('keydown keyup keypress', function() {		charCount(this,$(this).attr('maxlength')-this.value.length);	});	$('[id^=q_]').bind('keydown keyup keypress', function() {		var qid = $(this).attr('id').replace ( /[^\d.]/g, '' );		var questionNum = parseInt(qid,10);		$('#'+questionNum).html($(this).val() || "_"+questionNum+"_");			});});
</script>
	
</head>

<body role="document">
	<?php
		require_once('user_primary/navigation.php');
	?>
<form id="userprofile">
<section class="featured-area">
    <div class="container">
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">Let's get started!</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<br/>
        <div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:left; margin-left:15px;">Hey dude, What's your name?</span></div>
						</div>
						<div class="input-group">
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-user" style="color:#f7d500;" ></span></span>
							<input type="text" id="q_1" class="form-control" name="user_name" value="<?php echo $userData['user_name'];?>" placeholder="Enter Your Name" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:right; margin-right:15px;">How do your friends call you?</span></div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" id="q_2" value="<?php echo $userData['user_alias'];?>" name="user_alias" placeholder="Enter Alias Name" required/>
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-text-background" style="color:#f7d500;" ><b>A</b></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:left; margin-left:15px;">It's the day the Earth stood still!</span></div>
						</div>
						<div class="input-group">
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-globe" style="color:#f7d500;" ></span></span>
							<input type="date" class="form-control" id="q_3" value="<?php echo $userData['user_dob'];?>" name="user_dob" placeholder="Select your DOB" />
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:right; margin-right:15px;">What's your email? I'm gonna hack it!</span></div>
						</div>
						<div class="input-group">
							<input type="email" id="q_4" class="form-control" name="email" value="<?php echo $userData['email'];?>" placeholder="Enter Your Email" required/>
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-envelope" style="color:#f7d500;" ></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:left; margin-left:15px;">Ring! ring?</span></div>
						</div>
						<div class="input-group">
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-phone" style="color:#f7d500;" ></span></span>
							<input type="text" id="q_5" class="form-control" value="<?php echo $userData['user_phone'];?>" name="user_phone" placeholder="Enter Your Mobile" required/>
						</div>
						
					</div>
					<div class="form-group">
						<div class="row">
							<div class="category"><span style="float:right; margin-right:15px;">Address?</span></div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" name="" placeholder="Enter Your Address" />
							<span class="input-group-addon" style="background-color:#004850;" ><span class="fa fa-home" style="color:#f7d500;" ></span></span>
						</div>
					</div>
					<center><a href="javascript: submitDetails();" class="btn btn-sm btn-square btn-yellow  load-more-news vartha-animation" data-animation="fadeIn">SAVE</a></center>
  			
				<br/>
			</div>
			<div class="col-md-3">
			</div>
        </div><!-- End Row -->
    </div><!-- End Container -->
</section><!-- End Featured Area Section -->

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="section-title" style="margin-bottom:30px;">Let's select your template</h2>
            </div>
        </div><!-- End Row -->
        <div class="row">            <div class="owl-carousel latest-videos vartha-animation" data-animation="fadeIn">				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design02.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design02'>Select</button>"><img alt="Profiles_Design02" src="profilethemes/Profiles_Design02.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger pull-right selectedTheme" id="Profiles_Design02" >Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design03.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design03'>Select</button>"><img alt="Profiles_Design03" src="profilethemes/Profiles_Design03.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger pull-right selectedTheme" id="Profiles_Design03">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design04.jpg" data-button="<button class='btn btn-danger  selectedTheme' id='Profiles_Design04'>Select</button>"><img alt="Profiles_Design04" src="profilethemes/Profiles_Design04.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger pull-right selectedTheme" id="Profiles_Design04">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design05.jpg" data-button="<button class='btn btn-danger pull-right selectedTheme' id='Profiles_Design05'>Select</button>"><img alt="Profiles_Design05" src="profilethemes/Profiles_Design05.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger  pull-right selectedTheme" id="Profiles_Design05">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design06.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design06'>Select</button>"><img alt="Profiles_Design06" src="profilethemes/Profiles_Design06.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design06">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design07.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design07'>Select</button>"><img alt="Profiles_Design07" src="profilethemes/Profiles_Design07.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design07">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design08.jpg" data-button="<button class='btn btn-danger selectedTheme' id=''>Select</button>"><img alt="Profiles_Design08" src="profilethemes/Profiles_Design08.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design08">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design09.jpg" data-button="<button class='btn btn-danger pull-right selectedTheme' id='Profiles_Design09'>Select</button>"><img alt="Profiles_Design09" src="profilethemes/Profiles_Design09.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design09">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design10.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design10'>Select</button>"><img alt="Profiles_Design10" src="profilethemes/Profiles_Design10.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design10" >Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design11.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design11'>Select</button>"><img alt="Profiles_Design11" src="profilethemes/Profiles_Design11.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design11" >Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design14.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design14'>Select</button>"><img alt="Profiles_Design14" src="profilethemes/Profiles_Design14.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design14">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design15.jpg" data-button="<button class='btn btn-danger selectedTheme' id='Profiles_Design15'>Select</button>"><img alt="Profiles_Design15" src="profilethemes/Profiles_Design15.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design15" >Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">					<a href="profilethemes/Profiles_Design16.jpg" data-button="<button class='btn btn-danger  selectedTheme' id='Profiles_Design16'>Select</button>"><img alt="Profiles_Design16" src="profilethemes/Profiles_Design16.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design16">Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>				<div class="profile_themes">					<div class="themeImg">						<a href="profilethemes/Profiles_Design17.jpg" data-button="<button class='btn btn-danger  selectedTheme' id='Profiles_Design17'>Select</button>"><img alt="Profiles_Design17" src="profilethemes/Profiles_Design17.jpg" class="video-item"></a>					</div>					<div class="btn_selection">						<button class="btn btn-danger selectedTheme pull-right" id="Profiles_Design17" >Select </button>						<button class="btn btn-primary">Preview </button>					</div>				</div>							<script>					$(function(){						$('.profile_themes').each(function() {							$('.profile_themes').magnificPopup({								delegate: 'a',								type: 'image',								gallery: {								  enabled: true								},								image: {									titleSrc: 'data-button'								},								callbacks: {									open: function() {										$('.selectedTheme').click(function(){											var selectedTheme = $(this).attr('id')+'.jpg';											console.log(selectedTheme);											$('#user_template_selection').val(selectedTheme);											$.magnificPopup.close();											$('.profile_themes').find('.selected').removeClass('selected');											$('a[href*='+selectedTheme+']').closest('.themeImg').addClass('selected');										});									}								}							});						});						$('.btn_selection .btn-primary').click(function(){							//console.log($(this).closest('.profile_themes').find('a').attr('href'));							$(this).closest('.profile_themes').find('a').click();						});						$('.selectedTheme').click(function(){							//alert('click');							var selectedTheme = $(this).attr('id');							console.log(selectedTheme);							$('#user_template_selection').val(selectedTheme);							//$.magnificPopup.close();							$('.profile_themes').find('.selected').removeClass('selected');							$('a[href*='+selectedTheme+']').closest('.themeImg').addClass('selected');							return false;						});					});				</script>            </div><!-- End Owl Carousel Latest Videos -->        </div><!-- End Row -->
    </div><!-- End Container -->
	<input type="hidden" value="" name="user_template_selection" id="user_template_selection">
</section><!-- End Content Featured Area -->

<section class="latest-news"  style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">Ok! Now, let's answer few more questions</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<script>
			$(function() {
			  var eTop = $('#parasec').offset().top; //get the offset top of the element
				//console.log($('#parasec').height());
				//console.log($('#tabs-430445').height());
			  $(window).scroll(function() { //when window is scrolled
			 // console.log(eTop - $(window).scrollTop());
			// console.log($('#parasec').height()-$(window).height());
				encounter = eTop - $(window).scrollTop();
				// console.log($('#parasec').offset().top-$('.header1').height()+$('#parasec').height()-$('#tabs-430445').height());
				// console.log($(window).scrollTop());
				if($('#parasec').offset().top-$('.header1').height()<=$(window).scrollTop()){
					$('#tabs-430445').addClass('fixed');
				}
				else{
					$('#tabs-430445').removeClass('fixed');
					$('#paraTab').removeClass('bottom');
				}
				passedAway = $('#parasec').height()+encounter;
				//console.log(passedAway);
				if($('#parasec').offset().top-$('.header1').height()+$('#parasec').height()-$('#tabs-430445').height() <= $(window).scrollTop()){
					$('#tabs-430445').removeClass('fixed');
					$('#paraTab').addClass('bottom');
				}
			  });			
			});
		</script>
		<div class="row" id="parasec">
            <div class="col-sm-9">
                <div class="row vartha-animation" data-animation="fadeIn">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
						<div class="latest-news-article">
							<img src="images/color.jpg" alt="A Lovely Girl" class=" border-img-hover" />
							<h3><a><center style="margin-top:-20px;">Color! color!! which color do you choose?</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_7" width="100%" rows="2" maxlength="30" placeholder="Fav Color?" name="user_color" id="thirty" ><?php echo $userData['user_color'];?></textarea>
								<span class="charCount">30</span>
							</div>
						</div> <!-- Latest News Article 1 -->
						<div class="latest-news-article">
								<img src="images/best_feature.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a ><center style="margin-top:-20px;">Your best feature? Ok! some faking is allowed here..</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_8" width="100%" rows="2"  maxlength="30" placeholder="Best Feature?" value="<?php echo $userData['user_feature'];?>" name="user_feature" id="user_feature" id="thirty" ></textarea>
								<span class="charCount">30</span>
							</div>
						</div> <!-- Latest News Article 2 -->
						<div class="latest-news-article">
								<img src="images/wish.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a ><center style="margin-top:-20px;">If you had to make a wish, what would you wish for?</center></a></h3>
							<div class="inputArea">
								<textarea id="q_9" class="form-control" width="100%" rows="2" maxlength="30" placeholder="Make A Wish?" value="" name="user_wish" id="user_wish" id="thirty" ><?php echo $userData['user_wish'];?></textarea>
								<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 4 -->
						<div class="latest-news-article">
							<img src="images/.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a ><center style="margin-top:-20px;">That's my fav artists/music/albums/songs</center></a></h3>
							<textarea class="form-control" id="q_10" width="100%" rows="2"  maxlength="30" placeholder="Fav Color?" value=""  name="user_song" id="user_song" id="thirty" ><?php echo $userData['user_song'];?></textarea>
						</div> <!-- Latest News Article 1 -->
						<div class="latest-news-article">
							<img src="images/timepass.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a ><center style="margin-top:-20px;">In leisure times, your interests would be?</center></a></h3>
							<textarea class="form-control" id="q_11" width="100%" rows="2"  maxlength="30" placeholder="Time Pass?" value="" name="user_leisure" id="user_leisure" id="thirty" ><?php echo $userData['user_leisure'];?></textarea>
						</div><!-- Latest News Article 5 -->
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
						<div class="latest-news-article">
							<img src="images/3things.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a ><center style="margin-top:-20px;">3 things you love the most?</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_12" width="100%" rows="2"  maxlength="30" placeholder="3 things you love the most?" value="" name="user_3things" id="user_3things" id="thirty" ><?php echo $userData['user_3things'];?></textarea>
								<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 4 -->
						<div class="latest-news-article">
							<img src="images/hell.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a><center style="margin-top:-20px;">Life is hell without?</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_13" width="100%" rows="2" maxlength="30" placeholder="Life is hell without?" value=""  name="user_hell" id="user_hell" id="thirty" ><?php echo $userData['user_hell'];?></textarea>
								<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 5 -->
						<div class="latest-news-article">
							<img src="images/pet.jpg" alt="A Lovely Girl" class=" border-img-hover">
							<h3><a><center style="margin-top:-20px;">Any beauty queen or handsome stud? I'm talking about pets.</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_14" width="100%" rows="2"  maxlength="30" placeholder="Pets?" value="" name="user_pets" id="user_pets" id="thirty" ><?php echo $userData['user_pets'];?></textarea>
								<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 6 -->
						<div class="latest-news-article">
							
								<img src="images/cloud9.jpg" alt="A Lovely Girl" class=" border-img-hover">
							
							<h3><a ><center style="margin-top:-20px;">Cloud9 moment for you?</center></a></h3>
							<div class="inputArea">
								<textarea class="form-control" id="q_15" width="100%" rows="2" maxlength="30" placeholder="Cloud9 moment for you?" value="" name="user_cloud9" id="user_cloud9" id="thirty" ><?php echo $userData['user_cloud9'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 3 -->
						<div class="latest-news-article">
							
								<img src="images/embarrassing.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<h3><a ><center style="margin-top:-20px;">The most most most embarrassing moment of all! </center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_16" width="100%" rows="2"  maxlength="30" placeholder="most embarrassing moment?" value="" name="user_embarrassing" id="user_embarrassing" id="thirty" ><?php echo $userData['user_embarrassing'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div> <!-- Latest News Article 2 -->
					   
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
						<div class="latest-news-article">
							
								<img src="images/vacation.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<h3><a ><center style="margin-top:-20px;">I want to get lost to these vacation spots!</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_17" width="100%" rows="2" maxlength="30" placeholder="Vacation Spots?" value="" name="user_vacation" id="user_vacation" id="thirty" ><?php echo $userData['user_vacation'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div> <!-- Latest News Article 7 -->
						<div class="latest-news-article">
							
								<img src="images/favorite.jpg" alt="A Lovely Girl" class=" border-img-hover">
							
							<h3><a ><center style="margin-top:-20px;">My Favourite Movies/Shows</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_18" width="100%" rows="2" maxlength="30" placeholder=" Favourite Movies/Shows" value="<?php echo $userData['user_movies'];?>" name="user_movies" id="user_movies" id="thirty" ></textarea>
							<span class="charCount">30</span>
							</div>
						</div> <!-- Latest News Article 8 -->
						<div class="latest-news-article">
							
								<img src="images/sports.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<h3><a ><center style="margin-top:-20px;">Which Sports/Games do you like?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_19" width="100%" rows="2" maxlength="30" placeholder="Fav Sports/Games?" value="" name="user_sports" id="user_sports" id="thirty" ><?php echo $userData['user_sports'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 9 -->
						<div class="latest-news-article">
							
								<img src="images/regret.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<h3><a ><center style="margin-top:-20px;">Any regrets so for?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_24" width="100%" rows="2" maxlength="30"  placeholder="Any regrets?" value="" name="user_regrets" id="user_regrets" id="thirty" ><?php echo $userData['user_regrets'];?></textarea>
							<span class="charCount">30</span>
							</div>
							
						</div><!-- Latest News Article 3 -->
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
						<div class="latest-news-article">
							
								<img src="images/crazy.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<div class="category">
							</div><!-- End Category -->
							<h3><a ><center style="margin-top:-20px;">You are crazy about?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_20" width="100%" rows="2" maxlength="30"  placeholder="Crazy about?" value="" name="user_crazy" id="user_crazy" id="thirty" ><?php echo $userData['user_crazy'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 10 -->
						<div class="latest-news-article">
							
								<img src="images/food.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<div class="category">
							</div><!-- End Category -->
							<h3><a ><center style="margin-top:-20px;">What's your yummy tummy's fav food?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_21" width="100%" rows="2"  maxlength="30" placeholder="Fav Food?" value="" name="user_food" id="user_food" id="thirty"><?php echo $userData['user_food'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 11 -->
						<div class="latest-news-article">
							
								<img src="images/rolemodel.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<div class="category">
							</div><!-- End Category -->
							<h3><a ><center style="margin-top:-20px;">Who is your role model?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_22" width="100%" rows="2"  maxlength="30" placeholder="Role Model?" value="" name="user_role" id="user_role" id="thirty" ><?php echo $userData['user_role'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 12 -->
						 <div class="latest-news-article">
							
								<img src="images/aim.jpg" alt="A Lovely Girl" class=" border-img-hover">
						
							<h3><a ><center style="margin-top:-20px;">What's your aim in life?</center></a></h3>
							<div class="inputArea">
							<textarea class="form-control" id="q_23" width="100%" rows="5"  maxlength="30"  placeholder="Your Aim?" value="" name="user_aim" id="user_aim" id="thirty"><?php echo $userData['user_aim'];?></textarea>
							<span class="charCount">30</span>
							</div>
						</div><!-- Latest News Article 6 -->
					</div>
				</div><!-- End Row -->

            </div>
			<div id="paraTab">
                <div class="tabbable" id="tabs-430445">
					<ul class="nav nav-tabs">
						<li class="active"><a href="" class="liTab">p 1</a></li>
						<li><a href="" class="liTab">p 2</a></li>
						<li><a href="" class="liTab">p 3</a></li>
						<li><a href="" class="liTab">p 4</a></li>
						<li><a href="" class="liTab">p 5</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="panel-795840">
							<div class="jumbotron">
								<h1 id="paraHead">
									Hello,
								</h1>
								<p id="paraContent">
									 <span class="pQuestion">Hey people I’m </span><span id="1">_1_</span>
									 <span class="pQuestion">and my friends call me </span><span id="2">_2_.</span>
									 <span class="pQuestion">The color that instantly brightens up my mood is </span><span id="7">_7_. </span>
									 <span class="pQuestion">The person I adore told me that, my best trait was my</span><span id="8"> _8_. </span>
									 <span class="pQuestion">I really go mad about </span><span id="20">_20_ </span>
									 <span class="pQuestion">and you know this. I have a pet with the cutest name ever</span><span id="14">_14_. </span>
									 <span class="pQuestion">The place I have been longing to go is</span><span id="17"> _17_. </span>
									 <span class="pQuestion">I would like to eat</span><span id="21"> _21_ </span>
									 <span class="pQuestion">and get indulged in it. When it comes to the role model, it would be</span><span id="22"> _22_. </span>
									 <span class="pQuestion">If I really wanted to make a wish, it’s going to be</span><span id="9"> _9_. </span>
									 <span class="pQuestion">I regret about </span><span id="24">_24_. </span>
									 <span class="pQuestion">My most embarrassing moment was</span><span id="16"> _16_</span>
									 <span class="pQuestion">so far. My favorite song is </span><span id="10">_10_ </span>
									 <span class="pQuestion">and I keep humming them. My all time favorite Movies are </span><span id="18">_18_ </span>
									 <span class="pQuestion">and I like watching it many times. Games have always been my thing and I like </span><span id="19">_19_. </span>
									 <span class="pQuestion">Three things I love the most are</span><span id="12"> _12_ </span>
									 <span class="pQuestion">and I can’t live without them. My fav. Pastimes are </span><span id="11">_11_. </span>
									 <span class="pQuestion">Life becomes hell without the person</span><span id="13"> _13_. </span>
									 <span class="pQuestion">Cloud9 moment for me is</span><span id="15">_15_. </span>
									 <span class="pQuestion">I would like to become a </span><span id="23">_23_.</span>
								</p>
								<p>
									<button class="btn btn-primary btn-md" type="button" id="editPara">Edit</button>
									<button class="btn btn-success btn-md" type="button" id="updatePara" style="display:none;">update</button>
								</p>
								<textarea type="hidden" value="" name="user_Paragraph_selection" id="user_Paragraph_selection" style="display:none"></textarea>
							</div>
							<script>
								$('#editPara').click(function(){
									$('#editPara').hide();
									$('#updatePara').show();
									$('.pQuestion').each(function(){
										var fieldValue = $.trim($(this).text());
										replaceTag = '<input type="text" value="'+fieldValue+'" class="paraInput" />';
										$(this).html(replaceTag);
									});
								});
								function getAllFields(){
									$('[id^=q_]').each(function(){
										var qid = $(this).attr('id').replace ( /[^\d.]/g, '' );
										var questionNum = parseInt(qid,10);
										$('#'+questionNum).html($(this).val() || "_"+questionNum+"_");
									});
								}
								$('#updatePara').click(function(){
									$('#updatePara').hide();
									$('#editPara').show();
									$('.pQuestion').each(function(){
											$(this).html($(this).find('.paraInput').val()+' ');
									});
								});
															//TABS SCRIPT
									$('.liTab').click(function(e){
									e.preventDefault();
									$('#paraTab li').removeClass('active');
									$(this).closest('li').addClass('active');
									var i = parseInt($(this).text().replace ( /[^\d.]/g, '' ),10);
									switch(i){
										case 1 : $('#paraContent').html('<span class="pQuestion">Hey people I’m </span><span id="1">_1_</span>'+
																		 '<span class="pQuestion">and my friends call me </span><span id="2">_2_.</span>'+
																		 '<span class="pQuestion">The color that instantly brightens up my mood is </span><span id="7">_7_. </span>'+
																		 '<span class="pQuestion">The person I adore told me that, my best trait was my</span><span id="8"> _8_. </span>'+
																		 '<span class="pQuestion">I really go mad about </span><span id="20">_20_ </span>'+
																		 '<span class="pQuestion">and you know this. I have a pet with the cutest name ever</span><span id="14">_14_. </span>'+
																		 '<span class="pQuestion">The place I have been longing to go is</span><span id="17"> _17_. </span>'+
																		 '<span class="pQuestion">I would like to eat</span><span id="21"> _21_ </span>'+
																		 '<span class="pQuestion">and get indulged in it. When it comes to the role model, it would be</span><span id="22"> _22_. </span>'+
																		 '<span class="pQuestion">If I really wanted to make a wish, it’s going to be</span><span id="9"> _9_. </span>'+
																		 '<span class="pQuestion">I regret about </span><span id="24">_24_. </span>'+
																		 '<span class="pQuestion">My most embarrassing moment was</span><span id="16"> _16_</span>'+
																		 '<span class="pQuestion">so far. My favorite song is </span><span id="10">_10_ </span>'+
																		 '<span class="pQuestion">and I keep humming them. My all time favorite Movies are </span><span id="18">_18_ </span>'+
																		 '<span class="pQuestion">and I like watching it many times. Games have always been my thing and I like </span><span id="19">_19_. </span>'+
																		 '<span class="pQuestion">Three things I love the most are</span><span id="12"> _12_ </span>'+
																		 '<span class="pQuestion">and I can’t live without them. My fav. Pastimes are </span><span id="11">_11_. </span>'+
																		 '<span class="pQuestion">Life becomes hell without the person</span><span id="13"> _13_. </span>'+
																		 '<span class="pQuestion">Cloud9 moment for me is</span><span id="15">_15_. </span>'+
																		 '<span class="pQuestion">I would like to become a </span><span id="23">_23_.</span>')
												getAllFields();
												break;
										case 2 : $('#paraContent').html('<span class="pQuestion">Hi people! My name is </span><span id="1"> _1_ </span>'+
																		'<span class="pQuestion">and I go crazy about </span><span id="20">_20_. </span>'+
																		'<span class="pQuestion">The color I love is </span><span id="7">_7_ </span>'+
																		'<span class="pQuestion">and I’m sure it’s going to add some depth to anything. I’m often called with my pet name </span><span id="2">_2_. </span>'+
																		'<span class="pQuestion">When I get bored I tap to the song </span><span id="10">_10_. </span>'+
																		'<span class="pQuestion">I have a pet _14_. I have decided to go to </span><span id="17">_17_ </span>'+
																		'<span class="pQuestion">during my vacations. I like to watch movies and the last one I saw was </span><span id="18">_18_.</span>'+ 
																		'<span class="pQuestion">I play lot of games like </span><span id="19">_19_. </span>'+
																		'<span class="pQuestion">The Most embarrassing moment I have come across was </span><span id="16">_16_. </span>'+
																		'<span class="pQuestion">I know it’s been a long time and I still regret </span><span id="24">_24_. </span>'+
																		'<span class="pQuestion">I have a desire for </span><span id="9">_9_. </span>'+
																		'<span class="pQuestion">I have an appetite for </span><span id="21">_21_. </span>'+
																		'<span class="pQuestion">I admire and consider </span><span id="22">_22_ </span>'+
																		'<span class="pQuestion">to be my role model. I like passing my time by</span><span id="11">_11_. </span>'+
																		'<span class="pQuestion">Cloud9 moment for me was when </span><span id="15">_15_. </span>'+
																		'<span class="pQuestion">Lot of them said I have strong features and the best part is</span><span id="8"> _8_. </span>'+
																		'<span class="pQuestion">I have a penchant for 3 things, they are </span><span id="12">_12_. </span>'+
																		'<span class="pQuestion">Life is hellish without </span><span id="13">_13_.</span>'+
																		'<span class="pQuestion">My goal is to </span><span id="23">_23_.</span>');
												getAllFields();
												break;
										case 2 : $('#paraContent').html('<span class="pQuestion">Hey fellas! I’m </span><span id="1"> _1_ </span>'+
																		'<span class="pQuestion">I love to wear my favorite color </span><span id="7">_7_. </span>'+
																		'<span class="pQuestion">most of the times. My pals told me that I have beautiful</span><span id="8">_8_ </span>'+
																		'<span class="pQuestion">Music that soothes my senses is </span><span id="10">_10_. </span>'+
																		'<span class="pQuestion">Cloud9 moment I can never forget is </span><span id="15">_15_. </span>'+
																		'<span class="pQuestion">My most embarrassing moment is </span><span id="16">_16_ </span>'+
																		'<span class="pQuestion">and I still feel sick of it. Friends gave me the funniest name and it is </span><span id="2">_2_.</span>'+ 
																		'<span class="pQuestion">and guys... don’t you laugh. I always dreamt of going to </span><span id="17">_17_. </span>'+
																		'<span class="pQuestion">because that has been my favorite holiday spot. I keep watching this movie </span><span id="18">_18_. </span>'+
																		'<span class="pQuestion">every time. I entertain myself playing games like  </span><span id="19">_19_. </span>'+
																		'<span class="pQuestion">I’m a diehard fan of </span><span id="20">_20_. </span>'+
																		'<span class="pQuestion">and I go crazy every time. I like eating </span><span id="21">_21_. </span>'+
																		'<span class="pQuestion">and would you like to have a bite? My aim in life is </span><span id="23">_23_ </span>'+
																		'<span class="pQuestion">and all I need is some prep time to achieve it. 3 things that I love to indulge in </span><span id="12">_12_. </span>'+
																		'<span class="pQuestion">Life becomes hell without </span><span id="13">_13_. </span>'+
																		'<span class="pQuestion">I always play with my pet </span><span id="14"> _14_. </span>'+
																		'<span class="pQuestion">I generally pass my time by </span><span id="11">_11_. </span>'+
																		'<span class="pQuestion">I have this wish </span><span id="9">_9_.</span>'+
																		'<span class="pQuestion">and have been waiting for it to come true.</span>');
												getAllFields();
												break;
										case 3 : $('#paraContent').html('<span class="pQuestion">Hey fellas! I’m </span><span id="1"> _1_ </span>'+
																		'<span class="pQuestion">I love to wear my favorite color </span><span id="7">_7_. </span>'+
																		'<span class="pQuestion">most of the times. My pals told me that I have beautiful</span><span id="8">_8_ </span>'+
																		'<span class="pQuestion">Music that soothes my senses is </span><span id="10">_10_. </span>'+
																		'<span class="pQuestion">Cloud9 moment I can never forget is </span><span id="15">_15_. </span>'+
																		'<span class="pQuestion">My most embarrassing moment is </span><span id="16">_16_ </span>'+
																		'<span class="pQuestion">and I still feel sick of it. Friends gave me the funniest name and it is </span><span id="2">_2_.</span>'+ 
																		'<span class="pQuestion">and guys... don’t you laugh. I always dreamt of going to </span><span id="17">_17_. </span>'+
																		'<span class="pQuestion">because that has been my favorite holiday spot. I keep watching this movie </span><span id="18">_18_. </span>'+
																		'<span class="pQuestion">every time. I entertain myself playing games like  </span><span id="19">_19_. </span>'+
																		'<span class="pQuestion">I’m a diehard fan of </span><span id="20">_20_. </span>'+
																		'<span class="pQuestion">and I go crazy every time. I like eating </span><span id="21">_21_. </span>'+
																		'<span class="pQuestion">and would you like to have a bite? My aim in life is </span><span id="23">_23_ </span>'+
																		'<span class="pQuestion">and all I need is some prep time to achieve it. 3 things that I love to indulge in </span><span id="12">_12_. </span>'+
																		'<span class="pQuestion">Life becomes hell without </span><span id="13">_13_. </span>'+
																		'<span class="pQuestion">I always play with my pet </span><span id="14"> _14_. </span>'+
																		'<span class="pQuestion">I generally pass my time by </span><span id="11">_11_. </span>'+
																		'<span class="pQuestion">I have this wish </span><span id="9">_9_.</span>'+
																		'<span class="pQuestion">and have been waiting for it to come true.</span>');
												getAllFields();
												break;
										case 4 : $('#paraContent').html('<span class="pQuestion">Hello buddies! I prefer you to call me with my nick name </span><span id="2"> _2_ </span>'+
																		'<span class="pQuestion">If I’m asked to choose a color I would go for </span><span id="7">_7_. </span>'+
																		'<span class="pQuestion">During weekends I mostly go to my friends place to watch movies of</span><span id="18">_18_ </span>'+
																		'<span class="pQuestion">and munch on some </span><span id="21">_21_. </span>'+
																		'<span class="pQuestion">to fill our stomachs in. oops! I forgot to tell you that, my most embarrassing moment happened when </span><span id="16">_16_. </span>'+
																		'<span class="pQuestion">My role model is  </span><span id="22">_22_ </span>'+
																		'<span class="pQuestion">and I have been aiming for something like </span><span id="23">_23_.</span>'+ 
																		'<span class="pQuestion">When I was schooling I usually play </span><span id="19">_19_. </span>'+
																		'<span class="pQuestion">with my pals. I have been vacationing in </span><span id="17">_17_. </span>'+
																		'<span class="pQuestion">last year. My bestie gave me a compliment saying that I have cute </span><span id="8">_8_. </span>'+
																		'<span class="pQuestion">I was on cloud 9 when I </span><span id="15">_15_. </span>'+
																		'<span class="pQuestion">There are 3 things like </span><span id="12">_12_. </span>'+
																		'<span class="pQuestion">that I can’t let go off them. I wish that_9_ and guys I keep listening to this track </span><span id="10">_10_ </span>'+
																		'<span class="pQuestion"> I pass my time by </span><span id="11">_11_. </span>'+
																		'<span class="pQuestion">with my pet  </span><span id="14">_14_. </span>'+
																		'<span class="pQuestion">Without</span><span id="13"> _13_. </span>'+
																		'<span class="pQuestion">life becomes a hell. I’m crazy about </span><span id="20">_20_. </span>. <span id="24">_24_. </span>'+
																		'<span class="pQuestion">is what i regret a lot. By now you would have guessed up my name and it is </span><span id="1">_1_.</span>');
												getAllFields();
												break;
										case 5 : $('#paraContent').html('<span class="pQuestion">Hey sugar! My real name is </span><span id="1"> _1_ </span>'+
																		'<span class="pQuestion">and I often go under the alias of  </span><span id="2">_2_. </span>'+
																		'<span id="7">_7_ </span><span class="pQuestion">color is one of my favorites. I can’t stop myself when I listen to the song </span><span id="10">_10_</span>'+
																		'<span class="pQuestion">There are lot of things I like, among them</span><span id="12">_12_. </span>'+
																		'<span class="pQuestion">are the 3 things I love. Life becomes a hell without the person</span><span id="13">_13_ </span>'+
																		'<span class="pQuestion">. Most embarrassing moment of my life is when </span><span id="16">_16_.</span>'+ 
																		'<span class="pQuestion">I watch lot of movies and my favorite one is </span><span id="18">_18_. </span>'+
																		'<span class="pQuestion">I go mad when I keep thinking about </span><span id="20">_20_. </span>'+
																		'<span class="pQuestion">I keep eating a lot of  </span><span id="21">_21_. </span>'+
																		'<span class="pQuestion">My goal in life is </span><span id="23">_23_. </span>'+
																		'<span class="pQuestion">and I’m sure to work my way through it. I feel sorry whenever I think of </span><span id="24">_24_. </span>'+
																		'<span class="pQuestion">and I regret a lot about it. My best feature is my </span><span id="8">_8_ </span>'+
																		'<span class="pQuestion">and you will not stop staring at it. I wish to have lot of </span><span id="9">_9_. </span>'+
																		'<span class="pQuestion">in my closet. I have </span><span id="14">_14_. </span>'+
																		'<span class="pQuestion">as my pet. Cloud9 moment for me was</span><span id="15"> _15_. </span>'+
																		'<span class="pQuestion">When I feel tired I </span><span id="11">_11_. </span>'+
																		'<span class="pQuestion">because that’s been my favorite pastime so far. If I get a chance to visit my favorite vacation spot, I would lose myself in </span><span id="17">_17_.</span>');
												getAllFields();
												break;
									}
								});	
								function submitDetails(){									//console.log($('#paraContent').html());
									$('#user_Paragraph_selection').val($('#paraContent').html());
									formData = $( "#userprofile" ).serializeArray();
									//console.log($('#paraContent').text());
									$.post( "ajax_functions.php", $.param(formData))
									.done(function(data){
										if(data == 'updated')
											alert('Successfully Updated');
									});
								}
								$(function(){
									getAllFields();
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		  
        </div><!-- End Row -->
        <a href="javascript: submitDetails();" class="btn btn-medium btn-square btn-yellow btn-block load-more-news vartha-animation" data-animation="fadeIn">SAVE</a>
		<div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="">Love me or not! You got to answer these...</h2>
                <p class="section-subtitle"></p>
            </div><!-- End 12 Columns -->
        </div><!-- End Row -->
		<div class="row vartha-animation" data-animation="fadeIn">
            <div class="col-md-5">
                <div class="latest-news-article">
                        <img src="images/firstlove.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">Hey sweety, i wanna know about your first love?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="50" width="100%" rows="2" placeholder="First Love?" value=""  name="user_love" id="user_love"><?php echo $userData['user_love'];?></textarea>
						<span class="charCount">50</span>
					</div>
                </div> <!-- Latest News Article 1 -->
				<div class="latest-news-article">
                        <img src="images/firstkiss.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">First kiss! Yes? With whom and when?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="50" width="100%" rows="2" placeholder="First Kiss?" value="" name="user_kiss" id="user_kiss"><?php echo $userData['user_kiss'];?></textarea>
						<span class="charCount">50</span>
					</div>
                </div><!-- Latest News Article 4 -->
            </div><!-- End Column 4 -->
            <div class="col-md-2">
                <div class="latest-news-article">
                        <img src="images/celebrity.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">Who's your celebrity crush?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="50" width="100%" rows="2" placeholder="Celeb Crush?" value="" name="user_celebrity" id="user_celebrity"><?php echo $userData['user_celebrity'];?> </textarea>
						<span class="charCount">50</span>
					</div>
                </div><!-- Latest News Article 5 -->
            </div><!-- End Column 2 -->
            <div class="col-md-5">
                <div class="latest-news-article">
                        <img src="images/dream.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">I wish, I meet my dream boy/girl of this kind soon</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="50" width="100%" rows="2" placeholder="Dream boy/girl?" value=" " name="user_dream" id="user_dream"><?php echo $userData['user_dream'];?></textarea>
						<span class="charCount">50</span>
					</div>
                </div><!-- Latest News Article 5 -->
				<div class="latest-news-article">
                    
                        <img src="images/opinion.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">What's your opinion about love?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="50" width="100%" rows="2" placeholder="Opinion About Love?"  value="" name="user_opinion" id="user_opinion"><?php echo $userData['user_opinion'];?> </textarea>
						<span class="charCount">50</span>
					</div>
                </div><!-- Latest News Article 5 -->
            </div><!-- End Column 4 -->
        </div><!-- End Row -->
		<a href="javascript: submitDetails();" class="btn btn-medium btn-square btn-yellow btn-block load-more-news vartha-animation" data-animation="fadeIn">SAVE</a>
		<div class="row vartha-animation" data-animation="fadeIn">
            <div class="col-md-5">
                <div class="latest-news-article">
                    
                        <img src="images/unforgettable.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">Any unforgettable dream?</center></a></h3>
					<div class="inputArea">
						<textarea class="form-control" maxlength="70" width="100%" rows="4" placeholder="Unforgettable Dream?"  name="user_unforgettable" id="user_unforgettable" ><?php echo $userData['user_unforgettable'];?> </textarea>
						<span class="charCount">70</span>
					</div>
                </div> <!-- Latest News Article 1 -->
				<div class="latest-news-article">
                    
                        <img src="images/totallyimpress.jpg" alt="A Lovely Girl" class=" border-img-hover">
               
                    <h3><a ><center style="margin-top:-20px;">What can totally impress you?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="70" width="100%" rows="3" placeholder="What Can Impress You?"  name="user_impress" id="user_impress"><?php echo $userData['user_impress'];?></textarea>
						<span class="charCount">70</span>
					</div>
                </div><!-- Latest News Article 4 -->
            </div><!-- End Column 4 -->
            <div class="col-md-2">
                 <div class="latest-news-article">
                    
                        <img src="images/advice.jpg" alt="A Lovely Girl" class=" border-img-hover">
                    <h3><a ><center style="margin-top:-20px;">Best advice?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="70" width="100%" rows="6" placeholder="Best Advice?"  name="user_advice" id="user_advice"><?php echo $userData['user_advice'];?></textarea>
						<span class="charCount">70</span>
					</div>
                </div><!-- Latest News Article 5 -->
            </div><!-- End Column 2 -->
            <div class="col-md-5">
				<div class="latest-news-article">
                    
                        <img src="images/quote.jpg" alt="A Lovely Girl" class=" border-img-hover">

                    <h3><a ><center style="margin-top:-20px;">Never never never give up is my favourite Quote, What's yours?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="70" width="100%" rows="3" placeholder="Fav Quote?" name="user_quote" id="user_quote"><?php echo $userData['user_quote'];?></textarea>
						<span class="charCount">70</span>
					</div>
                </div><!-- Latest News Article 5 -->
               
				<div class="latest-news-article">
                    
                        <img src="images/opposite.jpg" alt="A Lovely Girl" class=" border-img-hover">

                    <h3><a ><center style="margin-top:-20px;">Thoughts about opposite sex?</center></a></h3>
                    <div class="inputArea">
						<textarea class="form-control" maxlength="70" width="100%" rows="3" placeholder="Opinion about men/women?"  name="user_opposite" id="user_opposite" ><?php echo $userData['user_opposite'];?></textarea>
						<span class="charCount">70</span>
					</div>
                </div><!-- Latest News Article 5 -->
            </div><!-- End Column 4 -->
        </div><!-- End Row -->
		<a href="javascript: submitDetails();" class="btn btn-medium btn-square btn-yellow btn-block load-more-news vartha-animation" data-animation="fadeIn">SAVE</a>
		<div class="row">
			<div class="col-md-6">
				<div class="latest-news-article">
					<img src="images/question1.jpg" alt="A Lovely Girl" class=" border-img-hover" width="100%">
					<div class="inputArea">
						<input class="form-control" width="100%" placeholder="Write Your Own Question?" />
						<textarea class="form-control" maxlength="70" width="100%" rows="2" placeholder="Your Answer?" name="" id=""></textarea>
						<span class="charCount">70</span>
					</div>
				</div> <!-- Latest News Article 7 -->
			</div>
			<div class="col-md-6">
				<div class="latest-news-article">
					
						<img src="images/question1.jpg" alt="A Lovely Girl" class=" border-img-hover" width="100%">
					<div class="inputArea">
						<input class="form-control" maxlength="70" width="100%" placeholder="Write Your Own Question?" />
						<textarea class="form-control" width="100%" rows="2" placeholder="Your Answer?" name="" id=""></textarea>
						<span class="charCount">70</span>
					</div>
				</div> <!-- Latest News Article 7 -->
			</div>
		</div>
		<a href="javascript: submitDetails();" class="btn btn-medium btn-square btn-yellow btn-block load-more-news vartha-animation" data-animation="fadeIn">SUBMIT</a>
   </div><!-- End Container -->
</section><!-- End Latest News -->
<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Select Template</button>
      </div>
    </div>
  </div>
</div>
</form>

		<?php
			require_once('admin_primary/admin_footer.php');
		?>

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
	//new UISearch( document.getElementById( 'sb-search' ) );

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
		loop:false,
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
else{
	$_SESSION['popup5'] = 1;	
	header('Location: ../index.php');
}
?>