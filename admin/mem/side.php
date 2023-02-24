<?php 
	$rank =  $_SESSION['role']; 
	if($rank == '2')
	{
		echo '<ul class="metismenu" id="menu">
				<li>
					<a href="index.php" class="has-arrow">
						<div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
				<li class="menu-label">Main Menu</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-5"><i class="bx bx-group"></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
					<ul>
						<li> <a href="customers.php"><i class="bx bx-right-arrow-alt"></i>Customers</a>
						</li>												
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-2"><i class="bx bx-file"></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="add_product.php"><i class="bx bx-plus"></i>Add New Product</a>
						</li>
						<li> <a href="products.php"><i class="bx bx-right-arrow-alt"></i>View Products</a>
						</li>											
					</ul>
				</li>				
				<li>
					<a href="sales.php">
						<div class="parent-icon icon-color-3"> <i class="bx bx-spa"></i>
						</div>
						<div class="menu-title">Sales</div>
					</a>
				</li>
				
				<li>
					<a href="#">
						<div class="parent-icon icon-color-5"><i class="bx bx-envelope"></i>
						</div>
						<div class="menu-title">Reports</div>
					</a>
				</li>
				
				<li>
					<a href="#" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
					<ul>
						<li> <a href="#"><i class="bx bx-right-arrow-alt"></i>FAQs</a>
						</li>	
						<li> <a href="#"><i class="bx bx-right-arrow-alt"></i>User Guides</a>
						</li>										
					</ul>
				</li>
			</ul>';
	}else
	{
		echo '<ul class="metismenu" id="menu">
				<li>
					<a href="index.php" class="has-arrow">
						<div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
				<li class="menu-label">Main Menu</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-5"><i class="bx bx-group"></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
					<ul>
						<li> <a href="customers.php"><i class="bx bx-right-arrow-alt"></i>Customers</a>
						</li>												
					</ul>
				</li>
							
				<li>
					<a href="rides.php">
						<div class="parent-icon icon-color-3"> <i class="bx bx-spa"></i>
						</div>
						<div class="menu-title">Rides</div>
					</a>
				</li>
				
				<li>
					<a href="#">
						<div class="parent-icon icon-color-5"><i class="bx bx-envelope"></i>
						</div>
						<div class="menu-title">Reports</div>
					</a>
				</li>
				
				<li>
					<a href="#" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
					<ul>
						<li> <a href="#"><i class="bx bx-right-arrow-alt"></i>FAQs</a>
						</li>	
						<li> <a href="#"><i class="bx bx-right-arrow-alt"></i>User Guides</a>
						</li>										
					</ul>
				</li>
			</ul>';
	}


