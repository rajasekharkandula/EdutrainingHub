<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('project_name'); ?></title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/admin_style.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/images/favicon.png" rel="icon" />
</head>
<body>
	<!-- Header starts here -->
	<?php echo $header;?>
	<!-- Header ends here -->
	
	<!-- Body content starts here -->
	<div class="body-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="page-title">Dashboard</div>
					<hr class="mt-0"></hr>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 mb-30">
					<center>	
						<a href="<?php echo base_url('admin/users'); ?>">
						<div class="big-box">
							<center>
								<div class="big-box-header">
									Users
								</div>
							</center>
							<div class="col-md-6 col-sm-6 col-xs-6 mt-10 mb-10">
								<div class="request-count-box">
									<h5><?php if(isset($user['userCount']))echo $user['userCount']; else echo '0';?></h5>
									<p>Total Users</p>
								</div>
							</div>
							<?php if(isset($user['roles'])){foreach($user['roles'] as $r){ ?>
							<div class="col-md-6 col-sm-6 col-xs-6 mt-10 mb-10">
								<div class="request-count-box">
									<h5><?php echo $r['count'];?></h5>
									<p><?php echo $r['name'];?></p>
								</div>
							</div>
							<?php } } ?>
						</div>
						</a>
					</center>
				</div>
			</div>
			
		</div>
	</div>
	<!-- Body content ends here -->	
	
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>