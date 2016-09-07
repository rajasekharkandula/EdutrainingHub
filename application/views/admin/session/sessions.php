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
					<div class="page-title pull-left"><button class="prev-btn hide"><i class="fa fa-arrow-left" aria-hidden="true"></i></button><?php echo ucfirst($courseType); ?> Sessions</div>
					
				</div>
			</div>
			<hr class="mt-0"></hr>
			<div class="panel">
				<div class="panel-heading"> 
					<span class="panel-title"> <i class="fa fa-list-alt"></i> List of <?php echo $course->courseName; ?> in  <i class="fa fa-map-marker" style="margin: 0px; min-width: 0px; border-right: none;"></i> <?php echo $city->cityName;?> <a href="#" class="city_popup" data-id="<?php echo $courseID;?>"> (change)</u></a></span> 
					<a href="<?php echo base_url('admin_course/session/'.$courseType.'/'.$courseID.'/'.$cityID);?>" class="btn btn-medium pull-right mt-5 mr-5"> <i class="fa fa-plus" aria-hidden="true"></i> Create </a>
				</div>
				<div class="panel-body">
					<div class="tab-block">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#upcoming" data-toggle="tab"> Upcoming</a></li>
						  <li><a href="#ongoing" data-toggle="tab"> On-Going</a></li>
						  <li><a href="#history" data-toggle="tab"> History</a></li>
						</ul>
						<div class="tab-content">
							<div id="upcoming" class="tab-pane active">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Session Name</th>
											<th>Start Date</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($sessions as $s){ 
										if(strtotime($s->startDate) > strtotime(date('Y-m-d H:i:s'))){
										?>
										<tr>
											<td><?php echo $s->name; ?></td>
											<td><?php echo date('d M y h:i A',strtotime($s->startDate)); ?></td>
											<td><?php echo $s->status; ?></td>
											<td><a href="<?php echo base_url('admin_course/session/'.$courseType.'/'.$courseID.'/'.$cityID.'/'.$s->sessionID);?>" class="btn btn-small"> <i class="fa fa-eye"></i> View </a></td>
										</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
							<div id="ongoing" class="tab-pane">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Session Name</th>
											<th>Start Date</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($sessions as $s){ 
										if(strtotime($s->startDate) < strtotime(date('Y-m-d H:i:s')) && strtotime($s->endDate) > strtotime(date('Y-m-d H:i:s'))){
										?>
										<tr>
											<td><?php echo $s->name; ?></td>
											<td><?php echo date('d M y h:i A',strtotime($s->startDate)); ?></td>
											<td><?php echo $s->status; ?></td>
											<td><a href="<?php echo base_url('admin_course/session/'.$courseType.'/'.$courseID.'/'.$cityID.'/'.$s->sessionID);?>" class="btn btn-small"> <i class="fa fa-eye"></i> View </a></td>
										</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
							<div id="history" class="tab-pane">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Session Name</th>
											<th>Start Date</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($sessions as $s){ 
										if(strtotime($s->endDate) < strtotime(date('Y-m-d H:i:s'))){
										?>
										<tr>
											<td><?php echo $s->name; ?></td>
											<td><?php echo date('d M y h:i A',strtotime($s->startDate)); ?></td>
											<td><?php echo $s->status; ?></td>
											<td><a href="#" class="btn btn-small"> <i class="fa fa-eye"></i> Track </a></td>
										</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body content ends here -->	
	
	<!-- Modal Start -->
	<div id="city_list" class="modal fade" role="dialog">
	  <div class="modal-dialog c-modal">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<select class="select2" style="width:100%;" id="city">
					<option value=""></option>
					<?php foreach($cities as $c){ ?>
					<option value="<?php echo $c->cityID; ?>"><?php echo $c->cityName; ?></option>
					<?php } ?>
				</select>
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
		$('.table').dataTable( {
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
			"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
			"iDisplayLength": 10,
			"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"sDom": 'T<"panel-menu dt-panelmenu"lfr><"clearfix">tip'
		});	
		// Add Placeholder text to datatables filter bar
		$('.dataTables_filter input').attr("placeholder", "Search Here....");
		$('.select2').select2({placeholder: "Select city"});
	});
	$(".city_popup").on("click",function(){
		$("#city").data("id",$(this).data("id"));
		$("#city_list").modal('show');
	});
	$("#city").on("change",function(){
		window.location = '<?php echo base_url('admin_course/sessions/'.$courseType);?>/'+$("#city").data("id")+'/'+$("#city").val();
	});
</script>
</body>
</html>