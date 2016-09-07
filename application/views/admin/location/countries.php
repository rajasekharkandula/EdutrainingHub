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
					<div class="page-title pull-left"><button class="prev-btn hide"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>Countries</div>
					<a href="<?php echo base_url('admin/country');?>" class="btn pull-right"><i class="fa fa-plus"></i> Add</a>
				</div>
			</div>
			<hr class="mt-0"></hr>
			<div class="panel">
				<div class="panel-body">
					<table class="table table-striped table-bordered" id="datatable">
						<thead>
							<tr>
								<th>Country Name</th>
								<th>Country Code</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($countries as $c){ ?>
							<tr>
								<td><?php echo $c->countryName; ?></td>
								<td><?php echo $c->countryCode; ?></td>
								<td><a href="<?php echo base_url('admin/country/'.$c->countryID);?>" class="btn btn-small"> <i class="fa fa-pencil"></i> Edit </a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>
	<!-- Body content ends here -->	
	
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
		$('.select2').select2({placeholder: "Select city"});
	});
</script>
</body>
</html>