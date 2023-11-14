<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Histori extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_histori');
		$this->load->model('m_transaksi');
		$this->load->model('m_outlet');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Histori Transaksi',
			'histori' => $this->m_histori->histori(),
			'isi' => 'backend/histori/v_histori'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	// Add a new item
	public function detail($no_transaksi)
	{
		$data = array(
			'title' => 'Detail Transaksi',
			'detail' => $this->m_histori->detail($no_transaksi),
			'isi' => 'backend/histori/v_detail'

		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	public function outlet($id_user)
	{
		$data = array(
			'title' => 'Histori Transaksi',
			'histori' => $this->m_histori->historioutlet($id_user),
			'isi' => 'backend/histori/v_histori_outlet'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}
}

/* End of file Histori.php */
