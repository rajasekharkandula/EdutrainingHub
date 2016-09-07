<?php 
class Admin_course_model extends CI_Model{
		
	/**
	 * @return void
	 **/
	public function __construct(){
		parent::__construct();
		
	}
	function session_save($courseID,$cityID){
		$sessionID = $this->input->post("sessionID");
		$courseType = $this->input->post("courseType");
		$name = $this->input->post("name");
		$noOfDays = $this->input->post("noOfDays");
		$startTime = date("H:i:s",strtotime($this->input->post("startTime")));
		$endTime = date("H:i:s",strtotime($this->input->post("endTime")));
		$currencyID = $this->input->post("currency");
		$amount = $this->input->post("amount");
		$offerDate = date("Y-m-d",strtotime($this->input->post("offerDate")));
		$offerAmount = 0;
		if($this->input->post("offerAmount"))
		$offerAmount = $this->input->post("offerAmount");
		$examFee = 0;
		if($this->input->post("examFee"))
			$examFee = 1;
		$trainerID = $this->input->post("trainerID");
		$venue = $this->input->post("venue");
		$classroomType = $this->input->post("classroomType");
		$elearning = 0;
		if($this->input->post("elearning"))
			$elearning = 1;
		$elearningID = $this->input->post("elearningID");
		
		$createdBy = $this->session->userdata('userID');
		$status = $this->input->post("status");
		
		if($sessionID == ""){
			$sessionID = $this->db->query("SELECT UUID() as sessionID")->row()->sessionID;
			$this->db->query("INSERT INTO tbl_sessions (sessionID, courseType, courseID, cityID, name, noOfDays, startTime, endTime, currencyID, amount, offerDate, offerAmount, examFee, trainerID, venue, classroomType, elearning, elearningID, createdBy, dateTime, status) VALUES ('$sessionID', '$courseType', '$courseID', '$cityID', '$name', '$noOfDays', '$startTime', '$endTime', '$currencyID', '$amount', '$offerDate', '$offerAmount', '$examFee', '$trainerID', '$venue', '$classroomType', '$elearning', '$elearningID', '$createdBy', NOW(), '$status')");
		}else{
			$this->db->query("UPDATE tbl_sessions SET name = '$name', noOfDays = '$noOfDays', startTime = '$startTime', endTime = '$endTime', currencyID = '$currencyID', amount = '$amount', offerDate = '$offerDate', offerAmount = '$offerAmount', examFee = '$examFee', trainerID = '$trainerID', venue = '$venue', classroomType = '$classroomType', elearning = '$elearning', elearningID = '$elearningID', createdBy = '$createdBy', dateTime = NOW(), status = '$status' WHERE sessionID = '$sessionID'; ");
		}
		$this->db->query("DELETE FROM tbl_session_dates WHERE sessionID = '$sessionID'");
		for($i=1;$i<=$noOfDays;$i++){
			if($i < 15){
				$date = date("Y-m-d",strtotime($this->input->post("day_".$i)));
				$this->db->query("INSERT INTO tbl_session_dates (sessionID, date) VALUES ('$sessionID', '$date');");	
			}				
		}
		$startDate = date("Y-m-d H:i:s",strtotime($this->input->post("day_1").' '.$startTime));
		$endDate = date("Y-m-d H:i:s",strtotime($date.' '.$endTime));
		$this->db->query("UPDATE tbl_sessions SET startDate = '$startDate', endDate = '$endDate' WHERE sessionID = '$sessionID'");
		return $sessionID;		
	}
	function getSessions($data){
		$type="";$sessionID="";$courseID="";$courseType="";$cityID="";
		if(isset($data['type']))$type=$data['type'];
		if(isset($data['sessionID']))$sessionID=$data['sessionID'];
		if(isset($data['courseType']))$courseType=$data['courseType'];
		if(isset($data['courseID']))$courseID=$data['courseID'];
		if(isset($data['cityID']))$cityID=$data['cityID'];
		
		if($type == 'LIST'){
			$qry = $this->db->query("SELECT * FROM tbl_sessions WHERE courseType = '$courseType' AND courseID = '$courseID' AND cityID = '$cityID'");
			return $qry->result();
		}
		if($type == 'S'){
			$qry = $this->db->query("SELECT * FROM tbl_sessions WHERE sessionID = '$sessionID'");
			return $qry->row();
		}
		if($type == 'DAYS'){
			$qry = $this->db->query("SELECT * FROM tbl_session_dates WHERE sessionID = '$sessionID' ORDER BY date");
			return $qry->result();
		}
	}
	function city_content_save(){
		$courseID = $this->input->post('courseID');
		$cityID = $this->input->post('cityID');
		
		$feature1 = $this->input->post('feature1');
		$feature2 = $this->input->post('feature2');
		$feature3 = $this->input->post('feature3');
		$feature4 = $this->input->post('feature4');
		$feature5 = $this->input->post('feature5');
		$feature6 = $this->input->post('feature6');
		
		$whoCanAttend = $this->input->post('whoCanAttend');
		$description = $this->input->post('desc');
		$agenda = $this->input->post('agenda');
		$certifications = $this->input->post('certifications');
		$benfits = $this->input->post('benfits');
		
		$title = $this->input->post('title');
		$metaDesc = $this->input->post('metaDesc');
		$SEOContent = $this->input->post('SEOContent');
		
		$trainerID = $this->input->post('trainerID');
		$venue = $this->input->post('venue');
		
		$status = $this->input->post('status');
		$userID = $this->session->userdata('userID');
		
		if($courseID != "" && $cityID != ""){
			$this->db->query("DELETE FROM tbl_course_city_content WHERE courseID = '$courseID' AND cityID = '$cityID'");
			$this->db->query("INSERT INTO tbl_course_city_content (courseID, cityID, feature1, feature2, feature3, feature4, feature5, feature6, whoCanAttend, description, agenda, certifications, benfits, cityContent, title, metaDesc, SEOContent, trainerID, venue, createdBy, createdDate, status) VALUES ('$courseID', '$cityID', '$feature1', '$feature2', '$feature3', '$feature4', '$feature5', '$feature6', '$whoCanAttend', '$description', '$agenda', '$certifications', '$benfits', '$SEOContent', '$title', '$metaDesc', '$SEOContent', '$trainerID', '$venue', '$userID', NOW(), '$status'); "); 	

			
			$faq_count = $this->input->post('faq_count');
			if($faq_count > 0)
				$this->db->query("DELETE FROM tbl_course_city_faqs WHERE courseID = '$courseID' AND cityID = '$cityID'");
			for($i=1;$i<=$faq_count;$i++){
				if($this->input->post('question_'.$i)){
					$this->db->query("INSERT INTO tbl_course_city_faqs (faqID, courseID, cityID, question, answer, dateTime, createdBy) VALUES (UUID(), '$courseID', '$cityID', '".$this->input->post('question_'.$i)."', '".$this->input->post('answer_'.$i)."', NOW(), '$userID'); ");
				}
			}
			
			$why_count = $this->input->post('why_count');
			if($why_count > 0)
				$this->db->query("DELETE FROM tbl_course_city_why WHERE courseID = '$courseID' AND cityID = '$cityID'");
			for($i=1;$i<=$why_count;$i++){
				if($this->input->post('why_'.$i)){
					$this->db->query("INSERT INTO tbl_course_city_why (whyID, courseID, cityID, description, dateTime, createdBy) VALUES (UUID(), '$courseID', '$cityID', '".$this->input->post('why_'.$i)."', NOW(), '$userID'); ");
				}
			}
			
			return true;
		}else{
			return false;
		}
	}
	function elearning_price_save(){
		$courseID = $this->input->post("courseID");
		$userID = $this->session->userdata('userID');
		$this->db->query("DELETE FROM tbl_elearning_prices WHERE courseID = '$courseID'");
		for($i=1;$i<=10;$i++){
			if($this->input->post("duration_".$i)){
				$duration = $this->input->post("duration_".$i);
				for($j=1;$j<=50;$j++){
					if($this->input->post("currency_".$i."_".$j)){
						$currency = $this->input->post("currency_".$i."_".$j);
						$amount = $this->input->post("amount_".$i."_".$j);
						$this->db->query("INSERT INTO tbl_elearning_prices (priceID,courseID,duration, currencyID, amount,createdBy,dateTime) VALUES (UUID(),'$courseID','$duration', '$currency',$amount,'$userID',NOW()); ");
					}
				}
			}
		}
		return true;
	}
	function getElearningPrice($type,$courseID){
		if($type == "LIST"){
			return $this->db->query("SELECT * FROM tbl_elearning_prices WHERE courseID='$courseID'")->result();
		}
		if($type == "DURATION"){
			return $this->db->query("SELECT duration,COUNT(*) as priceCount FROM tbl_elearning_prices WHERE courseID='$courseID' GROUP BY duration")->result();
		}
	}
}
?>