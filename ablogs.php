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

    <body class="blog blog-list right-sidebar">
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

            		<nav class="woocommerce-breadcrumb">
            			<a href="home.php">Home</a>
            			<span class="delimiter"><i class="fa fa-angle-right"></i></span>Blog
            		</nav>

            		<div id="primary" class="content-area">
            			<main id="main" class="site-main">
							<?php
								if($blogs = $fn->viewBlogs(0, 5, 0)){
									foreach($blogs as $key){
										$blg = (object) $key;
										$bcategory = $fn->viewBlogCatDetail($blg->blog_cat);
										$short = strip_tags($blg->descr);
							?>
							
            				<article class="post format-gallery hentry">

            					<div class="media-attachment">
            						<a href="blog-single.php?id=<?=$blg->id;?>">
            							<img width="430" height="245" src="assets/images/blog/<?=$blg->image;?>" class="wp-post-image" alt="1" />
									</a>
            					</div><!-- .media-attachment -->

            					<div class="content-body">
            						<header class="entry-header">
            							<h1 class="entry-title" itemprop="name headline">
            								<a href="blog-single.php?id=<?= $blg->id;?>" rel="bookmark"><?= $blg->title; ?></a>
            							</h1>

            							<div class="entry-meta">
            								<span class="cat-links">
            									<a href="blogs.php?id=<?= $blg->blog_cat;?>" rel="category tag"><?= $bcategory->cat_name;?></a>
            								</span>

            								<span class="posted-on">
            									<a href="blog-single.php?id=<?=$blg->id;?>" rel="bookmark">
            										<time class="entry-date published" datetime="<?= date("Y-m-d H:i:s", strtotime($blg->whens));?>"><?= date('M d, Y', strtotime($blg->whens));?></time>
            										<time class="updated" datetime="2016-03-04T18:46:11+00:00" itemprop="datePublished">March 4, 2016</time>
            									</a>
            								</span>
            							</div>
            						</header><!-- .entry-header -->

            						<div class="entry-content">

            							<p><?= substr($short, 0, 120) ?> ...</p>

            						</div><!-- .entry-content -->

            						<div class="post-readmore">
            							<a href="blog-single.php?id=<?=$blg->id;?>" class="btn btn-primary">Read More</a>
            						</div><!-- .post-readmore -->

            						<span class="comments-link">
            							<a href="#">3</a>
            						</span><!-- .comments-link -->
            					</div><!-- .content-body -->
            				</article><!-- #post-## -->

							<?php
									}
								}

							?>
							

            				<nav class="navigation pagination">
                                <h2 class="screen-reader-text">Posts navigation</h2>
                                <div class="nav-links">
                                    <ul class='page-numbers'>
                                        <li><span class='page-numbers current'>1</span></li>
                                        <li><a class='page-numbers' href='#'>2</a></li>
                                        <li><a class="next page-numbers" href="#">Next&nbsp;<span class="meta-nav">&rarr;</span></a></li>
                                    </ul>
                                </div>
                            </nav>


            			</main>
            		</div><!-- /#primary -->

            		<div id="sidebar" class="sidebar-blog" role="complementary">
                        <aside class="widget widget_text">
                            <h3 class="widget-title">About Blog</h3>
                            <div class="textwidget">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, erat in malesuada aliquam, est erat faucibus purus, eget viverra nulla sem vitae neque. Quisque id sodales libero.</div>
                        </aside>
                                    <aside class="widget widget_categories">
                            <h3 class="widget-title">Categories</h3>
                            <ul>
								<?php
									if($catList = $fn->viewBlogCategory()){
										foreach($catList as $key){
											$cl = (object) $key;
											echo "<li class='cat-item'><a href='blogs.php?id={$cl->blog_cat_id}'>{$cl->cat_name}</a></li>";
										}
									}
								?>
                        	</ul>
                        </aside>
                        <aside class="widget electro_recent_posts_widget"><h3 class="widget-title">Recent Posts</h3>
                            <ul>
								<?php
									if($recentBlog = $fn->viewRecentBlog()){
										foreach($recentBlog as $key){
											$rcb = (object) $key;
								?>
								
                                <li>
                                    <a class="post-thumbnail" href="blog-single.php?id=<?= $rcb->id;?>">
										<img width="150" height="150" src="assets/images/blog/<?= $rcb->image;?>" class="wp-post-image" alt="1"/>
									</a>
                                    <div class="post-content">
                                        <a class ="post-name" href="blog-single.php?id=<?= $rcb->id;?>"><?= $rcb->title;?></a>
                                        <span class="post-date"><?= date("M d, Y", strtotime($rcb->whens));?></span>
                                    </div>
                                </li>

								<?php
										}
									}

								?>
                        	</ul>
                        </aside>
                        <aside id="tag_cloud-2" class="widget widget_tag_cloud"><h3 class="widget-title">Adverts</h3>
                            <div class="tagcloud">
                                <!--<a href='#' class='' title='10 topics' style='font-size: 22pt;'>amazon like</a>
                                <a href='#' class='' title='10 topics' style='font-size: 22pt;'>Awesome</a>-->
                                <img src="./assets/images/4.jpg">
                                
                            </div>
                        </aside>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.site-content -->

            

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
