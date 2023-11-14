<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_master');
		$this->load->model('m_outlet');
	}

	// List all your items
	public function kategori()
	{
		$data = array(
			'title' => 'Kategori Produk',
			'kategori' => $this->m_master->kategori(),
			'isi' => 'backend/kategori/v_kategori'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	// Add a new item
	public function add()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori')
		);
		$this->m_master->add($data);
		$this->session->set_flashdata('pesan', 'Kategori Berhasil Ditambahkan!!!');
		redirect('master/kategori');
	}

	//Update one item
	public function edit($id_kategori = NULL)
	{
		$data = array(
			'id_kategori' => $id_kategori,
			'nama_kategori' => $this->input->post('nama_kategori')
		);
		$this->m_master->edit($data);
		$this->session->set_flashdata('pesan', 'Kategori Berhasil Diedit!!!');
		redirect('master/kategori');
	}

	//Delete one item
	public function delete($id_kategori = NULL)
	{
		$data = array(
			'id_kategori' => $id_kategori
		);
		$this->m_master->delete($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
		redirect('master/kategori');
	}

	// List all your items
	public function produk()
	{
		$data = array(
			'title' => 'Data produk',
			'produk' => $this->m_master->produk(),
			'isi' => 'backend/produk/v_produk',

		);
		$this->load->view('backend/v_wrapper.php', $data, FALSE);
	}

	// Add a new item
	public function add_produk()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('harga', 'Harga Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('berat', 'Berat Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('satuan', 'Produk Satuan', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('qty', 'qty Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));


		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = "gambar";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Tambah Produk',
					'kategori' => $this->m_master->kategori(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'backend/produk/v_add'
				);
				$this->load->view('backend/v_wrapper', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambar' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'nama_produk' => $this->input->post('nama_produk'),
					'id_kategori' => $this->input->post('id_kategori'),
					'harga' => $this->input->post('harga'),
					'berat' => $this->input->post('berat'),
					'satuan' => $this->input->post('satuan'),
					'qty' => $this->input->post('qty'),
					'gambar' => $upload_data['uploads']['file_name'],
				);
				$this->m_master->add_produk($data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
				redirect('master/produk');
			}
		}

		$data = array(
			'title' => 'Tambah Produk',
			'kategori' => $this->m_master->kategori(),
			'isi' => 'backend/produk/v_add'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	//Edit one item
	public function edit_produk($id_produk = NULL)
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('harga', 'Harga Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('berat', 'Berat Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('satuan', 'Satuan Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));
		$this->form_validation->set_rules('qty', 'qty Produk', 'required', array('required' => '%s Mohon Untuk Diisi !!!'));


		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = "gambar";
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Edit Produk',
					'kategori' => $this->m_master->kategori(),
					'produk' => $this->m_master->detail_produk($id_produk),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'backend/produk/v_edit'
				);
				$this->load->view('backend/v_wrapper', $data, FALSE);
			} else {
				//hapus gambar di folder
				$produk = $this->m_master->detail_produk($id_produk);
				if ($produk->gambar !== "") {
					unlink('./assets/gambar/' . $produk->gambar);
				}
				//end
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambar' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id_produk' => $id_produk,
					'nama_produk' => $this->input->post('nama_produk'),
					'id_kategori' => $this->input->post('id_kategori'),
					'harga' => $this->input->post('harga'),
					'berat' => $this->input->post('berat'),
					'satuan' => $this->input->post('satuan'),
					'qty' => $this->input->post('qty'),
					'gambar' => $upload_data['uploads']['file_name'],
				);
				$this->m_master->edit_produk($data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
				redirect('master/produk');
			} //tanpa ganti gambar
			$data = array(
				'id_produk' => $id_produk,
				'nama_produk' => $this->input->post('nama_produk'),
				'id_kategori' => $this->input->post('id_kategori'),
				'harga' => $this->input->post('harga'),
				'berat' => $this->input->post('berat'),
				'satuan' => $this->input->post('satuan'),
				'qty' => $this->input->post('qty'),
			);
			$this->m_master->edit_produk($data);
			$this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
			redirect('master/produk');
		}

		$data = array(
			'title' => 'Edit Produk',
			'kategori' => $this->m_master->kategori(),
			'produk' => $this->m_master->detail_produk($id_produk),
			'isi' => 'backend/produk/v_edit'
		);
		$this->load->view('backend/v_wrapper', $data, FALSE);
	}

	//Delete one item
	public function delete_produk($id_produk = NULL)
	{
		//hapus gambar
		$produk = $this->m_master->detail($id_produk);
		if ($produk->gambar !== "") {
			unlink('./assets/gambar/' . $produk->gambar);
		}

		$data = array(
			'id_produk' => $id_produk
		);
		$this->m_master->delete_produk($data);
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
		redirect('master/produk');
	}
}

/* End of file Master.php */
