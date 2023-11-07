<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_transaksi');
	}

	// CETAK STRUK
	public function index()
	{
		$data = array(
			'title' => 'Data Cetak Struk',
			'transaksi' => $this->m_transaksi->cetak(),
			'isi' => 'backend/cetak/v_cetak'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}
	public function print($no_transaksi)
	{
		$data = array(
			'no_transaksi' => $no_transaksi,
			'status' => 1,
		);
		$this->m_transaksi->update($data);

		$view = array(
			'transaksi' => $this->m_transaksi->print($no_transaksi)
		);
		$this->load->view('backend/cetak/v_print', $view, FALSE);
	}
}

/* End of file Cetak.php */
