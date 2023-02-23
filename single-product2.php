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

           <?php 

                include_once 'top.php'; 
                include_once 'main-head.php';
                include_once 'main-nav.php'; 
            ?>

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
                                            <div class="star-rating" title="Rated 4.33 out of 5">
                                                <span style="width:86.6%">
                                                    <strong itemprop="ratingValue" class="rating">4.33</strong>
                                                    out of <span itemprop="bestRating">5</span>				based on
                                                    <span itemprop="ratingCount" class="rating">3</span>
                                                    customer ratings
                                                </span>
                                            </div>

                                            <a href="#reviews" class="woocommerce-review-link">(<span itemprop="reviewCount" class="count">3</span> customer reviews)</a>
                                        </div><!-- .woocommerce-product-rating -->

                                        <div class="brand">
                                            <a href="product-category.html">
                                                <img src="assets/images/single-product/brand.png" alt="Gionee" />
                                            </a>
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

                                        <form class="variations_form cart" method="post">

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


                                            <div class="single_variation_wrap">
                                                <div class="woocommerce-variation single_variation"></div>
                                                <div class="woocommerce-variation-add-to-cart variations_button">
                                                    <div class="quantity">
                                                        <label>Quantity:</label>
                                                        <input type="number" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                    </div>
                                                    <button type="submit" class="single_add_to_cart_button button">Add to cart</button>
                                                    <input type="hidden" name="add-to-cart" value="2452" />
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

                                        <li class="nav-item reviews_tab">
                                            <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        

                                        <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                                            <div class="electro-description">

                                                <?= $it->description;?>
                                                
                                            </div><!-- /.electro-description -->

                                        </div>

                                        <div class="tab-pane panel entry-content wc-tab" id="tab-specification">
                                            <h3>Technical Specifications</h3>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Brand</td>
                                                        <td>Apple</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Item Height</td>
                                                        <td>18 Millimeters</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Item Width</td>
                                                        <td>31.4 Centimeters</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Screen Size</td>
                                                        <td>13 Inches</td>
                                                    </tr>
                                                    <tr class="size-weight">
                                                        <td>Item Weight</td>
                                                        <td>1.6 Kg</td>
                                                    </tr>
                                                    <tr class="size-weight">
                                                        <td>Product Dimensions</td>
                                                        <td>21.9 x 31.4 x 1.8 cm</td>
                                                    </tr>
                                                    <tr class="item-model-number">
                                                        <td>Item model number</td>
                                                        <td>MF841HN/A</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Processor Brand</td>
                                                        <td>Intel</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Processor Type</td>
                                                        <td>Core i5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Processor Speed</td>
                                                        <td>2.9 GHz</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RAM Size</td>
                                                        <td>8 GB</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hard Drive Size</td>
                                                        <td>512 GB</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hard Disk Technology</td>
                                                        <td>Solid State Drive</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Graphics Coprocessor</td>
                                                        <td>Intel Integrated Graphics</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Graphics Card Description</td>
                                                        <td>Integrated Graphics Card</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hardware Platform</td>
                                                        <td>Mac</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Operating System</td>
                                                        <td>Mac OS</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Average Battery Life (in hours)</td>
                                                        <td>9</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- /.panel -->

                                        <div class="tab-pane panel entry-content wc-tab" id="tab-reviews">
                                            <div id="reviews" class="electro-advanced-reviews">
                                                <div class="advanced-review row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <h2 class="based-title">Based on 3 reviews</h2>
                                                        <div class="avg-rating">
                                                            <span class="avg-rating-number">4.3</span> overall
                                                        </div>

                                                        <div class="rating-histogram">
                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:100%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:33%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">1</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 4 out of 5">
                                                                    <span style="width:80%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:67%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count">2</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 3 out of 5">
                                                                    <span style="width:60%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 2 out of 5">
                                                                    <span style="width:40%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 1 out of 5">
                                                                    <span style="width:20%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:0%" class="rating-percentage"></span>
                                                                </div>
                                                                <div class="rating-count zero">0</div>
                                                            </div><!-- .rating-bar -->
                                                        </div>
                                                    </div><!-- /.col -->

                                                    <div class="col-xs-12 col-md-6">
                                                        <div id="review_form_wrapper">
                                                            <div id="review_form">
                                                                <div id="respond" class="comment-respond">
                                                                    <h3 id="reply-title" class="comment-reply-title">Add a review
                                                                        <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a>
                                                                        </small>
                                                                    </h3>

                                                                    <form action="#" method="post" id="commentform" class="comment-form">
                                                                        <p class="comment-form-rating">
                                                                            <label>Your Rating</label>
                                                                        </p>

                                                                        <p class="stars">
                                                                            <span><a class="star-1" href="#">1</a>
                                                                                <a class="star-2" href="#">2</a>
                                                                                <a class="star-3" href="#">3</a>
                                                                                <a class="star-4" href="#">4</a>
                                                                                <a class="star-5" href="#">5</a>
                                                                            </span>
                                                                        </p>

                                                                        <p class="comment-form-comment">
                                                                            <label for="comment">Your Review</label>
                                                                            <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                        </p>

                                                                        <p class="form-submit">
                                                                            <input name="submit" type="submit" id="submit" class="submit" value="Add Review" />
                                                                            <input type='hidden' name='comment_post_ID' value='2452' id='comment_post_ID' />
                                                                            <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                                                                        </p>

                                                                        <input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="c7106f1f46" />
                                                                        <script>(function(){if(window===window.parent){document.getElementById('_wp_unfiltered_html_comment_disabled').name='_wp_unfiltered_html_comment';}})();</script>
                                                                    </form><!-- form -->
                                                                </div><!-- #respond -->
                                                            </div>
                                                        </div>

                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->

                                                <div id="comments">

                                                    <ol class="commentlist">
                                                        <li itemprop="review" class="comment even thread-even depth-1">

                                                            <div id="comment-390" class="comment_container">

                                                                <img alt='' src="assets/images/blog/avatar.jpg" class='avatar' height='60' width='60' />
                                                                <div class="comment-text">

                                                                    <div class="star-rating" title="Rated 4 out of 5">
                                                                        <span style="width:80%"><strong itemprop="ratingValue">4</strong> out of 5</span>
                                                                    </div>

                                                                    <p class="meta">
                                                                        <strong>John Doe</strong> &ndash;
                                                                        <time itemprop="datePublished" datetime="2016-03-03T14:13:48+00:00">March 3, 2016</time>:
                                                                    </p>

                                                                    <div itemprop="description" class="description">
                                                                        <p>Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.
                                                                        </p>
                                                                    </div>

                                                                    <p class="meta">
                                                                        <strong itemprop="author">John Doe</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:13:48+00:00">March 3, 2016</time>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </li><!-- #comment-## -->

                                                        <li class="comment odd alt thread-odd thread-alt depth-1">

                                                            <div class="comment_container">

                                                                <img alt='' src="assets/images/blog/avatar.jpg" class='avatar' height='60' width='60' />
                                                                <div class="comment-text">

                                                                    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="Rated 5 out of 5">
                                                                        <span style="width:100%"><strong itemprop="ratingValue">5</strong> out of 5</span>
                                                                    </div>

                                                                    <p class="meta">
                                                                        <strong>Anna Kowalsky</strong> &ndash;
                                                                        <time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00">March 3, 2016</time>:
                                                                    </p>


                                                                    <div itemprop="description" class="description">
                                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus. Etiam justo ligula, placerat ac augue id, volutpat porta dui.
                                                                        </p>
                                                                    </div>

                                                                    <p class="meta">
                                                                        <strong itemprop="author">Anna Kowalsky</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00">March 3, 2016</time>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </li><!-- #comment-## -->

                                                        <li class="comment odd alt thread-odd thread-alt depth-1">

                                                            <div class="comment_container">

                                                                <img alt='' src="assets/images/blog/avatar.jpg" class='avatar' height='60' width='60' />
                                                                <div class="comment-text">

                                                                    <div itemprop="reviewRating" class="star-rating" title="Rated 5 out of 5">
                                                                        <span style="width:100%"><strong itemprop="ratingValue">5</strong> out of 5</span>
                                                                    </div>

                                                                    <p class="meta">
                                                                        <strong>Anna Kowalsky</strong> &ndash;
                                                                        <time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00">March 3, 2016</time>:
                                                                    </p>

                                                                    <div itemprop="description" class="description">
                                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus. Etiam justo ligula, placerat ac augue id, volutpat porta dui.
                                                                        </p>
                                                                    </div>

                                                                    <p class="meta"><strong itemprop="author">Anna Kowalsky</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00">March 3, 2016</time></p>

                                                                </div>
                                                            </div>
                                                        </li><!-- #comment-## -->
                                                    </ol><!-- /.commentlist -->

                                                </div><!-- /#comments -->

                                                <div class="clear"></div>
                                            </div><!-- /.electro-advanced-reviews -->
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
