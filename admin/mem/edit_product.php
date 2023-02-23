<?php 
include_once '../assets/php/initiator.php';
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$dProd = $functioner->getOneProduct($id);
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
	<title>ABAMADE eCommerce Platform | Products</title>
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
						<div class="breadcrumb-title pr-3">Products</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="index.php"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Edit Products :: <?=$dProd['prod_name'];?> </li>
								</ol>
							</nav>
						</div>


					</div>
					<!--end breadcrumb-->


							<div class="card">
						<div class="card-header">Edit Products
							<p><span style="color: #cc0000;"><?php echo (isset($_SESSION['errMsg']) ? $_SESSION['errMsg']:""); unset($_SESSION['errMsg']); ?></span></p>
						</div>
						<div class="card-body">
								<form method="POST" action="../assets/php/edits.php?code=5" enctype="multipart/form-data">
									<input type="hidden" name="item_id" value="<?= $dProd['id'];?>" />
										<div class="row">
											<div class="col-md-8 col-sm-12 form-group">
												<input class="form-control" type="text" name="title" placeholder="Product Title" value="<?php echo $dProd['prod_name']; ?>" required="">
											</div>
											<div class=" col-md-4 col-sm-12 form-group">
												<select class="form-control" name="cat" required="">
													<option value=0>Select Category</option>
													<?php 
														if(!empty($liCats = $functioner->getLiCats($_GET['id'])))
														{
															foreach ($liCats as $key => $value) {
																echo $value;
															}
														}
													?>												
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8 col-sm-12">
												<div class="row">
													<div class="col-6 form-group">
														<input class="form-control" type="text" name="price" placeholder="Unit Price"  value=<?= $dProd['price'];?> />
													</div>

													<div class="col-6 form-group">
														<input class="form-control" type="text" name="brand" placeholder="Brand"  value="<?php echo $dProd['brand']; ?>">
													</div>

													<div class="col-12 form-group">
														<textarea class="mytextarea form-control" name="snote"><?php echo $dProd['short_note']; ?></textarea>
													</div>
												</div>
												
											</div>
											<div class="col-md-4 col-sm-12">
												<img src="../../assets/images/product/<?= $dProd['display_image'];?>" width="150px" alt="">												
												<div class="form-group">
													<label>Change Product Image:</label>
													<input type="file" name="cimage" class="form-control" />
												</div>
											</div>
											
										</div>
										
										
										<textarea class="mytextarea" name="descr" style="margin-bottom: 300px;" required=""><?php echo $dProd['description']; ?></textarea>

										<div class="form-group">
											<input type="submit" name="submit" value="Edit Product" class="btn btn-primary">
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
		  selector: '.mytextarea'
		});
	</script>
	</script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>
</body>

</html>