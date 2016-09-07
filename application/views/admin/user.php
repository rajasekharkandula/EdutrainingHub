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
			
			<form id="profile_form" method="POST" action="#" onSubmit="return false;">
				<h3>User Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create User </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="userID" name="userID" value="<?php echo $userID;?>">
						<input type="hidden" id="type" name="type" value="<?php if($userID !="")echo 'UPDATE';else echo 'INSERT';?>">
						<label>Basic details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Email <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php if(isset($details->email))echo $details->email;?>" <?php if(isset($details->email))echo 'readonly'; ?>/>
							</div>
						</div>
						<?php if(!isset($details->password)){ ?>
						<div class="row mb-10">
							<label class="col-md-2">Password <span class="required">*</span></label>
							<div class="col-md-5">
								<input type="password" class="form-control" name="password" placeholder="Password" />
							</div>
						</div>
						<?php } ?>
						<div class="row mb-10">
							<label class="col-md-2">Role <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="roleID" id="roleID">
									<option value=""></option>
									<?php foreach($roles as $r){  ?>
									<option value="<?php echo $r->roleID;?>" <?php if(isset($details->defaultRoleID))if($details->defaultRoleID == $r->roleID)echo 'selected';?>><?php echo $r->roleName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Status <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="status" id="status">
									<option value=""></option>
									<option value="P" <?php if(isset($details->status))if($details->status == "P")echo 'selected';?>>Active</option>
									<option value="S" <?php if(isset($details->status))if($details->status == "S")echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
						<label>Profile details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">First Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php if(isset($details->firstName))echo $details->firstName;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Last Name </label>
							<div class="col-md-5">
								<input data-req="false" type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php if(isset($details->lastName))echo $details->lastName;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Secondary Email </label>
							<div class="col-md-5">
								<input data-req="false" type="text" class="form-control" name="sEmail" placeholder="Secondary Email" id="sEmail" value="<?php if(isset($details->secondaryEmail))echo $details->secondaryEmail;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Primary Phone <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="phone" placeholder="Primary Phone" id="userPhone" value="<?php if(isset($details->phone))echo $details->phone;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Secondary Phone</label>
							<div class="col-md-5">
								<input data-req="false" type="text" class="form-control" name="sPhone" placeholder="Secondary Phone" id="sPhone" value="<?php if(isset($details->secondaryPhone))echo $details->secondaryPhone;?>" />
							</div>
						</div>
						<label>Profile details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Address line 1 <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="address1" placeholder="House number, Street number" value="<?php if(isset($details->addressLine1))echo $details->addressLine1;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Address line 2 </label>
							<div class="col-md-5">
								<input data-req="false" type="text" class="form-control" name="address2" placeholder="Area" value="<?php if(isset($details->addressLine2))echo $details->addressLine2;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Country <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="countryID" id="countryID">
									<option value=""></option>
									<?php foreach($countries as $c){  ?>
									<option value="<?php echo $c->countryID;?>" <?php if(isset($details->countryID))if($details->countryID == $c->countryID)echo 'selected';?>><?php echo $c->countryName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">State <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="stateID" id="stateID">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">City <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="cityID" id="cityID">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Zip Code  </label>
							<div class="col-md-5">
								<input data-req="false" type="text" class="form-control" name="zipCode" placeholder="Zip Code" id="zipCode" value="<?php if(isset($details->zipCode))echo $details->zipCode;?>" />
							</div>
						</div>
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/users');?>" class="btn btn-default">Cancel</a>
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
	function checkemail(email){
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
			return 1;
		}
		return 0;
	}
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
	});

	$("#countryID").on("change",function(){
		var stateID = '<?php if(isset($details->stateID))echo $details->stateID;?>';
		$.ajax({
			url:'<?php echo base_url('admin/getLocation');?>',
			type:'POST',
			data:{'type':'STATES','countryID':$('#countryID').val()},
			dataType:'JSON'
		}).done(function(data){
			var html = '<option value=""></option>';
			for(i=0;i<data.length;i++){
				if(stateID == data[i]['stateID'])
					html += "<option value='"+data[i]['stateID']+"' selected>"+data[i]['stateName']+"</option>";
				else
					html += "<option value='"+data[i]['stateID']+"' >"+data[i]['stateName']+"</option>";
			}
			$('#stateID').html(html);
			$('.select2').select2({placeholder: "Select"});
			if(stateID != '')$("#stateID").trigger("change");
		});
	});
	$("#stateID").on("change",function(){
		var cityID = '<?php if(isset($details->cityID))echo $details->cityID;?>';
		$.ajax({
			url:'<?php echo base_url('admin/getLocation');?>',
			type:'POST',
			data:{'type':'CITIES','stateID':$('#stateID').val()},
			dataType:'JSON'
		}).done(function(data){
			var len=data.length;
			html = '<option value=""></option>';
			for(i=0;i<len;i++){
				if(cityID == data[i]['cityID'])
					html += "<option value='"+data[i]['cityID']+"' selected>"+data[i]['cityName']+"</option>";
				else
					html += "<option value='"+data[i]['cityID']+"' >"+data[i]['cityName']+"</option>";
			}
			$('#cityID').html(html);
			$('.select2').select2({placeholder: "Select"});
		});
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#profile_form .form-control").each(function(){if($(this).val() == "" && $(this).data('req') != false){$(this).parent().append(text_error);error++;}});
		if(!checkemail($("#sEmail").val()) && $("#sEmail").val() != ""){$("#sEmail").parent().append('<span class="text-danger"> Invalid email </span>');error++;}
		if(!checkemail($("#email").val()) && $("#email").val() != ""){$("#email").parent().append('<span class="text-danger"> Invalid email </span>');error++;}
		if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/user_save');?>',
				type:'POST',
				data:$('#profile_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin/users');?>';
			});
		}
	});
	</script>
</body>
</html>
