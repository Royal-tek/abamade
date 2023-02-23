<?php
    include './php/funct.php';
    $fn = new funct();
    $checkout = (isset($_GET['out'])) ? "true" : "";

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

    <body class="page home page-template-default" style="background: #e1e1e1">
        <div id="page" class="hfeed site">
            

            <div id="content" class="site-content" tabindex="-1">
                <div class="container" style="background: #FFF; padding-bottom:4em">
                    

                    

                    
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">

                                            <div class="login-holder" id="customer_logi">
                                                <a href="./" class="header-logo-link">
                                                    <img src="./assets/images/logo.png">  
                                                </a>



                                                <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs">
                                                    <li class="nav-item col-sm-6">
                                                        <a class="nav-link active" href="#">Login</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="account2.php">Register</a>
                                                    </li>

                                                </ul>

                                                    <form method="post" class="login" action="./php/forms.php">

                                                        <p class="before-login-text">Welcome back! Sign in to your account</p>

                                                        <p class="form-row form-row-wide">
                                                            <label for="username">Username<span class="required">*</span></label>
                                                            <input type="text" class="input-text" name="username" id="username" value="" />
                                                        </p>

                                                        <p class="form-row form-row-wide">
                                                            <label for="password">Password<span class="required">*</span></label>
                                                            <input class="input-text" type="password" name="password" id="password" />
                                                        </p>

                                                        <p class="form-row">
                                                            <input class="button full-btn" type="submit" value="Login" name="loginBtn">
                                                            <input type="hidden" name="prevPage" value="<?=$checkout;?>" />    
                                                        </p>
                                                        

                                                        <p class="lost_password">
                                                            <a href="#login-and-register.html" class="lost-pass">Lost your password?</a>
                                                            <label for="rememberme" class="inline"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me</label>
                                                        </p>

                                                    </form>



                                            </div><!-- .col2-set -->

                                        </div><!-- /.customer-login-form -->


                </div><!-- .col-full -->
            </div><!-- #content -->
             <?php 

                //include_once 'brands.php'; 
                //include_once 'foot.php'; 

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
