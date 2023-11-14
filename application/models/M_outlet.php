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
}

/* End of file M_transaksi.php */
