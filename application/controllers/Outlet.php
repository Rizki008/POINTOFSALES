<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_outlet');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Outlet',
			'outlet' => $this->m_outlet->outletadmin(),
			'isi' => 'backend/outlet/v_outlet'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	// Add a new item
	public function add()
	{
		$data = array(
			'nama_outlet' => $this->input->post('nama_outlet'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'id_user' => $this->input->post('id_user'),
		);
		$this->m_outlet->add($data);
		$this->session->set_flashdata('pesan', 'Kategori Berhasil Ditambahkan!!!');
		redirect('outlet');
	}

	//Update one item
	public function edit($id_outlet = NULL)
	{
		$data = array(
			'id_outlet' => $id_outlet,
			'nama_outlet' => $this->input->post('nama_outlet'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'id_user' => $this->input->post('id_user'),
		);
		$this->m_outlet->edit($data);
		$this->session->set_flashdata('pesan', 'Outlet Berhasil Diedit!!!');
		redirect('outlet');
	}

	//Delete one item
	public function delete($id_outlet = NULL)
	{
		$data = array(
			'id_outlet' => $id_outlet
		);
		$this->m_outlet->delete($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
		redirect('outlet');
	}
}

/* End of file Master.php */
