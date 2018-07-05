<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");

class Kunjungan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$ns = 'http://'.$_SERVER['HTTP_HOST'].'/medisserver/index.php/kunjungan/';

        // load nusoap toolkit library in controller
		$this->load->library("Nusoap_library"); 

        // create soap server object
		$this->nusoap_server = new soap_server(); 
        // $this->nusoap_server->soap_defencoding = 'UTF-8';
        // wsdl configuration
		$this->nusoap_server->configureWSDL("Server SOAP Kunjungan", $ns);
		// server namespace
		$this->nusoap_server->wsdl->schemaTargetNamespace = $ns; 
		//keterangan	tanggal_kunjungan	keluhan	diagnosis
		$input_data_kunjungan = array ('idpasien'=>'xsd:string','iddokter'=>'xsd:string','keterangan' => "xsd:string", 'tanggalkunjungan' => "xsd:string",'keluhan' => "xsd:string",'diagnosis' => "xsd:string");

		$id_data_kunjungan = array ('id' => 'xsd:string');  

		$data_kunjungan = array ('id' => 'xsd:string','idpasien'=>'xsd:string','iddokter'=>'xsd:string','keterangan' => "xsd:string", 'tanggalkunjungan' => "xsd:string",'keluhan' => "xsd:string",'diagnosis' => "xsd:string");

		$return_kunjungan = array ("sukses" => "xsd:string");
		$this->nusoap_server->register(
            'insertKunjungan',                  // method name
            $input_data_kunjungan,                   // input parameters
            $return_kunjungan,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."insertkunjungan",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Rekam Medis"         // documentation 
            );

		$this->load->model(array('M_kunjungan'));
	}

	function index(){
		function insertKunjungan($idpasien,$iddokter,$keterangan,$tanggalkunjungan,$keluhan,$diagnosis){
			$ci =&get_instance();
			//'idpasien'=>'xsd:string','iddokter'=>'xsd:string','keterangan' => "xsd:string", 'tanggalkunjungan' => "xsd:string",'keluhan' => "xsd:string",'diagnosis' => "xsd:string"
			$param = array('id_pasien' => $idpasien,'id_dokter' => $iddokter, 'keterangan' => $keterangan, 'tanggal_kunjungan' => $tanggalkunjungan, 'keluhan' => $keluhan, 'diagnosis' => $diagnosis);

			$result = $ci->M_kunjungan->tambahDataKunjungan($param);
		}

		 // read raw data from request body
		$this->nusoap_server->service(file_get_contents("php://input")); 
	}
}
?>