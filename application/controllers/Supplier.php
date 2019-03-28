<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Useraccount', 'user');
	}

	public function index(){
		$this->check_access();
		$data['pagename'] = 'Login';
		$data['contents'] = 'login';
		$this->load->view('templates/headerlogin');
		$this->load->view('templates/main', $data);
	}

	public function register_supplier(){
		$this->check_access();
		$data['pagename'] = 'Supplier Registration';
		$data['contents'] = 'contents/admin/supplier_registration';
		$this->load->view('templates/sbadmin', $data);
	}



	public function registration(){

		$data = $this->input->post(); // return $_POST global array

		$result = $this->validate($data); // return array of error messages

		$this->setFlashData(array('alertType' => 'danger'));

		if(count($result) == 0){
			$result=$this->user->create_supp($data);
			if($this->user->create_supplier($data,$result)){
				$this->setFlashData(array('alertType' => 'success'));
				$this->setFlashData(array('system_msg' => array("Wait for admin approval!")));
			}else{
				$this->setFlashData(array('system_msg' => array("Failed to create!")));
			}
		}else{
			$this->setFlashData(array('system_msg' => $result));
		}
		
		redirect('Supplier/register_supplier');
	}

	private function setSession($data){
		$sessionData = array(
		    'username'  => $data[0]->username,
		    'accesslevel' => $data[0]->accesslevel,
		    'logged_in' => TRUE
		);

		$this->session->set_userdata($sessionData);
	}

	private function setFlashData($data){
		$this->session->set_flashdata($data);
	}

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 1){
				redirect('dashboard');
			}else if($this->session->userdata('accesslevel') == 3){
				redirect('shop');
			}
		}else{
			return true;
		}
	}

	private function validate($data){

		$sudlanan_sa_error = []; 

		if($data['username'] == ''){
			array_push($sudlanan_sa_error, "Username is not define");
		}

		if(strlen($data['password']) < 6){
			array_push($sudlanan_sa_error, "Password should be atleast 6 characters");
		}

		if($data['password'] == ''){
			array_push($sudlanan_sa_error, "Password is not define");
		}

		if($data['repassword'] == ''){
			array_push($sudlanan_sa_error, "Please confirm your password");
		}

		if($data['password'] != $data['repassword']){
			array_push($sudlanan_sa_error, "Password doesn't match");
		}

		return $sudlanan_sa_error; // array size is zero if no errors
	}

}