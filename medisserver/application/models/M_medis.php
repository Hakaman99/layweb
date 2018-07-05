<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_medis extends CI_Model{

	function tambahDataPasien($pasien){
		return $this->db->insert('pasien',$pasien);
	}

	function getListRekamPasien(){
		$query= $this->db->get('pasien');
		return $query->result();
	}

	function tampilUpdate($id){
		$query = $this->db->get_where('pasien', array('id' => $id));
		return $query->result();
	}
	function updateDataPasien($id,$data){
		$this->db->where('id', $id);
		$this->db->update('pasien', $data);
	}
	function deleteDataPasien($id){
		$this->db->delete('pasien', array('id' => $id));
	}
}
?>