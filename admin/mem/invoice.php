<?php 
include_once '../assets/php/initiator.php';
if(!isset($_GET['id']))
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{
	$inv = $_GET['id'];
	$currOrder = $functioner->getOneOrder($inv);
	$did = $currOrder['id'];
	$currInvoice = $functioner->getOrdDetail($did);	
	$cust = $functioner->getOneCustomer($currOrder['user_id']);
	
	$ordTax = $currOrder['amount'] * 0.075;
	$tot = $ordTax + $currOrder['amount'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="Tacoee Consults Ltd - https://tacoee.com" />
	<meta name="description" content="ABAMADE Administrative Platform" />
	<title>ABAMADE eCommerce Platform | Invoice</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
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
			<?php include_once 'side.php'; ?>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<?php include_once 'top.php'; ?>
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Invoice</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Invoice</li>
								</ol>
							</nav>
						</div>
						<!--<div class="ml-auto">
							<div class="btn-group">
								<button type="button" class="btn btn-primary">Settings</button>
								<button type="button" class="btn btn-primary bg-split-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">	<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">	<a class="dropdown-item" href="javascript:;">Action</a>
									<a class="dropdown-item" href="javascript:;">Another action</a>
									<a class="dropdown-item" href="javascript:;">Something else here</a>
									<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
								</div>
							</div>
						</div>-->
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-body">
							<div id="invoice">
								<div class="toolbar hidden-print">
									<div class="text-right">
										<button type="button" onclick="window.print();" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
										<!--<button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>   -->
									</div>
									<hr/>
								</div>
								<div class="invoice overflow-auto">
									<div style="min-width: 600px">
										<header>
											<div class="row">
												<div class="col">
													<a href="javascript:;">
														<img src="assets/images/logo-img.png"  alt="" />
													</a>
												</div>
												<div class="col company-details">
													<h2 class="name">
												<a target="_blank" href="javascript:;">
												<?php echo $sysInfo['title']; ?>
												</a>
											</h2>
													<div><?php echo $sysInfo['address']; ?></div>
													<div><?php echo $sysInfo['phone']; ?></div>
													<div><?php echo $sysInfo['email']; ?></div>
												</div>
											</div>
										</header>
										<main>
											<div class="row contacts">
												<div class="col invoice-to">
													<div class="text-gray-light">INVOICE TO:</div>
													<h2 class="to"><?php echo $cust['f_name']; ?></h2>
													<div class="address"><?php echo $cust['address']; ?></div>
													<div class="email"><a href="mailto:john@example.com"><?php echo $cust['phone']; ?></a>
													</div>
												</div>
												<div class="col invoice-details">
													<h2 class="invoice-id">INVOICE <?php echo $inv; ?></h2>
													<div class="date">Date of Invoice: <?php echo date('Y-M-d', strtotime($currOrder['created'])); ?></div>
												<!--<div class="date">Due Date: 30/10/2018</div>-->
												</div>
											</div>
											<table>
												<thead>
													<tr>
														<th>#</th>
														<th class="text-left">DESCRIPTION</th>
														<th class="text-right">PRICE</th>
														<th class="text-right">QTY</th>
														<th class="text-right">TOTAL</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
													<?php 
														if(!empty($currInvoice))
														{
															foreach ($currInvoice as $key => $value) {
																echo $value;
															}
														}
													?>
													
												</tbody>
												<tfoot>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">SUBTOTAL</td>
														<td>N<?php echo $currOrder['amount']; ?></td>
													</tr>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">TAX 7.5%</td>
														<td>N<?php echo $ordTax; ?></td>
													</tr>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">GRAND TOTAL</td>
														<td>N<?php echo $tot; ?></td>
													</tr>
												</tfoot>
											</table>
											<div class="thanks">Thank you!</div>
											<div class="notices">
												<div>NOTICE:</div>
												<div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
											</div>
										</main>
										<footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
									</div>
									<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
									<div></div>
								</div>
							</div>
						</div>
					</div>
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
	<!-- end wrapper -->
	
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>
</body>

</html>