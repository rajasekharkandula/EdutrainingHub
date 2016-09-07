<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('admin_model');
		$this->load->model('cart_model');
		//$this->session->sess_destroy();
	}
	public function index(){		
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'CART';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['cart'] = $cart = $this->session->userdata('cart');
		$data['currency'] = $currency = $this->session->userdata('currency');
		$data['contents'] = $this->cart_model->getCart('CONTENTS',$cart);
		$data['amount'] = $this->cart_model->getCart('AMOUNT',$cart);
		$data['user'] = $this->session->userdata('cart_user');
		//var_dump($data['cart']);exit();
		$this->load->view('cart/cart',$data);
	}
	public function payment(){	
		$this->session->set_userdata('redirect_url',base_url('cart/payment'));
if($this->session->userdata('login') != true && !$this->session->userdata("cart_user"))redirect(base_url('home/login'),'refresh');
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'PAYMENT';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['cart'] = $cart = $this->session->userdata('cart');
		$data['currency'] = $currency = $this->session->userdata('currency');
		$data['contents'] = $this->cart_model->getCart('CONTENTS',$cart);
		$data['amount'] = $this->cart_model->getCart('AMOUNT',$cart);
		//var_dump($data['amount']);exit();
		$this->load->view('cart/payment',$data);
	}
	public function add_cart(){		
		$cart = array();
		$sessionID = $this->input->post("sessionID");
		$session = $this->home_model->getSessions(array('type'=>'CART','sessionID'=>$sessionID));
		if($session){
			
			if($this->session->userdata('cart'))
				$cart = $this->session->userdata('cart');
			
			$amount = 0;
			if(strtotime(date('Y-m-d')) <= strtotime($session->offerDate))
				$amount = $session->offerAmount;
			else
				$amount = $session->amount;
			
			// Cart data
			$data = array(
				'id' => $sessionID,
				'qty' => 1,
				'amount' => $amount,
				'discount' => 0
			);
			
			//Creating row id
			$rowid=md5($sessionID);
			
			// let's unset this first, just to make sure our index contains only the data from this submission
			unset($cart[$rowid]);
			
			// Create a new index with our new row ID
			$cart[$rowid]['rowid'] = $rowid;

			// And add the new items to the cart array
			foreach ($data as $key => $val)
			{
				$cart[$rowid][$key] = $val;
			}
			//Destroying the sessions
			$this->session->unset_userdata('cart');
			
			//Creating sessions
			$this->session->set_userdata(array('cart' => $cart));
			$this->session->set_userdata(array('currency' => $session->currencyCode));
			
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}
	
	function save_cart_user(){
		$user["name"] = $this->input->post("name");
		$user["email"] = $this->input->post("email");
		$user["phone"] = $this->input->post("phone");
		$this->session->unset_userdata("cart_user");
		$this->session->set_userdata("cart_user",$user);
		echo json_encode(true);
	}
}
