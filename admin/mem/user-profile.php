<?php 
include_once '../assets/php/initiator.php';
$id =  $_SESSION['user_id'];
$currMem = $functioner->getOneMember($id);
	

	

?><!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="Tacoee Consults Ltd - https://tacoee.com" />
	<meta name="description" content="ABAMADE Administrative Platform" />
	<title>ABAMADE eCommerce Platform | Member Profile</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<!--Data Tables -->
	<link href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
		<!--end header-->
		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Profile</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="index.php"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>


						<!--<div class="ml-auto">
							<div class="btn-group">
								<button type="button" class="btn btn-primary">Settings</button>
								<button type="button" class="btn btn-primary bg-split-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">	<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">	<a class="dropdown-item" href="javascript:;">Export to Excel</a>
									<a class="dropdown-item" href="javascript:;">Send Mail</a>
									<a class="dropdown-item" href="javascript:;">Send SMS</a>
									<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Promo</a>
								</div>
							</div>
						</div>-->
					</div>
					<!--end breadcrumb-->
	<div class="user-profile-page">
						<div class="card radius-15">
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-lg-7 border-right">
										<div class="d-md-flex align-items-center">
											<div class="mb-md-0 mb-3">
												<img src="./assets/images/icons/user.png" class="rounded-circle shadow" width="130" height="130" alt="" />
											</div>
											<div class="ml-md-4 flex-grow-1">
												<div class="d-flex align-items-center mb-1">
													<h4 class="mb-0"><?php echo $currMem['fullname']; ?></h4>
													
												</div>
												<p class="mb-0 text-muted"><?php echo $currMem['types']; ?></p>												
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-5">
										<table class="table table-sm table-borderless mt-md-0 mt-3">
											<tbody>
												<tr>
													<th>Reg Date:</th>
													<td><?php echo date('d M, Y', strtotime($currMem['regDate'])); ?>
													</td>
												</tr>
												<tr>
													<th>Gender:</th>
													<td>NA
													</td>
												</tr>
												<tr>
													<th>Age:</th>
													<td>Adult</td>
												</tr>
												<tr>
													<th>Location:</th>
													<td><?php echo $currMem['address']; ?></td>
												</tr>
												<tr>
													<th>Contact:</th>
													<td><?php echo $currMem['phone']; ?> | <?php echo $currMem['email']; ?></td>
												</tr>
											</tbody>
										</table>
										<!--<div class="mb-3 mb-lg-0"> <a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-github'></i></a>
											<a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-twitter'></i></a>
											<a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-facebook'></i></a>
											<a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-linkedin'></i></a>
											<a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-dribbble'></i></a>
											<a href="javascript:;" class="btn btn-sm btn-link"><i class='bx bxl-stack-overflow'></i></a>
										</div>-->
									</div>
								</div>
								<!--end row-->
								<ul class="nav nav-pills">
									<!--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Experience"><span class="p-tab-name">Sales</span><i class='bx bx-donate-blood font-24 d-sm-none'></i></a>
									</li>-->
									<li class="nav-item"> <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#Biography"><span class="p-tab-name">Biography</span><i class='bx bxs-user-rectangle font-24 d-sm-none'></i></a>
									</li>
									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Edit-Profile"><span class="p-tab-name">Edit Profile</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#edit-setting"><span class="p-tab-name">Edit Settings</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
									<p><span style="color: #cc0000;"><?php echo (isset($_SESSION['errMsg']) ? $_SESSION['errMsg']:""); unset($_SESSION['errMsg']); ?></span></p>
								</ul>
								<div class="tab-content mt-3">
									
									<div class="tab-pane fade show active" id="Biography">
										<div class="row">
											<div class="col-lg-4">
												<div class="card shadow-none border mb-0">
													<div class="card-body">
														<h5 class="mb-3">Websites</h5>
													</div>
													<ul class="list-group list-group-flush">
														<li class="list-group-item">
															<p class="mb-0"><i class='bx bx-globe'></i> Website: <a href="javascript:;">tacoee.com</a>
															</p>
														</li>
														
														<li class="list-group-item">
															<p class="mb-0"><i class='bx bx-images'></i> Bank Details: <br/>
															<a href="javascript:;">Bank: <?php  echo $currMem['bank'];  ?></a><br/>
															<a href="javascript:;">Acc. <?php  echo $currMem['account'];  ?></a><br/>
															<a href="javascript:;">Name: <?php  echo $currMem['acc_name'];  ?></a>
															</p>
														</li>
													</ul>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="card shadow-none border mb-0 radius-15">
													<div class="card-body">
														<h5 class="mb-3">About</h5>
														<p><a href="javascript:;"><?php  echo $currMem['bio'];  ?></a></p>
														<hr>	
													</div>
												</div>
											</div>
										</div>
									</div>


									<div class="tab-pane fade" id="Edit-Profile">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												<div class="form-body">
													<div class="row">
														<div class="col-12 col-lg-5 border-right">
															<h4>Update Bank Details</h4>
															<form method="POST" action="../assets/php/forms.php?code=6">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<label>Bank Name</label>
																	<input type="text" name="bank" value="" class="form-control" required="">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-12">
																	<label>Account Name</label>
																	<input type="text" name="accname" value="" class="form-control" required="">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-12">
																	<label>Account Number</label>
																	<input type="text" name="acc" value="" class="form-control" required="">
																</div>
															</div>

															<div class="form-group">
																<input type="submit" name="submit" value="Update Bank" class="btn btn-success">
															</div>
														</form>
															
														</div>
														<div class="col-12 col-lg-7">
															<?php 
																if( $_SESSION['role']==2)
																{
																	echo '<h4>Update Profile</h4>
															<form method="POST" action="../assets/php/forms.php?code=8">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<label>About Company</label>
																	<textarea class="form-control" id="mytextarea" name="descr"  required="">Description!</textarea>
																</div>
															</div>

															<div class="form-group">
																<input type="submit" name="submit" value="Update Profile" class="btn btn-success">
															</div>
														</form>';
																}elseif( $_SESSION['role']==3)
																{
																	echo '<h4>Set Courier Rates (Flat Rates)</h4>
																	<p style="color: #cc0000;">Please always update duration for every rating that is updated</p>
															<form method="POST" action="../assets/php/forms.php?code=9">
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label>State Wide Deliveries</label>
																	<input type="text" placeholder="2000" name="istate" class="form-control" required="">
																</div>
																<div class="form-group col-md-6">
																	<label>Duration</label>
																	<input type="text" placeholder="3 Days" class="form-control" required="" name="idur">
																</div>
															</div>				
															<div class="form-row">
															<div class="form-group col-md-6">
																	<label>Interstate Deliveries</label>
																	<input type="text" placeholder="5000" class="form-control" required="" name="cstate">
																</div>

																<div class="form-group col-md-6">
																	<label>Duration</label>
																	<input type="text" placeholder="7 Days" class="form-control" required="" name= "cdur">
																</div>
																
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label>International Deliveries</label>
																	<input type="text" placeholder="25000" class="form-control" required="" name= "inter">
																</div>
																<div class="form-group col-md-6">
																	<label>International Duration</label>
																	<input type="text" placeholder="21 Days" class="form-control" required="" name= "interdur">
																</div>							
															</div>
															<div class="form-row">
															<div class="form-group col-md-12">
																	<label>Contact Phone</label>
																	<input type="text" value="" class="form-control" required="" name="phone">
																</div>
															</div>

															<div class="form-row">
															<div class="form-group col-md-12">
																	<label>About Company</label>
																	<textarea class="form-control" id="mytextarea" name="descr">Description!</textarea>
																</div>
															</div>
															<div class="form-group">
																<input type="submit" name="submit" value="Update Profile" class="btn btn-success">
															</div>
														</form>';
																}
															 ?>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>


									<div class="tab-pane fade" id="edit-setting">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												<div class="form-body">
													<div class="row">
														<div class="col-12 col-lg-5 border-right">
															<h4>Update Password</h4>
															<form method="POST" action="../assets/php/forms.php?code=76">
																<div class="form-row">
																	<div class="form-group col-md-12">
																		<label>Current Password</label>
																		<input type="password" name="pwd" value="" class="form-control" required="">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-12">
																		<label>New Password</label>
																		<input type="password" name="npwd" value="" class="form-control" required="">
																	</div>
																</div>

																<div class="form-group">
																	<input type="submit" name="ubmit" value="Update Password" class="btn btn-success">
																</div>
															</form>
															
														</div>
														<div class="col-12 col-lg-7">
															<h4>Update Company Detail</h4>
															<form method="POST" action="../assets/php/forms.php?code=77" enctype="multipart/form-data">
																<div class="form-row">
																	<div class="form-group col-md-12">
																		<label>Company name</label>
																		<input type="text" name="coy" value="" class="form-control" required="">
																	</div>
																	<div class="form-group col-md-12">
																		<label>Company Address</label>
																		<textarea class="form-control" id="mytextarea" name="addr"  required="">Description!</textarea>
																	</div>
																	<div class="form-group col-md-4">
																		<label>City</label>
																		<input type="text" name="city" value="" class="form-control" required="">
																	</div>
																	<div class="form-group col-md-4">
																		<label>State</label>
																		<input type="text" name="state" value="" class="form-control" required="">
																	</div>
																	<div class="form-group col-md-4">
																		<label>Logo</label>
																		<input type="file" name="logo" class="form-control" required="" />
																	</div>
																</div>

																<div class="form-group">
																	<input type="submit" name="submit" value="Update Profile" class="btn btn-success">
																</div>
															</form>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
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
	<!--Data Tables js-->
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>
	
	<!-- App JS -->
	<script src="assets/js/app.js"></script>
</body>

</html>