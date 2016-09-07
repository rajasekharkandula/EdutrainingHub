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
							<div class="col-md-12 pb-20">
								<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
								<div class="row mb-10 mt-20">
									<label class="col-md-3">Slug <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="slug" placeholder="Course Name" value="<?php if(isset($course->slug))echo $course->slug;?>" />
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">Title <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="title" placeholder="Meta Title" value="<?php if(isset($course->title))echo $course->title;?>" />
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">Meta Description <span class="required">*</span> </label>
									<div class="col-md-6">
										<textarea name="metaDesc" class="form-control" placeholder="Meta Description"><?php if(isset($course->metaDesc))echo $course->metaDesc;?></textarea>
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">SEO Content <span class="required">*</span> </label>
									<div class="col-md-9">
										<textarea name="SEOContent" id="SEOContent" class="form-control" placeholder="SEO Content"><?php if(isset($course->SEOContent))echo $course->SEOContent;?></textarea>
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">Rating <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="rating" placeholder="Rating" value="<?php if(isset($course->rating))echo $course->rating;?>" />
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">Rating Count <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="number" class="form-control" name="ratingCount" placeholder="Rating Count" value="<?php if(isset($course->ratingCount))echo $course->ratingCount;?>" />
									</div>
								</div>
								<div class="row mb-10">
									<label class="col-md-3">Users Enrolled <span class="required">*</span> </label>
									<div class="col-md-6">
										<input type="number" class="form-control" name="usersEnrolled" placeholder="Users Enrolled" value="<?php if(isset($course->usersEnrolled))echo $course->usersEnrolled;?>" />
									</div>
								</div>
								<hr class="mt-0"></hr>
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
<script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script>
	
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
		tinyMCE.init({
			theme : "modern",
			selector : "#SEOContent",
			height: 200
		});
	});

	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#SEOContent").val(tinyMCE.get('SEOContent').getContent());
		$("#course_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
		
		if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/course_dm_save');?>',
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
