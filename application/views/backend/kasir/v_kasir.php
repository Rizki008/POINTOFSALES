<?php
$total = $this->m_transaksi->total();
$total_produk = $this->m_transaksi->total_produk();
$total_kategori = $this->m_transaksi->total_kategori();
$total_transaksi = $this->m_transaksi->total_transaksi();
?>
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<h3><?= $total ?></h3>

			<p>Cetak Struk</p>
		</div>
		<div class="icon">
			<i class="fas fa-shopping-cart"></i>
		</div>
	</div>
</div>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?= $total_produk ?></h3>

			<p>Produk</p>
		</div>
		<div class="icon">
			<i class="ion ion-stats-bars"></i>
		</div>
	</div>
</div>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<h3><?= $total_kategori ?></h3>

			<p>Kategori Produk</p>
		</div>
		<div class="icon">
			<i class="fas fa-users"></i>
		</div>
	</div>
</div>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-danger">
		<div class="inner">
			<h3><?= $total_transaksi ?></h3>
			<p>Transaksi</p>
		</div>
		<div class="icon">
			<i class="fas fa-money-check-alt"></i>
		</div>
	</div>
</div>


<div class="col-md-12">
	<!-- AREA CHART -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Grafik Penjualan</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<div class="chart">
				<div id="container"></div>
				<!-- <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> -->
			</div>
		</div>
		<!-- /.card-body -->
	</div>
</div>
<!-- PRODUK TERLARIS -->
<script type="text/javascript">
	Highcharts.chart('container', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Penjualan Produk Terlaris'
		},
		subtitle: {
			text: 'POINT OF SALES'
		},
		xAxis: {

			categories: [
				<?php
				$tanggal_bulan = $this->m_transaksi->bulan();
				foreach ($tanggal_bulan as $benar) {
					echo "'" . $benar['tgl_transaksi'] . "',";
				}
				?>
			]
		},
		yAxis: {
			title: {
				text: 'Jumlah Terjual'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: false
			}
		},
		series: [
			<?php
			$produk = $this->m_transaksi->produk();
			foreach ($produk as $prod) { ?> {
					name: '<?php echo $prod['nama_produk'] ?>',

					data: [
						<?php
						$tanggal_bulan = $this->m_transaksi->bulan();
						foreach ($tanggal_bulan as $kedua) {
							$total_prpduk = $this->db->query("SELECT SUM(detail_transaksi.qty) as total FROM `detail_transaksi` LEFT JOIN transaksi ON transaksi.no_transaksi=detail_transaksi.no_transaksi LEFT JOIN produk ON produk.id_produk=detail_transaksi.id_produk WHERE nama_produk='" . $prod['nama_produk'] . "' AND tgl_transaksi='" . $kedua['tgl_transaksi'] . "'");
							foreach ($total_prpduk->result_array() as $total) {
								if (empty($total['total'])) {
									echo "0,";
								} else {
									echo $total['total'] . ",";
								}
							}
						}
						?>
					]
				},
			<?php } ?>
		]
	});
</script>