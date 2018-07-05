<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");
class Tesinsertdokter extends CI_Controller {
	private $api_url = 'http://localhost/medisserver/index.php/medisserver';
	function __construct(){
		parent::__construct();
		// load nusoap toolkit library in controller
		$this->load->library("Nusoap_library");
		// create soap server object
		$this->nusoap_client = new nusoap_client($this->api_url.'?wsdl', 'wsdl');
	}

	function index(){
		$data['action'] = 'http://localhost/medisclient/index.php/tesinsertdokter';
		
		$post = $_POST;
		if(!empty($post)){
		// pengecekan error
			$error = $this->nusoap_client->getError();
			if ($error) {
				$data['error'] = '<h2>Constructor error</h2><pre>' . $error . '</pre>';
			}else{
				// menggunakan data post sebagai parameter
				$param = array('nama' => $post['nama'], 'jeniskelamin' => $post['jeniskelamin'], 'profesi' => $post['profesi']);
				
				// memanggil dan mengeksekusi metode/fungsi penjumlahan di server
				$result = $this->nusoap_client->call('insertdokter',$param);
				var_dump($result);
				
				if($this->nusoap_client->fault){
					$data['fault'] = '<h2>Fault (Expect - The request contains an invalid
					SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
				}else{
					$err = $this->nusoap_client->getError();
					if ($err) {
						$data['error'] = '<h2>Error</h2><pre>' . $err . '</pre>';
					}else{
						/*$data['result'] ='<h2>Result</h2><p> Hasil penjumlahan :
						sukses</p>';*/
					}
				}
			}
		}
		$this->load->view('tesinsertdokter', $data);
	}
}
?>