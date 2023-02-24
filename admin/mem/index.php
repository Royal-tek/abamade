<?php 
include_once '../assets/php/initiator.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="Tacoee Consults Ltd - https://tacoee.com" />
	<meta name="description" content="ABAMADE Administrative Platform" />
	<title>ABAMADE eCommerce Platform | Register</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/css/dark-sidebar.css" />
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div class="">
					<img src="assets/images/logo-img.png" alt="" width="80%" />
				</div>
				
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<!--navigation-->
			<?php 
			if($_SESSION['role']=='2')
			{
				include_once 'side.php'; 

			}else
			{
				include_once 'side2.php'; 
			}

			
			?>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<?php include_once 'top.php'; ?>
		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="row">
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-voilet">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white"><?php echo $totalOrders; ?> <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-cart-alt"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Platform Sales</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-primary-blue">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white"><?php echo $totalProducts; ?> <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-file"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">My Products</p>
										</div>
									
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-rose">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white"><?php echo $totalVendors; ?> <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-group"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Total Vendors</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--
						<div class="col-12 col-lg-3">
							<div class="card radius-15 bg-sunset">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white"><?php echo $totalCustomers; ?> <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-user"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Platform Customers</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						-->
					</div>
					<!--end row-->
					
					<!-- graph div section
					<div class="card radius-15">
						<div class="card-header border-bottom-0">
							<div class="d-lg-flex align-items-center">
								<div>
									<h5 class="mb-2 mb-lg-0">Sales Update</h5>
								</div>
								<div class="ml-lg-auto mb-2 mb-lg-0">
									<div class="btn-group-round">
										<div class="btn-group">
											<button type="button" class="btn btn-white">Daily</button>
											<button type="button" class="btn btn-white">Weekly</button>
											<button type="button" class="btn btn-white">Monthly</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div id="chart1"></div>
						</div>
					</div>
					-->

					<div class="card radius-15">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Recent Orders</h5>
								</div>
								<div class="ml-auto">
									<a href="./sales.php" type="button" class="btn btn-white radius-15">View More</a>
								</div>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Photo</th>
											<th>Customer</th>
											<th>Shipment</th>											
											<th>Order id</th>
											<th>Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php

											if(!empty($dashOrders))
											{
												foreach ($dashOrders as $key => $value) {
													echo $value;
												}
											} 
										?>									
									</tbody>
								
								</table>
							</div>
						</div>
					</div>


					
						
					<div class="row">
						<div class="col-12 col-lg-12 ">
							<div class="card radius-15 w-100">
								<div class="card-body">
							
							<div class="d-flex align-items-center">
								<div>
									<h4 class="mb-0">Activity Log</h4>
								</div>
								<div class="ml-auto">
									<a href="./logs.php" type="button" class="btn btn-white radius-15">View All</a>
								</div>
							</div>
							<hr/>
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>#</th>
											<th>User</th>
											<th>Activity</th>
											<th>Date</th>											
										</tr>
									</thead>
									<tbody>
										<?php
											if(!empty($logs))
											{
												foreach ($logs as $key => $value) {
													echo $value;
												}
											}
										?>										
								</table>
							</div>	
								</div>
								
							</div>
						</div>
					
					</div>
					<!--end row-->
					
					<!--end row-->
					
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
		<!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->
		<?php include_once 'foot.php'; ?>
		<!-- end footer -->
	</div>
	
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="assets/js/index2.js"></script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>
</body>

</html>