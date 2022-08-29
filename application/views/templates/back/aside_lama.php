<?php $role = $this->session->userdata('id_role'); ?>
<!-- jika dia superadmin -->
<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">

			<!-- jika dia superadmin -->
			<?php if ($role == 1) {
			?>
				<div class="multinav-scroll" style="height: 100%;">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">Dashboard</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('superadmin/dashboard') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Dashboard</a></li>

							</ul>
						</li>


						<li class="header">Manajemen</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
								<span>Master Data</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('superadmin/users') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User</a></li>
								<li><a href="<?= base_url('superadmin/fakultas') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Fakultas</a></li>
								<li><a href="<?= base_url('superadmin/prodi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Prodi</a></li>
								<li><a href="<?= base_url('superadmin/role') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Role Manajemen</a></li>
								<li><a href="<?= base_url('superadmin/matakuliah') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Matakuliah</a></li>
							</ul>
						</li>

						<li class="header">Manajemen Profil</li>
						<li class="">
							<a href="<?= base_url('superadmin/profile') ?>">
								<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
								<span>Profil</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
						</li>
					</ul>
				</div>
			<?php } elseif ($role == 2) { ?>

				<div class="multinav-scroll" style="height: 100%;">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">Dashboard</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('keuangan/dashboard') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Dashboard</a></li>

							</ul>
						</li>
						<li class="header">Manajemen Pembayaran</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
								<span>Manajemen Pembayaran</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">

								<li><a href="<?= base_url('keuangan/pembayaran') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Pembayaran</a></li>
							</ul>
						</li>
						<li class="header">Manajemen Invoice</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
								<span>Manajemen Invoice</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">

								<li><a href="<?= base_url('keuangan/transaksi/daftarUlang') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Registrasi ulang</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Baju Almamater</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SPP</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>BPP</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>UTS</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>UAS</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Proposal</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bimbingan</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ujian Skripsi</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Wisuda</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Semester Pendek</a></li>

							</ul>
						</li>

						<li class="header">Manajemen Mahasiswa</li>
						<li class="treeview">
							<a href="widgets_blog.html">
								<i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
								<span>Manajemen Mahasiswa</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
						</li>


					</ul>
				</div>

			<?php } elseif ($role == 3) { ?>
				<div class="multinav-scroll" style="height: 100%;">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">Dashboard</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('akademik/dashboard') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Dashboard</a></li>

							</ul>
						</li>

						<li class="header">Manajemen Pembelajarann</li>
						<li class="treeview">

							<a href="javascript: void(0);">
								<i class="fas fa-running"></i>
								<span>Aktivitas Pembelajaran</span>
							</a>

							<ul class="treeview-menu">
								<li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Jadwal Kuliah </a></li>
								<li><a href="<?= base_url('akademik/matakuliah') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Mata Kuliah </a></li>
							</ul>

						</li>

						<li class="header">Sistem Informasi Akademik</li>
						<li class="treeview">
							<a href="javascript: void(0);">
								<i class=" fa fa-book"></i>
								<span>Manajemen Akademik</span>
							</a>
							<ul class="treeview-menu">

								<!-- <li><a href="widgets_statistic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>KRS Mahasiswa </a></li> -->
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>KHS Mahasiswa </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>HSK</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Transkip Nilai </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Konversi mahasiswa baru </a></li>


							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-cog"></i>
								<span>Manajemen Semester</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('akademik/semester') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Semester </a></li>
								<li><a href="<?= base_url('akademik/KalenderAkademik') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kalender Akademik </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Penjadwalan Kuliah </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Her-Reg Mahasiswa </a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-info"></i>
								<span>Manajemen Kurikulum</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('akademik/kurikulum') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kurikulum</a></li>
							</ul>
						</li>

						<li class="header">Manajemen Informasi</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Chat-locked"><span class="path1"></span><span class="path2"></span></i>
								<span>Informasi</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('akademik/mahasiswa') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Mahasiswa</a></li>
								<li><a href="<?= base_url('akademik/dosen') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Dosen</a></li>
								<li><a href="<?= base_url('akademik/profile') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Profile Akademik</a></li>
								<li><a href="<?= base_url('akademik/pengumuman') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pengumuman</a></li>
								<li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chat</a></li>
								<li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Log Systemm</a></li>

							</ul>
						</li>

					</ul>
				</div>

			<?php } elseif ($role == 4) { ?>
				<div class="multinav-scroll" style="height: 100%;">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">Dashboard</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('mahasiswa/dosen') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Dashboard</a></li>

							</ul>
						</li>

						<li class="header">Sistem Pembelajaran</li>
						<li class="treeview">

							<a href="javascript: void(0);">
								<i class="fas fa-book-open"></i>
								<span>Aktivitas Pembelajaran</span>
							</a>

							<ul class="treeview-menu">
								<li><a href="<?= base_url('mahasiswa/classes') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kelas </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agenda</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Laporan</a></li>
							</ul>

						</li>

						<li class="header">Sistem Informasi Akademik</li>
						<li class="treeview">
							<a href="javascript: void(0);">
								<i class=" fa fa-user-graduate"></i>
								<span>Manajemen Akademik</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>KHS Mahasiswa </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kalender Akademik</a></li>

							</ul>
						</li>



						<li class="header">Mahasiswa Bimbingan Akademik</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-money-check-alt"><span class="path1"></span><span class="path2"></span></i>
								<span>Lihat Bimbingan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mahasiswa</a></li>
							</ul>
						</li>

					</ul>
				</div>
			<?php } elseif ($role == 5) { ?>
				<div class="multinav-scroll" style="height: 100%;">
					<!-- sidebar menu-->
					<ul class="sidebar-menu" data-widget="tree">

						<li class="header">Dashboard</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('mahasiswa/dashboard') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Dashboard</a></li>

							</ul>
						</li>

						<li class="header">Sistem Pembelajaran</li>
						<li class="treeview">

							<a href="javascript: void(0);">
								<i class="fas fa-book-open"></i>
								<span>Aktivitas Pembelajaran</span>
							</a>

							<ul class="treeview-menu">
								<li><a href="<?= base_url('mahasiswa/classes') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kelas </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agenda</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kartu Peserta Ujian</a></li>
							</ul>

						</li>

						<li class="header">Sistem Informasi Akademik</li>
						<li class="treeview">
							<a href="javascript: void(0);">
								<i class=" fa fa-user-graduate"></i>
								<span>Manajemen Akademik</span>
							</a>
							<ul class="treeview-menu">

								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>KRS Mahasiswa </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>KHS Mahasiswa </a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>HSK</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Transkip Nilai </a></li>

							</ul>
						</li>



						<li class="header">Keuangan</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-money-check-alt"><span class="path1"></span><span class="path2"></span></i>
								<span>List Keuangan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('mahasiswa/keuangan') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lihat Tagihan</a></li>
								<li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Riwayat Pembayaran</a></li>


							</ul>
						</li>

					</ul>
				</div>
			<?php } ?>


		</div>
	</section>
	<div class="sidebar-footer">
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><span class="icon-Settings-2"></span></a>
		<a href="mailbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><span class="icon-Mail"></span></a>
		<a href="<?= base_url('login/logout') ?>" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
	</div>
</aside>