<?php
if(! defined("BASEPATH")) exit("No direct script access allowed");
class Teslistpasien extends CI_Controller {
	private $api_url = 'http://localhost/medisserver/index.php/medisserver';
	function __construct(){
		parent::__construct();
			// load nusoap toolkit library in controller
		$this->load->library("Nusoap_library");
			// create soap server object
		$this->nusoap_client = new nusoap_client($this->api_url.'?wsdl', 'wsdl');
	}

	function index(){
		$error = $this->nusoap_client->getError();
		if ($error) {
			echo '<h2>Constructor error</h2><pre>' . $error . '</pre>';
		}else{
			$param = '';
			$result = $this->nusoap_client->call('listpasien',array($param));
			// var_dump($result);
			if($this->nusoap_client->fault){
				echo '<h2>Fault (Expect - The request contains an invalid SOAP
				body)</h2><pre>'; print_r($result); echo '</pre>';
			}else{
				$err = $this->nusoap_client->getError();
				if ($err) {
					echo '<h2>Error</h2><pre>' . $err . '</pre>';}else{
						if (!empty($result)) {
							$data['result']=$result;
							$this->load->view('testlistpasien',$data);
						}else{
							echo "Data is empty";
						}
					}
				}
			}

		}

		function update($id){	
			$error = $this->nusoap_client->getError();
			if ($error) {
				echo '<h2>Constructor error</h2><pre>' . $error . '</pre>';
			}else{
				$param = array('id'=>$id);
				$result = $this->nusoap_client->call('tampilupdatepasien',$param);
			// var_dump($result);
				if($this->nusoap_client->fault){
					echo '<h2>Fault (Expect - The request contains an invalid SOAP
					body)</h2><pre>'; print_r($result); echo '</pre>';
				}else{
					$err = $this->nusoap_client->getError();
					if ($err) {
						echo '<h2>Error</h2><pre>' . $err . '</pre>';
					}else{
						if (!empty($result)) {
							$data['result']=$result;
							$this->load->view('tesupdatepasien',$data);
						}else{
							echo "Data is empty";
						}
					}
				}
			}
		}

		function updatedata(){
			$post = $_POST;
			if(!empty($post)){
		// pengecekan error
				$error = $this->nusoap_client->getError();
				if ($error) {
					$data['error'] = '<h2>Constructor error</h2><pre>' . $error . '</pre>';
				}else{
				// menggunakan data post sebagai parameter
					$param = array('id' => $post['id'],'nama' => $post['nama'], 'jeniskelamin' => $post['jeniskelamin'], 'nik' => $post['nik'], 'notlp' => $post['notlp'], 'alamat' => $post['alamat'], 'tanggallahir' => $post['tanggallahir'], 'golongandarah' => $post['golongandarah']);

				// memanggil dan mengeksekusi metode/fungsi penjumlahan di server
					$result = $this->nusoap_client->call('updatelistpasien',$param);
					var_dump($result);

					if($this->nusoap_client->fault){
						$data['fault'] = '<h2>Fault (Expect - The request contains an invalid
						SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
					}else{
						$err = $this->nusoap_client->getError();
						if ($err) {
							$data['error'] = '<h2>Error</h2><pre>' . $err . '</pre>';
						}else{
							$data['result'] ='<h2>Result</h2><p> Hasil  :
							sukses</p>';
						}
					}
				}
			}
			$this->load->helper('url'); 
			redirect("http://localhost/medisclient/index.php/teslistpasien"); 
		}

		function delete($id){
			$error = $this->nusoap_client->getError();
			if ($error) {
				echo '<h2>Constructor error</h2><pre>' . $error . '</pre>';
			}else{
				$param = array('id'=>$id);
				$result = $this->nusoap_client->call('deletepasien',$param);
			// var_dump($result);
				if($this->nusoap_client->fault){
					echo '<h2>Fault (Expect - The request contains an invalid SOAP
					body)</h2><pre>'; print_r($result); echo '</pre>';
				}else{
					$err = $this->nusoap_client->getError();
					if ($err) {
						echo '<h2>Error</h2><pre>' . $err . '</pre>';
					}else{
						if (!empty($result)) {
							$data['result']=$result;
						}else{
							echo "Data is empty";
						}
					}
				}
			}
			$this->load->helper('url'); 
			redirect("http://localhost/medisclient/index.php/teslistpasien"); 
		}

	}	
	?>