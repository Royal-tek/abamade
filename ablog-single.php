<?php
    include './php/funct.php';
    $fn = new funct();
    if(! isset($_GET['id'])){
        header("location: ./blogs.php");
        exit;
    }
    $id = $_GET['id'];
    $detail = $fn->viewSingleBlog($id);
    $blogCat = $fn->viewBlogCatDetail($detail->blog_cat);

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

    <body class="single-post right-sidebar">
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

                    <nav itemprop="breadcrumb" class="woocommerce-breadcrumb"><a href="index.php">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span><a href="blogs.php">Blogs</a><span class="delimiter"><i class="fa fa-angle-right"></i></span><?= $detail->title;?></nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="post type-post status-publish format-gallery has-post-thumbnail hentry" >
                                <div class="media-attachment">
                                    <div class="media-attachment-gallery">
                                        <div class=" ">
                                            <div class="item">
                                                <figure>
                                                    <img width="1144" height="600" src="assets/images/blog/<?= $detail->image;?>" class="attachment-post-thumbnail size-post-thumbnail" alt="1" />
                                                </figure>
                                            </div><!-- /.item -->
                                        </div>
                                    </div><!-- /.media-attachment-gallery -->
                                </div>

                                <header class="entry-header">
                                    <h1 class="entry-title" itemprop="name headline"><?=$detail->title;?>
                                        <!--<span class="comments-link">
                                            <a href="#comments">Leave a comment</a>
                                        </span>-->
                                    </h1>

                                    <div class="entry-meta">
                                        <span class="cat-links"><a href="./blogs.php?id=<?= $detail->cat_id;?>" rel="category tag"><?= $blogCat->cat_name;?></a></span>
                                        <span class="posted-on"><a href="#" rel="bookmark">
                                            <time class="entry-date published" datetime="<?=date("Y-m-d H:i:s", strtotime($detail->whens));?>"><?= date("M d, Y", strtotime($detail->whens));?></time> 
                                            <time class="updated" datetime="<?=date("Y-m-d H:i:s", strtotime($detail->whens));?>" itemprop="datePublished"><?=date("M d, Y", strtotime($detail->whens));?></time></a>
                                        </span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content" itemprop="articleBody">
                                    <?=$detail->descr;?>
                                </div><!-- .entry-content -->
                            </article>
                            <div class="post-author-info">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#"><img src="assets/images/blog/avatar.jpg" alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#"><?=$detail->owner;?></a></h4>

                                    </div>
                                </div>
                            </div>
                            <nav class="navigation post-navigation">
                                <h2 class="screen-reader-text">Post navigation</h2>
                                <div class="nav-links"><div class="nav-previous"><a rel="prev" href="#"><span class="meta-nav">←</span>&nbsp;Robot Wars &ndash; Now Closed &ndash; Post with Audio</a></div></div>
                            </nav>
                            <div class="comments-area" id="comments">

                                <h2 class="comments-title">3 Comments</h2>

                                <ol class="comment-list">
                                    <li id="comment-396" class="comment even thread-even depth-1">
                                        <div class="media">
                                            <div class="gravatar-wrapper media-left">
                                                <img class="avatar avatar-100 photo" src="assets/images/blog/avatar.jpg" alt="">
                                            </div>

                                            <div class="comment-body media-body">

                                                <div class="comment-content" id="div-comment-396">
                                                    <p>Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>
                                                </div>

                                                <div class="comment-meta" id="div-comment-meta-396">
                                                    <div class="author vcard">
                                                        <cite class="fn media-heading">John Doe</cite>
                                                    </div>

                                                    <div class="date">
                                                        <a class="comment-date" href="#">March 16, 2016</a>
                                                    </div>

                                                    <div class="reply">
                                                        <a aria-label="Reply to John Doe" onclick="return addComment.moveForm( &quot;div-comment-meta-396&quot;, &quot;396&quot;, &quot;respond&quot;, &quot;2415&quot; )" href="#" class="comment-reply-link" rel="nofollow">Reply</a>
                                                    </div>
                                                </div>

                                            </div><!-- /.comment-body -->
                                        </div><!-- /.media -->
                                    </li><!-- #comment-## -->
                                    <li id="comment-397" class="comment odd alt thread-odd thread-alt depth-1">
                                        <div class="media">
                                            <div class="gravatar-wrapper media-left">
                                                <img class="avatar avatar-100 photo" src="assets/images/blog/avatar.jpg" alt="">
                                            </div>

                                            <div class="comment-body media-body">

                                                <div class="comment-content" id="div-comment-397">
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus.</p>
                                                </div>

                                                <div class="comment-meta" id="div-comment-meta-397">
                                                    <div class="author vcard">
                                                        <cite class="fn media-heading">Anna Kowalsky</cite>
                                                    </div>

                                                    <div class="date">
                                                        <a class="comment-date" href="#">March 16, 2016</a>
                                                    </div>

                                                    <div class="reply">
                                                        <a aria-label="Reply to Anna Kowalsky" onclick="return addComment.moveForm( &quot;div-comment-meta-397&quot;, &quot;397&quot;, &quot;respond&quot;, &quot;2415&quot; )" href="#" class="comment-reply-link" rel="nofollow">Reply</a>
                                                    </div>
                                                </div>

                                            </div><!-- /.comment-body -->
                                        </div><!-- /.media -->
                                    </li><!-- #comment-## -->
                                    <li class="comment even thread-even depth-1">
                                        <div class="media">
                                            <div class="gravatar-wrapper media-left">
                                                <img class="avatar avatar-100 photo" src="assets/images/blog/avatar.jpg" alt="">
                                            </div>

                                            <div class="comment-body media-body">

                                                <div class="comment-content" id="div-comment-398">
                                                    <p>Sed id tincidunt sapien. Pellentesque cursus accumsan tellus, nec ultricies nulla sollicitudin eget. Donec feugiat orci vestibulum porttitor sagittis.</p>
                                                </div>

                                                <div class="comment-meta" id="div-comment-meta-398">
                                                    <div class="author vcard">
                                                        <cite class="fn media-heading">Peter Wargner</cite>
                                                    </div>

                                                    <div class="date">
                                                        <a class="comment-date" href="#">March 16, 2016</a>
                                                    </div>

                                                    <div class="reply">
                                                        <a aria-label="Reply to Peter Wargner" onclick="return addComment.moveForm( &quot;div-comment-meta-398&quot;, &quot;398&quot;, &quot;respond&quot;, &quot;2415&quot; )" href="#" class="comment-reply-link" rel="nofollow">Reply</a>
                                                    </div>
                                                </div>

                                            </div><!-- /.comment-body -->
                                        </div><!-- /.media -->
                                    </li><!-- #comment-## -->
                                </ol><!-- .comment-list -->

                                <div class="comment-respond" id="respond">
                                    <h3 class="comment-reply-title" id="reply-title">Leave a Reply <small><a style="display:none;" href="#" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a></small></h3>
                                    <form novalidate="" class="comment-form" id="commentform" method="post" action="#">
                                        <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p><p class="comment-form-comment"><label for="comment">Comment</label> <textarea required="required" maxlength="65525" rows="8" cols="45" name="comment" id="comment"></textarea></p><p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input type="text" required="required" aria-required="true" maxlength="245" size="30" value="" name="author" id="author"></p>
                                        <p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input type="email" required="required" aria-required="true" aria-describedby="email-notes" maxlength="100" size="30" value="" name="email" id="email"></p>
                                        <p class="comment-form-url"><label for="url">Website</label> <input type="url" maxlength="200" size="30" value="" name="url" id="url"></p>
                                        <p class="form-submit"><input type="submit" value="Post Comment" class="submit"></p>
                                    </form>
                                </div><!-- #respond -->

                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->

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
                               <img src="./assets/images/4.jpg">
                            </div>
                        </aside>
                    </div>
                </div><!-- .container -->
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
