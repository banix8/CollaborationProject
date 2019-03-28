<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Model {

    protected $table = "customers";


	public function read_customer_info_by_id($id){

		$sql = "SELECT * FROM ".$this->table." WHERE cus_id =".$id;

		return $this->db->query($sql)->result();

		// return $this->db->insert($data);

	}

	public function read_order_by_customer($id){

		$sql="SELECT * FROM orders o join customers c on o.cus_id=c.cus_id join billing b on c.cus_id=b.cus_id join courier cr on o.cour_id=cr.cour_id where o.cus_id=".$id." Group by billing_id DESC";

		return $this->db->query($sql)->result();
	}

}
