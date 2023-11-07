<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_transaksi');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'isi' => 'backend/kasir/v_kasir'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}
}

/* End of file Admin.php */
