<?php
    $menu = $fn->viewCategory(0, 0);
?>
<div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                        	<a href="./index.php" class="header-logo-link">
                                <img src="./assets/images/logo.png">                        		
                        	</a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->
						<ul class="nav navbar-nav departments-menu animate-dropdown">
							<li class="nav-item dropdown ">

								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle"><i class="fa fa-bars"></i></a>
								<ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown"> 
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
                        <form class="navbar-search" method="post" action="search.php">
                        	<label class="sr-only screen-reader-text" for="search">Search for:</label>
                        	<div class="input-group">
                        		<input type="text" id="search" class="form-control search-field" dir="ltr" value="" name="search" placeholder="Search for products" />
                        		<div class="input-group-addon search-categories">
                        			
                        		</div>
                        		<div class="input-group-btn">
                        			<input type="hidden" id="search-param" name="post_type" value="product" />
                        			<button type="submit" class="btn btn-secondary" name="searchBtn"><i class="ec ec-search"></i></button>
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
                        <ul class="navbar-mini-cart navbar-nav nav pull-right flip">
                        	<li class="nav-item">
                        		<a href="cart.php" class="nav-link">
                        			<i class="ec ec-shopping-bag"></i>
                        			<span class="cart-items-count count"><?=$cartCount;?></span>
                        			<span class="cart-items-total-price total-price"><span class="amount"><?=$fn->nairaValue($cartTotal);?></span></span>
                        		</a>
                        		
                        	</li>
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
							<li class="nav-item">
								<a title="My Account" href="account3.php" class="nav-link">
									<i class="ec ec-user"></i><?php if(isset($_SESSION['loginset']) ){ echo "Hi ".$_SESSION['username'];} else {echo "Account";} ?>
								</a>
							</li>
                        </ul>
                    </div><!-- /.row -->