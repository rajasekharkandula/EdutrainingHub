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
	.preview{
		width:150px;
		height:150px;
	}
	</style>
</head>
<body>
	<!-- Header starts here -->
	<?php echo $header;?>
	<!-- Header ends here -->
	<!-- Body content starts here -->
	<div class="body-container">
		<section class="container">
			
			<form id="testimonial_form" method="POST" action="#" onSubmit="return false;" >
				<h3>Testimonial Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create Testimonial </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="testimonialID" name="testimonialID" value="<?php echo $testimonialID;?>">
						<div class="row mb-10">
							<label class="col-md-2">User Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name" placeholder="Name" value="<?php if(isset($data->name))echo $data->name;?>" />
							</div>
						</div>
						<div class="row mb-10 mt-10">
							<label class="col-md-2">User Image <span class="required">*</span> </label>
							<div class="col-md-4">
								<input type="file" data-req="false" class="form-control" name="image" id="image" accept="image/*" onchange="return image_upload('image',0,0)">
								<input type="hidden" name="uploaded_img" id="uploaded_img" value="<?php if(isset($data->image))echo $data->image;?>">
								<?php if(isset($data->image)){?>
								<img class="preview" src="<?php echo base_url($data->image);?>">
								<?php } ?>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Designation <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="designation" placeholder="Designation" value="<?php if(isset($data->designation))echo $data->designation;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Review <span class="required">*</span> </label>
							<div class="col-md-5">
								<textarea class="form-control" name="review" placeholder="Type review"><?php if(isset($data->review))echo $data->review;?></textarea>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Status <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="status" id="status">
									<option value=""></option>
									<option value="P" <?php if(isset($data->status))if($data->status == "P")echo 'selected';?>>Active</option>
									<option value="S" <?php if(isset($data->status))if($data->status == "S")echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/testimonials');?>" class="btn btn-default">Cancel</a>
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
		$("#testimonial_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			var formData = new FormData($("#testimonial_form")[0]);
			$.ajax({
				url:'<?php echo base_url('admin/testimonial_save');?>',
				type:'POST',
				data:formData,
				dataType:'JSON',
				cache: false,
				contentType: false,
				processData: false
			}).success(function(data){
				window.location='<?php echo base_url('admin/testimonials');?>';
			});
		}
	});
	</script>
</body>
</html>
