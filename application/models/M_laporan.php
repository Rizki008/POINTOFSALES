<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
	public function lap_harian($tanggal, $bulan, $tahun)
	{
		$this->db->select('produk.nama_produk,produk.harga,detail_transaksi.qty,pembayaran.total_harga,transaksi.no_transaksi,transaksi.tgl_transaksi,detail_transaksi.no_transaksi');
		$this->db->from('detail_transaksi');
		$this->db->join('transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->where('DAY(transaksi.tgl_transaksi)', $tanggal);
		$this->db->where('MONTH(transaksi.tgl_transaksi)', $bulan);
		$this->db->where('YEAR(transaksi.tgl_transaksi)', $tahun);
		$this->db->order_by('qty', 'desc');
		return $this->db->get()->result();
	}

	public function lap_bulanan($bulan, $tahun)
	{
		$this->db->select('produk.nama_produk,produk.harga,detail_transaksi.qty,pembayaran.total_harga,transaksi.no_transaksi,transaksi.tgl_transaksi,detail_transaksi.no_transaksi');
		$this->db->from('detail_transaksi');
		$this->db->join('transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->where('MONTH(tgl_transaksi)', $bulan);
		$this->db->where('YEAR(tgl_transaksi)', $tahun);
		$this->db->order_by('qty', 'desc');
		return $this->db->get()->result();
	}

	public function lap_tahunan($tahun)
	{
		$this->db->select('produk.nama_produk,produk.harga,detail_transaksi.qty,pembayaran.total_harga,transaksi.no_transaksi,transaksi.tgl_transaksi,detail_transaksi.no_transaksi');
		$this->db->from('detail_transaksi');
		$this->db->join('transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');

		$this->db->where('YEAR(transaksi.tgl_transaksi)', $tahun);
		$this->db->order_by('qty', 'desc');

		return $this->db->get()->result();
	}

	public function lap_stock($tanggal, $bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->where('DAY(transaksi.tgl_transaksi)', $tanggal);
		$this->db->where('MONTH(transaksi.tgl_transaksi)', $bulan);
		$this->db->where('YEAR(transaksi.tgl_transaksi)', $tahun);
		$this->db->order_by('stock', 'desc');
		return $this->db->get()->result();
	}
}

/* End of file M_laporan.php */
