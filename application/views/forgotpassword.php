<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduadmin-template.multipurposethemes.com/bs4/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Sep 2021 22:33:02 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="#">

	<title>Wan University - Log in </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/vendors_css.css">

	<!-- Style-->
	<link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/style.css">
	<link rel="stylesheet" href="<?= base_url('assets/assets/backend/') ?>css/skin_color.css">
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" type="text/css">
	<style>
		.btn-kirim {
			color: #ffff;
			background-color: #04a08b;
		}
	</style>

</head>

<body class="hold-transition theme-primary bg-img" style="font-family:'Roboto', sans-serif; ">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h3 class="ttext-fade text-bold">Lupa Password</h3>
								<p class="mb-0">Sistem Informasi Akademik dan Learning Management System</p>
							</div>
							<div class="p-40">
								<form action="<?= base_url('Auth/forgotPassword'); ?>" method="post">
									<div class="form-group">
										<?= $this->session->flashdata('message'); ?>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
											</div>
											<input type="email" class="form-control pl-15 bg-transparent" placeholder="email" name="email" autocomplete="off">
										</div>
									</div>

									<div class="row">

										<div class="col-12 text-center">
											<!-- <button type="submit" class="btn btn-danger mt-10">Kirim</button> -->
											<button type="submit" class="btn btn-block btn-kirim mt-10">Kirim</button>
											<!-- <input type="submit" value="Log In" class="btn btn-block btn-login"> -->
										</div>
										<!-- /.col -->
									</div>
								</form>
								<div class="text-center">
									<!-- <p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-5">Sign Up</a></p> -->
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="<?= base_url('assets/assets/backend/') ?>js/vendors.min.js"></script>
	<script src="<?= base_url('assets/assets/backend/') ?>js/pages/chat-popup.js"></script>
	<script src="<?= base_url('assets/assets/backend/') ?>icons/feather-icons/feather.min.js"></script>

</body>



</html>