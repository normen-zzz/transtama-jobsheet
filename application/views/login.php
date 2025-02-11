<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<meta charset="utf-8" />
	<meta name="google-site-verification" content="n65eZx_Lmo6Qx0NYgwvqO_n21_VmI4GWGnl6CIWAAH8" />
	<title>Login Page</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="<?= base_url('assets/back/metronic/') ?>css/pages/login/classic/login-1.css" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?= base_url('assets/back/metronic/') ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/back/metronic/') ?>plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/back/metronic/') ?>css/style.bundle.css" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="<?= base_url('uploads/') ?>tlx.jpeg" />

	<style>
		#kt_body {
			background-image: url(<?= base_url('uploads/bg2.png') ?>);
			background-size: cover;
		}
	</style>


</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled subheader-enabled page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid" id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat" style="margin-left: 100px; margin-top:-50px">
				<!--begin: Aside Container-->
				<div class="d-flex flex-row-fluid flex-column justify-content-between">
					<!--<div class="flex-column-fluid d-flex flex-column justify-content-center">
						<a href="#" class="flex-column-auto">
							<img src="<?= base_url('uploads/logoRaw.png') ?>" alt="logo" width="auto" height="150" />
						</a>
					</div>-->
				</div>
				<!--end: Aside Container-->
			</div>
			<!--begin::Aside-->
			<div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden" >
				<div class="d-flex flex-column-fluid flex-center mt-lg-0">
					<!--begin::Signin-->
					<div class="login-form login-signin" style="margin-left: 120px;">
						<div class="mb-2">
							<h2 class="font-weight-bold text-light text-center">Sign In</h2>
							</br>
						</div>
						<form class="form" action="<?= base_url('backoffice') ?>" method="POST">
							<div class="form-group">
								<small class="text-light h6">Username</small>
								<input class="form-control form-control-solid h-auto py-5 px-6" required type="text" placeholder="Enter Your Username" name="username" autocomplete="off" />
							</div>
							<div class="form-group">
								<small class="text-light h6">Password</small>
								<input class="form-control form-control-solid h-auto py-5 px-6" required type="password" placeholder="Enter Your Password" name="password" autocomplete="off" />
							</div>
							<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
								<div class="checkbox-inline">
									<label class="checkbox m-0 text-light">
										<input type="checkbox" name="remember" />
										<span></span>Remember me</label>
								</div>
								<!-- <a href="javascript:;" id="kt_login_forgot" class="text-light text-hover-light">Forgot Password ?</a> -->
							</div>

							<!--begin::Action-->
							<div class="form-group d-flex align-items-center">
								<button type="submit" class="btn font-weight-bold px-9 py-4 my-3 text-light" style="background-color: #513851; width:100%">Sign In</button>
							</div>
							<!--end::Action-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Signin-->

				</div>
				<!--end::Content body-->

			</div>
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->
	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#6993FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1E9FF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="<?= base_url('assets/back/metronic/') ?>plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url('assets/back/metronic/') ?>plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="<?= base_url('assets/back/metronic/') ?>js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="<?= base_url('assets/back/metronic/') ?>js/pages/custom/login/login-general.js"></script>
	<!--end::Page Scripts-->
	<script src="<?= base_url('assets/assets/') ?>js/sweetalert2.all.min.js"></script>
</body>
<!--end::Body-->

</html>

<script>
	<?= $this->session->flashdata('messageAlert'); ?>
</script>