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
								<label>General Classroom Faq`s <span class="required">*</span></label>
								<hr class="mt-0 mb-20"></hr>
								<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
								<div id="faq_div">
									<input type="hidden" name="faq_count" id="faq_count" value="<?php echo count($faq);?>">
									<?php $i=1; foreach($faq as $f){ if($f->type == 'classroom'){ ?>
									<div class="row mb-10" id="question_<?php echo $i; ?>">
										<label class="col-md-2">Question <?php echo $i; ?> <span class="required">*</span> </label>
										<div class="col-md-9 mb-10">
											<input name="question_<?php echo $i; ?>" type="text" class="form-control" placeholder="Question <?php echo $i; ?>" value="<?php echo $f->question; ?>" />
										</div>
										<label class="col-md-2">Answer <?php echo $i; ?> <span class="required">*</span> </label>
										<div class="col-md-9">
											<textarea name="answer_<?php echo $i; ?>" class="form-control" placeholder="Answer <?php echo $i; ?>"><?php echo $f->answer; ?></textarea>
										</div>
									</div>
									<?php $i++; } } ?>
								</div>
								<div class="row">
									<div class="col-md-3 pull-right">
										<button class="btn" id="add_faq"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
										<button class="btn btn-danger" id="remove_faq"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
									</div>
								</div>
								<label>Online Classroom Faq`s <span class="required">*</span></label>
								<hr class="mt-0 mb-20"></hr>
								<input type="hidden" name="courseID" value="<?php echo $courseID;?>">
								<div id="faqo_div">
									<input type="hidden" name="faqo_count" id="faq_count" value="<?php echo count($faq);?>">
									<?php $i=1; foreach($faq as $f){ if($f->type == 'online'){?>
									<div class="row mb-10" id="questiono_<?php echo $i; ?>">
										<label class="col-md-2">Question <?php echo $i; ?> <span class="required">*</span> </label>
										<div class="col-md-9 mb-10">
											<input name="questiono_<?php echo $i; ?>" type="text" class="form-control" placeholder="Question <?php echo $i; ?>" value="<?php echo $f->question; ?>" />
										</div>
										<label class="col-md-2">Answer <?php echo $i; ?> <span class="required">*</span> </label>
										<div class="col-md-9">
											<textarea name="answero_<?php echo $i; ?>" class="form-control" placeholder="Answer <?php echo $i; ?>"><?php echo $f->answer; ?></textarea>
										</div>
									</div>
									<?php $i++; } } ?>
								</div>
								<div class="row">
									<div class="col-md-3 pull-right">
										<button class="btn" id="add_faqo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
										<button class="btn btn-danger" id="remove_faqo"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
									</div>
								</div>
								<label>Why us? <span class="required">*</span></label>
								<hr class="mt-0 mb-20"></hr>
								<div id="why_div">
									<input type="hidden" name="why_count" id="why_count" value="<?php echo count($why); ?>">
									<?php $i=1; foreach($why as $w){ ?>
									<div class="row mb-10" id="why_1">
										<label class="col-md-2">Description <?php echo $i; ?> <span class="required">*</span> </label>
										<div class="col-md-9">
											<textarea name="why_<?php echo $i; ?>" class="form-control" placeholder="Description <?php echo $i; ?>"><?php echo $w->description; ?></textarea>
										</div>
									</div>
									<?php $i++; } ?>
								</div>
								<div class="row mb-20">
									<div class="col-md-3 pull-right">
										<button class="btn" id="add_why"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
										<button class="btn btn-danger" id="remove_why"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
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
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script>
	
	$(document).ready(function() {
		$('.select2').select2({placeholder: "Select"});
		$("#countryID").trigger('change');
	});

	$("#add_faq").on('click',function(){
		var numItems = $('#faq_div .row').length;
		numItems= numItems+1;
		var html = '<div class="row mb-10" id="question_'+numItems+'">'+
					'<label class="col-md-2">Question '+numItems+' <span class="required">*</span> </label>'+
					'<div class="col-md-9 mb-10">'+
						'<input name="question_'+numItems+'" type="text" class="form-control" placeholder="Question '+numItems+'"/>'+
					'</div>'+
					'<label class="col-md-2">Answer '+numItems+' <span class="required">*</span> </label>'+
					'<div class="col-md-9">'+
						'<textarea name="answer_'+numItems+'" class="form-control" placeholder="Answer '+numItems+'"></textarea>'+
					'</div>'+
				'</div>';
		$("#faq_div").append(html);
		$("#faq_count").val(numItems);
	});
	$("#remove_faq").on('click',function(){
		var numItems = $('#faq_div .row').length;
		$("#question_"+numItems).remove();
		$("#faq_count").val(numItems);
	});
	$("#add_faqo").on('click',function(){
		var numItems = $('#faqo_div .row').length;
		numItems= numItems+1;
		var html = '<div class="row mb-10" id="questiono_'+numItems+'">'+
					'<label class="col-md-2">Question '+numItems+' <span class="required">*</span> </label>'+
					'<div class="col-md-9 mb-10">'+
						'<input name="questiono_'+numItems+'" type="text" class="form-control" placeholder="Question '+numItems+'"/>'+
					'</div>'+
					'<label class="col-md-2">Answer '+numItems+' <span class="required">*</span> </label>'+
					'<div class="col-md-9">'+
						'<textarea name="answero_'+numItems+'" class="form-control" placeholder="Answer '+numItems+'"></textarea>'+
					'</div>'+
				'</div>';
		$("#faqo_div").append(html);
		$("#faqo_count").val(numItems);
	});
	$("#remove_faqo").on('click',function(){
		var numItems = $('#faqo_div .row').length;
		$("#questiono_"+numItems).remove();
		$("#faqo_count").val(numItems);
	});
	$("#add_why").on('click',function(){
		var numItems = $('#why_div .row').length;
		numItems= numItems+1;
		var html = '<div class="row mb-10" id="why_'+numItems+'">'+
					'<label class="col-md-2">Description '+numItems+' <span class="required">*</span> </label>'+
					'<div class="col-md-9">'+
						'<textarea name="why_'+numItems+'" class="form-control" placeholder="Description '+numItems+'"></textarea>'+
					'</div>'+
				'</div>';
		$("#why_div").append(html);
		$("#why_count").val(numItems);
	});
	$("#remove_why").on('click',function(){
		var numItems = $('#why_div .row').length;
		$("#why_"+numItems).remove();
		$("#why_count").val(numItems);
	});
	$("#update_btn").on('click',function(){
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#course_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
		if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/course_faq_save');?>',
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
