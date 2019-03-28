<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

    protected $table = "supplier";

    public function check_account($data){
    	$sql = "SELECT * FROM ".$this->table." WHERE username = '".$data['username']."' AND password = '".$data['password']."'";

    	return $this->db->query($sql)->result();
    }
	public function create($data){

		$sql = "INSERT INTO ".$this->table." (username, password,accesslevel) 
		VALUES ('".$data['username']."','".$data['password']."',4)";

		$this->db->query($sql);
		return $this->db->insert_id();

		// return $this->db->insert($data);

	}    

	public function create_supplier($data){

		$sql = "INSERT INTO ".$this->table." ( userid,contact_number, supplier_companyname, supplier_street, supplier_city, supplier_province  ,supplier_postal ,supplier_email  )
		VALUES
		(
		".$result.
		"'".$data['contact_number']."',
		'".$data['supplier_companyname']."',
		'".$data['supplier_street']."',
		'".$data['supplier_city']."',
		'".$data['supplier_province']."',
		'".$data['supplier_postal']."',
		'".$data['supplier_email']."'
		)";

		return $this->db->query($sql);

		// return $this->db->insert($data);

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

}