<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('project_name'); ?></title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/admin_style.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/datatables/css/datatables.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/select2.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/images/favicon.png" rel="icon" />
	<style>

	</style>
</head>
<body>
	<!-- Header starts here -->
	<?php echo $header;?>
	<!-- Header ends here -->
	
	<!-- Body content starts here -->
	<div class="body-container">
		<div class="container">
			<div class="row mt-20">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="page-title pull-left"><button class="prev-btn hide"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>Course content for cities</div>
					<button class="btn pull-right" id="view"><i class="fa fa-plus"></i> Add</button>
				</div>
			</div>
			<hr class="mt-0"></hr>
			<div class="panel">
				<div class="panel-body">
					<table class="table table-striped table-bordered" id="datatable">
						<thead>
							<tr>
								<th>Course Name</th>
								<th>Category Name</th>
								<th>City</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($courses as $c){ ?>
							<tr>
								<td><?php echo $c->courseName; ?></td>
								<td><?php echo $c->categoryName; ?></td>
								<td><?php echo $c->cityName; ?></td>
								<td><a href="<?php echo base_url('admin_course/city_content_course/'.$c->courseID.'/'.$c->cityID);?>" class="btn btn-small"> <i class="fa fa-pencil"></i> Edit </a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>
	<!-- Body content ends here -->	
	
	<!-- Modal Start -->
	<div id="modal" class="modal fade" role="dialog">
	  <div class="modal-dialog c-modal">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<div>
					<label>Select course </label>
					<select class="select2" style="width:100%;" id="course">
						<option value=""></option>
						<?php foreach($courses as $course){ ?>
						<option value="<?php echo $course->courseID; ?>"><?php echo $course->courseName; ?></option>
						<?php } ?>
					</select>
				</div>
				<div>
					<label>Select city </label>
					<select class="select2" style="width:100%;" id="city">
						<option value=""></option>
						<?php foreach($cities as $c){ ?>
						<option value="<?php echo $c->cityID; ?>"><?php echo $c->cityName; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="modal-footer" style="text-align:center;">
				<button class="btn" id="update_btn"> Update </button>
				<button class="btn btn-default" data-dismiss="modal"> Cancel </button>
			</div>
		</div>

	  </div>
	</div>
	<!-- Modal Ends -->
	
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/js/datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').dataTable( {
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
			"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
			"iDisplayLength": 10,
			"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"sDom": 'T<"panel-menu dt-panelmenu"lfr><"clearfix">tip'
		});	
		// Add Placeholder text to datatables filter bar
		$('.dataTables_filter input').attr("placeholder", "Search Here....");
		$('#course').select2({placeholder: "Select course"});
		$('#city').select2({placeholder: "Select city"});
	$("#view").on("click",function(){
		$(".text-danger").remove();
		$("#modal").modal('show');
	});
	$("#update_btn").on("click",function(){
		$(".text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>';
		if($("#course").val() != "" && $("#city").val()){
			window.location = '<?php echo base_url('admin_course/city_content_course/');?>/'+$("#course").val()+'/'+$("#city").val();
		}else{
			if($("#course").val() == "")$("#course").parent().append(text_error);
			if($("#city").val() == "")$("#city").parent().append(text_error);
		}
	});
	});
	
</script>
</body>
</html>