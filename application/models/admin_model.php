<?php 
class Admin_model extends CI_Model{
		
	/**
	 * @return void
	 **/
	public function __construct(){
		parent::__construct();
		
	}
	/**
 * To encrypt password
 * @param password varchar
 * @return varchar // Password encrypted
 **/
	public function encrypt_password($password){
		/*test case
		$password = "password";
		$encrypt = $this->admin_acl_model->encrypt_password($password);
		$decrypt = $this->admin_acl_model->decrypt_password($encrypt, $password);
		echo 'password : '.$password.'<br/>encrypt : '.$encrypt.'<br/>decrypt : '.$decrypt;
		*/
		$length = $this->config->item('salt_length');
		$salt = $this->salt();
		return  $salt . substr(sha1($salt . $password), 0, -$length);
	}
		
/**
 * To decrypt password
 * @param password varchar
 * @return varchar // Password encrypted
 **/
	public function decrypt_password($db_password, $password){
		$length = $this->config->item('salt_length');
		$salt = substr($db_password, 0, $length);
		$db_password =  $salt . substr(sha1($salt . $password), 0, -$length);
		return $db_password;
	}
/**
 * To create salt
 * return @varchar
 **/
	public function salt(){
		return substr(md5(uniqid(rand(), true)), 0, $this->config->item('salt_length'));
	}
	/**
 * To create Random String
 * return @varchar
 **/
	function randStrGen($len=5){
		$result = "";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$charArray = str_split($chars);
		for($i = 0; $i < $len; $i++){
			$randItem = array_rand($charArray);
			$result .= "".$charArray[$randItem];
		}
		return 'r'.$result;
	}
	function file_upload($file,$uploaddir='assets/images/',$id=""){
		$ext = end(explode(".", $file["name"]));
		$path=$uploaddir.$id.'.'.$ext;
		if(file_exists($path) )
			unlink($path);
		if(move_uploaded_file($file["tmp_name"],$path))
			return $path;
		else
			return false;
	}
	public function getDashboard($data){		
		$type="";$roleID="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		
		if($type == 'USERS'){
			$qry = $this->db->query("SELECT * FROM tbl_users");
			$rQry = $this->db->query("SELECT r.roleName, (SELECT COUNT(*) FROM tbl_users u WHERE u.defaultRoleID = r.roleID) as count FROM tbl_roles r ");
			$i=0;$data = array();
			foreach($rQry->result() as $r){
				$roles[$i]['name'] = $r->roleName;
				$roles[$i]['count'] = $r->count;
				$i++;
			}
			$data['userCount'] = $qry->num_rows();
			$data['roles'] = $roles;
			return $data;
		}
	}
	
