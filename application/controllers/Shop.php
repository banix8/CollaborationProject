<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Product','prod');	
		$this->load->model('Customers','cust');
		$this->load->model('Order');		
	}	

	public function index(){
		$data['latest_products'] = $this->prod->read_latest_product();		
		$data['products'] = $this->prod->read_all_products();
		$data['pagename'] = 'Shop';
		$data['contents'] = 'contents/shop/home';		
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');
	}
	public function details(){
		$productid = $this->input->get('product');
		$data['product_detail']=$this->prod->read_product_by_id($productid);
		// $data['stock']=$this->prod->read_stocks_by_id($productid);
		//echo var_dump($data);
		$data['pagename'] = 'Details';
		$data['contents'] = 'contents/shop/single';		
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');	

	}

	public function cart() {
        $data = array();
        $data['cart_contents'] = $this->cart->contents();
		$data['pagename'] = 'Cart';
		$data['contents'] = 'contents/shop/cart';	
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');
    }
    public function save_cart() {
        $data = array();
		$productid = $this->input->post('product_id');
        $results = $this->prod->read_product_by_id($productid);

        $data['id'] = $results[0]->product_id;
        $data['name'] = $results[0]->product_name;
        $data['price'] = $results[0]->sell_price;
        $data['qty'] = $this->input->post('qty');
        $data['options'] = array('product_image' => $results[0]->product_image);

        $this->cart->insert($data);
        //echo var_dump($this->cart->contents());
        redirect('Shop/cart');
    }
    public function remove_cart() {

        $data = $this->input->post('rowid');
        $this->cart->remove($data);
        redirect('shop/cart');
    }    
    public function checkout(){
    	$this->check_access();
    	if($this->cart->total_items()){
    			$customer=$this->session->userdata('cus_id');
    			$data['customer_info']=$this->cust->read_customer_info_by_id($customer);
        		$data['cart_contents'] = $this->cart->contents();
        		$data['payment']= $this->Order->read_payment_method();  
        		$data['courier']=$this->Order->read_courier();  	
    			$data['pagename'] = 'Orders';
				$data['contents'] = 'contents/shop/order';	
				$this->load->view('templates/header');		
				$this->load->view('templates/main', $data);
				$this->load->view('templates/footer');
		}
		else{
			redirect('shop');
		}


    }

    public function save_order(){
    	$this->check_access();

    	$tax=($this->cart->total()*12)/100;
    	$total=$tax + $this->cart->total();
    	if($this->input->post('payment')==1){
			$payment_status="Pending";
			}
		else{
			$payment_status="Paid";
			}
		$data=array(
			'cus_id'=> $this->session->userdata('cus_id'),
			'cour_id'=>$this->input->post('cour'),
			'amount'=>$total,
			'payment_id'=>$this->input->post('payment'),
			'payment_status'=>$payment_status


		);
		$result=$this->Order->save_order($data);
		$chk=$this->Order->save_billing($data,$result);


		$newdata=array();
		$mycart=$this->cart->contents();

		foreach($mycart as $cart){
			$newdata['order_id']=$result;
			$newdata['product_id']=$cart['id'];
			$newdata['quantity']=$cart['qty'];
			$this->Order->save_order_details_info($newdata);
		}
		$this->cart->destroy();
		redirect('shop/view_orders');

    }

	public function view_orders(){
		$this->check_access();
		$cus_data=$this->session->userdata('cus_id');
		$data['order']=$this->cust->read_order_by_customer($cus_data);
    	$data['pagename'] = 'Orders';
		$data['contents'] = 'contents/shop/orderhistory';	
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');		


	}    

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 3){
				return true;
			}else{
				redirect('app');
			}
	    }else{
	    	redirect('app');
	    }
    }
}