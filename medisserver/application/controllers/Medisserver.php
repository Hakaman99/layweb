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
        $this->nusoap_server->configureWSDL("Membuat Server SOAP", $ns);
        
        // server namespace
        $this->nusoap_server->wsdl->schemaTargetNamespace = $ns; 
        //parameter pada func_get_arg(arg_num)si penjumlahan berserta tipe datanya
        $input_pasien = array ('nama' => "xsd:string", 'nik' => "xsd:string",'notlp' => "xsd:string",'jeniskelamin' => "xsd:string",'alamat' => "xsd:string",'tanggallahir' => "xsd:string",'golongandarah' => "xsd:string"); 

        //nilai kembalian beserta tipe datanya
        $return_pasien = array ("sukses" => "xsd:string");

        $input_dokter = array ('nama' => "xsd:string", 'jeniskelamin' => "xsd:string",'profesi' => "xsd:string");

        $update_dokter = array ('id' => 'xsd:string','nama' => "xsd:string", 'jeniskelamin' => "xsd:string",'profesi' => "xsd:string");

        $masuk_dokter = array ('id' => 'xsd:string');    
 
        //nilai kembalian beserta tipe datanya
        $return_dokter = array ("sukses" => "xsd:string");

        $this->nusoap_server->register(
            'insertpasien',                  // method name
            $input_pasien,                   // input parameters
            $return_pasien,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."insertpasien",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Rekam Medis"         // documentation 
        );

        $this->nusoap_server->register(
            'insertdokter',                  // method name
            $input_dokter,                   // input parameters
            $return_dokter,                  // output parameters    
            "urn:SOAPServerWSDL",           // namespace
            "urn:".$ns."insertdokter",       // soap action
            "rpc",                          // style
            "encoded",                      // use
            "Penambahan Data Dokter"         // documentation 
        );

        
        $this->nusoap_server->register(
            'tampilListDokter',
            $update_dokter,
            array('output' => 'xsd:Array'),
            'urn:SOAPServerWSDL',
            'urn:'.$ns.'tampilListDokter',
            'rpc',
            'encoded',
            'Daftar Dokter'
        );

        $this->nusoap_server->register(
            'updateListDokter',
            $update_dokter,
            $return_dokter,
            'urn:SOAPServerWSDL',
            'urn:'.$ns.'updateListDokter',
            'rpc',
            'encoded',
            'Update Dokter'
        );

        $this->nusoap_server->register(
            'deleteDokter',
            $masuk_dokter,
            $return_dokter,
            'urn:SOAPServerWSDL',
            'urn:'.$ns.'deleteDokter',
            'rpc',
            'encoded',
            'Delete dokter'
        );

        $this->nusoap_server->register(
        'listDokter',                          // method name
        array('input' => 'xsd:string'),    // input parameters
        array('output' => 'xsd:Array'),    // output parameters
        'urn:SOAPServerWSDL',              // namespace
        'urn:'.$ns.'listDokter',               // soapaction
        'rpc',                             // style
        'encoded',                         // use
        'Daftar Dokter'                    // documentation
    );

        $this->load->model(array('M_rekam'));
    }

    public function index(){

        function insertpasien($nama,$nik,$notlp,$jeniskelamin,$alamat,$tanggallahir,$golongandarah){
            $ci =&get_instance();

            $param = array('nama' => $nama, 'jenis_kelamin' => $jeniskelamin, 'nik' => $nik, 'no_tlp' => $notlp, 'alamat' => $alamat, 'tanggal_lahir' => $tanggallahir, 'golongan_darah' => $golongandarah);
            
            $result = $ci->M_rekam->tambahpasien($param);
            // $this->rekam_medis->tambahpasien($pasien);
            $sukses= "Insert Pasien Success";
            // return $sukses;
        }

        function insertdokter($nama,$jeniskelamin,$profesi){
            $ci =&get_instance();

            $param = array('nama' => $nama, 'jenis_kelamin' => $jeniskelamin, 'profesi' => $profesi);
            
            $result = $ci->M_rekam->tambahdokter($param);
            // $this->rekam_medis->tambahpasien($pasien);
            $sukses= "Insert Dokter Success";
            return $sukses;
        }

        function listDokter(){
            $ci =&get_instance();
            $result = $ci->M_rekam->getDokter();

            foreach($result as $row => $value){                 
                $return_value[] = array(
                    'id' => $value->id,
                    'nama'=> $value->nama,
                    'jenis_kelamin'=> $value->jenis_kelamin,
                    'profesi'=> $value->profesi
                );
            }
            $json = json_encode($return_value);
            return $json;
    }

    function updatelistDokter($id,$nama,$jeniskelamin,$profesi){
             $ci =&get_instance();
             $param = array('nama' => $nama, 'jenis_kelamin' => $jeniskelamin, 'profesi' => $profesi);
             $result = $ci->M_rekam->updateDataDokter($id,$param);
             $sukses= "Update Pasien Success";
        }

        function tampilListDokter($id){
                $ci =&get_instance();
                $result = $ci->M_rekam->tampilListDokter($id);

                foreach($result as $row => $value){                 
                    $return_value[] = array(
                        'id' => $value->id,
                        'nama'=> $value->nama,
                        'jenis_kelamin'=> $value->jenis_kelamin,
                        'profesi'=> $value->profesi
                    );
                }
                $hasil =json_encode($return_value);
                return $hasil;   
        }

        function deleteDokter($id){
            $ci =&get_instance();
            $result = $ci->M_rekam->deleteDataDokter($id);
            $hasil = "Sukses";
            return $hasil;
        }

        // read raw data from request body
        $this->nusoap_server->service(file_get_contents("php://input")); 
    }
}    
?>