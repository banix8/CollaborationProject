<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Useraccount', 'user');
		$this->load->model('Product','prod');	
	}

	public function index(){
		$this->check_access();
		$data['users'] = $this->user->read();

		$data['pagename'] = 'Dashboard';
		$data['contents'] = 'dashboard';		
		$this->load->view('templates/sbadmin', $data);
	}

	public function update(){
		$this->check_access();
		$userid = $this->input->get('userid');

		$data['useraccount'] = $this->user->read($userid);

		$data['pagename'] = 'Dashboard';
		$data['contents'] = 'contents/admin/update';		
		$this->load->view('templates/main', $data);

	}

	public function add_product(){
		$this->check_access();
		$data['category']= $this->prod->read_all_category();
		$data['supplier']=$this->prod->read_all_supplier();
		$data['pagename'] = 'ADD PRODUCT';
		$data['contents'] = 'contents/admin/addproduct';		
		$this->load->view('templates/sbadmin', $data);		

	}
	public function register_supplier(){
		$this->check_access();
		$data['pagename'] = 'Supplier Registration';
		$data['contents'] = 'contents/admin/supplier_registration';
		$this->load->view('templates/sbadmin', $data);
	}

	public function supplier_registration(){
		$this->check_access();

		$data = $this->input->post(); // return $_POST global array

		$err = $this->validate($data); // return array of error messages

		$this->setFlashData(array('alertType' => 'danger'));

		if(count($err) == 0){
			$result=$this->user->create_supp($data);
			if($this->user->create_supplier($data,$result)){
				$this->setFlashData(array('alertType' => 'success'));
				$this->setFlashData(array('system_msg' => array("Supplier successfully added")));
			}else{
				$this->setFlashData(array('system_msg' => array("Failed to create!")));
			}
		}else{
			$this->setFlashData(array('system_msg' => $err));
		}
		
		redirect('Supplier/register_supplier');
	}	

	public function updateAccount(){

		$data = $this->input->post();
		$userid = $this->input->post('userid');

		if($this->user->update($data, $userid)){
			redirect('dashboard');
		}else{
			echo "Failed to update! <a href='".base_url('dashboard')."'>Go back</a>";
		}

	}
	public function submit_product(){
		$data=$this->input->post();
		if($this->prod->save_product($data)){
			$this->setFlashData(array('alertType' => 'success'));
			$this->setFlashData(array('system_msg' => array("Successfully added a new product")));
		}
		else{
			$this->setFlashData(array('system_msg' => array("Failed to create!")));
		}
		redirect('dashboard/add_product');
	}

	public function disable(){

		$userid = $this->input->get('userid');

		if($this->user->disable($userid)){
			redirect('dashboard');
		}else{
			echo "Failed to disable! <a href='".base_url('dashboard')."'>Go back</a>";
		}

	}

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 1){
				return true;
			}else{
				redirect('app');
			}
	    }else{
	    	redirect('app');
	    }
    }
	private function setFlashData($data){
		$this->session->set_flashdata($data);
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