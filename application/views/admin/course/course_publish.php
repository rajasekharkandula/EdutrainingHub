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
	<style>
	label{line-height:22px;}
	</style>
</head>
<body>
	<!-- Header starts here -->
	<?php echo $header;?>
	<!-- Header ends here -->
	<!-- Body content starts here -->
	<div class="body-container">
		<section class="container">
			
			<form id="course_form" method="POST" action="#" onSubmit="return false;">
				<h3>Course Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-gears"></i> <?php echo $course->courseName;?> </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body no-padding">
						<div class="row table-layout">
							<?php echo $sidebar; ?>
							<div class="col-md-12 pb-20">
								<input type="hidden" name="courseID" id="courseID" value="<?php echo $courseID;?>">
								<?php $cstatus = 'Not Published'; if($status->info && $status->basic && $status->desc && $status->faq && $status->dm &&  $status->status != 'DISABLED'){
									$cstatus = 'Published';
								}else if($status->status == 'DISABLED'){
									$cstatus = 'Disabled';
								} ?>
								<div class="row mb-10 mt-20">
									<label class="col-md-4"> Current Status :</label>
									<div class="col-md-6 pl-0">
										<?php echo $cstatus; ?>
									</div>
								</div>
								<div class="row mb-10 mt-20">
									<label class="col-md-4"> Course Info :</label>
									<div class="col-md-6 pl-0">
										<?php if($status->info)echo 'Completed'; ?>
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-4"> Course Basic :</label>
									<div class="col-md-6 pl-0">
										<?php if($status->basic)echo 'Completed';else echo 'Not completed'; ?>
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-4"> Course Description :</label>
									<div class="col-md-6 pl-0">
										<?php if($status->desc)echo 'Completed';else echo 'Not completed'; ?>
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-4"> Course Faqs :</label>
									<div class="col-md-6 pl-0">
										<?php if($status->faq)echo 'Completed';else echo 'Not completed'; ?>
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-4"> Digital Marketing :</label>
									<div class="col-md-6 pl-0">
										<?php if($status->dm)echo 'Completed';else echo 'Not completed'; ?>
									</div>
								</div>
								
								<hr></hr>
								<div class="col-md-10 text-center">
									<?php if($status->info && $status->basic && $status->desc && $status->faq && $status->dm){ ?>
									<button class="btn" id="update_btn">Publish</button>
									<?php } ?>
									<?php $st = 'DISABLED'; $name = 'Disable'; if($status->status == 'DISABLED'){
										$st = 'PUBLISHED'; $name = 'Enable';
									} ?>
									<button class="btn" id="status_btn" data-status='<?php echo $st;?>'><?php echo $name; ?></button>
									<a href="<?php echo base_url('admin/courses');?>" class="btn btn-default">Cancel</a>
								</div>
							</div>
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
<script src="<?php echo base_url(); ?>assets/js/admin_scripts.js"></script>
<script>
	
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
	});
	$("#update_btn").on('click',function(){
		var courseID = $("#courseID").val();
		$("button").attr("disabled",true);
		$.ajax({
			url:'<?php echo base_url('admin/course_publish');?>',
			type:'POST',
			data:{'courseID':courseID},
			dataType:'JSON'
		}).success(function(data){
			if(data){
				$("#update_btn").parent().append("<h3 class='text-success'>Course Published Successfully.Please wait...</h3>");
			}else{
				$("#update_btn").parent().append("<h3 class='text-danger'>Course Not Published Successfully. Please try agan later</h3>");
			}
			setTimeout(function(){window.location.reload();},1000);
		});
	});
	$("#status_btn").on('click',function(){
		var courseID = $("#courseID").val();
		var status = $(this).data('status');
		$("button").attr("disabled",true);
		$.ajax({
			url:'<?php echo base_url('admin/course_status_update');?>',
			type:'POST',
			data:{'courseID':courseID,'status':status},
			dataType:'JSON'
		}).success(function(data){
			if(data){
				$("#status_btn").parent().append("<h3 class='text-success'>Course status changed successfully. Please wait...</h3>");
			}else{
				$("#status_btn").parent().append("<h3 class='text-danger'>Course status not changed successfully. Please try agan later</h3>");
			}
			setTimeout(function(){window.location.reload();},1000);
		});
	});
	</script>
</body>
</html>
