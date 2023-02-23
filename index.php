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

            <?php include_once 'top.php'; ?>

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
                            <div class="home-v1-slider" >
                            	<!-- ========================================== SECTION – HERO : END========================================= -->

                            	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                    <?php
                                        if($slides = $fn->viewSlides("index main slide", 4)){
                                            foreach($slides as $key){
                                                $adv = (object) $key;
                                    ?>

                            		<div class="item" style="background-image: url(assets/images/slider/<?=$adv->imagename;?>);">
                            			<div class="container">
                            				<div class="row">
                            					<div class="col-md-offset-3 col-md-5">
                            						<div class="caption vertical-center text-left">
                            							<div class="hero-1 fadeInDown-1">
                            								<?= $adv->image_titles; ?>
                            							</div>

                            							<div class="hero-subtitle fadeInDown-2">
                            								<?= $adv->short_desc; ?>
                            							</div>
                            							
                            							<!--<div class="hero-action-btn fadeInDown-4">
                            								<a href="single-product.html" class="big le-button ">Start Buying</a>
                            							</div>-->
                            						</div><!-- /.caption -->
                            					</div>
                            				</div>
                            			</div><!-- /.container -->
                            		</div><!-- /.item -->
                                    
                                    <?php
                                            }
                                        }
                                    ?>


                            	</div><!-- /.owl-carousel -->

                                <!-- ========================================= SECTION – HERO : END ========================================= -->

                            </div><!-- /.home-v1-slider -->

                            <div class="home-v1-ads-block animate-in-view fadeIn animated" data-animation="fadeIn">
                            	<div class="ads-block row">
                                    <?php
                                        if($advert = $fn->viewSlides("index small advert", 3)){
                                            foreach($advert as $key){
                                                $ad = (object) $key;
                                    ?>
                            		<div class="ad col-xs-12 col-sm-4">
                            			<div class="media">
                            				<div class="media-left media-middle">
                            					<img data-echo="assets/images/banner/<?= $ad->imagename;?>" src="assets/images/blank.gif" alt="">
                            				</div>
                            				<div class="media-body media-middle">
                            					<div class="ad-text">
                            						<?= $ad->short_desc; ?>
                            					</div>
                            					<div class="ad-action">
                            						<!--<a href="#">Shop now</a>-->
                            					</div>
                            				</div>
                            			</div>
                            		</div>
                                    
                                    <?php
                                            }
                                        }
                                    ?>

                            	</div>
                            </div>

                            <div class="home-v1-deals-and-tabs deals-and-tabs row animate-in-view fadeIn animated" data-animation="fadeIn">
                            	


                                <div class="tabs-block col-lg-12">
                                    <div class="products-carousel-tabs">
                                        <ul class="nav nav-inline">
                                            <li class="nav-item"><a class="nav-link active" href="#tab-products-1" data-toggle="tab">Featured</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab-products-2" data-toggle="tab">On Sale</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tab-products-3" data-toggle="tab">Top Rated</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                                <div class="woocommerce columns-4">

                                                    <ul class="products columns-4">
                                                    <?php
                                                        if($featured = $fn->viewProducts(0, 8, 0, 1)){
                                                            foreach($featured as $key){
                                                                $fd = (object) $key;
                                                                $category = $fn->viewCategoryDetail($fd->cat_id);
                                                    ?>
                                                    
                                                        <li class="product">
                                                            <div class="product-outer">
                                                                <div class="product-inner">
                                                                    <span class="loop-product-categories"><a href="shop.php?cat=<?= $category->id;?>" rel="tag"><?=$category->cat_name;?></a></span>
                                                                    <a href="single-product.php?id=<?=$fd->id;?>">
                                                                        <h3><?= $fd->prod_name;?></h3>
                                                                        <div class="product-thumbnail">
                                                                            <img src="assets/images/blank.gif" data-echo="assets/images/product/<?=$fd->display_image;?>" class="img-responsive" alt="">
                                                                        </div>
                                                                    </a>

                                                                    <div class="price-add-to-cart">
                                                                        <span class="price">
                                                                            <span class="electro-price">
                                                                                <ins><span class="amount"> <?=$fn->nairaValue($fd->price);?></span></ins>
                                                                                <!--<del><span class="amount">$2,299.00</span></del>-->
                                                                                <span class="amount"> </span>
                                                                            </span>
                                                                        </span>
                                                                        <a rel="nofollow" href="./php/forms.php?cart=1&item=<?=$fd->id;?>" class="button add_to_cart_button">Add to cart</a>
                                                                    </div><!-- /.price-add-to-cart -->

                                                                    <div class="hover-area">
                                                                        <div class="action-buttons">

                                                                            <a href="./php/forms.php?wish=<?=$fd->id;?>&list=true" rel="nofollow" class="add_to_wishlist"> Wishlist</a>

                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.product-inner -->
                                                            </div><!-- /.product-outer -->
                                                        </li><!-- /.products -->

                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-products-2" role="tabpanel">
                                                <div class="woocommerce columns-4">
                                                    <ul class="products columns-4">
                                                    <?php
                                                        if($sales = $fn->viewDiscountItems(6)){
                                                            foreach($sales as $key){
                                                                $sl = (object) $key;
                                                                $category = $fn->viewCategoryDetail($fd->cat_id);
                                                                $discount = $fn->discount($sl->price, $sl->discount_rate);
                                                    ?>
                                                    

                                                    <li class="product">
                                                            <div class="product-outer">
                                                                <div class="product-inner">
                                                                    <span class="loop-product-categories"><a href="shop.php?cat=<?= $category->id;?>" rel="tag"><?=$category->cat_name;?></a></span>
                                                                    <a href="single-product.php?id=<?=$sl->prod_id;?>">
                                                                        <h3><?= $sl->prod_name;?></h3>
                                                                        <div class="product-thumbnail">
                                                                            <img src="assets/images/blank.gif" data-echo="assets/images/product/<?=$sl->display_image;?>" class="img-responsive" alt="">
                                                                        </div>
                                                                    </a>

                                                                    <div class="price-add-to-cart">
                                                                        <span class="price">
                                                                            <span class="electro-price">
                                                                                <ins><span class="amount"> <?=$fn->nairaValue($discount);?></span></ins>
                                                                                <del><span class="amount"><?= $fn->nairaValue($sl->price);?></span></del>
                                                                                <span class="amount"> </span>
                                                                            </span>
                                                                        </span>
                                                                        <a rel="nofollow" href="./php/forms.php?cart=1&item=<?=$sl->prod_id;?>" class="button add_to_cart_button">Add to cart</a>
                                                                    </div><!-- /.price-add-to-cart -->

                                                                    <div class="hover-area">
                                                                        <div class="action-buttons">

                                                                            <a href="./php/forms.php?wish=<?=$sl->prod_id;?>&list=true" rel="nofollow" class="add_to_wishlist"> Wishlist</a>

                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.product-inner -->
                                                            </div><!-- /.product-outer -->
                                                        </li><!-- /.products -->

                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-products-3" role="tabpanel">
                                                <div class="woocommerce columns-4">

                                                    <ul class="products columns-4">
                                                    <?php
                                                        if($topRated = $fn->viewProducts(0, 6, 0, 2)){
                                                            foreach($topRated as $key){
                                                                $td = (object) $key;
                                                                $category = $fn->viewCategoryDetail($td->cat_id);
                                                    ?>
                                                        <li class="product">
                                                            <div class="product-outer">
                                                                <div class="product-inner">
                                                                    <span class="loop-product-categories"><a href="shop.php?cat=<?= $category->id;?>" rel="tag"><?=$category->cat_name;?></a></span>
                                                                    <a href="single-product.php?id=<?=$fd->id;?>">
                                                                        <h3><?= $td->prod_name;?></h3>
                                                                        <div class="product-thumbnail">
                                                                            <img src="assets/images/blank.gif" data-echo="assets/images/product/<?=$td->display_image;?>" class="img-responsive" alt="">
                                                                        </div>
                                                                    </a>

                                                                    <div class="price-add-to-cart">
                                                                        <span class="price">
                                                                            <span class="electro-price">
                                                                                <ins><span class="amount"> <?=$fn->nairaValue($td->price);?></span></ins>
                                                                                <!--<del><span class="amount">$2,299.00</span></del>-->
                                                                                <span class="amount"> </span>
                                                                            </span>
                                                                        </span>
                                                                        <a rel="nofollow" href="./php/forms.php?cart=l&item=<?=$td->id;?>" class="button add_to_cart_button">Add to cart</a>
                                                                    </div><!-- /.price-add-to-cart -->

                                                                    <div class="hover-area">
                                                                        <div class="action-buttons">

                                                                            <a href="./php/forms.php?wish=<?=$td->id;?>&list=true" rel="nofollow" class="add_to_wishlist"> Wishlist</a>

                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.product-inner -->
                                                            </div><!-- /.product-outer -->
                                                        </li><!-- /.products -->
                                                        
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                        
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.tabs-block -->
                            </div><!-- /.deals-and-tabs -->

                            <!-- ============================================================= 2-1-2 Product Grid ============================================================= -->
                            <section class="products-2-1-2 animate-in-view fadeIn animated" data-animation="fadeIn">
                                <h2 class="sr-only">Products Grid</h2>
                                <div class="container">

                                    <ul class="nav nav-inline nav-justified">
                                    <?php
                                        $active = "active";
                                        $id = $n = 0;
                                        if($catArray = $fn->viewCategory2(0, 0, 8)){
                                            foreach($catArray as $key){
                                                $ct = (object) $key;
                                                echo "<li class='nav-item'><a class='{$active} nav-link' href='shop.php?cat={$ct->id}'>{$ct->cat_name}</a></li>";
                                                if($n == 0){
                                                    $active = "";
                                                    $id = $ct->id;
                                                }
                                                $n++;
                                            }
                                        }
                                    ?>

                                    </ul>

                                    <div class="columns-2-1-2">
                                        <ul class="products exclude-auto-height">
                                        <?php
                                            if($products = $fn->viewProducts($id, 2, 0, 0)){
                                                foreach($products as $key){
                                                    $pd = (object) $key;
                                                    $category = $fn->viewCategoryDetail($id);
                                        ?>
                                            <li class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="shop.php?cat=<?=$pd->cat_id;?>" rel="tag"><?= $category->cat_name;?></a></span>
                                                        <a href="single-product.php?id=<?=$pd->id;?>">
                                                            <h3><?= $pd->prod_name;?></h3>
                                                            <div class="product-thumbnail">

                                                                <img data-echo="assets/images/product/<?= $pd->display_image;?>" src="assets/images/blank.gif" alt="">

                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"><?= $fn->nairaValue($pd->price);?></span></ins>
                                                                    <!--<del><span class="amount">&#036;2,299.00</span></del>-->
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="./php/forms.php?item=<?=$pd->id;?>&cart=1" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">

                                                                <a href="./php/forms.php?wish=<?=$pd->id;?>&list=1" rel="nofollow" class="add_to_wishlist">
                                                                    Wishlist</a>

                                                                <!--<a href="#" class="add-to-compare-link">Compare</a>-->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li>
                                        
                                         <?php
                                                }
                                            }

                                        ?>
                                           
                                        </ul>

                                        <ul class="products exclude-auto-height product-main-2-1-2">
                                        <?php
                                            if($products = $fn->viewProducts($id, 1, 2, 0)){
                                                foreach($products as $key){
                                                    $pd = (object) $key;
                                                    $category = $fn->viewCategoryDetail($id);
                                        ?>
                                            <li class="last product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="shop.php?cat=<?=$pd->cat_id;?>" rel="tag"><?= $category->cat_name;?></a></span>
                                                        <a href="single-product.php?id=<?=$pd->id;?>">
                                                            <h3><?= $pd->prod_name;?></h3>
                                                            <div class="product-thumbnail">

                                                                <img data-echo="assets/images/product/<?= $pd->display_image;?>" src="assets/images/blank.gif" alt="">

                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"><?= $fn->nairaValue($pd->price);?></span></ins>
                                                                    <!--<del><span class="amount">&#036;2,299.00</span></del>-->
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="./php/forms.php?item=<?=$pd->id;?>&cart=1" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">

                                                                <a href="./php/forms.php?wish=<?=$pd->id;?>&list=1" rel="nofollow" class="add_to_wishlist">
                                                                    Wishlist</a>

                                                                <!--<a href="#" class="add-to-compare-link">Compare</a>-->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </li>
                                        <?php
                                                }
                                            }
                                        ?>

                                        </ul>

                                        <ul class="products exclude-auto-height">
                                        <?php
                                            if($products = $fn->viewProducts($id, 2, 3, 0)){
                                                foreach($products as $key){
                                                    $pd = (object) $key;
                                                    $category = $fn->viewCategoryDetail($id);
                                        ?>
                                            <li class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="shop.php?cat=<?=$pd->cat_id;?>" rel="tag"><?= $category->cat_name;?></a></span>
                                                        <a href="single-product.php?id=<?=$pd->id;?>">
                                                            <h3><?= $pd->prod_name;?></h3>
                                                            <div class="product-thumbnail">

                                                                <img data-echo="assets/images/product/<?= $pd->display_image;?>" src="assets/images/blank.gif" alt="">

                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"><?= $fn->nairaValue($pd->price);?></span></ins>
                                                                    <!--<del><span class="amount">&#036;2,299.00</span></del>-->
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="./php/forms.php?item=<?=$pd->id;?>&cart=1" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">

                                                                <a href="./php/forms.php?wish=<?=$pd->id;?>&list=1" rel="nofollow" class="add_to_wishlist">
                                                                    Wishlist</a>

                                                                <!--<a href="#" class="add-to-compare-link">Compare</a>-->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </li>
                                        <?php
                                                }
                                            }
                                        ?>
                                        
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <!-- ============================================================= 2-1-2 Product Grid : End============================================================= -->

                            <section class="section-product-cards-carousel animate-in-view fadeIn animated" data-animation="fadeIn">

                                <header>
                                    <h2 class="h1">Best Sellers</h2>

                                    <!--<ul class="nav nav-inline">

                                        <li class="nav-item active"><span class="nav-link">Top 20</span></li>

                                        <li class="nav-item"><a class="nav-link" href="product-category.html">Smart Phones &amp; Tablets</a></li>

                                        <li class="nav-item"><a class="nav-link" href="product-category.html">Laptops &amp; Computers</a></li>

                                        <li class="nav-item"><a class="nav-link" href="product-category.html">Video Cameras 3</a></li>
                                    </ul>-->
                                </header>

                                <div id="home-v1-product-cards-careousel">
                                    <div class="woocommerce columns-3 home-v1-product-cards-carousel product-cards-carousel owl-carousel">

                                        <ul class="products columns-3">
                                        <?php
                                            if($topSell = $fn->viewTopSelling(6)){
                                                foreach($topSell as $key){
                                                    $ts = (object) $key;
                                                    $im = $fn->viewItem($ts->prod_id);
                                                    $category = $fn->viewCategoryDetail($im->cat_id);
                                        ?>
                                       
                                            <li class="product product-card">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.php?id=<?=$im->id;?>" title="<?= $im->prod_name;?>">
                                                            <img class="media-object wp-post-image img-responsive" src="assets/images/blank.gif" data-echo="assets/images/product/<?=$im->display_image;?>" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="shop.php?cat=<?=$im->cat_id;?>" rel="tag"><?=$category->cat_name;?></a>
                                                            </span>

                                                            <a href="single-product.php?id=<?=$im->id;?>">
                                                                <h3><?= $im->prod_name;?></h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"><?=$fn->nairaValue($im->price);?> </span></ins>
                                                                    </span>
                                                                </span>

                                                                <a href="./php/forms.php?cart=1&item=<?= $im->id;?>" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="./php/forms.php?wish=<?= $im->id;?>&list=1" class="add_to_wishlist">Wishlist</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                        <?php                                                    
                                                }
                                            }
                                        
                                        ?>
                                        </ul>
                                        <ul class="products columns-3">
                                            <li class="product product-card first">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/2.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">Headphone Cases</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>Universal Headphones Case in Black</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1500</span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                            <li class="product product-card ">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/5.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">Printers</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>Full Color LaserJet Pro  M452dn</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $500</span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                            <li class="product product-card last">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/4.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">TVs</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>Widescreen 4K SUHD TV</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $400</span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                            <li class="product product-card first">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/3.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">Smartphones</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>Notebook Purple G752VT-T7008T</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> $3,788.00</span></ins>
                                                                        <del><span class="amount">$4,780.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                            <li class="product product-card ">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/6.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">Peripherals</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>External SSD USB 3.1  750 GB</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> $3,788.00</span></ins>
                                                                        <del><span class="amount">$4,780.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                            <li class="product product-card last">

                                                <div class="product-outer">
                                                    <div class="media product-inner">

                                                        <a class="media-left" href="single-product.html" title="Pendrive USB 3.0 Flash 64 GB">
                                                            <img class="img-responsive media-object wp-post-image" src="assets/images/blank.gif" data-echo="assets/images/product-cards/1.jpg" alt="">
                                                        </a>

                                                        <div class="media-body">
                                                            <span class="loop-product-categories">
                                                                <a href="product-category.html" rel="tag">Smartphones</a>
                                                            </span>

                                                            <a href="single-product.html">
                                                                <h3>Tablet Thin EliteBook  Revolve 810 G6</h3>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> $3,788.00</span></ins>
                                                                        <del><span class="amount">$4,780.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>

                                                                <a href="cart.html" class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="#" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->
                                        </ul>
                                    </div>
                                </div><!-- #home-v1-product-cards-careousel -->

                            </section>

                            <div class="home-v1-banner-block animate-in-view fadeIn animated" data-animation="fadeIn">
                            	<div class="home-v1-fullbanner-ad fullbanner-ad" style="margin-bottom: 70px">
                                    <?php
                                        if($banner = $fn->viewSlides("index bottom banner", 1)){
                                            foreach($banner as $key){
                                                $bn = (object) $key;
                                    ?>
                                    
                            		<a href="#">
                                        <img src="assets/images/blank.gif" data-echo="assets/images/banner/<?= $bn->imagename;?>" class="img-responsive" alt="<?= $bn->image_titles;?>">
                                    </a>
                                    <?php
                                            }
                                        }
                                    ?>
                            	</div>
                            </div><!-- /.home-v1-banner-block -->



                            <section class="home-v1-recently-viewed-products-carousel section-products-carousel animate-in-view fadeIn animated" data-animation="fadeIn">
                                <header>
                                    <h2 class="h1">Special Deal</h2>
                                    <div class="owl-nav">
                                        <a href="#products-carousel-prev" data-target="#recently-added-products-carousel" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                                        <a href="#products-carousel-next" data-target="#recently-added-products-carousel" class="slider-next"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </header>

                                <div id="recently-added-products-carousel">
                                    <div class="woocommerce columns-6">
                                        <div class="products owl-carousel recently-added-products products-carousel columns-6">
                                        <?php
                                            if($recent = $fn->viewProducts(0, 8, 0, 0)){
                                                foreach($recent as $key){
                                                    $rt = (object) $key;
                                                    $category = $fn->viewCategoryDetail($rt->cat_id);
                                        ?>


                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="shop.php?cat=<?=$category->id;?>" rel="tag"><?= $category->cat_name;?></a></span>
                                                        <a href="single-product.php?id=<?=$rt->id;?>">
                                                            <h3><?= $rt->prod_name;?></h3>
                                                            <div class="product-thumbnail">
                                                                <img src="assets/images/blank.gif" data-echo="assets/images/product/<?=$rt->display_image;?>" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> <?= $fn->nairaValue($rt->price);?></span></ins>
                                                                    <!--<del><span class="amount">$2,299.00</span></del>-->
                                                                    <span class="amount"> </span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="./php/forms.php?cart=1&item=<?=$rt->id;?>" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">

                                                                <a href="./php/forms.php?wish=<?=$rt->id;?>&list=1" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                        
                                        <?php
                                                }
                                            }

                                        ?>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .container -->
            </div><!-- #content -->

            <section class="brands-carousel">
            	<h2 class="sr-only">Brands Carousel</h2>
            	<div class="container">
            		<div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">

            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Acer</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="assets/images/blank.gif" data-echo="assets/images/brands/1.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Apple</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="assets/images/blank.gif" data-echo="assets/images/brands/2.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Asus</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="assets/images/blank.gif" data-echo="assets/images/brands/3.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Dell</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/4.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Gionee</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/5.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>HP</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/6.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>HTC</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/3.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>IBM</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/5.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Lenova</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/2.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>LG</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/1.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Micromax</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/6.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Microsoft</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="assets/images/blank.gif" data-echo="assets/images/brands/4.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            		</div><!-- /.owl-carousel -->

            	</div>
            </section>

         <?php include_once 'foot.php'; ?>

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
