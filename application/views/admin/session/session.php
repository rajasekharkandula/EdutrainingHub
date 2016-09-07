<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('project_name'); ?></title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/admin_style.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/select2.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/images/favicon.png" rel="icon" />
</head>
<body>
	<!-- Header starts here -->
	<?php echo $header;?>
	<!-- Header ends here -->
	<!-- Body content starts here -->
	<div class="body-container">
		<section class="container">
			
			<form id="session_form" method="POST" action="#" onSubmit="return false;">
				<h3><?php echo ucfirst($courseType); ?> Session Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<div class="row">
							<div class="col-md-4">
								<span class="panel-title"> <i class="fa fa-cogs"></i> <?php echo $course->courseName; ?> </span> 
							</div>
							<div class="col-md-4">
								<span class="panel-title"> <i class="fa fa-map-marker"></i> <?php echo $city->cityName;?> </span> 
							</div>
							<div class="col-md-4">
								<span class="panel-title"> Course type : <?php echo ucfirst($courseType); ?> </span> 
							</div>
						</div>
					</div>
					<div class="panel-body">
						<input type="hidden" id="sessionID" name="sessionID" value="<?php echo $sessionID;?>">
						<input type="hidden" id="courseType" name="courseType" value="<?php echo $courseType; ?>">
						<label>Basic details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Session nick name <span class="required">*</span> </label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="name" name="name" placeholder="Session nick name" value="<?php if(isset($session->name))echo $session->name;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">No of days <span class="required">*</span> </label>
							<div class="col-md-4">
								<input type="number" min="1" max="10" class="form-control" id="noOfDays" name="noOfDays" placeholder="Number of days" value="<?php if(isset($session->noOfDays))echo $session->noOfDays;?>" />
							</div>
							<label class="col-md-1 no-padding">Time from <span class="required">*</span> </label>
							<div class="col-md-2">
								<div class="input-group"> 
									<span class="input-group-addon"><i class="fa fa-clock-o"></i> </span>
									<input type="time" class="form-control" id="startTime" name="startTime" placeholder="09:00 AM" value="<?php if(isset($session->startTime))echo $session->startTime;else echo '09:00';?>" />
								</div>
							</div>
							<label class="col-md-1 no-padding">To <span class="required">*</span> </label>
							<div class="col-md-2">
								<div class="input-group"> 
									<span class="input-group-addon"><i class="fa fa-clock-o"></i> </span>
									<input type="time" class="form-control" id="endTime" name="endTime" placeholder="06:30 PM" value="<?php if(isset($session->endTime))echo $session->endTime;else echo '21:00';?>" />
								</div>
							</div>
						</div>
						<div id="days">
							<?php if(count($days) > 0){ 
							$i=1;foreach($days as $d){
							?>
							<div class="row mb-10">
								<label class="col-md-2">Day <?php echo $i;?> <span class="required">*</span> </label>
								<div class="col-md-4">
									<div class="input-group"> 
										<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>
										<input type="date" class="form-control" id="day_<?php echo $i;?>" name="day_<?php echo $i;?>" placeholder="dd-mm-yyyy" value="<?php echo $d->date;?>"/>
									</div>
								</div>
							</div>
							<?php $i++;} 
							}else{ ?>
								<div class="row mb-10">
								<label class="col-md-2">Day 1 <span class="required">*</span> </label>
								<div class="col-md-4">
									<div class="input-group"> 
										<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>
										<input type="date" class="form-control" id="day_1" name="day_1" placeholder="dd-mm-yyyy" />
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						
						<label>Price details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Currency <span class="required">*</span></label>
							<div class="col-md-4">
								<select class="form-control select2" name="currency" id="currencyID">
									<option value=""></option>
									<?php foreach($currencies as $c){  ?>
									<option value="<?php echo $c->currencyID;?>" <?php if(isset($session->currencyID))if($session->currencyID == $c->currencyID)echo 'selected';?>><?php echo $c->currencyCode;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Anount <span class="required">*</span> </label>
							<div class="col-md-4">
								<input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php if(isset($session->amount))echo $session->amount;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Earlybird date </label>
							<div class="col-md-4">
								<div class="input-group"> 
									<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>
									<input type="date" class="form-control" id="offerDate" name="offerDate" placeholder="dd-mm-yyyy" value="<?php if(isset($session->offerDate))echo $session->offerDate;?>"/>
								</div>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Earlybird amount </label>
							<div class="col-md-4">
								<input type="number" class="form-control" id="offerAmount" name="offerAmount" placeholder="Earlybird amount" value="<?php if(isset($session->offerAmount))echo $session->offerAmount;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Includes exam fee </label>
							<div class="col-md-4">
								<input type="checkbox" class="checkbox" id="examFee" name="examFee" <?php if(isset($session->examFee))if($session->examFee)echo 'checked';?>/>
							</div>
						</div>
						
						<label>Trainer and venue details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Trainer </label>
							<div class="col-md-4">
								<select class="form-control select2" name="trainerID" id="trainerID">
									<option value=""></option>
									<?php foreach($trainers as $t){  ?>
									<option value="<?php echo $t->userID;?>" <?php if(isset($session->trainerID))if($session->trainerID == $t->userID)echo 'selected';?>><?php echo $t->firstName.' '.$t->lastName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Venue </label>
							<div class="col-md-4">
								<textarea class="form-control" placeholder="venue" id="venue" name="venue" rows="4" ><?php if(isset($session->venue))echo $session->venue;?></textarea>
							</div>
						</div>
						<label>Other details</label>
						<hr class="mt-0 mb-10"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Classroom type <span class="required">*</span></label>
							<div class="col-md-4">
								<select class="form-control select2" name="classroomType" id="classroomType">
									<option value=""></option>
									<option value="Morning" <?php if(isset($session->classroomType))if($session->classroomType== 'Morning')echo 'selected';?>>Morning</option>
									<option value="Evening" <?php if(isset($session->classroomType))if($session->classroomType== 'Evening')echo 'selected';?>>Evening</option>
									<option value="Weekday" <?php if(isset($session->classroomType))if($session->classroomType== 'Weekday')echo 'selected';?>>Weekday</option>
									<option value="Weekend" <?php if(isset($session->classroomType))if($session->classroomType== 'Weekend')echo 'selected';?>>Weekend</option>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Enable free E-learning </label>
							<div class="col-md-4">
								<input type="checkbox" class="checkbox" id="elearning" name="elearning" <?php if(isset($session->elearning))if($session->elearning)echo 'checked';?>/>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">E-learning courses </label>
							<div class="col-md-4">
								<select class="form-control select2" name="elearningID" id="elearningID">
									<option value=""></option>
									<?php foreach($elearningCourses as $e){  ?>
									<option value="<?php echo $e->courseID;?>" <?php if(isset($session->elearningID))if($session->elearningID == $e->courseID)echo 'selected';?>><?php echo $e->courseName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<hr></hr>
						<div class="col-md-7 text-center">
							<input type="hidden" name="status" id="status" value="SAVED">
							<button data-status="SAVED" class="btn" id="update_btn">Save</button>
							<button data-status="PUBLISHED" class="btn btn-success" id="publish_btn">Publish</button>
							<a href="<?php echo base_url('admin_course/sessions/'.$courseType.'/'.$courseID.'/'.$cityID);?>" class="btn btn-default">Cancel</a>
						</div>
					</div>
				</div>
			</form>
			
		</section>
	</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-tabcollapse.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
	<script>
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
	});

	$("#noOfDays").on("change",function(){
		var noOfDays = $(this).val();
		if(noOfDays < 0 || noOfDays > 10){
			$("#noOfDays").parent().append('<span class="text-danger"> Enter value between 1 to 10 </span>');
		}else{
			$("#noOfDays").parent().find(".text-danger").remove();
			var html = "";
			for(var i=1;i<=noOfDays;i++){
				html+='<div class="row mb-10">'+
						'<label class="col-md-2">Day '+i+' <span class="required">*</span> </label>'+
						'<div class="col-md-4">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>'+
								'<input type="date" class="form-control" id="day_'+i+'" name="day_'+i+'" placeholder="dd-mm-yyyy" />'+
							'</div>'+
						'</div>'+
					'</div>';
			}
			$("#days").html(html);
		}
	});
	
	$("#update_btn,#publish_btn").on('click',function(){
		$("#status").val($(this).data("status"));
		//Validations
		$(".text-danger").remove();var count = 1;
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		if($("#name").val() == ""){$("#name").parent().append(text_error);error++;}
		if($("#noOfDays").val() == ""){$("#noOfDays").parent().append(text_error);error++;}
		
		//Dates validation
		if(parseInt($("#noOfDays").val()) > 1){
			$('input[type="date"]').each(function(item1){
				if($("#day_"+count).val() == ""){
					$("#day_"+count).parent().parent().append(text_error);error++;
				}else if(count > 1){
					var day1 = $("#day_"+count).val();
					var day2 = $("#day_"+(count-1)).val();
					if(Date.parse(day1) <= Date.parse(day2)){
						$('#day_'+count).parent().parent().append('<span class="text-danger">Date should not be ealier than previous date</span>');
						error++;
					}else{
						$('#day_'+count).parent().parent().find(".text-danger").remove();
					}
				}
				count++;
			});
		}
		
		//Time validation
		if($("#startTime").val() == ""){$("#startTime").parent().parent().append(text_error);error++;}
		if($("#endTime").val() == ""){$("#endTime").parent().parent().append(text_error);error++;}
		var day = new Date(),d = day.getDate(),m =  day.getMonth()+1,y = day.getFullYear(),s_t=$('#startTime').val().split(":"),e_t=$('#endTime').val().split(":");
		var check1_date = new Date(y, m, d, parseInt(s_t[0]), parseInt(s_t[1]), 0);
		var date_to_check = new Date(y, m, d, parseInt(e_t[0]), parseInt(e_t[1]), 0);
		if(check1_date >= date_to_check){
			error++;$('#endTime').parent().parent().append('<span class="text-danger">Invalid time</span>');
		}
		
		if($("#currencyID").val() == ""){$("#currencyID").parent().append(text_error);error++;}
		if($("#amount").val() == ""){$("#amount").parent().append(text_error);error++;}
		if($("#classroomType").val() == ""){$("#classroomType").parent().append(text_error);error++;}
		
		//Offer date validation
		var offerDate = $('#offerDate').val();
		var day_1 = $('#day_1').val();
		if(Date.parse(day_1) <= Date.parse(offerDate)){
			$('#offerDate').parent().parent().append('<span class="text-danger">Offer date should not be ealier than day 1</span>');
			error++;
		}
		
		//Offer price validation
		if(offerDate!=''){
			var offerAmount = $('#offerAmount').val();
			if(offerAmount=='' || parseInt(offerAmount)<=0){error++;$('#offerAmount').parent().append(text_error)};
			if(parseInt(offerAmount) >= parseInt($("#amount").val())){
				error++;$('#offerAmount').parent().append('<span class="text-danger">Offer amount should be less than actual amount</span>');
			}
		}
		
		if(error == 0){
			$("#update_btn,#publish_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$(".btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin_course/session_save/'.$courseID.'/'.$cityID);?>',
				type:'POST',
				data:$('#session_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin_course/sessions/'.$courseType.'/'.$courseID.'/'.$cityID);?>';
			});
		}
	});
	</script>
</body>
</html>
