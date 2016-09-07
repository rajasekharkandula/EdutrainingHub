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
			
			<form id="course_form" method="POST" action="#" onSubmit="return false;">
				<h3>Course Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-gears"></i> Create Course </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body no-padding">
						<div class="row table-layout">
							<?php echo $sidebar; ?>
							<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
							<div class="col-md-12 pb-20">
								<label>Course Description <span class="required">*</span></label>
								<hr class="mt-0 mb-5"></hr>
								<div class="row mb-10 mt-10">
									<div class="col-md-12">
										<textarea name="desc" class="form-control" rows="7" placeholder="Course Description..."><?php if(isset($course->description))echo $course->description;?></textarea>
									</div>
								</div>
								<label>Course Agenda  <span class="required">*</span></label>
								<hr class="mt-0 mb-5"></hr>
								<div class="row mb-10 mt-10">
									<div class="col-md-12">
										<textarea name="agenda" class="form-control" rows="7" placeholder="Course Agenda..."><?php if(isset($course->agenda))echo $course->agenda;?></textarea>
									</div>
								</div>
								<label>Course Certifications <span class="required">*</span></label>
								<hr class="mt-0 mb-5"></hr>
								<div class="row mb-10 mt-10">
									<div class="col-md-12">
										<textarea name="certifications" class="form-control" rows="7" placeholder="Course Certifications..."><?php if(isset($course->certifications))echo $course->certifications;?></textarea>
									</div>
								</div>
								<label>Course Benefits  <span class="required">*</span></label>
								<hr class="mt-0 mb-5"></hr>
								<div class="row mb-10 mt-10">
									<div class="col-md-12">
										<textarea name="benfits" class="form-control" rows="7" placeholder="Course Benefits..."><?php if(isset($course->benfits))echo $course->benfits;?></textarea>
									</div>
								</div>
								
								<hr></hr>
								<div class="col-md-10 text-center">
									<button class="btn" id="update_btn">Save</button>
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
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script>
	
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
	});

	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#course_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
		if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/course_desc_save');?>',
				type:'POST',
				data:$('#course_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location.reload();
			});
		}
	});
	</script>
</body>
</html>
