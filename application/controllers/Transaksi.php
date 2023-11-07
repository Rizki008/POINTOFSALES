<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->model('m_master');
		$this->load->model('m_outlet');
	}

	public function index()
	{
		$data = array(
			'title' => 'transaksi',
			'produk' => $this->m_master->produk(),
			'isi' => 'backend/transaksi/v_transaksi'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	public function pesan()
	{
		$redirect_page =  $this->input->post('redirect_page');
		$data = array(
			'id'      => $this->input->post('id'),
			'qty'     => $this->input->post('qty'),
			'price'   => $this->input->post('price'),
			'name'    => $this->input->post('name'),
			'img'    => $this->input->post('img'),
		);

		$this->cart->insert($data);
		redirect($redirect_page, 'refresh');
	}
	public function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			$data = array(
				'rowid' => $items['rowid'],
				'qty'   => $this->input->post($i . '[qty]'),
			);
			$this->cart->update($data);
			$i++;
		}
		$this->session->set_flashdata('pesan', 'Berhasil Diupdate');
		redirect('transaksi');
	}
	public function delete($rowid)
	{
		$this->cart->remove($rowid);
		redirect('transaksi');
	}

	public function checkout()
	{
		// $id_produk = $this->input->post('id_produk');
		$data = array(
			'id_user' => $this->session->userdata('id_user'),
			'no_transaksi' => $this->input->post('no_transaksi'),
			'tgl_transaksi' => date('Y-m-d H:i:s'),
			'status' => 0,
		);
		$this->m_transaksi->pesan($data);
		//simpan ke tabel bayar
		$bayar = array(
			'no_transaksi' => $this->input->post('no_transaksi'),
			'total_harga' => $this->input->post('total_harga'),
			'jumlah_bayar' => $this->input->post('jumlah_bayar'),
		);
		$this->m_transaksi->bayar($bayar);
		//simppan belanja langsung ke rinci
		$i = 1;
		$j = 1;
		foreach ($this->cart->contents() as $item) {
			$data_rinci_langsung = array(
				'no_transaksi' => $this->input->post('no_transaksi'),
				'id_detail' => $this->input->post('id_detail' . $j++),
				'id_produk' => $item['id'],
				'qty' => $this->input->post('qty' . $i++)
			);
			$this->m_transaksi->rinci($data_rinci_langsung);
		}
		$this->cart->destroy();
		redirect('transaksi');
	}

	public function keranjang()
	{
		if (empty($this->cart->contents())) {
			redirect('transaksi');
		}
		$data = array(
			'title' => 'Produk',
			'user' => $this->m_outlet->outlet(),
			'isi' => 'backend/transaksi/v_detail'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}
}
