<div class="col-12">
	<div class="callout callout-info">
		<h5><i class="fas fa-info"></i> Note:</h5>
		Mohon Untuk Dicek Kembali
	</div>


	<!-- Main content -->
	<div class="invoice p-3 mb-3">
		<!-- title row -->
		<div class="row">
			<div class="col-12">
				<h4>
					<?php foreach ($user as $key => $out) { ?>
						<i class="fas fa-globe"></i> <?= $out->nama_outlet ?>.
					<?php } ?>
					<small class="float-right">Date: <?= date('Y-m-d') ?></small>
				</h4>
			</div>
			<!-- /.col -->
		</div>
		<!-- info row -->
		<div class="row invoice-info">
			<div class="col-sm-4 invoice-col">
				From
				<address>
					<strong><?= $this->session->userdata('fullname') ?>.</strong><br>
					<?= $out->alamat ?><br>
					Phone: <?= $out->no_hp ?><br>
					Email: <?= $out->email ?>
				</address>
			</div>
		</div>
		<!-- /.row -->
		<form class="forms-sample" action="<?= base_url('transaksi/checkout') ?>" method="POST">
			<?php
			$i = 1;
			$j = 1;
			foreach ($this->cart->contents() as $items) {
				echo form_hidden('qty' . $i++, $items['qty']);
				$id_detail = random_string('alnum', 5);
				echo form_hidden('id_detail' . $j++, $id_detail);
			}
			$no_transaksi = date('Ymd') . strtoupper(random_string('alnum', 8));
			?>
			<input type="hidden" name="no_transaksi" value="<?= $no_transaksi ?>">
			<input type="hidden" name="total_harga" value="<?php echo $this->cart->total() ?>">
			<!-- Table row -->
			<div class="row">
				<div class="col-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Product</th>
								<th>Qty</th>
								<th>Subtotal</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>

							<?php
							$total_berat = 0;
							$total = 0;
							foreach ($this->cart->contents() as $items) {
								$produk = $this->m_master->detail_produk($items['id']);
								$berat = $items['qty'] * $produk->berat;
								$total_berat =  $total_berat + $berat;
							?>
								<tr>
									<td><?php echo $items['name']; ?></td>
									<td><?php echo form_input(
											array(
												'name' => $i . '[qty]',
												'value' => $items['qty'],
												'maxlength' => '3',
												'min' => '0',
												'max' => 'stock',
												'size' => '5',
												'type' => 'number',
												'class' => 'form-control'
											)
										); ?>
									</td>
									<td>Rp. <?= number_format($items['price']); ?></td>
									<td><a href="<?= base_url('transaksi/delete/') . $items['rowid'] ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a></td>
								</tr>
								<?php $i++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
				<!-- accepted payments column -->
				<div class="col-6">

				</div>
				<!-- /.col -->
				<div class="col-6">
					<p class="lead">Amount Due <?= date('Y-m-d') ?></p>

					<div class="table-responsive">
						<table class="table">
							<tr>
								<th>Total:</th>
								<td>Rp. <?= number_format($this->cart->total(), 0) ?></td>
							</tr>
						</table>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<!-- this row will not appear when printing -->
			<div class="row no-print">
				<div class="col-12">
					<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default"><i class="far fa-credit-card"></i> Submit
						Payment
					</button>
					<!-- <a href="<?= base_url('transaksi/print') ?>" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a> -->
					<!-- <a href="<?= base_url('transaksi/cetak') ?>" target="_blank" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a> -->
					<!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
						<i class="fas fa-download"></i> Generate PDF
					</button> -->
				</div>
			</div>
		</form>
	</div>
	<!-- /.invoice -->
</div><!-- /.col -->

<?php
$total_berat = 0;
$total = 0;
foreach ($this->cart->contents() as $items) {
	$produk = $this->m_master->detail_produk($items['id']);
	$berat = $items['qty'] * $produk->berat;
	$total_berat =  $total_berat + $berat;
?>
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Pembayaran</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="forms-sample" action="<?= base_url('transaksi/checkout') ?>" method="POST">
					<?php
					$i = 1;
					$j = 1;
					foreach ($this->cart->contents() as $items) {
						echo form_hidden('qty' . $i++, $items['qty']);
						$id_detail = random_string('alnum', 5);
						echo form_hidden('id_detail' . $j++, $id_detail);
					}
					$no_transaksi = date('Ymd') . strtoupper(random_string('alnum', 8));
					?>
					<input type="hidden" name="no_transaksi" value="<?= $no_transaksi ?>">
					<input type="hidden" name="total_harga" value="<?php echo $this->cart->total() ?>">
					<div class="modal-body">
						<label for="">Jumlah Pembayaran</label>
						<input type="number" name="jumlah_bayar" class="form-control">
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>