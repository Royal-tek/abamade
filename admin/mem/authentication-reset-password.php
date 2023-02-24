<?php
@session_start();
$id=0;
//get the email id from the link
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //pass as hidden attribute for the form
}else{
     header("Location: ./authentication-login.php");
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
	<title>ABAMADE eCommerce Platform | Register</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-5">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="assets/images/logo-img.png" width="180" alt="">
									</div>
									<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
									<p class="text-muted">We received your reset password request. Please enter your new password!</p>
									<span style="color: #cc0000;"><?php echo (isset($_SESSION['errMsg']) ? $_SESSION['errMsg']:""); ?></span>

								<form method="POST" action="./assets/php/loginProcessor.php?code=4">
									 <input type="hidden" name="zimail" value="<?php echo $id; ?>">
									<div class="form-group mt-5">
										<label>New Password</label>
										<input type="text" name="pass1" class="form-control" placeholder="Enter new password" />
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="text" name="pass2" class="form-control" placeholder="Confirm password" />
									</div>
									<button type="submit" class="btn btn-primary btn-block">Change Password</button> <a href="authentication-login.php" class="btn btn-link btn-block"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
								</form>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>