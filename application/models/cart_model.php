<?php 
class Cart_model extends CI_Model{
		
	/**
	 * @return void
	 **/
	public function __construct(){
		parent::__construct();
		
	}
	
	function getCart($type,$cart){
		
		if($type=="CONTENTS"){
			
			$temp = array();
			if($cart)
			foreach($cart as $c)array_push($temp,$c['id']);
			$sessionIDs = '';
			if(count($temp) > 0)$sessionIDs = implode("','",$temp);
			
			return $this->db->query("SELECT s.sessionID,c.courseID,c.courseName,c.categoryID,ca.categoryName,s.courseType,s.cityID,ci.cityName,s.startDate,s.endDate,s.currencyID,cu.currencyCode,s.amount,s.offerDate,s.offerAmount FROM tbl_courses c INNER JOIN tbl_categories ca ON ca.categoryID = c.categoryID INNER JOIN tbl_sessions s ON s.courseID = c.courseID INNER JOIN tbl_cities ci ON ci.cityID = s.cityID INNER JOIN tbl_currencies cu ON cu.currencyID = s.currencyID WHERE s.sessionID IN ('$sessionIDs')")->result();
		}
		
		if($type=="AMOUNT"){
			$amount = array();
			$subTotal = 0;$discountAmount = 0;$grandTotal = 0;$serviceTax = 0;
			$serviceTaxPerc = $this->config->item("service_tax");
			$discountPercentage = 5;
			
			if($cart)
			foreach($cart as $c) $subTotal = $subTotal+$c['amount'];
			
			$discountAmount = ($subTotal*$discountPercentage)/100;
			$serviceTax = (($subTotal-$discountAmount)*$serviceTaxPerc)/100;
			$grandTotal = $subTotal-$discountAmount+$serviceTax;
			
			$amount['subTotal'] = number_format($subTotal,2);
			$amount['discountAmount'] = number_format($discountAmount,2);
			$amount['discountPercentage'] = $discountPercentage;
			$amount['serviceTax'] = $serviceTax;
			$amount['serviceTaxPerc'] = $serviceTaxPerc;
			$amount['grandTotal'] = number_format($grandTotal,2);
			return $amount;
		}
		
	}
	
}

?>