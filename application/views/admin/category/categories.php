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
		<div class="container">
			<div class="row mt-20">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="page-title pull-left">Categories</div>
					<a href="<?php echo base_url('admin/category');?>" class="btn pull-right"> Add </a>
				</div>
			</div>
			<hr class="mt-0"></hr>
			<div class="row">
				<div class="col-md-12 mb-30">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Category Name</th>
								<th>Descriprion</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($categories as $c){ ?>
							<tr>
								<td width="200px"><?php echo $c->categoryName; ?></td>
								<td><?php echo $c->description; ?></td>
								<td width="150px"><?php if($c->status=='P')echo 'Active';else echo 'In Active'; ?></td>
								<td width="100px"><a href="<?php echo base_url();?>admin/category/<?php echo $c->categoryID; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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
</body>
</html>