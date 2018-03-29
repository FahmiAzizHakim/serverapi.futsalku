<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

	function getListData($table)
	{
		return $this->db->get($table);
	}

	function getDataWhere($where, $param, $table)
	{
		$this->db->where($where, $param);
		return $this->db->get($table)->result();
	}
}
?>