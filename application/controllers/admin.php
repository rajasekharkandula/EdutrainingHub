<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('admin_course_model');
	}
	public function index(){		
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'DASHBOARD';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['user'] = $this->admin_model->getDashboard(array('type'=>'USERS'));
		//var_dump($data['user']);exit();
		$this->load->view('admin/dashboard',$data);
	}
	public function login(){		
		if($this->session->userdata('login') == true)redirect('admin','refresh');
		$pageData['currentPage'] = 'DASHBOARD';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$this->load->view('admin/login',$data);
	}
	public function users(){		
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'USERS';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['users'] = $this->admin_model->getUsers(array('type'=>'USERS'));
		$this->load->view('admin/users',$data);
	}
	public function user($userID=""){	
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'USERS';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['countries'] = $this->admin_model->getLocation(array('type'=>'COUNTRIES'));
		$data['roles'] = $this->admin_model->getRoles(array('type'=>'ROLES'));
		$data['details'] = $this->admin_model->getUsers(array('type'=>'USER','userID'=>$userID));
		$data["userID"] = $userID;
		$this->load->view('admin/user',$data);
	}
	function user_save(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$data['userID']=$this->input->post('userID');
		$data['type']=$this->input->post('type');
		$data['firstName']=$this->input->post('firstName');
		$data['lastName']=$this->input->post('lastName');
		$data['profilePic']=$this->input->post('profilePic');
		$data['email']=$this->input->post('email');
		$data['password']=$this->input->post('password');
		$data['sEmail']=$this->input->post('sEmail');
		$data['phone']=$this->input->post('phone');
		$data['sPhone']=$this->input->post('sPhone');
		$data['address1']=$this->input->post('address1');
		$data['address2']=$this->input->post('address2');
		$data['countryID']=$this->input->post('countryID');
		$data['stateID']=$this->input->post('stateID');
		$data['cityID']=$this->input->post('cityID');
		if($this->input->post('zipCode'))
		$data['zipCode']=$this->input->post('zipCode');
		$data['roleID']=$this->input->post('roleID');
		$data['status']=$this->input->post('status');
		echo json_encode($this->admin_model->user_save($data));
	}
	public function roles(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'USERS';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['roles'] = $this->admin_model->getRoles(array('type'=>'ROLES'));
		$this->load->view('admin/roles',$data);
	}
	public function role($roleID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'USERS';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['role'] = $this->admin_model->getRoles(array('type'=>'ROLE','roleID'=>$roleID));
		$data["roleID"] = $roleID;
		$this->load->view('admin/role',$data);
	}
	function role_save(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$data['type']=$this->input->post('type');
		$data['roleID']=$this->input->post('roleID');
		$data['roleName']=$this->input->post('roleName');
		$data['roleCode']=$this->input->post('roleCode');
		$data['desc']=$this->input->post('desc');
		$data['status']=$this->input->post('status');
		echo json_encode($this->admin_model->role_save($data));
	}
	public function categories(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['categories'] = $this->admin_model->getCategories(array('type'=>'CATEGORIES'));
		$this->load->view('admin/category/categories',$data);
	}
	public function category($categoryID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['category'] = $this->admin_model->getCategories(array('type'=>'CATEGORY','categoryID'=>$categoryID));
		$data["categoryID"] = $categoryID;
		$this->load->view('admin/category/category',$data);
	}
	public function courses(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['courses'] = $this->admin_model->getCourse(array('type'=>'LIST'));
		$data['status'] = $this->admin_model->getCourse(array('type'=>'STATUS_L'));
		$this->load->view('admin/course/courses',$data);
	}
	public function course($page="",$courseID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$pageData['currentPage'] = 'COURSE';
		$pageData['page'] = $page;
		$pageData['courseID'] = $courseID;
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['sidebar'] = $this->load->view('admin/course/sidebar',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['categories'] = $this->admin_model->getCategories(array('type'=>'CATEGORIES'));
		$data['courseTypes'] = $this->admin_model->getCourseTypes(array('type'=>'LIST'));
		$data['course'] = $this->admin_model->getCourse(array('type'=>'S','courseID'=>$courseID));
		$data["courseID"] = $courseID;
		
		if($page == 'info'){
			$data['courseTypeMaping'] = $this->admin_model->getCourseTypeMaping(array('type'=>'IDS','courseID'=>$courseID));
			$this->load->view('admin/course/course_info',$data);
		}
		if($page == 'basic'){
			$this->load->view('admin/course/course_basic',$data);
		}
		if($page == 'desc'){
			$this->load->view('admin/course/course_desc',$data);
		}
		if($page == 'faq'){
			$data['faq'] = $this->admin_model->getCourseFaqs(array('type'=>'LIST','courseID'=>$courseID));
			$data['why'] = $this->admin_model->getCourseWhyus(array('type'=>'LIST','courseID'=>$courseID));
			$this->load->view('admin/course/course_faq',$data);
		}
		if($page == 'dm'){
			$this->load->view('admin/course/course_dm',$data);
		}
		if($page == 'publish'){
			$data['status'] = $this->admin_model->getCourse(array('type'=>'STATUS','courseID'=>$courseID));
			//var_dump($data['status']);exit();
			$this->load->view('admin/course/course_publish',$data);
		}
		
	}
	function course_save(){
		echo json_encode($this->admin_model->course_save());
	}
	function course_basic_save(){
		echo json_encode($this->admin_model->course_basic_save());
	}
	function course_desc_save(){
		echo json_encode($this->admin_model->course_desc_save());
	}
	function course_faq_save(){
		echo json_encode($this->admin_model->course_faq_save());
	}
	function course_dm_save(){
		echo json_encode($this->admin_model->course_dm_save());
	}
	function course_publish(){
		echo json_encode($this->admin_model->course_publish());
	}
	function course_status_update(){
		echo json_encode($this->admin_model->course_status_update());
	}
	function category_save(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$data['type']=$this->input->post('type');
		$data['categoryID']=$this->input->post('categoryID');
		$data['categoryName']=$this->input->post('categoryName');
		$data['desc']=$this->input->post('desc');
		$data['status']=$this->input->post('status');
		echo json_encode($this->admin_model->category_save($data));
	}
	function getLocation(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$data['type']=$this->input->post('type');
		$data['countryID']=$this->input->post('countryID');
		$data['stateID']=$this->input->post('stateID');
		$data['cityID']=$this->input->post('cityID');
		echo json_encode($this->admin_model->getLocation($data));
	}
	public function login_check(){
		echo json_encode($this->admin_model->login($this->input->post('username'),$this->input->post('password')));
	}
	public function check_user(){
		echo json_encode($this->admin_model->check_user($this->input->post('email')));
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login','refresh');
	}
	function register(){
		$retvalue['status']=false;
		$data['type']='INSERT';
		$data['firstName']=$this->input->post('name');
		$data['email']=$this->input->post('email');
		$data['password']=$this->input->post('password');
		$data['phone']=$this->input->post('phone');
		$data['roleID']= $this->admin_model->getRoles(array('type'=>'CODE','roleName'=>$this->config->item('user_role')))->roleID;
		$data['status']='P';
		if($this->admin_model->user_save($data))
			echo json_encode($this->admin_model->login($this->input->post('email'),$this->input->post('password')));
		else
			echo json_encode($retvalue);
	}
	public function currencies(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['currencies'] = $this->admin_model->getCurrency(array('type'=>'LIST'));
		$this->load->view('admin/location/currencies',$data);
	}
	public function currency($currencyID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['currency'] = $this->admin_model->getCurrency(array('type'=>'S','currencyID'=>$currencyID));
		$data['currencyID'] = $currencyID;
		$this->load->view('admin/location/currency',$data);
	}
	function currency_save(){
		echo json_encode($this->admin_model->currency_save());
	}
	public function countries(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['countries'] = $this->admin_model->getLocation(array('type'=>'COUNTRIES'));
		$this->load->view('admin/location/countries',$data);
	}
	public function country($countryID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['country'] = $this->admin_model->getLocation(array('type'=>'COUNTRY','countryID'=>$countryID));
		$data['countryID'] = $countryID;
		$this->load->view('admin/location/country',$data);
	}
	function country_save(){
		echo json_encode($this->admin_model->country_save());
	}
	public function states(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['states'] = $this->admin_model->getLocation(array('type'=>'STATES_LIST'));
		$this->load->view('admin/location/states',$data);
	}
	public function state($stateID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['state'] = $this->admin_model->getLocation(array('type'=>'STATE','stateID'=>$stateID));
		$data['countries'] = $this->admin_model->getLocation(array('type'=>'COUNTRIES'));
		$data['stateID'] = $stateID;
		//var_dump($data['state']);exit();
		$this->load->view('admin/location/state',$data);
	}
	function state_save(){
		echo json_encode($this->admin_model->state_save());
	}
	public function cities(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['cities'] = $this->admin_model->getLocation(array('type'=>'CITIES_LIST'));
		//var_dump($data['cities']);exit();
		$this->load->view('admin/location/cities',$data);
	}
	public function city($cityID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'LOCATION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['city'] = $this->admin_model->getLocation(array('type'=>'CITY','cityID'=>$cityID));
		$data['countries'] = $this->admin_model->getLocation(array('type'=>'COUNTRIES'));
		$data['states'] = $this->admin_model->getLocation(array('type'=>'STATES_LIST'));
		$data['currencies'] = $this->admin_model->getCurrency(array('type'=>'LIST'));
		$data['cityID'] = $cityID;
		$this->load->view('admin/location/city',$data);
	}
	function city_save(){
		echo json_encode($this->admin_model->city_save());
	}
	public function group_discounts(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'DISCOUNT';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['group'] = $this->admin_model->getDiscounts('GROUP_LIST',"");
		$this->load->view('admin/discount/group_list',$data);
	}
	public function group_discount_create($discountID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'DISCOUNT';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['discountID'] = $discountID;
		$data['group'] = $this->admin_model->getDiscounts('GROUP_S',$discountID);
		//var_dump($data['group']);exit();
		$this->load->view('admin/discount/group_create',$data);
	}
	function group_discount_save(){
		echo json_encode($this->admin_model->group_discount_save());
	}
	public function special_discounts(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'DISCOUNT';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['special'] = $this->admin_model->getDiscounts('SPECIAL_LIST',"");
		$this->load->view('admin/discount/special_list',$data);
	}
	public function special_discount_create($discountID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'DISCOUNT';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['discountID'] = $discountID;
		$data['special'] = $this->admin_model->getDiscounts('SPECIAL_S',$discountID);
		//var_dump($data['group']);exit();
		$this->load->view('admin/discount/special_create',$data);
	}
	function special_discount_save(){
		echo json_encode($this->admin_model->special_discount_save());
	}
	public function testimonials(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['list'] = $this->admin_model->getTestimonials('LIST',"");
		$this->load->view('admin/course/testimonials',$data);
	}
	public function testimonial_create($testimonialID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['testimonialID'] = $testimonialID;
		$data['data'] = $this->admin_model->getTestimonials('S',$testimonialID);
		//var_dump($data['group']);exit();
		$this->load->view('admin/course/testimonial_create',$data);
	}
	function testimonial_save(){
		echo json_encode($this->admin_model->testimonial_save());
	}
}
