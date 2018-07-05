<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Medisserver extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$ns = 'http://'.$_SERVER['HTTP_HOST'].'/medisserver/index.php/medisserver/';

        // load nusoap toolkit library in controller
		$this->load->library("Nusoap_library"); 

        // create soap server object
		$this->nusoap_server = new soap_server(); 
        // $this->nusoap_server->soap_defencoding = 'UTF-8';
        // wsdl configuration
		$this->nusoap_server->configureWSDL("Server SOAP Rekam Medis", $ns);
		// server namespace
		$this->nusoap_server->wsdl->schemaTargetNamespace = $ns; 

		$input_data_pasien = array ('nama' => "xsd:string", 'nik' => "xsd:string",'notlp' => "xsd:string",'jeniskelamin' => "xsd:string",'alamat' => "xsd:string",'tanggallahir' => "xsd:string",'golongandarah' => "xsd:string");
		$id_data_pasien = array ('id' => 'xsd:string');  

		$data_pasien = array ('id' => 'xsd:string','nama' => "xsd:string", 'nik' => "xsd:string",'notlp' => "xsd:string",'jeniskelamin' => "xsd:string",'alamat' => "xsd:string",'tanggallahir' => "xsd:string",'golongandarah' => "xsd:string");

		$return_pasien = array ("sukses" => "xsd:string");

		$this->nusoap_server->register(
            'insertPasien',                  // method name
            $input_data_pasien,                   // input parameters
            $return_pasien,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."insertpasien",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Rekam Medis"         // documentation 
            );
		$this->nusoap_server->register(
            'listRekamPasien',                  // method name
            $input_data_pasien,                   // input parameters
            $return_pasien,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."listRekamPasien",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Rekam Medis"         // documentation 
            );
		$this->nusoap_server->register(
            'tampilUpdatePasien',                  // method name
            $data_pasien,                   // input parameters
            $return_pasien,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."tampilUpdatePasien",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Rekam Medis"         // documentation 
            );
		$this->nusoap_server->register(
			'updateDataPasien',
			$data_pasien,
			$return_pasien,
			'urn:SOAPServerWSDL',
			'urn:'.$ns.'updateDataPasien',
			'rpc',
			'encoded',
			'Daftar Update'
			);
		$this->nusoap_server->register(
			'deletePasien',
			$id_data_pasien,
			$return_pasien,
			'urn:SOAPServerWSDL',
			'urn:'.$ns.'deletePasien',
			'rpc',
			'encoded',
			'Daftar Pasien'
			);
		$this->load->model(array('M_medis'));
	}

	function index(){
		function insertPasien($nama,$nik,$notlp,$jeniskelamin,$alamat,$tanggallahir,$golongandarah){
			$ci =&get_instance();

			$param = array('nama' => $nama, 'jenis_kelamin' => $jeniskelamin, 'nik' => $nik, 'no_tlp' => $notlp, 'alamat' => $alamat, 'tanggal_lahir' => $tanggallahir, 'golongan_darah' => $golongandarah);

			$result = $ci->M_medis->tambahDataPasien($param);
		}

		function listRekamPasien(){
			$ci =&get_instance();
			$result = $ci->M_medis->getListRekamPasien();

			foreach($result as $row => $value){                 
				$return_value[] = array(
					'id' => $value->id,
					'nama'=> $value->nama,
					'jenis_kelamin'=> $value->jenis_kelamin,
					'nik'=> $value->nik,
					'no_tlp'=> $value->no_tlp,
					'alamat'=> $value->alamat,
					'tanggal_lahir'=> $value->tanggal_lahir,
					'golongan_darah'=> $value->golongan_darah
					);
			}
			$r =json_encode($return_value);
			return $r;
		}

		function tampilUpdatePasien($id){
			$ci =&get_instance();
			$result = $ci->M_medis->tampilUpdate($id);

			foreach($result as $row => $value){                 
				$return_value[] = array(
					'id' => $value->id,
					'nama'=> $value->nama,
					'jenis_kelamin'=> $value->jenis_kelamin,
					'nik'=> $value->nik,
					'no_tlp'=> $value->no_tlp,
					'alamat'=> $value->alamat,
					'tanggal_lahir'=> $value->tanggal_lahir,
					'golongan_darah'=> $value->golongan_darah
					);
			}
			$hasil =json_encode($return_value);
			return $hasil; 
		}

		function updateDataPasien($id,$nama,$nik,$notlp,$jeniskelamin,$alamat,$tanggallahir,$golongandarah){
			$ci =&get_instance();
			$param = array('nama' => $nama, 'jenis_kelamin' => $jeniskelamin, 'nik' => $nik, 'no_tlp' => $notlp, 'alamat' => $alamat, 'tanggal_lahir' => $tanggallahir, 'golongan_darah' => $golongandarah);
			$result = $ci->M_medis->updateDataPasien($id,$param);
			$sukses= "Insert Pasien Success";
		}

		function deletePasien($id){
			$ci =&get_instance();
			$result = $ci->M_medis->deleteDataPasien($id);
			$hasil = "Sukses";
			return $hasil;
		}
		 // read raw data from request body
		$this->nusoap_server->service(file_get_contents("php://input")); 
	}
}
?>