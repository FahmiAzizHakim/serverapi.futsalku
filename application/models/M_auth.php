<?php
defined('BASEPATH') OR exit('No direct script allowed');

class M_auth extends CI_Model {
	function cek_user($username, $password)
	{
		$this->db->where('user_code', $username);
		$this->db->where('activestatus', 'ATSAC');
		$this->db->where('user_password', $password);
		return $this->db->get('mst_admuser');
	}
}