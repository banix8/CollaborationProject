<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Inventaryo','inv');		
	}	

	public function index(){
		$this->check_access();
	//	$data['latest_products'] = $this->prod->read_latest_product();		
		$data['products'] = $this->inv->read_all_products();
		$data['pagename'] = 'Inventory';
		$data['contents'] = 'contents/admin/inventory';		
		$this->load->view('templates/sbadmin', $data);
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
}