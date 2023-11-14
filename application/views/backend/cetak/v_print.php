<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>POINT OF SALES | Invoice Print</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 -->

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('template') ?>/dist/css/adminlte.min.css">

	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<!-- Main content -->
		<section class="invoice">
			<?php foreach ($transaksi as $key => $items) {
			}
			?>
			<!-- title row -->
			<div class="row">
				<div class="col-12">
					<h2 class="page-header">
						<i class="fas fa-globe"></i> <?= $items->nama_outlet ?>.
						<small class="float-right">Date: <?= $items->tgl_transaksi ?></small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
			<!-- info row -->
			<div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
					From
					<address>
						<strong><?= $items->fullname ?>.</strong><br>
					</address>
				</div>
				<div class="col-sm-6 invoice-col">
					<b>Invoice <?= $items->no_transaksi ?></b><br>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<!-- Table row -->
			<div class="row">
				<div class="col-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Product</th>
								<th>Qty</th>
								<th>Harga Satuan</th>
								<th>Total Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($transaksi as $key => $value) { ?>
								<tr>
									<td><?= $value->nama_produk ?></td>
									<td><?= $value->qty * $value->harga ?></td>
									<td>Rp. <?= number_format($value->qty * $value->harga, 0) ?></td>
									<td>Rp. <?= number_format($value->total_harga, 0) ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
			<!-- /.row -->

		</section>
		<!-- /.content -->
	</div>
	<!-- ./wrapper -->

	<script type="text/javascript">
		window.addEventListener("load", window.print());
	</script>

</body>

</html>