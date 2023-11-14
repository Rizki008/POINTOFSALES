<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Data Cetak Transaksi</h3>

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
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($transaksi as $key => $value) { ?>
						<tr class="text-center">
							<td><?= $no++; ?></td>
							<td><?= $value->no_transaksi ?></td>
							<td><?= $value->tgl_transaksi ?></td>
							<td>Rp. <?= number_format($value->total_harga, 0) ?></td>
							<td>Rp. <?= number_format($value->jumlah_bayar, 0) ?></td>
							<td>
								<?php if ($value->status <= 0) { ?>
									<span class="badge bg-danger">Belum Cetak</span>
								<?php } else { ?>
									<span class="badge badge-success">Sudah Cetak</span><br>
								<?php } ?>
							</td>
							<td>
								<?php if ($value->status <= 0) { ?>
									<a href="<?= base_url('cetak/print/' . $value->no_transaksi) ?>" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a>
								<?php } ?>
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