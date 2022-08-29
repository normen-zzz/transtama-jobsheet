<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">
		<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent" data-toggle="push-menu" role="button">
			<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
		</a>
		<!-- Logo -->
		<a href="#" class="logo">
			<!-- logo-->
			<div class="logo-lg">
				<span class="light-logo"> <b> TRANSTAMA </b></span>
				<!-- <span class="light-logo"><img src="<?= base_url('uploads') ?>/logo.png" alt="logo"></span> -->
				<span class="dark-logo">TRANSTAMA LOGISTICS</span>
			</div>
		</a>
	</div>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<div class="app-menu">
			<ul class="header-megamenu nav">

				<li class="btn-group nav-item d-none d-xl-inline-block">
					<h3>Selamat Datang, <?= $this->session->userdata('nama_user') ?></h3>
				<li class="font-weight-200"><span class="badge badge-sm badge-dot badge-danger mr-10"></span></li>

				<li class="btn-group nav-item d-md-none">
					<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
						<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
					</a>
				</li>

			</ul>
		</div>

	</nav>
</header>