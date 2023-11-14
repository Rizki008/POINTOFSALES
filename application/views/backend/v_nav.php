<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('admin') ?>" class="brand-link">
		<!-- <img src="<?= base_url() ?>assets/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
		<span class="brand-text font-weight-light">
			<h5 class="text-center bold">POINT OF SALES</h5>
		</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="<?= base_url('admin') ?>" class="d-block">
					<?= $this->session->userdata('fullname'); ?>
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<?php if ($this->session->userdata('level_user') == 'admin') { ?>
					<li class="nav-item">
						<a href="<?= base_url('admin') ?>" class="nav-link <?php if (
																				$this->uri->segment(1) == 'admin' and $this->uri->segment(2) == " "
																			) {
																				echo "active";
																			} ?>">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Dashboard
							</p>
						</a>
					</li>
				<?php } else { ?>
					<li class="nav-item">
						<a href="<?= base_url('kasir') ?>" class="nav-link <?php if (
																				$this->uri->segment(1) == 'admin' and $this->uri->segment(2) == " "
																			) {
																				echo "active";
																			} ?>">
							<i class="nav-icon fas fa-home"></i>
							<p>
								Dashboard
							</p>
						</a>
					</li>
				<?php } ?>

				<?php if ($this->session->userdata('level_user') == 'admin') { ?>
					<li class="nav-item has-treeview">
						<a class="nav-link">
							<i class="nav-icon fas fa-box"></i>
							<p>
								Produk
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('master/kategori') ?>" class="nav-link <?php if (
																									$this->uri->segment(2) == 'kategori' and $this->uri->segment(1) == 'master'
																								) {
																									echo "active";
																								} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Kategori Produk</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('master/produk') ?>" class="nav-link <?php if (
																								$this->uri->segment(2) == 'produk' and  $this->uri->segment(1) == 'master'
																							) {
																								echo "active";
																							} ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Produk Terbaru</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('outlet') ?>" class="nav-link <?php if (
																				$this->uri->segment(1) == 'outlet'
																			) {
																				echo "active";
																			} ?>">
							<i class="nav-icon fas fa-store"></i>
							<p>
								Outlet
							</p>
						</a>
					</li>
				<?php } ?>

				<?php if ($this->session->userdata('level_user') === 'kasir') { ?>
					<li class="nav-item">
						<a href="<?= base_url('transaksi') ?>" class="nav-link <?php if (
																					$this->uri->segment(1) == 'transaksi'
																				) {
																					echo "active";
																				} ?>">
							<i class="nav-icon fas fa-money-check-alt"></i>
							<p>
								Produk
							</p>
						</a>
					</li>
					<?php $total_cetak = $this->m_transaksi->total(); ?>
					<li class="nav-item">
						<a href="<?= base_url('cetak') ?>" class="nav-link <?php if (
																				$this->uri->segment(1) == 'cetak'
																			) {
																				echo "active";
																			} ?>">
							<i class="nav-icon fas fa-cash-register"></i>
							<p>
								Cetak Struk
								<span class="badge badge-warning right"><?= $total_cetak ?></span>
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('histori') ?>" class="nav-link <?php if (
																					$this->uri->segment(1) == 'histori'
																				) {
																					echo "active";
																				} ?>">
							<i class="nav-icon fas fa-receipt"></i>
							<p>
								Hostory Penjualan
							</p>
						</a>
					</li>
				<?php } ?>

				<?php if ($this->session->userdata('level_user') == 'admin') { ?>
					<li class="nav-item">
						<a href="<?= base_url('laporan') ?>" class="nav-link <?php if (
																					$this->uri->segment(1) == 'laporan'
																				) {
																					echo "active";
																				} ?>">
							<i class="nav-icon fas fa-address-book"></i>
							<p>
								Laporan Penjualan
							</p>
						</a>
					</li>
					<li class="nav-item has-treeview">
						<a class="nav-link">
							<i class="nav-icon fas fa-info"></i>
							<p>
								Info Outlet
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<?php $outlet = $this->m_outlet->cabangoutlet(); ?>
						<ul class="nav nav-treeview">
							<?php foreach ($outlet as $out) { ?>
								<li class="nav-item">
									<a href="<?= base_url('histori/outlet/' . $out->id_user) ?>" class="nav-link <?php if (
																														$this->uri->segment(2) == 'outlet' and $this->uri->segment(1) == 'histori'
																													) {
																														echo "active";
																													} ?>">
										<i class="far fa-circle nav-icon"></i>
										<p><?= $out->nama_outlet ?></p>
									</a>
								</li>
							<?php } ?>

						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/user') ?>" class="nav-link <?php if (
																					$this->uri->segment(2) == 'user' and $this->uri->segment(1) == 'admin'
																				) {
																					echo "active";
																				} ?>">
							<i class="nav-icon fas fa-users"></i>
							<p>
								User
							</p>
						</a>
					</li>
				<?php } ?>

				<li class="nav-item">
					<a href="<?= base_url('auth/logout') ?>" class="nav-link">
						<i class="nav-icon fas fa-angle-double-left"></i>
						<p>
							LogOut
						</p>
					</a>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $title ?></h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">