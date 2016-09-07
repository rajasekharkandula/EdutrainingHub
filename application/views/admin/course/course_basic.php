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
						<span class="panel-title"> <i class="fa fa-gears"></i> <?php echo $course->courseName;?> </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body no-padding">
						<div class="row table-layout">
							<?php echo $sidebar; ?>
							<div class="col-md-12 pb-20">
								<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
								<label>Features</label>
								<hr class="mt-0"></hr>
								<div class="row mb-10 mt-10">
									<label class="col-md-1"> 1 <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="feature1" placeholder="Feature 1" value="<?php if(isset($course->feature1))echo $course->feature1;?>" />
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-1"> 2 <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="feature2" placeholder="Feature 2" value="<?php if(isset($course->feature2))echo $course->feature2;?>" />
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-1"> 3 <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="feature3" placeholder="Feature 3" value="<?php if(isset($course->feature3))echo $course->feature3;?>" />
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-1"> 4 <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="feature4" placeholder="Feature 4" value="<?php if(isset($course->feature4))echo $course->feature4;?>" />
									</div>
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-1"> 5 <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="feature5" placeholder="Feature 5" value="<?php if(isset($course->feature5))echo $course->feature5;?>" />
									</div>
								</div>
								
								<label>Image</label>
								<hr class="mt-0"></hr>
								<div class="row mb-10 mt-10">
									<label class="col-md-2"> Cover Image <span class="required">*</span> </label>
									<div class="col-md-4">
										<input type="file" data-req="false" class="form-control" name="image" id="image" accept="image/*" onchange="return image_upload('image',200,130)">
										<input type="hidden" name="uploaded_img" id="uploaded_img" value="<?php if(isset($course->image))echo $course->image;?>">
										<?php if(isset($course->image)){?>
										<img class="preview" src="<?php echo base_url($course->image);?>">
										<?php } ?>
									</div>
									<label class="col-md-2"> Authorized Logo </label>
									<div class="col-md-4">
										<input type="file" data-req="false" class="form-control" name="authLogo" id="auth_logo" accept="image/*" onchange="return image_upload('auth_logo',200,130)">
										<input data-req="false" type="hidden" name="uploaded_auth_logo" id="uploaded_auth_logo" value="<?php if(isset($course->authLogo))echo $course->authLogo;?>">
										<?php if(isset($course->authLogo)){?>
										<img class="preview" src="<?php echo base_url($course->authLogo);?>">
										<?php } ?>
									</div>
									
								</div>
								<div class="row mb-10 mt-10">
									<label class="col-md-2"> Brochure  <span class="required">*</span> </label>
									<div class="col-md-4">
										<input type="file" data-req="false" class="form-control" name="brochure" id="brochure" onchange="return file_upload('brochure')" accept="application/pdf"/>
										<input type="hidden" name="uploaded_brochure" id="uploaded_brochure" value="<?php if(isset($course->brochure))echo $course->brochure;?>">
										<?php if(isset($course->brochure)){ ?>
										<a class="btn mt-10" href="<?php echo base_url($course->brochure);?>" target="_blank">View uploded brochure</a>
										<?php } ?>
									</div>
								</div>
								<label>Who can attend? <span class="required">*</span></label>
								<hr class="mt-0 mb-5"></hr>
								<div class="row mb-10 mt-10">
									<div class="col-md-12">
										<textarea name="whoCanAttend" class="form-control" rows="7" placeholder="Who can attend?"><?php if(isset($course->whoCanAttend))echo $course->whoCanAttend;?></textarea>
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
<script src="<?php echo base_url(); ?>assets/js/admin_scripts.js"></script>
<script>
	
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#course_form .form-control").each(function(){
			if($(this).val() == "" && $(this).data('req') != false){$(this).parent().append(text_error);error++;}
		});
		if($("#image").val() == "" && $("#uploaded_img").val() == ""){$("#image").parent().append(text_error);error++;}
		
		if($("#brochure").val() == "" && $("#uploaded_brochure").val() == ""){$("#brochure").parent().append(text_error);error++;}
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			var formData = new FormData($("#course_form")[0]);
			$.ajax({
				url:'<?php echo base_url('admin/course_basic_save');?>',
				type:'POST',
				data:formData,
				dataType:'JSON',
				cache: false,
				contentType: false,
				processData: false
			}).success(function(data){
				window.location.reload();
			});
		}
	});
	</script>
</body>
</html>
