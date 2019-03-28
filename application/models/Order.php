<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {



	public function read_payment_method(){
		$sql="SELECT * from payment";

		return $this->db->query($sql)->result();

	}
	public function read_courier(){
		$sql="SELECT * from courier";

		return $this->db->query($sql)->result();

	}



	public function save_order($data){
		$this->db->insert('orders',array('cus_id'=>$data['cus_id'],'cour_id'=>$data['cour_id']));
		return $this->db->insert_id();

	}

	public function save_order_details_info($data){
		$this->db->insert('order_details',$data);


	}
	public function save_billing($data,$result){
		return $this->db->insert('billing',array('amount'=>$data['amount'],'payment_status'=>$data['payment_status'],'payment_id'=>$data['payment_id'],'order_id'=>$result,'cus_id'=>$data['cus_id']));
	}	
}