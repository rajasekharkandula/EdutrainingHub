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
			
			<form id="city_form" method="POST" action="#" onSubmit="return false;">
				<h3>City Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create city </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="cityID" name="cityID" value="<?php echo $cityID;?>">
						<div class="row mb-10">
							<label class="col-md-2">Country Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<select class="form-control select2" name="countryID" id="countryID">
									<option value=""></option>
									<?php foreach($countries as $c){  ?>
									<option value="<?php echo $c->countryID;?>" <?php if(isset($city->countryID))if($city->countryID == $c->countryID)echo 'selected';?>><?php echo $c->countryName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">State Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<select class="form-control select2" name="stateID" id="stateID">
									<option value=""></option>
									<?php foreach($states as $s){  ?>
									<option value="<?php echo $s->stateID;?>" <?php if(isset($city->stateID))if($city->stateID == $s->stateID)echo 'selected';?>><?php echo $s->stateName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="row mb-10">
							<label class="col-md-2">City Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="name" name="name" placeholder="city name" value="<?php if(isset($city->cityName))echo $city->cityName;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">City Slug <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="slug" name="slug" placeholder="city name" value="<?php if(isset($city->slug))echo $city->slug;?>" readonly />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Currency <span class="required">*</span> </label>
							<div class="col-md-5">
								<select class="form-control select2" name="currencyID" id="currencyID">
									<option value=""></option>
									<?php foreach($currencies as $cu){  ?>
									<option value="<?php echo $cu->currencyID;?>" <?php if(isset($city->currencyID))if($city->currencyID == $cu->currencyID)echo 'selected';?>><?php echo $cu->currencyName.'('.$cu->currencyCode.')';?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<input type="hidden" name="status" value="P">
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/cities');?>" class="btn btn-default">Cancel</a>
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
		$("#cityID").trigger('change');
	});
	$("#countryID").on("change",function(){
		var stateID = '<?php if(isset($city->stateID))echo $city->stateID;?>';
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
	$("#name").blur(function(){
		var slug = $("#name").val().toLowerCase().replace(/ /g,'').replace(/-/g,'').replace(/[^\w-]+/g,'')
		$("#slug").val(slug);
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#city_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/city_save');?>',
				type:'POST',
				data:$('#city_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				//window.location='<?php echo base_url('admin/cities');?>';
			});
		}
	});
	</script>
</body>
</html>
