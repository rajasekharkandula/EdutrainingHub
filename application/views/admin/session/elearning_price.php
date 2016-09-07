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
	.delete{
		font-size: 20px;
		line-height: 28px;
		color: #c50606;
		cursor:pointer;
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
			
			<form id="price_form" method="POST" action="#" onSubmit="return false;">
				<h3>Elearning Price Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<div class="row">
							<div class="col-md-4">
								<span class="panel-title"> <i class="fa fa-cogs"></i> <?php echo $course->courseName; ?> </span> 
							</div>
							<div class="col-md-4">
								<span class="panel-title"> Course type : Elearning </span> 
							</div>
						</div>
					</div>
					<div class="panel-body">
						<input type="hidden" id="courseID" name="courseID" value="<?php echo $course->courseID;?>">
						<?php $i=1;foreach($duration as $d){ ?>
						<div id="duration_div_<?php echo $i; ?>">
							<label>Duration <?php echo $i; ?></label>
							<hr class="mt-0"></hr>
							<div class="row mb-10">
								<label class="col-md-2">Duration <span class="required">*</span> </label>
								<div class="col-md-4">
									<input type="number" class="form-control" id="duration_<?php echo $i; ?>" name="duration_<?php echo $i; ?>" placeholder="Enter Duration" value="<?php echo $d->duration; ?>"/>
								</div>
								<div class="col-md-4">
									<button class="btn addc_btn" type="button" data-duration="<?php echo $i; ?>" data-currency="<?php echo $d->priceCount; ?>"> Add Currency</button>
								</div>
							</div>
							<?php $j=1;foreach($prices as $p){ if($p->duration == $d->duration){ ?>
							<div class="row mb-10 currency" id="currency_div_<?php echo $i.'_'.$j; ?>">
								<label class="col-md-2">Select Currency <span class="required">*</span> </label>
								<div class="col-md-4">
									<select class="form-control select2" name="currency_<?php echo $i.'_'.$j; ?>" id="currency_<?php echo $i.'_'.$j; ?>">
										<option value=""></option>
										<?php foreach($currencies as $c){  ?>
										<option value="<?php echo $c->currencyID;?>" <?php if($p->currencyID == $c->currencyID)echo 'selected';?>><?php echo $c->currencyCode;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<input type="number" class="form-control" id="amount_<?php echo $i.'_'.$j; ?>" name="amount_<?php echo $i.'_'.$j; ?>" placeholder="Enter Amount" value="<?php echo $p->amount; ?>"/>
								</div>
								<div class="col-md-2">
									<span class="fa fa-trash-o delete" data-duration="<?php echo $i; ?>" data-currency="<?php echo $j; ?>"></span>
								</div>
							</div>
							<?php $j++;} } ?>
						</div>
						<?php $i++;} ?>
						<?php if(count($duration) == 0){ ?>
						<div id="duration_div_1">
							<label>Duration 2</label>
							<hr class="mt-0"></hr>
							<div class="row mb-10">
								<label class="col-md-2">Duration <span class="required">*</span> </label>
								<div class="col-md-4">
									<input type="number" class="form-control" id="duration_1" name="duration_1" placeholder="Enter Duration"/>
								</div>
								<div class="col-md-4">
									<button class="btn addc_btn" type="button" data-duration="1" data-currency="1"> Add Currency</button>
								</div>
							</div>
							<div class="row mb-10 currency"  id="currency_div_1_1">
								<label class="col-md-2">Select Currency <span class="required">*</span> </label>
								<div class="col-md-4">
									<select class="form-control select2" name="currency_1_1" id="currency_1_1">
										<option value=""></option>
										<?php foreach($currencies as $c){  ?>
										<option value="<?php echo $c->currencyID;?>"><?php echo $c->currencyCode;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<input type="number" class="form-control" id="amount_1_1" name="amount_1_1" placeholder="Enter Amount"/>
								</div>
								<div class="col-md-2">
									<span class="fa fa-trash-o delete" data-duration="1" data-currency="1"></span>
								</div>
							</div>
						</div>
						<div id="duration_div_2">
							<label>Duration 2</label>
							<hr class="mt-0"></hr>
							<div class="row mb-10">
								<label class="col-md-2">Duration <span class="required">*</span> </label>
								<div class="col-md-4">
									<input type="number" class="form-control" id="duration_2" name="duration_2" placeholder="Enter Duration"/>
								</div>
								<div class="col-md-4">
									<button class="btn addc_btn" type="button" data-duration="2" data-currency="1"> Add Currency</button>
								</div>
							</div>
							<div class="row mb-10 currency"  id="currency_div_2_1">
								<label class="col-md-2">Select Currency <span class="required">*</span> </label>
								<div class="col-md-4">
									<select class="form-control select2" name="currency_2_1" id="currency_2_1">
										<option value=""></option>
										<?php foreach($currencies as $c){  ?>
										<option value="<?php echo $c->currencyID;?>" <?php if(isset($session->currencyID))if($session->currencyID == $c->currencyID)echo 'selected';?>><?php echo $c->currencyCode;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<input type="number" class="form-control" id="amount_2_1" name="amount_2_1" placeholder="Enter Amount"/>
								</div>
								<div class="col-md-2">
									<span class="fa fa-trash-o delete" data-duration="2" data-currency="1"></span>
								</div>
							</div>
						</div>
						<?php } ?>				
						<hr></hr>
						<div class="col-md-7 text-center">
							<button data-status="SAVED" class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin_course/online_courses');?>" class="btn btn-default">Cancel</a>
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
		$('.select2').select2({placeholder: "Select Currency"});
	});

	
	$(".addc_btn").on('click',function(){
		var duration = parseInt($(this).data("duration"));
		var currency = parseInt($("#duration_div_"+duration+" .currency").length)+1;
		var html = '<div class="row mb-10 currency" id="currency_div_'+duration+'_'+currency+'">'+
					'<label class="col-md-2">Select Currency <span class="required">*</span> </label>'+
					'<div class="col-md-4">'+
						'<select class="form-control select2" name="currency_'+duration+'_'+currency+'" id="currency_'+duration+'_'+currency+'">'+
							'<option value=""></option>'+
							'<?php foreach($currencies as $c){  ?>'+
							'<option value="<?php echo $c->currencyID;?>"><?php echo $c->currencyCode;?></option>'+
							'<?php } ?>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<input type="number" class="form-control" id="amount_'+duration+'_'+currency+'" name="amount_'+duration+'_'+currency+'" placeholder="Enter Amount"/>'+
					'</div>'+
					'<div class="col-md-2">'+
						'<span class="fa fa-trash-o delete" data-duration="'+duration+'" data-currency="'+currency+'"></span>'+
					'</div>'+
				'</div>';
		$("#duration_div_"+duration).append(html);
		$('.select2').select2({placeholder: "Select Currency"});
	});
	$("body").on('click',".delete",function(){
		var currency = parseInt($(this).data("currency"));
		var duration = parseInt($(this).data("duration"));
		$("#currency_div_"+duration+"_"+currency,"body").remove();
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#price_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
		if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin_course/elearning_price_save');?>',
				type:'POST',
				data:$('#price_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location.reload();
			});
		}
	});
	</script>
</body>
</html>
