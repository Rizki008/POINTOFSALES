<!-- Default box -->
<div class="card card-solid">
	<div class="card-body pb-0">
		<div class="row d-flex align-items-stretch">
			<?php foreach ($produk as $key => $value) { ?>
				<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
					<?php echo form_open('transaksi/pesan');
					echo form_hidden('id', $value->id_produk);
					echo form_hidden('name', $value->nama_produk);
					echo form_hidden('price', $value->harga);
					echo form_hidden('qty', 1);
					echo form_hidden('img', $value->gambar);
					echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
					?>
					<div class="card bg-light">
						<div class="card-header text-muted border-bottom-0">
							<?= $value->nama_kategori ?>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-7">
									<h2 class="lead"><b><?= $value->nama_produk ?></b></h2>
									<p class="text-muted text-sm"><b>Harga: </b> Rp. <?= number_format($value->harga, 0) ?> </p>
									<p class="text-muted text-sm"><b>Berat: </b> <?= $value->berat ?> <?= $value->satuan ?> </p>
									<p class="text-muted text-sm"><b>Stock: </b> <?= $value->qty ?> </p>
								</div>
								<div class="col-5 text-center">
									<img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" alt="" class="img-circle img-fluid">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="text-right">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">QTY:</label>
									<div class="col-sm-6">
										<input type="number" class="form-control" id="inputEmail3" name="qty" value="1" class="form-control" min="1" max=<?= $value->qty ?>>
									</div>
									<button type="submit" class="btn btn-sm btn-primary">
										<i class="fas fa-plus"></i> Tambah
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close() ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- /.card -->