 <?php
    $menu = $fn->viewCategory(0, 0);
?>
 <nav class="navbar navbar-primary navbar-full hidden-md-down">
                <div class="container">
                    <ul class="nav navbar-nav departments-menu animate-dropdown">
                        <li class="nav-item dropdown ">

                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
                            <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                                <li class="highlight menu-item animate-dropdown active"><a title="Value of the Day" href="product-category.html">Value of the Day</a></li>
                                <li class="highlight menu-item animate-dropdown"><a title="Top 100 Offers" href="home-v3.html">Top 100 Offers</a></li>
                                <li class="highlight menu-item animate-dropdown"><a title="New Arrivals" href="home-v3-full-color-background.html">New Arrivals</a></li>

                                
                            <?php
                                if($menu){
                                    foreach($menu as $key){
                                        $m = (object) $key;
                                        if(($nmenu = $fn->viewSubCategory($m->id))){
                            
                                            echo "<li id='menu-item-2695' class='menu-item menu-item-has-children animate-dropdown dropdown'>
                                                    <a title='Accessories' data-hover='dropdown' href='shop.php?cat={$m->id}' data-toggle='dropdown' class='dropdown-toggle' aria-haspopup='true'>
                                                        {$m->cat_name}</a>";
                                            
                                            echo "<ul role='menu' class='dropdown-menu'>";
                                            foreach($nmenu as $mu){
                                                $n = (object) $mu;
                                                echo "<li class='menu-item animate-dropdown'><a title='{$n->cat_name}' href='shop.php?cat={$n->id}'>{$n->cat_name}</a></li>";
                                            }
                                            echo '</ul></li>';                                                    
                                            
                                        }
                                        else{

                                            echo "<li class='menu-item animate-dropdown'>
                                                <a title='Value of the Day' href='./shop.php?cat={$m->id}'>{$m->cat_name}</a>
                                            </li>"; 

                                        }
                                    }
                                }
                            ?>  

                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-search" method="get" action="/">
                        <label class="sr-only screen-reader-text" for="search">Search for:</label>
                        <div class="input-group">
                            <input type="text" id="search" class="form-control search-field" dir="ltr" value="" name="s" placeholder="Search for products" />
                            <div class="input-group-addon search-categories">
                                <!--
                                <select name='product_cat' id='product_cat' class='postform resizeselect' >
                                    <option value='0' selected='selected'>All Categories</option>
                                    <option class="level-0" value="laptops-laptops-computers">Laptops</option>
                                    <option class="level-0" value="ultrabooks-laptops-computers">Ultrabooks</option>
                                    <option class="level-0" value="mac-computers-laptops">Mac Computers</option>
                                    <option class="level-0" value="all-in-one-laptops-computers">All in One</option>
                                    <option class="level-0" value="servers">Servers</option>
                                    <option class="level-0" value="peripherals">Peripherals</option>
                                    <option class="level-0" value="gaming-laptops-computers">Gaming</option>
                                    <option class="level-0" value="accessories-laptops-computers">Accessories</option>
                                    <option class="level-0" value="audio-speakers">Audio Speakers</option>
                                    <option class="level-0" value="headphones">Headphones</option>
                                    <option class="level-0" value="computer-cases">Computer Cases</option>
                                    <option class="level-0" value="printers">Printers</option>
                                    <option class="level-0" value="cameras">Cameras</option>
                                    <option class="level-0" value="smartphones">Smartphones</option>
                                    <option class="level-0" value="game-consoles">Game Consoles</option>
                                    <option class="level-0" value="power-banks">Power Banks</option>
                                    <option class="level-0" value="smartwatches">Smartwatches</option>
                                    <option class="level-0" value="chargers">Chargers</option>
                                    <option class="level-0" value="cases">Cases</option>
                                    <option class="level-0" value="headphone-accessories">Headphone Accessories</option>
                                    <option class="level-0" value="headphone-cases">Headphone Cases</option>
                                    <option class="level-0" value="tablets">Tablets</option>
                                    <option class="level-0" value="tvs">TVs</option>
                                    <option class="level-0" value="wearables">Wearables</option>
                                    <option class="level-0" value="pendrives">Pendrives</option>
                                </select> 
                                -->
                            </div>
                            <div class="input-group-btn">
                                <input type="hidden" id="search-param" name="post_type" value="product" />
                                <button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <?php
                        $cart = $fn->viewCart(session_id());
                        $cartTotal = 0;
                        $cartCount = 0;
                        if($cart){
                            foreach($cart as $key){
                                $ct = (object) $key;
                                $citem = $fn->viewItem($ct->prod_id);
                                $price = ($c = $fn->viewItemDiscount($ct->prod_id)) ? $fn->discount($citem->price, $c->discount_rate) : $citem->price;
                                $cartTotal += $price*$ct->qty;
                                $cartCount += $ct->qty;
                            }
                        }
                    ?>

                    <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
                    <?php
								$WishListArr = $fn->viewWish(session_id());
								$wlist = (isset($WishListArr)) ? count($WishListArr) : 0;
						?>
						<li class="nav-item">
							<a href="wishlist.php" class="nav-link">
								<i class="ec ec-favorites"></i>
								<span class="cart-items-count count"><?=$wlist;?></span>
							</a>
						</li>
                        <li class="nav-item dropdown">
                            <a href="cart.html" class="nav-link" data-toggle="dropdown">
                                <i class="ec ec-shopping-bag"></i>
                                <span class="cart-items-count count"><?=$cartCount;?></span>
                                <span class="cart-items-total-price total-price"><span class="amount"><!--<?=$fn->nairaValue($cartTotal);?> --></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-mini-cart">
                                <li>
                                    <div class="widget_shopping_cart_content">

                                        <ul class="cart_list product_list_widget ">


                                        <?php
												if($cart){
													foreach($cart as $key){
														$ct = (object) $key;
														$citem = $fn->viewItem($ct->prod_id);
														$price = ($c = $fn->viewItemDiscount($ct->prod_id)) ? $fn->discount($citem->price, $c->discount_rate) : $citem->price;

											?>
                        						<li class="mini_cart_item">
                        							<a title="Remove this item" class="remove" href="./php/forms.php?code=2&item=<?=$ct->id;?>">×</a>
                        							<a href="single-product.php?id=<?=$ct->prod_id;?>">
                        								<img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="assets/images/product/<?=$citem->display_image;?>" alt=""><?=$citem->prod_name;?>
                        							</a>

                        							<span class="quantity"><?=$ct->qty;?> × <span class="amount"><?= $fn->nairaValue(($price*$ct->qty));?></span></span>
                        						</li>
												
											<?php
													}
												}
											?>


                                        </ul><!-- end product list -->


                                        <p class="total"><strong>Subtotal:</strong> <span class="amount"><?= $fn->nairaValue(($cartTotal));?></span></p>


                                        <p class="buttons">
                                            <a class="button wc-forward" href="cart.php">View Cart</a>
                                            <a class="button checkout wc-forward" href="checkout.php">Checkout</a>
                                        </p>


                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a title="My Account" href="account3.php" class="nav-link" style="color:#FFF">
                                <i class="ec ec-user"></i>
                                <?php if(isset($_SESSION['loginset']) ){ echo "Hi ".$_SESSION['username'];} else {echo "My Account";} ?>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>