	public function getLocation($data){		
		$type="";$countryID="";$stateID="";$cityID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['countryID']))$countryID=$data['countryID'];
		if(isset($data['stateID']))$stateID=$data['stateID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		
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
	}
	public function getCurrency($data){		
		$type="";$currencyID="";$cityID="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['currencyID']))$currencyID=$data['currencyID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'LIST'){
			$qry = $this->db->query("SELECT * FROM tbl_currencies");
			return $qry->result();
		}
		if($type == 'S'){
			$qry = $this->db->query("SELECT * FROM tbl_currencies WHERE currencyID = '$currencyID'");
			return $qry->row();
		}
		
	}
	public function getRoles($data){		
		$type="";$roleID="";$roleName="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['roleID']))$roleID=$data['roleID'];
		if(isset($data['roleName']))$roleName=$data['roleName'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'ROLES'){
			$qry = $this->db->query("SELECT * FROM tbl_roles");
			return $qry->result();
		}
		if($type == 'ROLE'){
			$qry = $this->db->query("SELECT * FROM tbl_roles WHERE roleID = '$roleID'");
			return $qry->row();
		}
		if($type == 'CODE'){
			$qry = $this->db->query("SELECT * FROM tbl_roles WHERE roleCode = '$roleName'");
			return $qry->row();
		}
	}
	public function getCategories($data){		
		$type="";$categoryID="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['categoryID']))$categoryID=$data['categoryID'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'CATEGORIES'){
			$qry = $this->db->query("SELECT * FROM tbl_categories");
			return $qry->result();
		}
		if($type == 'CATEGORY'){
			$qry = $this->db->query("SELECT * FROM tbl_categories WHERE categoryID = '$categoryID'");
			return $qry->row();
		}
	}
	public function getCourseTypes($data){		
		$type="";$courseTypeID="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['courseTypeID']))$courseTypeID=$data['courseTypeID'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'LIST'){
			$qry = $this->db->query("SELECT * FROM tbl_coursetypes");
			return $qry->result();
		}
		if($type == 'S'){
			$qry = $this->db->query("SELECT * FROM tbl_coursetypes WHERE courseTypeID = '$courseTypeID'");
			return $qry->row();
		}
	}
	public function getUsers($data){		
		$type="";$roleID="";$email="";$roleCode="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['email']))$email=$data['email'];
		if(isset($data['roleID']))$roleID=$data['roleID'];
		if(isset($data['roleCode']))$roleCode=$data['roleCode'];
		if(isset($data['userID']))$userID=$data['userID'];
		
		if($type == 'EMAIL_CHECK'){
			$qry = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email'");
			return $qry->row();
		}
		if($type == 'USER'){
			$qry = $this->db->query("SELECT * FROM tbl_users u INNER JOIN tbl_userdetails d ON d.userID = u.userID INNER JOIN tbl_roles r ON r.roleID = u.defaultRoleID WHERE u.userID = '$userID'");
			return $qry->row();
		}
		if($type == 'USERS'){
			$qry = $this->db->query("SELECT * FROM tbl_users u INNER JOIN tbl_userdetails d ON d.userID = u.userID INNER JOIN tbl_roles r ON r.roleID = u.defaultRoleID");
			return $qry->result();
		}
		//Users by role code
		if($type == 'UR'){
			$qry = $this->db->query("SELECT * FROM tbl_users u INNER JOIN tbl_userdetails d ON d.userID = u.userID INNER JOIN tbl_roles r ON r.roleID = u.defaultRoleID WHERE r.roleCode = '$roleCode'");
			return $qry->result();
		}
	}
	public function user_save($data){
		$type="";$userID="";$firstName="";$lastName="";$profilePic="";$email="";$password="";$sEmail="";$phone="";$sPhone="";$address1="";$address2="";$countryID="";$stateID="";$cityID="";$courseID="";$zipCode=0;$roleID="";$status="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['userID']))$userID=$data['userID'];
		if(isset($data['firstName']))$firstName=$data['firstName'];
		if(isset($data['lastName']))$lastName=$data['lastName'];
		if(isset($data['profilePic']))$profilePic=$data['profilePic'];
		if(isset($data['email']))$email=$data['email'];
		if(isset($data['password']))$password=$data['password'];
		if(isset($data['sEmail']))$sEmail=$data['sEmail'];
		if(isset($data['phone']))$phone=$data['phone'];
		if(isset($data['sPhone']))$sPhone=$data['sPhone'];
		if(isset($data['address1']))$address1=$data['address1'];
		if(isset($data['address2']))$address2=$data['address2'];
		if(isset($data['countryID']))$countryID=$data['countryID'];
		if(isset($data['stateID']))$stateID=$data['stateID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['courseID']))$cityID=$data['courseID'];
		if(isset($data['zipCode']))$zipCode=$data['zipCode'];
		if(isset($data['roleID']))$roleID=$data['roleID'];
		if(isset($data['status']))$status=$data['status'];
		
		$ipAddress = $this->input->ip_address();
		$password = $this->encrypt_password($password);
		
		if($type=="INSERT"){
			
			$check = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email'")->row();
			if(!$check){
				$userID = $this->db->query("SELECT UUID() as userID")->row()->userID;
				$this->db->query("INSERT INTO tbl_users (userID, userName, password, email, defaultRoleID, ipAddress, createdDate, modifiedDate, status) VALUES ('$userID', '$email', '$password', '$email', '$roleID', '$ipAddress', NOW(), NOW(), '$status')"); 
				
				$this->db->query("INSERT INTO tbl_userdetails (userID, firstName, lastName, profilePic, countryID, stateID, cityID, addressLine1, addressLine2, zipCode, phone, secondaryEmail, secondaryPhone, createdDate, modifiedDate, status) VALUES ('$userID', '$firstName', '$lastName', '$profilePic', '$countryID', '$stateID', '$cityID', '$address1', '$address2', '$zipCode', '$phone', '$sEmail', '$sPhone', Now(), NOW(), '$status')"); 
			
				$this->db->query("INSERT INTO tbl_userroles (userID, roleID, createdDate) VALUES ('$userID', '$roleID', NOW())");
				return $userID;
			}else{
				return false;
			}
		}
		if($type=="UPDATE" && $userID != ""){
			
			$this->db->query("UPDATE tbl_users SET userName = '$email', defaultRoleID = '$roleID', ipAddress = '$ipAddress', modifiedDate = NOW(), status = '$status' WHERE userID = '$userID'" ); 
			
			$this->db->query("UPDATE tbl_userdetails SET firstName = '$firstName', lastName = '$lastName', profilePic = '$profilePic', countryID = '$countryID', stateID = '$stateID', cityID = '$cityID', addressLine1 = '$address1', addressLine2 = '$address2', zipCode = '$zipCode',  phone = '$phone', secondaryEmail = '$sEmail', secondaryPhone = '$sPhone', modifiedDate = NOW(), status = '$status' WHERE userID = '$userID'; "); 
        
			$this->db->query("UPDATE tbl_userroles SET roleID = '$roleID', createdDate = NOW() WHERE userID ='$userID'");
			
			return $userID;
		}
		return false;
	}
	public function role_save($data){
		$type="";$roleName="";$roleCode="";$desc="";$roleID="";$status="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['roleName']))$roleName=$data['roleName'];
		if(isset($data['roleCode']))$roleCode=$data['roleCode'];
		if(isset($data['desc']))$desc=$data['desc'];
		if(isset($data['roleID']))$roleID=$data['roleID'];
		if(isset($data['status']))$status=$data['status'];
		
		if($type=="INSERT"){
			$roleID = $this->db->query("SELECT UUID() as roleID")->row()->roleID;
			$this->db->query("INSERT INTO tbl_roles (roleID, roleName, roleCode, description, createdDate, modifiedDate, status) VALUES ('$roleID', '$roleName', '$roleCode', '$desc', NOW(), NOW(), '$status')"); 
			
			return $roleID;
		}
		if($type=="UPDATE" && $roleID != ""){
			
			$this->db->query("UPDATE tbl_roles SET roleName = '$roleName', roleCode = '$roleCode', description = '$desc', modifiedDate = NOW(), status = '$status' WHERE roleID = '$roleID'" ); 
			
			return $roleID;
		}
	}
	public function category_save(){
		$type=$this->input->post('type');
		$categoryID=$this->input->post('categoryID');
		$categoryName=$this->input->post('categoryName');
		$categorySlug=$this->input->post('categorySlug');
		$categoryOrder=$this->input->post('categoryOrder');
		$desc=$this->input->post('desc');
		$status=$this->input->post('status');
		
		if($type=="INSERT"){
			$categoryID = $this->db->query("SELECT UUID() as categoryID")->row()->categoryID;
			$this->db->query("INSERT INTO tbl_categories (categoryID, categoryName, categorySlug, description, categoryOrder, createdDate, modifiedDate, status) VALUES ('$categoryID', '$categoryName', '$categorySlug', '$desc','$categoryOrder', NOW(), NOW(), '$status')"); 
			
			return $categoryID;
		}
		if($type=="UPDATE" && $categoryID != ""){
			
			$this->db->query("UPDATE tbl_categories SET categoryName = '$categoryName', categorySlug = '$categorySlug', description = '$desc', categoryOrder = '$categoryOrder', modifiedDate = NOW(), status = '$status' WHERE categoryID = '$categoryID'" ); 
			
			return $categoryID;
		}
	}
	public function login($userName,$password){
		$retvalue = array();
		$qry = $this->db->query("SELECT * FROM tbl_users u INNER JOIN tbl_userdetails d ON d.userID = u.userID INNER JOIN tbl_roles r ON r.roleID = u.defaultRoleID WHERE (email = '".$userName."' OR userName = '".$userName."');");
		mysqli_next_result($this->db->conn_id);
		$row = $qry->row();
		if($row){
			$password = $this->decrypt_password($row->password, $password);
			
			if($password == $row->password){
				
				//Setting login session
				$this->session->set_userdata('login',true);
				$this->session->set_userdata('userID',$row->userID);
				$this->session->set_userdata('name',$row->firstName.' '.$row->lastName);
				$this->session->set_userdata('email',$row->email);
				$this->session->set_userdata('roleID',$row->defaultRoleID);
				$this->session->set_userdata('roleName',$row->roleCode);
				$retvalue['name'] = $row->firstName.' '.$row->lastName;
				
				//Redirect URL
				$redirectURL = base_url();
				if($this->session->userdata("redirect_url")){
					$redirectURL = $this->session->userdata("redirect_url");
					$this->session->unset_userdata("redirect_url");
				}
				
				$retvalue['redirectURL'] = $redirectURL;
				$retvalue['message'] = 'Logged in successfully';
				$retvalue['status'] = true;
			}else{
				$retvalue['message'] = 'Invalid Username or Password';
				$retvalue['status'] = false;
			}
		}else{
			$retvalue['message'] = 'Username does not exist';
			$retvalue['status'] = false;
		}
		return $retvalue;
	}
	function check_user($email){
		$qry = $this->db->query("SELECT * FROM tbl_users WHERE (email = '".$email."' OR userName = '".$email."')")->row();
		if($qry)
			return true;
		else
			return false;
	}
	function getCourseTypeMaping($data){
		$type="";$courseID="";$categoryID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['courseTypeID']))$categoryID=$data['courseTypeID'];
		
		if($type=="IDS"){
			$qry = $this->db->query("SELECT * FROM tbl_coursetypemaping WHERE courseID = '$courseID'");
			$retValue = array();
			foreach($qry->result() as $m)
				array_push($retValue,$m->courseTypeID);
			return $retValue;
		}
				
	}
	function getCourse($data){
		$type="";$courseID="";$categoryID="";$cityID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		if(isset($data['categoryID']))$categoryID=$data['categoryID'];
		
		if($type=="LIST"){
			$qry = $this->db->query("SELECT c.*,ca.categoryName,concat(d.firstName,d.lastName) as modifiedBy FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy");
			return $qry->result();
		}
		if($type=="S"){
			$qry = $this->db->query("SELECT c.*,ca.categoryName,concat(d.firstName,' ',d.lastName) as modifiedBy FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_userdetails d ON d.userID = c.createdBy WHERE c.courseID = '$courseID'");
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
		if($type == 'STATUS'){
			$status = array();
			$status['info'] = false;$status['basic'] = false;$status['desc'] = false;$status['faq'] = false;$status['dm'] = false;$status['status'] = 'PUBLISHED';
			$course = $this->db->query("SELECT * FROM tbl_courses WHERE courseID='$courseID'")->row();
			$faq = $this->db->query("SELECT * FROM tbl_coursefaqs WHERE courseID='$courseID'")->row();
			$why = $this->db->query("SELECT * FROM tbl_coursewhy WHERE courseID='$courseID'")->row();
			//var_dump($course);exit();
			if($course){
				if(!empty($course->courseName) && !empty($course->categoryID))
					$status['info'] = true;
				if(!empty($course->feature1) && !empty($course->image) && !empty($course->brochure))
					$status['basic'] = true;
				if($course->whoCanAttend !=" " && $course->description != " " && $course->agenda != "")
					$status['desc'] = true;
				if($faq && $why)
					$status['faq'] = true;
				if(!empty($course->slug) && !empty($course->title) && !empty($course->metaDesc) && !empty($course->SEOContent))
					$status['dm'] = true;
				$pcourse = $this->db->query("SELECT * FROM tbl_courses WHERE courseID='$courseID'")->row();
				if($pcourse)if($pcourse->status == 'DISABLED')$status['status'] = 'DISABLED';
			}
			return (object)$status;
		}
		if($type == 'STATUS_L'){
			return $this->db->query("SELECT * FROM tbl_courses_published")->result();
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
	function getCourseWhyus($data){
		$type="";$courseID="";$categoryID="";$cityID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		
		if($type=="LIST"){
			$qry = $this->db->query("SELECT * FROM tbl_coursewhy WHERE courseID = '$courseID' ORDER BY whyID");
			return $qry->result();
		}
		if($type=="CITY_LIST"){
			$qry = $this->db->query("SELECT * FROM tbl_course_city_why WHERE courseID = '$courseID' AND cityID = '$cityID' ORDER BY whyID");
			return $qry->result();
		}		
	}
	function course_save(){
		$type = $this->input->post('type');
		$courseID = $this->input->post('courseID');
		$courseName = $this->input->post('courseName');
		$categoryID = $this->input->post('categoryID');
		$courseTypes = $this->input->post('courseTypes');
		$status = 'SAVED';
		$userID = $this->session->userdata('userID');
		//var_dump($courseTypes);exit();
		if($this->input->post('courseID')){
			$this->db->query("UPDATE tbl_courses SET courseName = '$courseName', categoryID = '$categoryID', createdBy = '$userID', modifiedDate = NOW(), status = '$status' WHERE courseID = '$courseID'" ); 
			$this->db->query("DELETE FROM tbl_coursetypemaping WHERE courseID = '$courseID'" ); 
			foreach($courseTypes as $t){
				$this->db->query("INSERT INTO tbl_coursetypemaping (courseID, courseTypeID) VALUES ('$courseID', '$t')");
			}
			return $courseID;
		}
		else{
			$courseID = $this->db->query("SELECT UUID() as courseID")->row()->courseID;
			$this->db->query("INSERT INTO tbl_courses (courseID, courseName, categoryID,createdBy, createdDate, modifiedDate, status) VALUES ('$courseID', '$courseName', '$categoryID', '$userID', NOW(), NOW(), '$status')"); 
			foreach($courseTypes as $t){
				$this->db->query("INSERT INTO tbl_coursetypemaping (courseID, courseTypeID) VALUES ('$courseID', '$t')");
			}
			return $courseID;
		}
		return false;
	}
	function course_basic_save(){
		$courseID = $this->input->post('courseID');
		$feature1 = $this->input->post('feature1');
		$feature2 = $this->input->post('feature2');
		$feature3 = $this->input->post('feature3');
		$feature4 = $this->input->post('feature4');
		$feature5 = $this->input->post('feature5');
		
		$image=$this->file_upload($_FILES['image'],'assets/images/courses/',$courseID);
		if(!$image)
			$image = $this->input->post('uploaded_img');
		
		$authLogo=$this->file_upload($_FILES['authLogo'],'assets/images/courses/',$courseID.'_logo');
		if(!$authLogo)
			$authLogo = $this->input->post('uploaded_auth_logo');
		
		$brochure=$this->file_upload($_FILES['brochure'],'assets/images/courses/',$courseID.'_brochure');
		if(!$brochure)
			$brochure = $this->input->post('uploaded_brochure');
		
		$whoCanAttend = $this->input->post('whoCanAttend');
		$userID = $this->session->userdata('userID');
		
		$this->db->query("UPDATE tbl_courses SET feature1 = '$feature1', feature2 = '$feature2', feature3 = '$feature3', feature4 = '$feature4', feature5 = '$feature5', image = '$image', authLogo = '$authLogo', brochure = '$brochure', whoCanAttend = '$whoCanAttend', createdBy = '$userID', modifiedDate = NOW() WHERE courseID = '$courseID'" );
		
		return $courseID;
	}
	function course_desc_save(){
		$courseID = $this->input->post('courseID');
		
		$description = $this->input->post('desc');
		$agenda = $this->input->post('agenda');
		$certifications = $this->input->post('certifications');
		$benfits = $this->input->post('benfits');
		
		$userID = $this->session->userdata('userID');
		
		$this->db->query("UPDATE tbl_courses SET description = '$description', agenda = '$agenda', certifications = '$certifications', benfits = '$benfits', createdBy = '$userID', modifiedDate = NOW() WHERE courseID = '$courseID'" );
		
		return $courseID;
	}
	function course_faq_save(){
		$courseID = $this->input->post('courseID');
		$userID = $this->session->userdata('userID');
		
		$faq_count = $this->input->post('faq_count');
		if($faq_count > 0)
			$this->db->query("DELETE FROM tbl_coursefaqs WHERE courseID = '$courseID' AND type='classroom'");
		for($i=1;$i<=$faq_count;$i++){
			if($this->input->post('question_'.$i)){
				$this->db->query("INSERT INTO tbl_coursefaqs (faqID, courseID, question, answer, type, dateTime, createdBy) VALUES (UUID(), '$courseID', '".$this->input->post('question_'.$i)."', '".$this->input->post('answer_'.$i)."', 'classroom', NOW(), '$userID'); ");
			}
		}
		
		$faqo_count = $this->input->post('faqo_count');
		if($faqo_count > 0)
			$this->db->query("DELETE FROM tbl_coursefaqs WHERE courseID = '$courseID' AND type='online'");
		for($i=1;$i<=$faqo_count;$i++){
			if($this->input->post('questiono_'.$i)){
				$this->db->query("INSERT INTO tbl_coursefaqs (faqID, courseID, question, answer, type, dateTime, createdBy) VALUES (UUID(), '$courseID', '".$this->input->post('questiono_'.$i)."', '".$this->input->post('answero_'.$i)."', 'online', NOW(), '$userID'); ");
			}
		}
		
		$why_count = $this->input->post('why_count');
		if($why_count > 0)
			$this->db->query("DELETE FROM tbl_coursewhy WHERE courseID = '$courseID'");
		for($i=1;$i<=$why_count;$i++){
			if($this->input->post('why_'.$i)){
				$this->db->query("INSERT INTO tbl_coursewhy (whyID, courseID, description, dateTime, createdBy) VALUES (UUID(), '$courseID', '".$this->input->post('why_'.$i)."', NOW(), '$userID'); ");
			}
		}
		return $courseID;
	}
	function course_dm_save(){
		$courseID = $this->input->post('courseID');
		
		$slug = $this->input->post('slug');
		$title = $this->input->post('title');
		$metaDesc = $this->input->post('metaDesc');
		$SEOContent = $this->input->post('SEOContent');
		$rating = $this->input->post('rating');
		$ratingCount = $this->input->post('ratingCount');
		$usersEnrolled = $this->input->post('usersEnrolled');
		
		$userID = $this->session->userdata('userID');
		
		$this->db->query("UPDATE tbl_courses SET slug = '$slug', title = '$title', metaDesc = '$metaDesc', SEOContent = '$SEOContent', rating = '$rating', ratingCount = '$ratingCount', usersEnrolled = '$usersEnrolled', createdBy = '$userID', modifiedDate = NOW() WHERE courseID = '$courseID'" );
		
		return $courseID;
	}
	function course_publish(){
		$courseID = $this->input->post("courseID");
		$qry = $this->db->query("SELECT * FROM tbl_courses WHERE courseID = '$courseID'")->row();
		if($qry){
			$this->db->query("DELETE FROM tbl_courses_published WHERE courseID = '$courseID'");
			$this->db->query("DELETE FROM tbl_coursefaqs_published WHERE courseID = '$courseID'");
			$this->db->query("DELETE FROM tbl_coursewhy_published WHERE courseID = '$courseID'");
			
			$this->db->query("INSERT INTO tbl_courses_published SELECT * FROM tbl_courses WHERE courseID = '$courseID'");
			$this->db->query("INSERT INTO tbl_coursefaqs_published SELECT * FROM tbl_coursefaqs WHERE courseID = '$courseID'");
			$this->db->query("INSERT INTO tbl_coursewhy_published SELECT * FROM tbl_coursewhy WHERE courseID = '$courseID'");
			$this->db->query("UPDATE tbl_courses SET status = 'PUBLISHED' WHERE courseID = '$courseID'");
			$this->db->query("UPDATE tbl_courses_published SET status = 'PUBLISHED' WHERE courseID = '$courseID'");
			return true;
		}else{
			return false;
		}
		
	}
	function course_status_update(){
		$courseID = $this->input->post("courseID");
		$status = $this->input->post("status");
		$this->db->query("UPDATE tbl_courses SET status = '$status' WHERE courseID = '$courseID'");
		$this->db->query("UPDATE tbl_courses_published SET status = '$status' WHERE courseID = '$courseID'");
		return true;
	}
	function currency_save(){
		$currencyID = $this->input->post('currencyID');
		
		$name = $this->input->post('name');
		$code = $this->input->post('code');
		$desc = $this->input->post('desc');
		$status = $this->input->post('status');
		$status = 'P';
		
		$userID = $this->session->userdata('userID');
		
		if($currencyID == ""){
			$this->db->query("INSERT INTO tbl_currencies (currencyID, currencyName, currencyCode, description, createdBy, dateTime, status) VALUES (UUID(), '$name', '$code', '$desc', '$userID', NOW(), '$status'); ");
		}else{
			$this->db->query("UPDATE tbl_currencies SET currencyName = '$name', currencyCode = '$code', description = '$desc', createdBy = '$userID', dateTime = NOW(), status = '$status' WHERE currencyID = '$currencyID'; ");
		}
		return true;
	}
	function country_save(){
		$countryID = $this->input->post('countryID');
		
		$countryName = $this->input->post('name');
		$countryCode = $this->input->post('code');
		$userID = $this->session->userdata('userID');
		
		if($countryID == ""){
			$this->db->query("INSERT INTO tbl_countries (countryID, countryName, countryCode) VALUES (UUID(), '$countryName', '$countryCode')");
		}else{
			$this->db->query("UPDATE tbl_countries SET countryName = '$countryName', countryCode = '$countryCode' WHERE countryID = '$countryID'");
		}
		return true;
	}
	function state_save(){
		$stateID = $this->input->post('stateID');
		$countryID = $this->input->post('countryID');
		
		$stateName = $this->input->post('name');
		$userID = $this->session->userdata('userID');
		
		if($stateID == ""){
			$this->db->query("INSERT INTO tbl_states (stateID,countryID, stateName) VALUES (UUID(), '$countryID', '$stateName')");
		}else{
			$this->db->query("UPDATE tbl_states SET countryID = '$countryID', stateName = '$stateName' WHERE stateID = '$stateID'");
		}
		return true;
	}
	function city_save(){
		$cityID = $this->input->post('cityID');
		
		$cityName = $this->input->post('name');
		$slug = $this->input->post('slug');
		$countryID = $this->input->post('countryID');
		$stateID = $this->input->post('stateID');
		$currencyID = $this->input->post('currencyID');
		$userID = $this->session->userdata('userID');
		
		if($cityID == ""){
			$this->db->query("INSERT INTO tbl_cities (cityID,cityName,stateID,countryID,currencyID,slug) VALUES (UUID(), '$cityName', '$stateID', '$countryID', '$currencyID', '$slug')");
		}else{
			$this->db->query("UPDATE tbl_cities SET cityName = '$cityName', stateID = '$stateID', countryID = '$countryID', currencyID = '$currencyID', slug = '$slug' WHERE cityID = '$cityID'");
		}
		
		return true;
	}
	function group_discount_save(){
		$discountID = $this->input->post("discountID");
		$groupName = $this->input->post('groupName');
		$group = $this->input->post('from').'-'.$this->input->post('to');
		$discount = $this->input->post('discount');
		$status = $this->input->post('status');
		
		$userID = $this->session->userdata('userID');
		if($discountID ==""){
			$this->db->query("INSERT INTO tbl_discount_group (discountID,groupName,groupMembers,discount,createdBy,dateTime,status) VALUES (UUID(), '$groupName', '$group', '$discount', '$userID', NOW(),'$status')");
		}else{
			$this->db->query("UPDATE tbl_discount_group SET groupName = '$groupName', groupMembers = '$group', discount = '$discount', status = '$status', createdBy = '$userID', dateTime = NOW() WHERE discountID = '$discountID'");
		}
		return true;
	}
	function getDiscounts($type,$discountID=""){
		if($type=="GROUP_LIST"){
			return $this->db->query("SELECT * FROM tbl_discount_group")->result();
		}
		if($type=="GROUP_S"){
			return $this->db->query("SELECT * FROM tbl_discount_group WHERE discountID = '$discountID'")->row();
		}
		if($type=="SPECIAL_LIST"){
			return $this->db->query("SELECT * FROM tbl_discount_special")->result();
		}
		if($type=="SPECIAL_S"){
			return $this->db->query("SELECT * FROM tbl_discount_special WHERE discountID = '$discountID'")->row();
		}
	}
	function special_discount_save(){
		$discountID = $this->input->post("discountID");
		$name = $this->input->post('name');
		$coupon = $this->input->post('coupon');
		$validAll = $this->input->post('validAll');
		$users = $this->input->post('users');
		$discount = $this->input->post('discount');
		$status = $this->input->post('status');
		
		$userID = $this->session->userdata('userID');
		if($discountID ==""){
			$this->db->query("INSERT INTO tbl_discount_special (discountID, name, coupon, validAll, users, discount, createdBy, dateTime, status) VALUES (UUID(), '$name', '$coupon', '$validAll', '$users', $discount, '$userID', NOW(), '$status'); ");
		}else{
			$this->db->query("UPDATE tbl_discount_special SET name = '$name', coupon = '$coupon', validAll = '$validAll', users = '$users', discount = '$discount', status = '$status', createdBy = '$userID', dateTime = NOW() WHERE discountID = '$discountID'");
		}
		return true;
	}
	function getTestimonials($type,$testimonialID=""){
		if($type=="LIST"){
			return $this->db->query("SELECT * FROM tbl_testimonials")->result();
		}
		if($type=="S"){
			return $this->db->query("SELECT * FROM tbl_testimonials WHERE testimonialID = '$testimonialID'")->row();
		}
		
	}
	function testimonial_save(){
		$testimonialID = $this->input->post("testimonialID");
		$name = $this->input->post('name');
		$designation = $this->input->post('designation');
		$review = $this->input->post('review');
		$status = $this->input->post('status');
		
		if($testimonialID == "")
			$uuid = 'user_'.date('ymdhis');
		else
			$uuid = $testimonialID;
		$image=$this->file_upload($_FILES['image'],'assets/images/courses/',$uuid);
		if(!$image)
			$image = $this->input->post('uploaded_img');
		
		$userID = $this->session->userdata('userID');
		if($testimonialID == ""){
			$this->db->query("INSERT INTO tbl_testimonials (testimonialID, name, image, designation, review, createdBy, dateTime, status) VALUES (UUID(), '$name', '$image', '$designation', '$review', '$userID', NOW(), '$status'); ");
		}else{
			$this->db->query("UPDATE tbl_testimonials SET name = '$name', image = '$image', designation = '$designation', review = '$review', status = '$status', createdBy = '$userID', dateTime = NOW() WHERE testimonialID = '$testimonialID'");
		}
		return true;
	}
	
}

?>