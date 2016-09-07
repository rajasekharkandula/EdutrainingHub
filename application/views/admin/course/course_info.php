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
				<h3>Course Information <?php if(isset($course->modifiedBy)){?><label class="modified_by">Modified By <?php echo $course->modifiedBy;?> on <?php echo date('d-M-Y h:i A',strtotime($course->modifiedDate));?></label><?php } ?></h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-gears"></i> <?php if(isset($course->courseName))echo $course->courseName;else echo 'Create Course'; ?> </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body no-padding">
						<div class="row table-layout">
							<?php echo $sidebar; ?>
							<div class="col-md-12 pb-20">
								<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
								<div class="row mb-10 mt-20">
									<label class="col-md-2"> Course Name <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="courseName" placeholder="Course Name" value="<?php if(isset($course->courseName))echo $course->courseName;?>" />
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-2"> Category <span class="required">*</span> </label>
									<div class="col-md-6">
										<select class="form-control select2" name="categoryID">
											<option value=""></option>
											<?php foreach($categories as $c){ 
											$categoryID = "";
											if(isset($course->categoryID))
												$categoryID = $course->categoryID;
											?>
											<option value="<?php echo $c->categoryID;?>" <?php if($categoryID == $c->categoryID)echo 'selected'; ?>><?php echo $c->categoryName; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-2"> Course Type <span class="required">*</span> </label>
									<div class="col-md-6">
										<select class="form-control select2" name="courseTypes[]" multiple >
											<option value=""></option>
											<?php foreach($courseTypes as $ct){ ?>
											<option value="<?php echo $ct->courseTypeID;?>" <?php if(in_array($ct->courseTypeID,$courseTypeMaping))echo 'selected'; ?>><?php echo $ct->courseTypeName; ?></option>
											<?php } ?>
										</select>
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
		$("#course_form .form-control").each(function(){if($(this).val() == "" || $(this).val() == null){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/course_save');?>',
				type:'POST',
				data:$('#course_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location = '<?php echo base_url();?>admin/course/info/'+data;
			});
		}
	});
	</script>
</body>
</html>
