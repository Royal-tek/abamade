 <div class="container hidden-lg-up">
                    <div class="handheld-header">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                            <a href="index.php" class="header-logo-link">
                                 <img src="./assets/images/logo.png">    
                            </a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->

                        <div class="handheld-navigation-wrapper">   
                            <div class="handheld-navbar-toggle-buttons clearfix"> 
                                <button class="navbar-toggler navbar-toggle-hamburger hidden-lg-up pull-right flip" type="button"> 
                                    <i class="fa fa-bars" aria-hidden="true"></i> 
                                </button> 
                                <button class="navbar-toggler navbar-toggle-close hidden-lg-up pull-right flip" type="button"> 
                                    <i class="ec ec-close-remove"></i> 
                                </button>
                            </div>  
                            <div class="handheld-navigation hidden-lg-up" id="default-hh-header"> 
                                <span class="ehm-close">Close</span>
                                <ul id="menu-all-departments-menu-1" class="nav nav-inline yamm">
                                <?php
                                    if($menu){
                                        foreach($menu as $key){
                                            $m = (object) $key;
                                            if(($nmenu = $fn->viewSubCategory($m->id))){
                                
                                                echo "<li class='yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown'>
                                                        <a title='{$m->cat_name}' data-toggle='dropdown' class='dropdown-toggle' aria-haspopup='true' href='shop.php?cat={$m->id}'>
                                                            {$m->cat_name}
                                                        </a>";
                                                
                                                echo    '<ul role="menu" class=" dropdown-menu">
                                                            <li class="menu-item animate-dropdown ">
                                                                <div class="yamm-content">
                                                                    <ul>';
                                                foreach($nmenu as $mu){
                                                    $n = (object) $mu;
                                                    echo "<li><a title='{$n->cat_name}' href='shop.php?cat={$n->id}'>{$n->cat_name}</a></li>";
                                                }
                                                echo '</ul></div></li></ul>';                                                    
                                                
                                            }
                                            else{

                                                echo "<li class='highlight menu-item animate-dropdown'>
                                                    <a title='{$m->cat_name}' href='./shop.php?cat={$m->id}'>{$m->cat_name}</a>
                                                </li>"; 

                                            }
                                        }
                                    }
                                ?>  
                                    <li class="highlight menu-item animate-dropdown ">
                                        <a title="My Cart" href="cart.php">My Cart</a>
                                    </li>
                                    <li class="highlight menu-item animate-dropdown ">
                                        <a title="My Wish List" href="wishlist.php">Wish List</a>
                                    </li>
                                    <li class="highlight menu-item animate-dropdown ">
                                        <a title="My Account" href="account3.php">My Account</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        </div>
                </div>