<!--
<div class="top-bar hidden-md-down">
                <div class="container">
                    <nav>
                        <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Welcome to Worldwide Electronics Store" href="./">Welcome to Abamade Ecommerce Platform</a></li>
                        </ul>
                    </nav>

                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                            --<li class="menu-item animate-dropdown"><a title="Store Locator" href="#"><i class="ec ec-map-pointer"></i>Store Locator</a></li>
                            <li class="menu-item animate-dropdown"><a title="Track Your Order" href="#"><i class="ec ec-transport"></i>Track Your Order</a></li>
                            <li class="menu-item animate-dropdown"><a title="Shop" href="shop.php"><i class="ec ec-shopping-bag"></i>Shop</a></li>--
                            <li class="menu-item animate-dropdown"><a title="My Account" href="my-account.php"><i class="ec ec-user"></i>My Account</a></li>
                        </ul>
                    </nav>
                </div>
            </div>-- /.top-bar -->
            <?php
                if(isset($_SESSION['msg'])) 
                {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>