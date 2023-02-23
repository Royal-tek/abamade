<?php 
include_once './assets/php/initiator.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="Tacoee Consults Ltd - https://tacoee.com" />
	<meta name="description" content="ABAMADE Administrative Platform" />
	<title>ABAMADE eCommerce Platform | Blogs</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	
	<link href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/smart-wizard/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
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
						<div class="breadcrumb-title pr-3">Blogs</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="index.php"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Add Blogs</li>
								</ol>
							</nav>
						</div>


							<div class="ml-auto">
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
						</div>
					</div>
					<!--end breadcrumb-->


							<div class="card">
						<div class="card-header">Add Blogs
							<p><span style="color: #cc0000;"><?php echo (isset($_SESSION['errMsg']) ? $_SESSION['errMsg']:""); unset($_SESSION['errMsg']); ?></span></p>
						</div>
						<div class="card-body">
								<form method="POST" action="./assets/php/forms.php?code=2" enctype="multipart/form-data">
										<div class="form-group">
											<input class="form-control" type="text" name="title" placeholder="Blog Title" required="">
										</div>

										<div class="form-group">
											<input class="form-control" type="text" name="author" placeholder="Blog Author" required="">
										</div>


										<div class="form-group">
											<select class="form-control" name="cat" required="">
												<option>Select Category</option>
												<option value="1">Technology</option>
												<option value="2">Lifestyle</option>
												<option value="4">Politics</option>
												<option value="3">Fashion</option>
												<option value="5">Travel</option>
												<option value="6">Others</option>
											</select>
										</div>
										<div class="form-group">
											<label>Blog Image:</label>
											<input type="file" name="file" class="form-control" required="">
										</div>
										<textarea id="mytextarea" name="descr" style="margin-bottom: 300px;" required="">Hello, World!</textarea>

										<div class="form-group">
											<input type="submit" name="submit" value="Add Blog" class="btn btn-primary">
										</div>
									</form>

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
	<script src="assets/plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
	
	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>
	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>
	</script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>
</body>

</html>