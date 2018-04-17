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

	function getDataWhere2($where, $param, $table)
	{
		$this->db->where($where, $param);
		$this->db->where('activestatus', 'ATSAC');
		return $this->db->get($table)->row_array();
	}

	function single_data_get($company_code, $coloumn, $id, $table)
	{
		$this->db->where('company_code', $company_code);
		$this->db->where('activestatus', 'ATSAC');
		$this->db->where($coloumn, $id);
		return $this->db->get($table)->row_array();
	}

	function update($where, $id, $data, $table)
	{
		$this->db->where($where, $id);
		$this->db->update($table, $data);
		return true;
	}

	function del($id, $kolom, $table)
	{
		$this->db->where($kolom, $id);
		$this->db->delete($table);
	}

}
?>