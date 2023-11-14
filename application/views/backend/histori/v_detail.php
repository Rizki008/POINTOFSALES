<!-- Main content -->

<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Produk Dalam Pesanan</h3>
		</div>
		<div class="card-body p-0">
			<table class="table align-items-center table-flush">
				<thead class="thead-light">
					<tr>
						<th></th>
						<th>Nama Produk</th>
						<th>Jumlah</th>
						<th>Harga Satuan</th>
						<th>Total Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($detail as $key => $value) { ?>
						<tr>
							<td><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="150px"></td>
							<td><?= $value->nama_produk ?></td>
							<td><?= $value->qty ?></td>
							<td>Rp. <?= number_format($value->harga, 0) ?></td>
							<td>Rp. <?= number_format($value->qty * $value->harga, 0) ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tr>
					<th></th>
					<th><b>Jumlah Bayar</b></th>
					<th></th>
					<th></th>
					<td><b>Rp. <?= number_format($value->jumlah_bayar) ?></b></td>
				</tr>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>