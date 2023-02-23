<?php
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

    <body class="page home page-template-default">
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

            <div tabindex="-1" class="site-content" id="content">
                <div class="container">

                    <nav class="woocommerce-breadcrumb"><a href="index.php">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Wishlist</nav>
                    <div class="content-area" id="primary">
                        <main class="site-main" id="main">
                            <article class="page type-page status-publish hentry">
                                <div itemprop="mainContentOfPage" class="entry-content">
                                    <div id="yith-wcwl-messages"></div>
                                    <form class="woocommerce" method="post" id="yith-wcwl-form">

                                        <input type="hidden" value="68bc4ab99c" name="yith_wcwl_form_nonce" id="yith_wcwl_form_nonce"><input type="hidden" value="/electro/wishlist/" name="_wp_http_referer">
                                        <!-- TITLE -->
                                        <div class="wishlist-title ">
                                            <h2>My wishlist</h2>
                                        </div>

                                        <!-- WISHLIST TABLE -->
                                        <table data-token="" data-id="" data-page="1" data-per-page="5" data-pagination="no" class="shop_table cart wishlist_table">

                                            <thead>
                                                <tr>

                                                    <th class="product-remove"></th>

                                                    <th class="product-thumbnail"></th>

                                                    <th class="product-name">
                                                        <span class="nobr">Product Name</span>
                                                    </th>

                                                    <th class="product-price">
                                                        <span class="nobr">Unit Price</span>
                                                    </th>

                                                    <th class="product-add-to-cart"></th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                    
                                                    if($mywishlist = $fn->viewWish(session_id())){
                                                        foreach($mywishlist as $key){
                											$wl = (object) $key;
                											$witem = $fn->viewItem($wl->prod_id);
                											$price = ($c = $fn->viewItemDiscount($wl->prod_id)) ? $fn->discount($witem->price, $c->discount_rate) : $witem->price;
                                                            $wtotal += ($price * 1); 
                                                ?>
                                                <tr>
                                                    <td class="product-remove">
                                                        <div>
                                                            <a class="remove" href="./php/forms.php?code=3&item=<?=$wl->id;?>">×</a>
                                                        </div>
                                                    </td>

                                                    <td class="product-thumbnail">
                                                        <a href="single-product.html"><img width="180" height="180" src="assets/images/product/<?=$witem->display_image;?>" alt=""></a>
                                                    </td>

                                                    <td class="product-name">
                                                        <a href="single-product.php?id=<?=$wl->prod_id;?>"><?=$witem->prod_name;?></a>
                                                    </td>

                                                    <td class="product-price">
                                                        <span class="electro-price"><span class="amount"><?= $fn->nairaValue($price);?></span></span>
                                                    </td>

                                                    <td class="product-add-to-cart">
                                                        <!-- Date added -->

                                                        <!-- Add to cart button -->
                                                        <a href="./php/forms.php?cart=1&item=<?=$wl->prod_id;?>" class="button w-Btn"> Add to Cart</a>
                                                        <!-- Change wishlist -->

                                                        <!-- Remove from wishlist -->
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                            
                                        }
                                    }
                                    else{
                                        echo "<td colspan=5 align=center>Wishlist is Empty</td>";
                                    }
                                ?>
                                                
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                </tr>
                                            </tfoot>

                                        </table>


                                    </form>

                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .col-full -->
            </div>

  <?php 

                include_once 'brands.php'; 
                include_once 'foot.php'; 

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
