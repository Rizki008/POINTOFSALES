<?php



defined('BASEPATH') or exit('No direct script access allowed');

class M_outlet extends CI_Model
{
	public function outlet()
	{
		$this->db->select('*');
		$this->db->from('outlet');
		$this->db->join('user', 'outlet.id_user = user.id_user', 'left');
		$this->db->where('outlet.id_user', $this->session->userdata('id_user'));
		return $this->db->get()->result();
	}
	public function cabangoutlet()
	{
		$this->db->select('*');
		$this->db->from('outlet');
		$this->db->join('user', 'outlet.id_user = user.id_user', 'left');
		return $this->db->get()->result();
	}

	public function outletadmin()
	{
		$this->db->select('*');
		$this->db->from('outlet');
		$this->db->join('user', 'outlet.id_user = user.id_user', 'left');
		return $this->db->get()->result();
	}
	public function user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('level_user', 'kasir');
		return $this->db->get()->result();
	}
	public function add($data)
	{
		$this->db->insert('outlet', $data);
	}

	public function edit($data)
	{
		$this->db->where('id_outlet', $data['id_outlet']);
		$this->db->update('outlet', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_outlet', $data['id_outlet']);
		$this->db->delete('outlet', $data);
	}
}

/* End of file M_transaksi.php */
