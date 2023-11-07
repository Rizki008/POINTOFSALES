<?php



defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
	public function pesan($data)
	{
		$this->db->insert('transaksi', $data);
	}
	public function bayar($data)
	{
		$this->db->insert('pembayaran', $data);
	}
	public function rinci($data)
	{
		$this->db->insert('detail_transaksi', $data);
	}

	// CETAK
	public function cetak()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->join('outlet', 'user.id_user = outlet.id_user', 'left');
		$this->db->group_by('detail_transaksi.no_transaksi');

		return $this->db->get()->result();
	}
	public function print($no_transaksi)
	{
		$this->db->select('detail_transaksi.qty,produk.nama_produk,produk.harga,user.fullname,outlet.nama_outlet,transaksi.no_transaksi,transaksi.tgl_transaksi,transaksi.status,pembayaran.total_harga');
		$this->db->from('transaksi');
		$this->db->join('detail_transaksi', 'transaksi.no_transaksi = detail_transaksi.no_transaksi', 'left');
		$this->db->join('produk', 'detail_transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('pembayaran', 'transaksi.no_transaksi = pembayaran.no_transaksi', 'left');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->join('outlet', 'user.id_user = outlet.id_user', 'left');
		$this->db->where('transaksi.no_transaksi', $no_transaksi);

		return $this->db->get()->result();
	}

	public function update($data)
	{
		$this->db->where('no_transaksi', $data['no_transaksi']);
		$this->db->update('transaksi', $data);
	}

	public function total()
	{
		$this->db->where('status', 0);
		return $this->db->get('transaksi')->num_rows();
	}
	public function total_produk()
	{
		return $this->db->get('produk')->num_rows();
	}
	public function total_transaksi()
	{
		return $this->db->get('transaksi')->num_rows();
	}
	public function total_kategori()
	{
		return $this->db->get('kategori')->num_rows();
	}

	public function bulan()
	{
		$sql = 'SELECT tgl_transaksi FROM `transaksi` GROUP BY tgl_transaksi ORDER BY tgl_transaksi';
		$qry = $this->db->query($sql);
		return $qry->result_array();
	}
	public function produk()
	{
		$sql = 'SELECT nama_produk FROM `detail_transaksi` LEFT JOIN produk ON produk.id_produk=detail_transaksi.id_produk GROUP BY detail_transaksi.id_produk ORDER BY detail_transaksi.id_produk;';
		$qry = $this->db->query($sql);
		return $qry->result_array();
	}
}

/* End of file M_transaksi.php */
