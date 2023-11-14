<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?= base_url('admin') ?>" class="nav-link">Home</a>
				</li>
			</ul>

			<!-- SEARCH FORM -->
			<form class="form-inline ml-3">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>
			<?php $keranjang = $this->cart->contents();
			$jml_item = 0;
			foreach ($keranjang as $key => $value) {
				$jml_item = $jml_item + $value['qty'];
			} ?>
			<ul class="navbar-nav ml-auto">
				<?php if ($this->session->userdata('level_user') === 'kasir') { ?>
					<li class="nav-item dropdown">
						<a class="nav-link" href="<?= base_url('transaksi/keranjang') ?>">
							<i class="fa fa-shopping-cart"></i>
							<span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</nav>
		<!-- /.navbar -->