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
			
			<form id="special_form" method="POST" action="#" onSubmit="return false;">
				<h3>speciSl Discount Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create Special Discount </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="discountID" name="discountID" value="<?php echo $discountID;?>">
						<div class="row mb-10">
							<label class="col-md-2">Discount Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name" placeholder="Name" value="<?php if(isset($special->name))echo $special->name;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Coupon Code <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="coupon" placeholder="coupon" value="<?php if(isset($special->coupon))echo $special->coupon;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2"> </label>
							<div class="col-md-2">
								<input type="radio" name="validAll" value="1" <?php if(isset($special->validAll)){if($special->validAll ==1)echo 'checked';}else{echo 'checked';}?>/> Valid for all
							</div>
							<div class="col-md-2">
								<input type="radio" id="c-user" name="validAll" value="0" <?php if(isset($special->validAll))if($special->validAll == 0)echo 'checked';?>/> Select user
							</div>
						</div>
						<div class="row mb-10 <?php if(isset($special->validAll))if($special->validAll == 1)echo 'hide';?>" id="users_div">
							<label class="col-md-2">Email ID`s <span class="required">*</span> </label>
							<div class="col-md-5">
								<textarea req="false" id="emails" class="form-control" name="users" placeholder="Type emails seperated by camma(,)"/><?php if(isset($special->users))echo $special->users;?></textarea>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Discount <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="number" class="form-control" name="discount" placeholder="Discount" value="<?php if(isset($special->discount))echo $special->discount;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Status <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="status" id="status">
									<option value=""></option>
									<option value="P" <?php if(isset($special->status))if($special->status == "P")echo 'selected';?>>Active</option>
									<option value="S" <?php if(isset($special->status))if($special->status == "S")echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/special_discounts');?>" class="btn btn-default">Cancel</a>
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

	$("input[name=validAll]").on('change',function(){
		if($(this).val() == 0)
			$("#users_div").removeClass("hide");
		else
			$("#users_div").addClass("hide");
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#special_form .form-control").each(function(){if($(this).val() == "" && $(this).attr('req')!="false" ){$(this).parent().append(text_error);error++;}});
		if($("#c-user").is(":checked") && $("#emails").val() == ""){$("#emails").parent().append(text_error);error++;}
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/special_discount_save');?>',
				type:'POST',
				data:$('#special_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin/special_discounts');?>';
			});
		}
	});
	</script>
</body>
</html>
