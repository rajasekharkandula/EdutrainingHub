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
			
			<form id="category_form" method="POST" action="#" onSubmit="return false;">
				<h3>Category Information</h3>
				<div class="panel">
					<div class="panel-heading"> 
						<span class="panel-title"> <i class="fa fa-pencil"></i> Create Category </span> 
						<label>Fields marked with (<span class="required">*</span>) are mandatory</label>
					</div>
					<div class="panel-body">
						<input type="hidden" id="categoryID" name="categoryID" value="<?php echo $categoryID;?>">
						<input type="hidden" id="type" name="type" value="<?php if($categoryID !="")echo 'UPDATE';else echo 'INSERT';?>">
						<div class="row mb-10">
							<label class="col-md-2">Category Name <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="categoryName" placeholder="Category Name" value="<?php if(isset($category->categoryName))echo $category->categoryName;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Category Slug <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="categorySlug" placeholder="Category Slug" value="<?php if(isset($category->categorySlug))echo $category->categorySlug;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Description <span class="required">*</span> </label>
							<div class="col-md-5">
								<textarea class="form-control" id="desc" name="desc" placeholder="Description"><?php if(isset($category->description))echo $category->description;?></textarea>
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Category Order <span class="required">*</span> </label>
							<div class="col-md-5">
								<input type="number" class="form-control" name="categoryOrder" placeholder="Category Order" value="<?php if(isset($category->categoryOrder))echo $category->categoryOrder;?>" />
							</div>
						</div>
						<div class="row mb-10">
							<label class="col-md-2">Status <span class="required">*</span></label>
							<div class="col-md-5">
								<select class="form-control select2" name="status" id="status">
									<option value=""></option>
									<option value="P" <?php if(isset($category->status))if($category->status == "P")echo 'selected';?>>Active</option>
									<option value="S" <?php if(isset($category->status))if($category->status == "S")echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
						<hr class="mt-0"></hr>
						<div class="col-md-7 text-center">
							<button class="btn" id="update_btn">Save</button>
							<a href="<?php echo base_url('admin/categories');?>" class="btn btn-default">Cancel</a>
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
		$("#category_form .form-control").each(function(){if($(this).val() == ""){$(this).parent().append(text_error);error++;}});
	if(error == 0){
			$("#update_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#update_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/category_save');?>',
				type:'POST',
				data:$('#category_form').serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location='<?php echo base_url('admin/categories');?>';
			});
		}
	});
	</script>
</body>
</html>
