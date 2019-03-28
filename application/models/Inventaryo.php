 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventaryo extends CI_Model {
	protected $table = 'products';
	
	public function read_all_products(){
		$sql = "SELECT *  FROM ".$this->table." p join stock s on p.product_id=s.product_id";
		return $this->db->query($sql)->result();
	}
	public function read_latest_product(){
		$sql = "SELECT * FROM ".$this->table." ORDER by date_added DESC LIMIT 2";
		return $this->db->query($sql)->result();
	}
	public function read_product_by_id($id){
		$sql = "SELECT * FROM ".$this->table." p join product_category c on p.category_id=c.category_id join stock s on p.product_id=s.product_id WHERE p.product_id='".$id."'";
		return $this->db->query($sql)->result();
	}	
	public function read_stocks_by_id($id){
		$sql = "SELECT * FROM stock WHERE product_id='".$id."'";
		return $this->db->query($sql)->result();
	}
}