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
					<div class="page-title pull-left"><button class="prev-btn hide"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>Courses</div>
					<a href="<?php echo base_url('admin/course/info');?>" class="btn pull-right"> Add </a>
				</div>
			</div>
			<hr class="mt-0"></hr>
			<div class="row">
				<div class="col-md-12 mb-30">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Course Name</th>
								<th>Category Name</th>
								<th>Status</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($courses as $c){ ?>
							<tr>
								<td><?php echo $c->courseName; ?></td>
								<td><?php echo $c->categoryName; ?></td>
								<?php $stat = 'Saved';
								foreach($status as $s){
									if($s->courseID == $c->courseID){
										if($s->status == 'DISABLED')
											$stat = 'Disabled';
										else if($s->status == 'PUBLISHED')
											$stat = 'Published';
									}
								}
								?>
								<td><?php echo $stat; ?></td>
								<td><a href="<?php echo base_url();?>admin/course/info/<?php echo $c->courseID; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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