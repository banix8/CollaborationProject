<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccount extends CI_Model {

    protected $table = "useraccounts";

    public function check_account($data){
    	$sql = "SELECT * FROM ".$this->table." WHERE username = '".$data['username']."' AND password = '".$data['password']."'";

    	return $this->db->query($sql)->result();
    }

	public function create($data){

		$sql = "INSERT INTO ".$this->table." (username, password) VALUES ('".$data['username']."','".$data['password']."')";

		$this->db->query($sql);
		return $this->db->insert_id();

		// return $this->db->insert($data);

	}
	public function create_customer($data,$result){

		return $this->db->insert('customers',array('userid'=>$result,'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'middle_name'=>$data['middle_name'],'contact_num'=>$data['contact'],'cus_street'=>$data['street'],'cus_city'=>$data['city'],'cus_province'=>$data['province'],'cus_email'=>$data['email'],'cus_postal'=>$data['postal']));	

	}

	public function read($id = null){
		if($id != null){
			$sql = "SELECT * FROM ".$this->table." WHERE userid = ".$id;

			return $this->db->query($sql)->result();
		}

		$sql = "SELECT * FROM ".$this->table." WHERE status = '1' ";

		return $this->db->query($sql)->result();

		// return $this->db->get($this->table);

	}

	public function update($data, $id){
		$sql = "UPDATE ".$this->table." SET username = '".$data['username']."', password = '".$data['password']."' WHERE userid = '".$userid."'";

		return $this->db->query($sql);

		// return $this->db->where('userid', $userid)->update($this->table, $data);

	}

	public function disable($id){
		$sql = "UPDATE ".$this->table." SET status = '0' WHERE userid = '".$id."'";

		return $this->db->query($sql);
	}
	public function user_check($data){
		$sql="SELECT * from useraccounts where username= '".$data."'";
		return $this->db->query($sql);

	}

	public function check_userid($data){

		$sql="SELECT * from customers where userid=".$data;

		return $this->db->query($sql)->result();
	}

}
