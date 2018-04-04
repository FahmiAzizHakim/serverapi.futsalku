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
		$this->db->where('activestatus', 'ATSAC');
		return $this->db->get($table)->result();
	}

	function getLastNo($data, $table ,$company_code)
	{
		
		return $this->db->query("SELECT MAX(".$data.") as data FROM ".$table." WHERE company_code ='".$company_code."'")->row_array();
	}

	function getCodebyCategory($param)
	{
		$this->db->where('code_category', $param);
		$this->db->where('activestatus', 'ATSAC');
		return $this->db->get('GLB_DTACODE')->result();
	}

	function save($table, $data)
	{
		$this->db->insert($table, $data);
		if($this->db->affected_rows() > 0)
		{
		    return true;
		}else return false;
	}
}
?>