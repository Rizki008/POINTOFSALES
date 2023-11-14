<?php



defined('BASEPATH') or exit('No direct script access allowed');

class M_histori extends CI_Model
{

	public function histori()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->group_by('detail_transaksi.no_transaksi');

		return $this->db->get()->result();
	}
	public function detail($no_transaksi)
	{
		$this->db->select('produk.nama_produk,produk.gambar,produk.harga,detail_transaksi.qty,transaksi.no_transaksi,pembayaran.total_harga,pembayaran.jumlah_bayar');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->where('transaksi.no_transaksi', $no_transaksi);
		return $this->db->get()->result();
	}


	public function historioutlet($id_user)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->join('outlet', 'user.id_user = outlet.id_user', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->where('outlet.id_user', $id_user);
		$this->db->group_by('detail_transaksi.no_transaksi');
		return $this->db->get()->result();
	}
}

/* End of file M_histori.php */
