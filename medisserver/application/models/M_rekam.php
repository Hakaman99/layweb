<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rekam extends CI_Model{
	// private $table = 'pasien';

	function tambahpasien($pasien){
		return $this->db->insert('pasien',$pasien);
	}

	function tambahdokter($dokter){
		return $this->db->insert('dokter',$dokter);
	}

	function getDokter(){        
        $query = $this->db->get('dokter');
        return $query->result();
    }

    function updateDataDokter($id,$data){
        $this->db->where('id', $id);
        $this->db->update('dokter', $data);
    }

    function tampilListDokter($id){
        $query = $this->db->get_where('dokter', array('id' => $id));
        return $query->result();
    }

    function deleteDataDokter($id){
        $this->db->delete('dokter', array('id' => $id));
    }
}
?>