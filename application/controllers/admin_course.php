<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_course extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('admin_course_model');
	}
	public function courses($courseType=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'SESSION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['courses'] = $this->admin_model->getCourse(array('type'=>'LIST'));
		$data['cities'] = $this->admin_model->getLocation(array('type'=>'CITIES_LIST'));
		$data['courseType'] = $courseType;
		if($courseType=="classroom" || $courseType=="virtual"){
			$this->load->view('admin/session/courses',$data);
		}else{
			$this->load->view('error_404',$data);
		}
	}
	public function sessions($courseType="",$courseID="",$cityID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'SESSION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['course'] = $this->admin_model->getCourse(array('type'=>'S','courseID'=>$courseID));
		$data['city'] = $this->admin_model->getLocation(array('type'=>'CITY','cityID'=>$cityID));
		$data['cities'] = $this->admin_model->getLocation(array('type'=>'CITIES_LIST'));
		$data['sessions'] = $this->admin_course_model->getSessions(array('type'=>'LIST','courseType'=>$courseType,'courseID'=>$courseID,'cityID'=>$cityID));
		$data['courseID'] = $courseID;
		$data['cityID'] = $cityID;
		$data['courseType'] = $courseType;
		//var_dump($data['sessions']);exit();
		if($data['course'] && $data['city'] && ($courseType=="classroom" || $courseType=="virtual")){
			$this->load->view('admin/session/sessions',$data);
		}else{
			$this->load->view('error_404',$data);
		}
	}
	public function session($courseType="",$courseID="",$cityID="",$sessionID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'SESSION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['course'] = $this->admin_model->getCourse(array('type'=>'S','courseID'=>$courseID));
		$data['city'] = $this->admin_model->getLocation(array('type'=>'CITY','cityID'=>$cityID));
		$data['currencies'] = $this->admin_model->getCurrency(array('type'=>'LIST'));
		$data['trainers'] = $this->admin_model->getUsers(array('type'=>'UR','roleCode'=>$this->config->item('trainer_role')));
		$data['session'] = $this->admin_course_model->getSessions(array('type'=>'S','sessionID'=>$sessionID));
		$data['days'] = $this->admin_course_model->getSessions(array('type'=>'DAYS','sessionID'=>$sessionID));
		$data['courseID'] = $courseID;
		$data['cityID'] = $cityID;
		$data['sessionID'] = $sessionID;
		$data['courseType'] = $courseType;
		//var_dump($data['session']);exit();
		if($data['course'] && $data['city'] && ($courseType=="classroom" || $courseType=="virtual")){
			$this->load->view('admin/session/session',$data);
		}else{
			$this->load->view('error_404',$data);
		}
	}
	function session_save($courseID,$cityID){
		echo json_encode($this->admin_course_model->session_save($courseID,$cityID));
	}
	public function city_content_courses(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['courses'] = $this->admin_model->getCourse(array('type'=>'CITY_CONTENT_LIST'));
		$data['cities'] = $this->admin_model->getLocation(array('type'=>'CITIES_LIST'));
		$this->load->view('admin/course/city_content_courses',$data);
	}
	public function city_content_course($courseID="",$cityID=""){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'COURSE';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['course'] = $this->admin_model->getCourse(array('type'=>'S','courseID'=>$courseID));
		$data['city_content'] = $this->admin_model->getCourse(array('type'=>'CITY_CONTENT','courseID'=>$courseID,'cityID'=>$cityID));
		$data['city'] = $this->admin_model->getLocation(array('type'=>'CITY','cityID'=>$cityID));
		if($data['city_content']){
			$data['faq'] = $this->admin_model->getCourseFaqs(array('type'=>'CITY_LIST','courseID'=>$courseID,'cityID'=>$cityID));
			$data['why'] = $this->admin_model->getCourseWhyus(array('type'=>'CITY_LIST','courseID'=>$courseID,'cityID'=>$cityID));
		}else{
			$data['faq'] = $this->admin_model->getCourseFaqs(array('type'=>'LIST','courseID'=>$courseID));
			$data['why'] = $this->admin_model->getCourseWhyus(array('type'=>'LIST','courseID'=>$courseID));
		}
		$data['trainers'] = $this->admin_model->getUsers(array('type'=>'UR','roleCode'=>$this->config->item('trainer_role')));
		$data['courseID'] = $courseID;
		$data['cityID'] = $cityID;
		//var_dump($data['city_content']);exit();
		if($data['course'] && $data['city']){
			$this->load->view('admin/course/city_content_course',$data);
		}else{
			$this->load->view('error_404',$data);
		}
	}
	function city_content_save(){
		echo json_encode($this->admin_course_model->city_content_save());
	}
	public function online_courses(){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');		
		$pageData['currentPage'] = 'SESSION';
		$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['courses'] = $this->admin_model->getCourse(array('type'=>'LIST'));
		$this->load->view('admin/session/elearning_courses',$data);
	}
	public function online_prices($courseID){
		if(!$this->session->userdata('login'))redirect('admin/login','refresh');
		$course = $this->admin_model->getCourse(array('type'=>'S','courseID'=>$courseID));
		if($course){ 
			$pageData['currentPage'] = 'SESSION';
			$data['header'] = $this->load->view('templates/admin_header',$pageData,true);
			$data['footer'] = $this->load->view('templates/footer',$pageData,true);
			$data['course'] = $course;
			$data['courseID'] = $courseID;
			$data['currencies'] = $this->admin_model->getCurrency(array('type'=>'LIST'));
			$data['prices'] = $this->admin_course_model->getElearningPrice('LIST',$courseID);
			$data['duration'] = $this->admin_course_model->getElearningPrice('DURATION',$courseID);
			//var_dump($data['duration']);exit();
			$this->load->view('admin/session/elearning_price',$data);
		}else{
			$this->load->view('error_404',$data);
		}
	}
	function elearning_price_save(){
		echo json_encode($this->admin_course_model->elearning_price_save());
	}
}
?>