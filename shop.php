
<?php
    //Exit();
    include './php/funct.php';
    $fn = new funct();
    $br = $br1 = $br2 = "";
    if(! isset($_GET['cat'])){
        header("location: ./index.php");
        exit;
    }
    $id = $_GET['cat'];

    $br = $fn->viewCategoryDetail($id);
    $br1 = (! empty($br->ref)) ? $fn->viewCategoryDetail($br->ref) : "";
    $br2 = (! empty($br1->ref)) ? $fn->viewCategoryDetail($br1->ref) : "";



    //initializing paginattion variable
    $url_string = "cat=".$id;
    $per_page = 9;

    if (isset($_GET['page']) && $_GET['page']!="") {
        $page_no = $_GET['page'];
    } 
    else {
        $page_no = 1;
    }

    if(isset($_POST['sort'])){
        $_SESSION['sort'] = $_POST['sort'];
    }

    $priority = (! empty($_SESSION['sort'])) ? $_SESSION['sort'] : ""; 

    $offset = ($page_no-1) * $per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    $total_records = count($fn->allItem($_GET['cat']));
    $total_no_of_pages = ceil($total_records / $per_page);
    $second_last = $total_no_of_pages - 1; // total page minus 1

    //paging and number variables
    $n3 = $page_no*$per_page;
	$record = ($total_records < $n3) ? $total_records : $n3;


    $sort = "";

    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }

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

    <body  class="left-sidebar">
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

                    <nav class="woocommerce-breadcrumb" >
                        <a href="index.php">Home</a>
                        <?php
                            if(!empty($br2)){ 
                                echo "<span class='delimiter'><i class='fa fa-angle-right'></i></span>
                                <a href='shop.php?cat={$br2->id}'>{$br2->cat_name}</a>";
                            }
                            if(!empty($br1)){
                                echo "<span class='delimiter'><i class='fa fa-angle-right'></i></span>
                                <a href='shop.php?cat={$br1->id}'>{$br1->cat_name}</a>";
                            } 
                        ?>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span><?=$br->cat_name;?>
                    </nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            

                            <header class="page-header">
                                <h1 class="page-title"><?= $br->cat_name;?></h1>
                                <!--<p class="woocommerce-result-count">Showing <?=$offset+1;?> - <?=$record;?> of <?=$total_records;?> results</p>-->
                            </header>

                            <div class="shop-control-bar">
                                <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View" href="#grid"><i class="fa fa-th"></i></a></li>
                                    <!--<li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li>
                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>-->
                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small" href="#list-view-small"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <nav class="electro-advanced-pagination">
                                    Showing <?=$offset+1;?> - <?=$record;?> of <?=$total_records;?> results
                                </nav>
                            </div>

                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

                                    <ul class="products columns-3">
                                    <?php    
                                         if($products = $fn->viewAllProducts($id, $per_page, $offset, 0)){
                                            foreach($products as $key){
                                                $pd = (object) $key;
                                                //$category = $fn->viewCategoryDetail($id);
                                                $price = ($c = $fn->viewItemDiscount($pd->id)) ? $fn->discount($pd->price, $c->discount_rate) : $pd->price;
                                    
                                    ?>
                                        <li class="product">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <a href="single-product.php?id=<?= $pd->id;?>">
                                                        <h3><?=$pd->prod_name;?></h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="assets/images/product/<?=$pd->display_image;?>" src="assets/images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount"><?=$fn->nairaValue($price);?></span></ins>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="./php/forms.php?cart=1&item=<?=$pd->id;?>" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="./php/forms.php?wish=<?=$pd->id?>&course=TRUE" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                    <?php
           
                                            }
                                        }
                                    ?>

                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">

                                    <ul class="products columns-3">
                                    <?php    
                                         if($products = $fn->viewAllProducts($id, $per_page, $offset, 0)){
                                            foreach($products as $key){
                                                $pd = (object) $key;
                                                //$category = $fn->viewCategoryDetail($id);
                                                $price = ($c = $fn->viewItemDiscount($pd->id)) ? $fn->discount($pd->price, $c->discount_rate) : $pd->price;
                                                $discr = strip_tags($pd->description);
                                    
                                    ?>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.php?id=<?=$pd->id;?>">
                                                        <img class="wp-post-image" data-echo="assets/images/product/<?=$pd->display_image;?>" src="assets/images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            
                                                            <a href="single-product.php?id=<?= $pd->id;?>"><h3><?= $pd->prod_name;?></h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li><?=$discr;?></li>
                                                                    </ul>
                                                                </div>
                                                                <!--<div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>-->
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount"><?= $fn->nairaValue($price);?></span></span></span>
                                                                <a class="button add_to_cart_button" href="./php/forms.php?item=<?=$pd->id;?>&cart=1" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="./php/forms.php?wish=<?=$pd->id;?>&list=1" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php

                                            }
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-control-bar-bottom">
                                
                                <p class="woocommerce-result-count"> <span>Showing <?=$offset+1;?> - <?=$record;?> of <?=$total_records;?> item(s) </span></p>
                                <?php include 'pagination.php'; ?>
                            </div>

                        </main><!-- #main -->
                    </div><!-- #primary -->

                    <div id="sidebar" class="sidebar" role="complementary">
                        <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                            <ul class="product-categories category-single">
                                <li class="product_cat">
                                    
                                    <ul>
                                        <li class="cat-item current-cat"><a href="shop.php?cat=<?=$id;?>"><?= $br->cat_name;?></a> <span class="count"></span>
                                            <ul class='children'>
                                                <?php
                                                    if($countCat = $fn->viewCategory()){
                                                        foreach($countCat as $key){
                                                            $sub = (object) $key;
                                                            $total = $fn->viewProductCount($sub->id);
                                                            //$category = $fn->viewCategoryDetail($cCat->cat_id);
                                                            echo "<li class='cat-item'><a href='shop.php?cat={$sub->id}'>{$sub->cat_name}</a> <span class='count'>({$total->total})</span></li>";
                                                            //$total->total = 0;
                                                        }
                                                    }

                                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget widget_electro_products_filter">
                            <h3 class="widget-title">Filters</h3>
                            <aside class="widget woocommerce widget_layered_nav">
                                <h3 class="widget-title">Brands</h3>
                                <ul>
                                    <li style=""><a href="#">Apple</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Gionee</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">HTC</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">LG</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">Micromax</a> <span class="count">(1)</span></li>
                                </ul>
                                <p class="maxlist-more"><a href="#">+ Show more</a></p>
                            </aside>
                            <aside class="widget woocommerce widget_layered_nav">
                                <h3 class="widget-title">Color</h3>
                                <ul>
                                    <li style=""><a href="#">Black</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Black Leather</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">Turquoise</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">White</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Gold</a> <span class="count">(4)</span></li>
                                </ul>
                                <p class="maxlist-more"><a href="#">+ Show more</a></p>
                            </aside>
                            <aside class="widget woocommerce widget_price_filter">
                                <h3 class="widget-title">Price</h3>
                                <form action="#">
                                    <div class="price_slider_wrapper">
                                        <div style="" class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span>
                                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>
                                        </div>
                                        <div class="price_slider_amount">
                                            <a href="#" class="button">Filter</a>
                                            <div style="" class="price_label">Price: <span class="from">$428</span> &mdash; <span class="to">$3485</span></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                            </aside>
                        </aside>
                        <aside class="widget widget_text">
                            <div class="textwidget">
                                <a href="#"><img src="assets/images/banner/ad-banner-sidebar.jpg" alt="Banner"></a>
                            </div>
                        </aside>
                        <aside class="widget widget_products">
                            <h3 class="widget-title">Latest Products</h3>
                            <ul class="product_list_widget">
                            <?php
                                if($recent = $fn->viewProducts(0, 3, 0, 0)){
                                    foreach($recent as $key){
                                        $rt = (object) $key;
                                        $category = $fn->viewCategoryDetail($rt->cat_id);
                            ?>
                                <li>
                                    <a href="single-product.php?id=<?=$rt->id;?>" title="<?= $rt->prod_name;?>">
                                        <img width="180" height="180" src="assets/images/product/<?= $rt->display_image;?>" class="wp-post-image" alt=""/>
                                        <span class="product-title"><?= $rt->prod_name;?></span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount"><?=$fn->nairaValue($rt->price);?></span></ins></span>
                                </li>
                            <?php
                                    }
                                }
                            ?>

                                
                            </ul>
                        </aside>
                    </div>

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
