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
			
			<form id="state_form" method="POST" action="#" onSubmit="return false;">
				<h3>State Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create state </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="stateID" name="stateID" value="<?php echo $stateID;?>">
						<div class="row mb-10">
							<label class="col-md-2">Country Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<select class="form-control select2" name="countryID" id="countryID">
									<option value=""></option>
									<?php foreach($countries as $c){  ?>
									<option value="<?php echo $c->countryID;?>" <?php if(isset($state->countryID))if($state->countryID == $c->countryID)echo 'selected';?>><?php echo $c->countryName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="row mb-10">
							<label class="col-md-2">State Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name" placeholder="State name" value="<?php if(isset($state->stateName))echo $state->stateName;?>" />
							</div>
						</div>
						
						<input type="hidden" name="status" value="P">
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/states');?>" class="btn btn-default">Cancel</a>
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
		$("#stateID").trigger('change');
	});

	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#state_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/state_save');?>',
				type:'POST',
				data:$('#state_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin/states');?>';
			});
		}
	});
	</script>
</body>
</html>
