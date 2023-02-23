<?php
    include './php/funct.php';
    $fn = new funct();
    $br = $br1 = $br2 = "";
    if(! isset($_GET['id'])){
        header("location: ./index.php");
        exit;
    }
    $id = $_GET['id'];
    $it = $fn->viewItem($id);
    $iprice = ($i = $fn->viewItemDiscount($it->id)) ? $fn->discount($it->price, $i->discount_rate) : "";

    
    $br = $fn->viewCategoryDetail($it->cat_id);
    $br1 = (! empty($br->ref)) ? $fn->viewCategoryDetail($br->ref) : "";
    $br2 = (! empty($br1->ref)) ? $fn->viewCategoryDetail($br1->ref) : "";


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

    <body class="single-product">
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
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        <?=$br->cat_name;?>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        <?=$it->prod_name;?>
                    </nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <div class="product">

                                <div class="single-product-wrapper">
                                    <div class="product-images-wrapper">
                                        <?php if(!empty($iprice)) echo '
                                            <span class="onsale">Sale!</span>
                                        '; ?>
                                        
                                        <div class="images electro-gallery">
                                            <div class="thumbnails-single owl-carousel">
                                                <a href="assets/images/product/<?=$it->display_image;?>" class="zoom" title="" data-rel="prettyPhoto[product-gallery]"><img src="assets/images/blank.gif" data-echo="assets/images/product/<?= $it->display_image;?>" class="wp-post-image" alt=""></a>
                                            </div><!-- .thumbnails-single -->

                                            <div class="thumbnails-all columns-5 owl-carousel">
                                                <a href="assets/images/product/<?= $it->display_image;?>" class="first" title=""><img src="assets/images/blank.gif" data-echo="assets/images/product/<?= $it->display_image;?>" class="wp-post-image" alt=""></a>

                                                <!--<a href="assets/images/single-product/single-thumb2.jpg" class="" title=""><img src="assets/images/blank.gif" data-echo="assets/images/single-product/single-thumb2.jpg" class="wp-post-image" alt=""></a>

                                                <a href="assets/images/single-product/single-thumb3.jpg" class="" title=""><img src="assets/images/blank.gif" data-echo="assets/images/single-product/single-thumb3.jpg" class="wp-post-image" alt=""></a>

                                                <a href="assets/images/single-product/single-thumb4.jpg" class="" title=""><img src="assets/images/blank.gif" data-echo="assets/images/single-product/single-thumb4.jpg" class="wp-post-image" alt=""></a>

                                                <a href="assets/images/single-product/single-thumb5.jpg" class="last" title=""><img src="assets/images/blank.gif" data-echo="assets/images/single-product/single-thumb5.jpg" class="wp-post-image" alt=""></a>

                                                <a href="assets/images/single-product/single-thumb6.jpg" class="first" title=""><img src="assets/images/blank.gif" data-echo="assets/images/single-product/single-thumb6.jpg" class="wp-post-image" alt=""></a>
                        -->
                                            </div><!-- .thumbnails-all -->
                                        </div><!-- .electro-gallery -->
                                    </div><!-- /.product-images-wrapper -->

                                    <div class="summary entry-summary">

                                        <span class="loop-product-categories">
                                            <a href="shop.php?cat=<?=$it>cat_id;?>" rel="tag"><?= $br->cat_name;?></a>
                                        </span><!-- /.loop-product-categories -->

                                        <h1 itemprop="name" class="product_title entry-title"><?= $it->prod_name;?></h1>

                                        <div class="woocommerce-product-rating">
                                            <!--<div class="star-rating" title="Rated 4.33 out of 5">
                                                <span style="width:86.6%">
                                                    <strong itemprop="ratingValue" class="rating">4.33</strong>
                                                    out of <span itemprop="bestRating">5</span>				based on
                                                    <span itemprop="ratingCount" class="rating">3</span>
                                                    customer ratings
                                                </span>
                                            </div>-->

                                            <!-- <a href="#reviews" class="woocommerce-review-link">(<span itemprop="reviewCount" class="count">3</span> customer reviews)</a> -->
                                        </div><!-- .woocommerce-product-rating -->

                                        <div class="brand">
                                            <!--<a href="product-category.html">
                                                <img src="assets/images/single-product/brand.png" alt="Gionee" />
                                            </a>-->
                                        </div><!-- .brand -->

                                        <div class="availability in-stock">
                                            Availablity: <span>In stock</span>
                                        </div><!-- .availability -->

                                        <hr class="single-product-title-divider" />

                                        <div class="action-buttons">

                                            <a href="./php/forms.php?wish=<?= $it->id;?>&list=1" class="add_to_wishlist" >Wishlist</a>
                                        </div><!-- .action-buttons -->

                                        <div itemprop="description">
                                            <!--<ul>
                                                <li>4.5 inch HD Touch Screen (1280 x 720)</li>
                                                <li>Android 4.4 KitKat OS</li>
                                                <li>1.4 GHz Quad Core™ Processor</li>
                                                <li>20 MP front and 28 megapixel CMOS rear camera</li>
                                            </ul>-->

                                            <p><?= strip_tags($it->short_note);?></p>
                                            
                                        </div><!-- .description -->

                                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                                            <p class="price"><span class="electro-price">
                                                <?php if(empty($iprice)){?>
                                                <ins><span class="amount"><?=$fn->nairaValue($it->price);?></span></ins> 
                                            <?php
                                                }else{ ?>
                                                <ins><span class="amount"><?=$fn->nairaValue($iprice);?></span></ins> 
                                                <del><span class="amount"><?=$fn->nairaValue($it->price);?></span></del>
                                            <?php
                                                }
                                            ?>
                                                
                                            </span></p>

                                            <meta itemprop="price" content="1215" />
                                            <meta itemprop="priceCurrency" content="USD" />
                                            <link itemprop="availability" href="http://schema.org/InStock" />

                                        </div><!-- /itemprop -->

                                        <form class="variations_form cart" method="get" action="./php/forms.php">
                                            <!--

                                            <table class="variations">
                                                <tbody>
                                                    <tr>
                                                        <td class="label"><label>Color</label></td>
                                                        <td class="value">
                                                            <select class="" name="attribute_pa_color">
                                                                <option value="">Choose an option</option>
                                                                <option value="black-with-red" >Black with Red</option>
                                                                <option value="white-with-gold"  selected='selected'>White with Gold</option>
                                                            </select>
                                                            <a class="reset_variations" href="#">Clear</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            -->


                                            <div class="single_variation_wrap">
                                                <div class="woocommerce-variation single_variation"></div>
                                                <div class="woocommerce-variation-add-to-cart variations_button">
                                                    <div class="quantity">
                                                        <label>Quantity:</label>
                                                        <input type="number" name="cart" value="1" title="Qty" class="input-text qty text"/>
                                                    </div>
                                                    <button type="submit" name="addCart" class="single_add_to_cart_button button">Add to cart</button>
                                                    <input type="hidden" name="item" value="<?=$it->id;?>" />
                                                    <input type="hidden" name="product_id" value="2452" />
                                                    <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                </div>
                                            </div>
                                        </form>

                                    </div><!-- .summary -->
                                </div><!-- /.single-product-wrapper -->


                                <div class="woocommerce-tabs wc-tabs-wrapper">
                                    <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
                                       
                                        <li class="nav-item description_tab">
                                            <a href="#tab-description" class="active" data-toggle="tab">Description</a>
                                        </li>

                                        <li class="nav-item specification_tab">
                                            <a href="#tab-specification" data-toggle="tab">Specification</a>
                                        </li>

                                        <!--<li class="nav-item reviews_tab">
                                            <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                                        </li>-->
                                    </ul>

                                    <div class="tab-content">
                                        

                                        <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                                            <div class="electro-description">

                                                <?= $it->description;?>
                                                
                                            </div><!-- /.electro-description -->

                                        </div>

                                        <div class="tab-pane panel entry-content wc-tab" id="tab-specification">
                                            <h3>Technical Specifications</h3>
                                            <?= $it->short_note;?>
                                            
                                            
                                        </div><!-- /.panel -->

                                        <div class="tab-pane panel entry-content wc-tab" id="tab-reviews">
                                            <!-- Review Content -->
                                        </div><!-- /.panel -->
                                    </div>
                                </div><!-- /.woocommerce-tabs -->

                            </div>
                        </main><!-- /.site-main -->
                    </div><!-- /.content-area -->

                    <div id="sidebar" class="sidebar" role="complementary">

                        <aside id="electro_product_categories_widget-2" class="widget woocommerce widget_product_categories electro_widget_product_categories">
                            <ul class="product-categories category-single">
                                <li class="product_cat">

                                    

                                    <ul>
                                        <li class="cat-item cat-item-172 current-cat-parent current-cat-ancestor">

                                            <a href="shop.php?id=<?=$br->id;?>"><?= $br->cat_name;?></a>
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
                                </li><!-- .product_cat -->
                            </ul><!-- .product-categories -->
                        </aside><!-- .widget -->
                        
                        
                        
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
                    </div><!-- /.sidebar-shop -->

                </div><!-- .col-full -->
            </div><!-- #content -->

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
