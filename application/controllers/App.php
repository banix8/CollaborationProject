<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Useraccount', 'user');
	}

	public function index(){
		$this->check_access();
		$data['pagename'] = 'Login';
		$data['contents'] = 'login';			
		$this->load->view('templates/main', $data);

	}

	public function register(){
		$data['pagename'] = 'Register';
		$data['contents'] = 'contents/shop/registration';		
		$this->load->view('templates/main', $data);
	}


	public function login(){
		$data = $this->input->post();
		$result = $this->user->check_account($data);

		if(count($result) && $result[0]->accesslevel == 1){
			$this->setSession($result);	

			redirect('dashboard');
		}else if(count($result) && $result[0]->accesslevel == 3){
			$this->setSession($result);	
			if($this->cart->total_items()){
				redirect('shop/cart');
				}else{
					redirect('shop');
				}

		}else if(count($result) && $result[0]->accesslevel == 4){
			$this->setSession($result);	

			redirect('user_guide');				
		}else{
			$this->setFlashData(array('alertType' => 'danger'));
			$this->setFlashData(array('system_msg' => array("Account doesn't Exist!")));
		}

		redirect('app');

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('shop');
	}

	public function registration(){

		$data = $this->input->post(); // return $_POST global array

		$err = $this->validate($data); // return array of error messages

		$this->setFlashData(array('alertType' => 'danger'));

		if(count($err) == 0){
			$result=$this->user->create($data);
			if($this->user->create_customer($data,$result)){
				$this->setFlashData(array('alertType' => 'success'));
				$this->setFlashData(array('system_msg' => array("Successfully Registered!")));
			}else{
				$this->setFlashData(array('system_msg' => array("Failed to create!")));
			}
		}else{
			$this->setFlashData(array('system_msg' => $err));
		}
		
		redirect('app/register');
	}

	private function setSession($data){


		$sessionData = array(
		  	'username'  => $data[0]->username,
			'accesslevel' => $data[0]->accesslevel,
		   	'logged_in' => TRUE
		);				

		$this->session->set_userdata($sessionData);
		if($data[0]->accesslevel==3){
			$result=$this->user->check_userid($data[0]->userid);
			$this->session->set_userdata('cus_id',$result[0]->cus_id);
		}
		if($data[0]->accesslevel==4){
			$result=$this->user->check_userid($data[0]->userid);
			$this->session->set_userdata('supplier_id',$result[0]->supplier_id);
		}		
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
		if($this->user->user_check($data['username'])==0){
			array_push($sudlanan_sa_error, "Username is has already taken");
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
		if(!is_numeric($data['contact'])){
			array_push($sudlanan_sa_error, "Please put a valid number");
		}
		if($data['city'] == ''){
			array_push($sudlanan_sa_error, "City is not defined");
		}
		if($data['province'] == ''){
			array_push($sudlanan_sa_error, "Province is not defined");
		}	
		if($data['street'] == ''){
			array_push($sudlanan_sa_error, "Street is not defined");
		}				
		if($data['first_name'] == ''){
			array_push($sudlanan_sa_error, "Enter your first name");
		}
		if($data['last_name'] == ''){
			array_push($sudlanan_sa_error, "Enter your last name");
		}		
		if($data['postal'] == '' || !is_numeric($data['postal'])){
			array_push($sudlanan_sa_error, "Enter a valid postal code");
		}
		if($data['last_name'] == ''){
			array_push($sudlanan_sa_error, "Enter your last name");
		}	
		if($data['email'] == ''){
			array_push($sudlanan_sa_error, "Enter your email");
		}						



		return $sudlanan_sa_error; // array size is zero if no errors
	}

}
