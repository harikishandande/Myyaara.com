    
<header id="header" class="header-wrapper">
    <div class="header-topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 ticker">
                    <ul class="newsticker">
						<li>Hey! Sup? Welcome to Myyaara</li>
						<li>Friendship rocks!!!</li>
						<li>Add to your group using admin email id or group id</li>
						<li>Please upload higher resolution photos</li>
						<li>Higher resolution photos gives excellent quality print</li> 
						<li>Check the template in regard to the  characters limit for each question</li>
						<li>Print you memories of the best part of your life</li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul class="topbar-social-icons list-inline pull-right">
                        <li><a href="javascript: void(0);"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript: void(0);"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript: void(0);"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="javascript: void(0);"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div><!-- End Column 3 -->
            </div><!-- End Row -->
        </div><!-- End Container -->
    </div><!-- End Top Header -->

    <div class="fixed-top">
        <nav id="navigation" class="header1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 logo-wrapper navbar navbar-default">
                        <a href="javascript: void(0);" class="logo" style="font-size:20px;color:#fff;"><img src="img/logo-horizontal.png" width="15%" alt=""/> &nbsp;Myyaara</a>
                        <div class="navbar-header">
                            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-9 zero-padding-mobile">
                        <div class="navbar navbar-default yamm">
                            <div id="navbar-collapse-grid" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="<?php if($nav == "myself") { echo "active"; } ?> " ><a href="u_myself.php">MySelf</a></li>
                                    <li class="<?php if($nav == "mystory") { echo "active"; } ?> " ><a href="u_mystory.php">My Story</a></li>
									<li class="<?php if($nav == "mypics") { echo "active"; } ?> " ><a href="u_mypics.php">My Pics</a></li>
									<li class="<?php if($nav == "myvotes") { echo "active"; } ?> " ><a href="u_myvotes.php">My Votes</a></li>
                                    <li class="<?php if($nav == "helpme") { echo "active"; } ?> " ><a href="u_helpme.php">Help Me</a></li>
									<li class="pull-right" ><a href="javascript: void(0);"><?php echo $_SESSION['user_email'];?></a>
										<ul class="dropdown-menu" style="z-index:1;" class="pull-right">
											<li><a href="u_mygroup.php">My Group</a></li>
											<li><a href="u_index.php">Change Password</a></li>
											<li><a href="logout.php">Logout</a></li>
										</ul>
									</li>
                                </ul><!-- End Nav -->
                            </div>
                        </div><!-- End Navigation Bar -->
                    </div><!-- End Column 9 -->
                </div><!-- End Row -->
            </div><!-- End Container -->
        </nav><!-- End Navigation -->
    </div><!-- End Fixed Menu Top-->
</header><!-- End Header -->