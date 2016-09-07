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
				<h3> Course Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<div class="row">
							<div class="col-md-4">
								<span class="panel-title"> <i class="fa fa-cogs"></i> <?php echo $course->courseName; ?> </span> 
							</div>
							<div class="col-md-4">
								<span class="panel-title"> Category :  <?php echo $course->categoryName; ?> </span> 
							</div>
							<div class="col-md-4">
								<span class="panel-title"> <i class="fa fa-map-marker"></i> <?php echo $city->cityName;?> </span> 
							</div>
						</div>
					</div>
					<div class="panel-body">
						<input type="hidden" id="courseID" name="courseID" value="<?php echo $courseID;?>">
						<input type="hidden" id="cityID" name="cityID" value="<?php echo $cityID; ?>">
						<label>Basic details</label>
						<hr class="mt-0"></hr>
						<div class="row mb-10 mt-10">
							<label class="col-md-1"> 1 <span class="required">*</span> </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="feature1" placeholder="Feature 1" value="<?php if(isset($city_content))echo $city_content->feature1; else echo $course->feature1;?>" />
							</div>
						</div>
						<div class="row mb-10 mt-10">
							<label class="col-md-1"> 2 <span class="required">*</span> </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="feature2" placeholder="Feature 2" value="<?php if(isset($city_content))echo $city_content->feature2; else echo $course->feature2;?>" />
							</div>
						</div>
						<div class="row mb-10 mt-10">
							<label class="col-md-1"> 3 <span class="required">*</span> </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="feature3" placeholder="Feature 3" value="<?php if(isset($city_content))echo $city_content->feature3; else echo $course->feature3;?>" />
							</div>
						</div>
						<div class="row mb-10 mt-10">
							<label class="col-md-1"> 4 <span class="required">*</span> </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="feature4" placeholder="Feature 4" value="<?php if(isset($city_content))echo $city_content->feature4; else echo $course->feature4;?>" />
							</div>
						</div>
						<div class="row mb-10 mt-10">
							<label class="col-md-1"> 5 <span class="required">*</span> </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="feature5" placeholder="Feature 5" value="<?php if(isset($city_content))echo $city_content->feature5; else echo $course->feature5;?>" />
							</div>
						</div>
						<label>Who can attend?</label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10 mt-10">
							<div class="col-md-12">
								<textarea name="whoCanAttend" class="form-control" rows="7" placeholder="Who can attend?"><?php if(isset($city_content))echo $city_content->whoCanAttend; else echo $course->whoCanAttend;?></textarea>
							</div>
						</div>
						<label>Course Description <span class="required">*</span></label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10 mt-10">
							<div class="col-md-12">
								<textarea name="desc" class="form-control" rows="7" placeholder="Course Description..."><?php if(isset($city_content))echo $city_content->description; else echo $course->description;?></textarea>
							</div>
						</div>
						<label>Course Agenda  <span class="required">*</span></label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10 mt-10">
							<div class="col-md-12">
								<textarea name="agenda" class="form-control" rows="7" placeholder="Course Agenda..."><?php if(isset($city_content))echo $city_content->agenda; else echo $course->agenda;?></textarea>
							</div>
						</div>
						<label>Course Certifications <span class="required">*</span></label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10 mt-10">
							<div class="col-md-12">
								<textarea name="certifications" class="form-control" rows="7" placeholder="Course Certifications..."><?php if(isset($city_content))echo $city_content->certifications; else echo $course->certifications;?></textarea>
							</div>
						</div>
						<label>Course Benefits  <span class="required">*</span></label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10 mt-10">
							<div class="col-md-12">
								<textarea name="benfits" class="form-control" rows="7" placeholder="Course Benefits..."><?php if(isset($city_content))echo $city_content->benfits; else echo $course->benfits;?></textarea>
							</div>
						</div>
						<label>SEO Content <span class="required">*</span></label>
						<hr class="mt-0 mb-5"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Title </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" placeholder="Meta Title" value="<?php if(isset($city_content))echo $city_content->title; else echo $course->title;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Meta Description </label>
							<div class="col-md-6">
								<textarea name="metaDesc" class="form-control" placeholder="Meta Description"><?php if(isset($city_content))echo $city_content->metaDesc; else echo $course->metaDesc;?></textarea>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">City SEO Content </label>
							<div class="col-md-6">
								<textarea name="SEOContent" class="form-control" placeholder="SEO Content"><?php if(isset($city_content))echo $city_content->SEOContent; else echo $course->SEOContent;?></textarea>
							</div>
						</div>
						<label>Trainer and venue details <span class="required">*</span></label>
						<hr class="mt-0"></hr>
						<div class="row mb-10">
							<label class="col-md-2">Trainer </label>
							<div class="col-md-4">
								<select class="form-control select2" name="trainerID" id="trainerID">
									<option value=""></option>
									<?php foreach($trainers as $t){  ?>
									<option value="<?php echo $t->userID;?>" <?php if(isset($city_content->trainerID))if($city_content->trainerID == $t->userID)echo 'selected';?>><?php echo $t->firstName.' '.$t->lastName;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Venue </label>
							<div class="col-md-4">
								<textarea class="form-control" placeholder="venue" id="venue" name="venue" rows="4" ><?php if(isset($city_content->venue))echo $city_content->venue;?></textarea>
							</div>
						</div>
						
						<label>Faq`s <span class="required">*</span></label>
						<hr class="mt-0 mb-20"></hr>
						<div id="faq_div">
							<input type="hidden" name="faq_count" id="faq_count" value="<?php echo count($faq);?>">
							<?php $i=1; foreach($faq as $f){ ?>
							<div class="row mb-10" id="question_<?php echo $i; ?>">
								<label class="col-md-2">Question <?php echo $i; ?> </label>
								<div class="col-md-9 mb-10">
									<input name="question_<?php echo $i; ?>" type="text" class="form-control" placeholder="Question <?php echo $i; ?>" value="<?php echo $f->question; ?>" />
								</div>
								<label class="col-md-2">Answer <?php echo $i; ?> </label>
								<div class="col-md-9">
									<textarea name="answer_<?php echo $i; ?>" class="form-control" placeholder="Answer <?php echo $i; ?>"><?php echo $f->answer; ?></textarea>
								</div>
							</div>
							<?php $i++; } ?>
						</div>
						<div class="row">
							<div class="col-md-3 pull-right">
								<button class="btn" id="add_faq"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
								<button class="btn btn-danger" id="remove_faq"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
							</div>
						</div>
						<label>Why us? <span class="required">*</span></label>
						<hr class="mt-0 mb-20"></hr>
						<div id="why_div">
							<input type="hidden" name="why_count" id="why_count" value="<?php echo count($why); ?>">
							<?php $i=1; foreach($why as $w){ ?>
							<div class="row mb-10" id="why_<?php echo $i; ?>">
								<label class="col-md-2">Description <?php echo $i; ?> </label>
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
						<hr></hr>
						<div class="col-md-7 text-center">
							<input type="hidden" name="status" id="status" value="SAVED">
							<button data-status="SAVED" class="btn hide" id="update_btn">Save</button>
							<button data-status="PUBLISHED" class="btn btn-success" id="publish_btn">Publish</button>
							<a href="<?php echo base_url('admin_course/city_content_courses');?>" class="btn btn-default">Cancel</a>
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
	});
	
	$("#add_faq").on('click',function(){
		var numItems = $('#faq_div .row').length;
		numItems= numItems+1;
		var html = '<div class="row mb-10" id="question_'+numItems+'">'+
					'<label class="col-md-2">Question '+numItems+' </label>'+
					'<div class="col-md-9 mb-10">'+
						'<input name="question_'+numItems+'" type="text" class="form-control" placeholder="Question '+numItems+'"/>'+
					'</div>'+
					'<label class="col-md-2">Answer '+numItems+' </label>'+
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
	$("#add_why").on('click',function(){
		var numItems = $('#why_div .row').length;
		numItems= numItems+1;
		var html = '<div class="row mb-10" id="why_'+numItems+'">'+
					'<label class="col-md-2">Description '+numItems+' </label>'+
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
	
	$("#update_btn,#publish_btn").on('click',function(){
		$("#status").val($(this).data("status"));
		//Validations
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		$("#course_form .form-control").each(function(){if($(this).val() == "" || $(this).val() == null){$(this).parent().append(text_error);error++;}});
		if(error == 0){
			$(this).html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$(".btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin_course/city_content_save');?>',
				type:'POST',
				data:$('#course_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location = '<?php echo base_url();?>admin_course/city_content_courses';
			});
		}
	});
	
	
	</script>
</body>
</html>
