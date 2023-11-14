<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Data Histori Transaksi</h3>
			<div class="card-tools">
			</div>
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<?php
			if ($this->session->flashdata('pesan')) {
				echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
				echo $this->session->flashdata('pesan');
				echo '</h5></div>';
			}
			?>
			<table id="example1" class="table table-bordered" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>No Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Total Harga</th>
						<th>Jumlah Bayar</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($histori as $key => $value) { ?>
						<tr class="text-center">
							<td><?= $no++; ?></td>
							<td><?= $value->no_transaksi ?></td>
							<td><?= $value->tgl_transaksi ?></td>
							<td>Rp. <?= number_format($value->total_harga, 0) ?></td>
							<td>Rp. <?= number_format($value->jumlah_bayar, 0) ?></td>
							<td>
								<a href="<?= base_url('histori/detail/' . $value->no_transaksi) ?>" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-detail"></i>Detail Transaksi</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>