<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Beta PC: Your PC our responsibility</title>

    <meta name="description" content="Your PC our responsibility"/>
    <meta name="keywords" content="Beta PC"/>
    <meta name="author" content="Beta PC"/>


    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="Beta PC"/>
    <meta property="og:url" content="www.mrrobi.tech/"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="Beta PC"/>
    <!--meta property="fb:admins" content="" /-->  <!-- use this if you have  -->
    <meta property="og:type" content="website"/> <!-- 'article' for single page  -->
    <meta property="og:image"
        content="<?php echo $baseurl;?>assets/img/logo.png"/> <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends here -->

    <!-- desktop bookmark -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $baseurl;?>assets/img/favicon.ico">
    <meta name="theme-color" content="#ffffff">

    <!-- icons & favicons -->
    <link rel="shortcut icon" type="image/x-icon"  href="<?php echo $baseurl;?>assets/img/favicon.ico"/>  <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="<?php echo $baseurl;?>assets/img/favicon.ico"/> <!-- this icon shows in browser toolbar -->

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <!-- <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <script src="https://kit.fontawesome.com/d6062a4230.js" crossorigin="anonymous"></script>
    <style>
		a.isDisabled {
			color: currentColor;
			cursor: not-allowed;
			opacity: 0.5;
			text-decoration: none;
		}
        button.isDisabled {
			color: currentColor;
			cursor: not-allowed;
			opacity: 0.5;
			text-decoration: none;
		}
		</style>
        <style type="text/css">
    	.btn-disable
        {
			cursor: not-allowed;
			pointer-events: none;

			/*Button disabled - CSS color class*/
			color: #c0c0c0;
			background-color: #ffffff;

        }
        /* #loading
        {
            background:#000 url(images/loader.gif) no-repeat center center;
            height: 100px;
            width: 100px;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            margin: -25px 0 0 -25px;
        } */

		</style>

        <!-- <style>
            #dvLoading {
            background:url(http://loadinggif.com/images/image-selection/36.gif) no-repeat center center;
            height: 100px;
            width: 100px;
            position: fixed;
            left: 50%;
            top: 50%;
            margin: -25px 0 0 -25px;
            z-index: 1000;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script>
            $(document).ready(function() {
                var iSrc = "http://2.bp.blogspot.com/-Us15MaCuNjg/T88jIdQzGUI/AAAAAAAACbE/MDNj13OmjiI/s1600/Demo.jpg";
                var rndNum = Math.random();
                iSrc = iSrc + "?q=" + rndNum;
                $('img').attr('src', iSrc);
            });

            $(window).bind("load", function() {
                $('#dvLoading').fadeOut(2000);
            });
        </script> -->
</head>

<body>
<!-- <div id="dvLoading"></div> -->
    <!-- HEADER -->
    <header>


        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <div class="header-logo">
                        <a class="logo" href="<?php echo $baseurl ?>">
                            <img src="<?php echo $baseurl ?>assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- /Logo -->
                </div>


                <?php if($this->uri->segment(1)!="logSign") { ?>
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Account -->
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                            </div>
                            <?php if($this->session->userdata("logged_in")==true) { ?>
                            <?php echo $this->session->userdata("name");?>

                            <?php } ?>
                            <!-- <?php if($this->session->userdata("logged_in")!=true) { ?>
                            <a href="<?php echo $baseurl ?>logSign" class="text-uppercase">Signin/Signup</a>
                            <?php } ?> -->
                            <ul class="custom-menu">
                                <?php if($this->session->userdata('role') == '1'){ ?>
                                <li><a href="<?php echo $baseurl ?>ad"><i class="fa fa-user-o"></i> Admin Dashboard</a>
                                </li>
                                <li><a href="<?php echo $baseurl ?>welcome\ses_clear" class="text-uppercase"><i
                                            class='fas fa-sign-out-alt'></i> Logout</a></li>
                                <?php }else{ ?>

                                <li><a href="<?php echo $baseurl. "history" ?>"><i class="fas fa-history"></i></i> My
                                        History</a></li>
                                <?php if($this->session->userdata("logged_in")!=true) { ?>
                                    <li><a href="<?php echo $baseurl ?>logSign" class="text-uppercase">Signin</a>
                                    </li>
									<li><a href="<?php echo $baseurl ?>welcome/regi" class="text-uppercase">Signup</a>
                                    </li>
									<?php }else{?>
                                <li><a href="<?php echo $baseurl ?>welcome\ses_clear" class="text-uppercase"><i
									class='fas fa-sign-out-alt'></i> Logout</a></li> <?php } ?>
                                <!-- <li><a href="#"><i class="fa fa-exchange"></i> Compare</a></li> -->
                                <!-- <li><a href="#"><i class="fa fa-check"></i> Checkout</a></li> -->
                                <!-- <li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li> -->
                                <!-- <li><a href="#"><i class="fa fa-user-plus"></i> Join</a></li> -->
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- /Account -->

                        <!-- <li class="header-account">
                        <div>
                        <div class="header-btns-icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            <strong> Community </strong>
                                    </div>
                        </li> -->

                        <?php }?>

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->
    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav <?php if($this->uri->segment(1)!=null) echo 'show-on-click'?>">
					<span class="category-header">Products <i class="fa fa-list"></i></span>
					<ul class="category-list">
                        <li><a href="<?php echo $baseurl ?>product/cpu">Processor  </a></li>
                        <li><a href="<?php echo $baseurl ?>product/gpu">Graphics Card </a></li>
                        <li><a href="<?php echo $baseurl ?>product/ram">RAM </a></li>
                        <li><a href="<?php echo $baseurl ?>product/psu">Power Supply Unit </i></a></li>
                        <li><a href="<?php echo $baseurl ?>product/motherboard">Motherboard </i></a></li>
                        <li><a href="<?php echo $baseurl ?>product/hdd">Hard Disk Drive </i></a></li>
                        <li><a href="<?php echo $baseurl ?>product/ssd">Solid State Drive </i></a></li>
                        <li><a href="<?php echo $baseurl ?>product/casing">Casing </i></a></li>
					</ul>
				</div>
				<!-- /category nav -->

                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="<?php echo $baseurl ?>">Home</a></li>

                        <!-- <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="true">Products <i class="fa fa-caret-down"></i></a>
                            <ul class="custom-menu">
                                <li><a href="<?php echo $baseurl ?>product/cpu">Processor</a></li>
                                <li><a href="<?php echo $baseurl ?>product/gpu">Graphics Card</a></li>
                                <li><a href="<?php echo $baseurl ?>product/ram">RAM</a></li>
                                <li><a href="<?php echo $baseurl ?>product/psu">Power Supply Unit</a></li>
                                <li><a href="<?php echo $baseurl ?>product/motherboard">Motherboard</a></li>
                                <li><a href="<?php echo $baseurl ?>product/hdd">Hard Disk Drive</a></li>
                                <li><a href="<?php echo $baseurl ?>product/ssd">Solid State Drive</a></li>
                                <li><a href="<?php echo $baseurl ?>product/casing">Casing</a></li>
                                <li><a href="<?php echo $baseurl ?>cart">Checkout</a></li>
                            </ul>
                        </li> -->
                        <?php $this->session->set_userdata('prev',$_SERVER['REQUEST_URI']); ?>
                        <!-- <?php echo $this->session->userdata('prev') ?> -->
                        <li><a href="<?php echo $baseurl ?>pc_build">Built Your PC</a></li>
                    </ul>
                </div>
                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->
    <?php echo $this->session->flashdata('msg'); ?>