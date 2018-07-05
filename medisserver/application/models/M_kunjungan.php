<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_kunjungan extends CI_Model{

	function tambahDataKunjungan($pasien){
		return $this->db->insert('kunjungan',$pasien);
	}

	function getListRekamKunjungan(){
		$query= $this->db->get('kunjungan');
		return $query->result();
	}

	function tampilUpdate($id){
		$query = $this->db->get_where('kunjungan', array('id' => $id));
		return $query->result();
	}
	function updateDataKunjungan($id,$data){
		$this->db->where('id', $id);
		$this->db->update('kunjungan', $data);
	}
	function deleteDataKunjungan($id){
		$this->db->delete('kunjungan', array('id' => $id));
	}
}
?>