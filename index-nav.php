<?php
    $menu = $fn->viewCategory(0, 0);
?>

<div class="col-xs-12 col-lg-3">
    <nav>
        <ul class="list-group vertical-menu yamm make-absolute">
            <li class="list-group-item"><span><i class="fa fa-list-ul"></i> All Departments</span></li>

            <li class="highlight menu-item animate-dropdown"><a title="Value of the Day" href="./shop.php?value ">Value of the Day</a></li>

            <li class="highlight menu-item animate-dropdown"><a title="Top 100 Offers" href="./shop.php?topOffers">Top 100 Offers</a></li>

            <li class="highlight menu-item animate-dropdown"><a title="New Arrivals" href="./shop.php?arrival">New Arrivals</a></li>

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
    </nav>
</div>