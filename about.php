<?php 
    @session_start();
    include './php/funct.php';
    $fn = new funct();
?>

<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Abamade &#8211; Abamade Ecommerce Platform</title>
        <meta name="description" content="Made by Nigerians for Nigerians and the World.">
        <meta name="author" content="TACOEE CONSULTS LIMITED - https://tacoee.com">

        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/font-electro.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="assets/css/colors/yellow.css" media="all" />
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="assets/images/fav-icon.png">
    </head>

    <body class="about full-width page page-template-default">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            <header id="masthead" class="site-header header-v1">
                <div class="container hidden-md-down">
                    
                    <?php include_once 'index-thead.php'; ?>

                    <!--<div class="row">
                        <?php //include_once 'index-nav.php'; ?>

                        
                    </div>-->
                </div>

                <?php include_once 'mobile-menu.php'; ?>
                
            </header><!-- #masthead -->

            <div id="content" class="site-content" tabindex="-1">
            	<div class="container">
            		<div id="primary" class="content-area">
            			<main id="main" class="site-main">
            				<article class="has-post-thumbnail hentry">
            					<header class="entry-header header-with-cover-image" style="background-image: url(assets/images/products/header-image.jpg);">
            						<div class="caption">
            							<h1 class="entry-title" itemprop="name" style="color: #000">About Us</h1>
            							<p class="entry-subtitle" style="color: #fff">We are a group of marketers showcasing Nigeria's finest products to Nigerians and foreigners at home and in the diaspora.</p>
            							<p class="entry-subtitle" style="color: #fff">We live our passion, it fuels our resolve and commitment to do <br> better and showcase the many artifacts of the Nigerian market to Nigerian and the world at large. </p>
            						</div>
            					</header><!-- .entry-header -->

            					<div class="entry-content">
            						<div class="row about-features inner-top-md inner-bottom-sm">
            							<div class="col-xs-12 col-md-4">
            								<figure class="wpb_wrapper vc_figure outer-bottom-xs">
            									<div class="vc_single_image-wrapper">
            										<img src="assets/images/abt1.jpg" data-echo="assets/images/abt1.jpg" class="img-responsive" alt="">
            									</div>
            								</figure>


            								<div class="text-content">
            									<h2 class="align-top">What we really do?</h2>
            									<p>We catalog and showcase Nigerian based products <br>for sale to the Nigerian market both forign and domestic
            									</p>

            								</div>
            							</div><!-- .col -->

            							<div class="col-xs-12 col-md-4">
            								<figure class="wpb_wrapper vc_figure outer-bottom-xs">
            									<div class="vc_single_image-wrapper">
            										<img src="assets/images/abt2.jpg" data-echo="assets/images/abt2.jpg" class="img-responsive" alt="">
            									</div>
            								</figure>


            								<div class="text-content">
            									<h2 class="align-top">Our Vision</h2>
            									<p>To be the GOTO market place for all Nigerian <br>based products and to set the bar on excellent service delivery.
            									</p>

            								</div>
            							</div><!-- .col -->

            							<div class="col-xs-12 col-md-4">
            								<figure class="wpb_wrapper vc_figure outer-bottom-xs">
            									<div class="vc_single_image-wrapper">
            										<img src="assets/images/abt3.jpg" data-echo="assets/images/abt3.jpg" class="img-responsive" alt="">
            									</div>
            								</figure>


            								<div class="text-content">
            									<h2 class="align-top">Our Mandate</h2>
            									<p>To change the current and prevailing narrative about Nigeria and her produce and set her in the limelight for excellence.
            									</p>

            								</div>
            							</div><!-- .col -->
            						</div><!-- .row -->

            					
            					</div><!-- .entry-content -->

            				</article><!-- #post-## -->
            			</main><!-- #main -->
            		</div><!-- #primary -->
            	</div><!-- .col-full -->
            </div><!-- #content -->

             <?php 

                //include_once 'brands.php'; 
                include_once 'foot3.php'; 

            ?>


        </div><!-- #page -->

        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/tether.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="assets/js/echo.min.js"></script>
        <script type="text/javascript" src="assets/js/wow.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="assets/js/electro.js"></script>

    </body>
</html>
