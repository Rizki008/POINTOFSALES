<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login($username, $password)
	{
		$cek =  $this->ci->m_auth->login_user($username, $password);

		if ($cek) {
			$id_user = $cek->id_user;
			$fullname = $cek->fullname;
			$username = $cek->username;
			$password = $cek->password;
			$level_user = $cek->level_user;

			$this->ci->session->set_userdata('id_user', $id_user);
			$this->ci->session->set_userdata('fullname', $fullname);
			$this->ci->session->set_userdata('username', $username);
			$this->ci->session->set_userdata('password', $password);
			$this->ci->session->set_userdata('level_user', $level_user);

			if ($level_user == 'kasir') {
				redirect('kasir');
			} else {
				redirect('admin');
			}
		} else {
			$this->ci->session->set_flashdata('error', 'Mohon Maaf Username atau Password salah');
			redirect('auth');
		}
	}

	public function proteksi_halaman()
	{
		if ($this->ci->session->userdata('username') == '') {
			$this->ci->session->set_flashdata('error', 'Mohon Maaf anda belum login');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('id_user');
		$this->ci->session->unset_userdata('fullname');
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('password');
		$this->ci->session->unset_userdata('level_user');
		$this->ci->session->set_flashdata('pesan', 'Berhasil Logout');
		redirect('auth');
	}
}
