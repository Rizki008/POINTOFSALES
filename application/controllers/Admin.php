<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_auth');
		$this->load->model('m_transaksi');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'isi' => 'backend/admin/v_admin'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	// List all your items
	public function user()
	{
		$data = array(
			'title' => 'Data User',
			'user' => $this->m_auth->get_all_data(),
			'isi' => 'backend/user/v_user'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	// Add a new item
	public function add()
	{
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'level_user' => $this->input->post('level_user'),
		);
		$this->m_auth->add($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
		redirect('admin/user');
	}

	//Update one item
	public function edit($id_user = NULL)
	{
		$data = array(
			'id_user' => $id_user,
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'level_user' => $this->input->post('level_user'),
		);
		$this->m_auth->edit($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
		redirect('admin/user');
	}

	//Delete one item
	public function delete($id_user = NULL)
	{
		$data = array('id_user' => $id_user);
		$this->m_auth->delete($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
		redirect('admin/user');
	}
}

/* End of file Admin.php */
