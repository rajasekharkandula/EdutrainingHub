<?php 
class Home_model extends CI_Model{
		
	/**
	 * @return void
	 **/
	public function __construct(){
		parent::__construct();
		
	}
	function getHeader(){
		$data['courses'] = $this->getCourse(array('type'=>'LIST'));
		$data['categories'] = $this->getCategories(array('type'=>'LIST'));
		return $data;
	}
	function getCourse($data){
		$type="";$courseID="";$categoryID="";$cityID="";$slug="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['slug']))$slug=$data['slug'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['categoryID']))$categoryID=$data['categoryID'];
		
		if($type=="LIST"){
			$qry = $this->db->query("SELECT c.*,ca.categoryName,ca.categorySlug,concat(d.firstName,d.lastName) as modifiedBy FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy");
			return $qry->result();
		}
		if($type=="S"){
			$qry = $this->db->query("SELECT c.*,ca.categoryName,concat(d.firstName,' ',d.lastName) as modifiedBy FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy WHERE c.courseID = '$courseID'");
			return $qry->row();
		}
		if($type=="SLUG"){
			$qry = $this->db->query("SELECT c.*,ca.categoryName,concat(d.firstName,' ',d.lastName) as modifiedBy FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy WHERE c.slug = '$slug'");
			return $qry->row();
		}
		if($type=="CITY_CONTENT"){
			$qry = $this->db->query("SELECT c.*,concat(d.firstName,' ',d.lastName) as modifiedBy FROM tbl_course_city_content c INNER JOIN tbl_userdetails d ON d.userID = c.createdBy WHERE c.courseID = '$courseID' AND c.cityID='$cityID'");
			return $qry->row();
		}
		if($type=="CITY_CONTENT_LIST"){
			$qry = $this->db->query("SELECT ca.categoryName,c.*,concat(d.firstName,' ',d.lastName) as modifiedBy,course.courseName,city.cityName FROM tbl_course_city_content c INNER JOIN tbl_courses course ON course.courseID = c.courseID INNER JOIN tbl_categories ca ON ca.categoryID = course.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy INNER JOIN tbl_cities city ON city.cityID = c.cityID ORDER BY createdDate");
			return $qry->result();
		}
		if($type=="LIST_CATEGORY"){
			$qry = $this->db->query("SELECT * FROM tbl_courses WHERE categoryID = '$categoryID'");
			return $qry->result();
		}
	}
	public function getCategories($data){		
		$type="";$categoryID="";$userID="";$slug="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['slug']))$slug=$data['slug'];
		if(isset($data['categoryID']))$categoryID=$data['categoryID'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'LIST'){
			$qry = $this->db->query("SELECT category.*,(SELECT COUNT(*) FROM tbl_courses course WHERE course.categoryID = category.categoryID) as courseCount FROM tbl_categories category");
			return $qry->result();
		}
		if($type == 'S'){
			$qry = $this->db->query("SELECT * FROM tbl_categories WHERE categoryID = '$categoryID'");
			return $qry->row();
		}
		if($type == 'SLUG'){
			$qry = $this->db->query("SELECT * FROM tbl_categories WHERE categorySlug = '$slug'");
			return $qry->row();
		}
	}
	public function getLocation($data){		
		$type="";$countryID="";$stateID="";$cityID="";$slug="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['countryID']))$countryID=$data['countryID'];
		if(isset($data['stateID']))$stateID=$data['stateID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['slug']))$slug=$data['slug'];
		
		if($type == 'COUNTRIES'){
			$qry = $this->db->query("SELECT * FROM tbl_countries ORDER BY countryName");
			return $qry->result();
		}
		if($type == 'COUNTRY'){
			$qry = $this->db->query("SELECT * FROM tbl_countries WHERE countryID = '$countryID'");
			return $qry->row();
		}
		if($type == 'STATES'){
			$qry = $this->db->query("SELECT * FROM tbl_states WHERE countryID = '$countryID' ORDER BY stateName");
			return $qry->result();
		}
		if($type == 'STATES_LIST'){
			$qry = $this->db->query("SELECT s.*,c.countryName FROM tbl_states s INNER JOIN tbl_countries c ON s.countryID = c.countryID ORDER BY s.stateName");
			return $qry->result();
		}
		if($type == 'STATE'){
			$qry = $this->db->query("SELECT s.*,c.countryName FROM tbl_states s INNER JOIN tbl_countries c ON s.countryID = c.countryID WHERE s.stateID = '$stateID'");
			return $qry->row();
		}
		if($type == 'CITIES'){
			$qry = $this->db->query("SELECT * FROM tbl_cities WHERE stateID = '$stateID' ORDER BY cityName");
			return $qry->result();
		}
		if($type == 'CITIES_LIST'){
			$qry = $this->db->query("SELECT city.*,country.countryName,state.stateName,currency.currencyName,currency.currencyCode FROM tbl_cities city INNER JOIN tbl_states state ON state.stateID = city.stateID INNER JOIN tbl_countries country ON country.countryID = city.countryID INNER JOIN tbl_currencies currency ON currency.currencyID = city.currencyID  ORDER BY city.cityName");
			return $qry->result();
		}
		if($type == 'CITY'){
			$qry = $this->db->query("SELECT * FROM tbl_cities WHERE cityID = '$cityID' ");
			return $qry->row();
		}
		if($type == 'CITIES_BY_COUNTRY'){
			$qry = $this->db->query("SELECT * FROM tbl_cities WHERE countryID = '$countryID' ");
			return $qry->result();
		}
		if($type == 'CITY_SLUG'){
			$qry = $this->db->query("SELECT city.*,state.stateName,country.countryName FROM tbl_cities city INNER JOIN tbl_states state ON state.stateID = city.stateID INNER JOIN tbl_countries country ON country.countryID = city.countryID WHERE slug = '$slug' ");
			return $qry->row();
		}		
	}
	function getSessions($data){
		$type="";$sessionID="";$courseID="";$courseType="";$cityID="";$countryID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['sessionID']))$sessionID=$data['sessionID'];
		if(isset($data['courseType']))$courseType=$data['courseType'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['countryID']))$countryID=$data['countryID'];
		
		if($type == 'LIST'){
			$qry = $this->db->query("SELECT * FROM tbl_sessions WHERE courseType = '$courseType' AND courseID = '$courseID' AND cityID = '$cityID'");
			return $qry->result();
		}
		if($type == 'S'){
			$qry = $this->db->query("SELECT * FROM tbl_sessions WHERE sessionID = '$sessionID'");
			return $qry->row();
		}
		if($type == 'CART'){
			$qry = $this->db->query("SELECT s.sessionID,c.courseID,c.courseName,c.categoryID,ca.categoryName,s.courseType,s.cityID,ci.cityName,s.startDate,s.endDate,s.currencyID,cu.currencyCode,s.amount,s.offerDate,s.offerAmount FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_sessions s ON s.courseID = c.courseID INNER JOIN tbl_cities ci ON ci.cityID = s.cityID INNER JOIN tbl_currencies cu ON cu.currencyID = s.currencyID WHERE sessionID = '$sessionID'");
			return $qry->row();
		}
		if($type == 'DAYS'){
			$qry = $this->db->query("SELECT * FROM tbl_session_dates WHERE sessionID = '$sessionID' ORDER BY date");
			return $qry->result();
		}
		if($type == 'DAYS_LIST'){
			$qry = $this->db->query("SELECT * FROM tbl_session_dates WHERE sessionID IN ('$sessionID') ORDER BY date");
			return $qry->result();
		}
		if($type == 'CITY'){
			$qry = $this->db->query("SELECT s.*,c.currencyCode FROM tbl_sessions s INNER JOIN tbl_currencies c ON c.currencyID = s.currencyID WHERE cityID = '$cityID' AND startDate > NOW() ORDER BY startDate ASC");
			return $qry->result();
		}
		
		if($type == 'AVAILABALE_CITIES'){
			$qry = $this->db->query("SELECT DISTINCT c.* FROM tbl_sessions s INNER JOIN tbl_cities c ON c.cityID = s.cityID WHERE c.countryID = '$countryID' AND c.cityID != '$cityID' AND startDate > NOW()");
			return $qry->result();
		}
		
		
	}
	function getCourseFaqs($data){
		$type="";$courseID="";$categoryID="";$cityID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		
		if($type=="LIST"){
			$qry = $this->db->query("SELECT * FROM tbl_coursefaqs WHERE courseID = '$courseID' ORDER BY faqID");
			return $qry->result();
		}	
		if($type=="CITY_LIST"){
			$qry = $this->db->query("SELECT * FROM tbl_course_city_faqs WHERE courseID = '$courseID' AND cityID = '$cityID' ORDER BY faqID");
			return $qry->result();
		}		
	}
	
	function register(){
		
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$phone = $this->input->post("phone");
		$country = $this->input->post("country");
		$city = $this->input->post("city");
		$course = $this->input->post("course");
		
	}
	
}

?>