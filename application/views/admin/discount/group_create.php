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
			
			<form id="group_form" method="POST" action="#" onSubmit="return false;">
				<h3>Group Discount Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create Group Discount </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="discountID" name="discountID" value="<?php echo $discountID;?>">
						<div class="row mb-10">
							<label class="col-md-2">Group Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="groupName" placeholder="Name" value="<?php if(isset($group->groupName))echo $group->groupName;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Group <span class="required">*</span> </label>
							<?php 
								$from = 0; $to=0;
								if(isset($group->groupMembers)){
									$temp = explode("-",$group->groupMembers);
									$from = $temp[0];
									$to = $temp[1];
								}
							?>
							<div class="col-md-1 pr-0">
								<select class="form-control" name="from">
									<?php for($i=1;$i<=20;$i++){?>
									<option <?php if($i==$from)echo 'selected';?>><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-1 text-center" style="width: 10px;line-height: 30px;">
							-
							</div>	
							<div class="col-md-1 pl-0">
								<select class="form-control" name="to">
									<?php for($i=1;$i<=20;$i++){?>
									<option <?php if($i==$to)echo 'selected';?>><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Discount <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="number" class="form-control" name="discount" placeholder="Discount" value="<?php if(isset($group->discount))echo $group->discount;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Status <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="status" id="status">
									<option value=""></option>
									<option value="P" <?php if(isset($group->status))if($group->status == "P")echo 'selected';?>>Active</option>
									<option value="S" <?php if(isset($group->status))if($group->status == "S")echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/group_discounts');?>" class="btn btn-default">Cancel</a>
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
		$("#group_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/group_discount_save');?>',
				type:'POST',
				data:$('#group_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin/group_discounts');?>';
			});
		}
	});
	</script>
</body>
</html>
