<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('admin_model');
	}
	public function index($category = null, $slug = null, $uid = null){		
		
		$type="";
		$temp=explode("-",$slug);
		$temp1=end($temp);

		if($temp1=="classroom" || $temp1=="virtual" || $temp1=="online" || $temp1=="webinar"){
			$type=$temp1;
			array_pop($temp);
			$slug=implode("-",$temp);
		}
		
		if($category != null && $type == 'online'){
			return $this->_elearning_overview($category,$slug);
		}
		
		if($category != null && $slug != null){
			$temp=explode("-",$slug);
			$citySlug=end($temp);
			$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
			if($city){
				array_pop($temp);
				$slug=implode("-",$temp);
				return $this->_course_session_detail($category,$slug,$citySlug);
			}else{
				return $this->_course_detail($category,$slug);
			}
		}
		
		if($category != null){
			return $this->_category($category);
		}
		
		
		
		$pageData['currentPage'] = 'HOME';
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data["courses"] = $pageData["courses"];
		$data["testimonials"] = $this->admin_model->getTestimonials('LIST',"");
		//var_dump($data["courses"]);exit();
		$this->load->view('index',$data);

	}
	public function _category($slug){	
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$category = $this->home_model->getCategories(array('type'=>'SLUG','slug'=>$slug));
		if($category){ 
			$data["category"] = $category;
			$data["courses"] = $this->home_model->getCourse(array('type'=>'LIST_CATEGORY','categoryID'=>$category->categoryID));
			$data["countries"] = $this->home_model->getLocation(array('type'=>'COUNTRIES'));
			$citySlug = $this->config->item("cityUrl");
			$data["city"] = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
			
			$this->load->view('course/category',$data);
		}else{
			$this->load->view('404',$data);
		}
	}
	
	public function _course_detail($category,$slug){
		
		$citySlug = $this->config->item("cityUrl");
		$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
		$course = $this->home_model->getCourse(array('type'=>'SLUG','slug'=>$slug));
		$category = $this->home_model->getCategories(array('type'=>'SLUG','slug'=>$category));
		$pageData = $this->home_model->getHeader();
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		if($course && $category){
			$data["category"] = $category;
			$data["course"] = $course;
			$data["city"] = $city;
			$data["courses"] = $pageData["courses"];
			
			$data["faqs"] = $this->home_model->getCourseFaqs(array('type'=>'LIST','courseID'=>$course->courseID));
			$data["countries"] = $this->home_model->getLocation(array('type'=>'COUNTRIES'));
			$data["cities"] = $this->home_model->getLocation(array('type'=>'CITIES_LIST'));
			$data["availableCities"] = $this->home_model->getSessions(array('type'=>'AVAILABALE_CITIES','courseID'=>$course->courseID,'countryID'=>$city->countryID,'cityID'=>$city->cityID));
			
			//var_dump($data["city"]);exit();
			$this->load->view('course/course_overview',$data);
		}else{
			$this->load->view('404',$data);
		}
	}
	public function _elearning_overview($category,$slug){
		
		$citySlug = $this->config->item("cityUrl");
		$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
		$course = $this->home_model->getCourse(array('type'=>'SLUG','slug'=>$slug));
		$category = $this->home_model->getCategories(array('type'=>'SLUG','slug'=>$category));
		$pageData = $this->home_model->getHeader();
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		if($course && $category){
			$data["category"] = $category;
			$data["course"] = $course;
			$data["city"] = $city;
			$data["courses"] = $pageData["courses"];
			
			$data["faqs"] = $this->home_model->getCourseFaqs(array('type'=>'LIST','courseID'=>$course->courseID));
			$data["countries"] = $this->home_model->getLocation(array('type'=>'COUNTRIES'));
			$data["cities"] = $this->home_model->getLocation(array('type'=>'CITIES_LIST'));
			$data["availableCities"] = $this->home_model->getSessions(array('type'=>'AVAILABALE_CITIES','courseID'=>$course->courseID,'countryID'=>$city->countryID,'cityID'=>$city->cityID));
			
			//var_dump($data["city"]);exit();
			$this->load->view('course/elearning_overview',$data);
		}else{
			$this->load->view('404',$data);
		}
	}
	public function _course_session_detail($category,$slug,$citySlug){
		
		/* $temp=explode("-",$slug);
		$citySlug=end($temp);
		$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
		if($city){
			array_pop($temp);
			$slug=implode("-",$temp);
		}else{
			$citySlug = $this->config->item("cityUrl");
			$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
		} */
		$city = $this->home_model->getLocation(array('type'=>'CITY_SLUG','slug'=>$citySlug));
		$course = $this->home_model->getCourse(array('type'=>'SLUG','slug'=>$slug));
		$category = $this->home_model->getCategories(array('type'=>'SLUG','slug'=>$category));
		$pageData = $this->home_model->getHeader();
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		if($course && $category && $city){
			$data["category"] = $category;
			$data["course"] = $course;
			$data["city"] = $city;
			$data["courses"] = $pageData["courses"];
			
			//Sessions
			$sessions = $this->home_model->getSessions(array('type'=>'CITY','cityID'=>$city->cityID));
			$ssns = array();
			foreach($sessions as $s)array_push($ssns,$s->sessionID);
			$sessionIDs='';
			if(count($ssns)>0)$sessionIDs = implode("','",$ssns);
			$days = $this->home_model->getSessions(array('type'=>'DAYS_LIST','sessionID'=>$sessionIDs));
			$sessions = $this->_month_wise_schedule_with_days($sessions,$days);
			$data["sessions"] = $sessions;
			
			
			$data["faqs"] = $this->home_model->getCourseFaqs(array('type'=>'LIST','courseID'=>$course->courseID));
			$data["countries"] = $this->home_model->getLocation(array('type'=>'COUNTRIES'));
			$data["cities"] = $this->home_model->getLocation(array('type'=>'CITIES_LIST'));
			$data["availableCities"] = $this->home_model->getSessions(array('type'=>'AVAILABALE_CITIES','courseID'=>$course->courseID,'countryID'=>$city->countryID,'cityID'=>$city->cityID));
			
			//var_dump($data["sessions"]);exit();
			$this->load->view('course/course_session_overview',$data);
		}else{
			$this->load->view('404',$data);
		}
	}
	function courses(){
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data["categories"] = $this->home_model->getCategories(array('type'=>'LIST'));
		$data["courses"] = $this->home_model->getCourse(array('type'=>'LIST'));
		$this->load->view('course/courses_list',$data);
	}
	
	public function _month_wise_schedule_with_days($sessions,$days) {
		
		if(!empty($sessions) && !empty($days)) {

			foreach ($sessions  as $session) {
				$months = array();$count = 0;
				foreach ($days  as $date) {
					
					if($date->sessionID == $session->sessionID){
					
						$month = date('M', strtotime($date->date));

						$day['day'] = date('D', strtotime($date->date));
						$day['date'] = date('d', strtotime($date->date));

						if(isset($months[$month])) {

							array_push($months[$month], $day);
						} else {

							$months[$month] = array();

							array_push($months[$month], $day);
						}
						$count++;
					}
				}
				$session->days = $months;
				$session->daysCount = $count;
			}
		}
		return $sessions;		
	}	
	
	function getLocation(){
		$data['type']=$this->input->post('type');
		$data['countryID']=$this->input->post('countryID');
		$data['stateID']=$this->input->post('stateID');
		$data['cityID']=$this->input->post('cityID');
		echo json_encode($this->home_model->getLocation($data));
	}
	public function login(){	
		
		if($this->session->userdata('login') == true)redirect(base_url(),'refresh');
		$pageData = $this->home_model->getHeader();
		$pageData['currentPage'] = 'LOGIN';
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data["courses"] = $pageData["courses"];
		$data["countries"] = $this->home_model->getLocation(array('type'=>'COUNTRIES'));
		$this->load->view('login',$data);
	}
	function register(){
		$status = array();
		$data['type']="INSERT";
		$data['firstName']=$this->input->post('name');
		$data['email'] = $email =$this->input->post('email');
		$data['password']=$password=$this->input->post('password');
		$data['phone']=$this->input->post('phone');
		$data['countryID']=$this->input->post('countryID');
		$data['cityID']=$this->input->post('cityID');
		$data['courseID']=$this->input->post('courseID');
		
		$status['status'] = false;
		$check = $this->admin_model->getUsers(array('type'=>'EMAIL_CHECK','email'=>$email));
		if($check){
			$status['status'] = 'EXIST';
		}else{
			$qry = $this->db->query("SELECT roleID FROM tbl_roles WHERE roleCode = 'USER'")->row();
			$data['roleID']=$qry->roleID;
			$data['status']="P";
			$userID = $this->admin_model->user_save($data);
			if($userID)
				$status = $this->admin_model->login($email,$password);
		}
		echo json_encode($status);
	}
	function login_check(){
		echo json_encode($this->admin_model->login($this->input->post('email'),$this->input->post('password')));
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}
	
}
