<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="header hidden-xs" >
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-3">
				<a class="logo" href="<?php echo base_url('admin');?>"><!--img src="/images/logo.png" class="img-responsive logo-img hidden-xs" alt="LOGO" -->Adapt Skills</a>
			</div>
			<?php if($this->session->userdata('login') == true){ ?>
			<div class="col-md-9 col-sm-9 col-xs-9">				
				<div class="header-top">
					<ul>
						<li><a href="#">Welcome: <?php echo $this->session->userdata('name');?></a></li>
						<li><a href="#"><?php echo $this->session->userdata('roleName'); ?></a></li>
						<li class="border-none-r"><a href="<?php echo base_url('admin/logout');?>">Sign Out</a></li>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php if($this->session->userdata('login') == true){ ?>
<nav class="navbar navbar-static-top">
	<div class="navbar-header visible-xs">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="navbar" class="navbar-collapse collapse bg-lightblue">
		<div class="container">
			<?php if(!isset($currentPage))$currentPage="";?>
			<ul class="nav navbar-nav">
				<li <?php if($currentPage == 'DASHBOARD')echo 'class="active"';?>><a href="<?php echo base_url('admin');?>" class="">Dashboard</a></li>
				<li class="dropdown <?php if($currentPage == 'USERS')echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Ussers <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href ="<?php echo base_url('admin/users');?>">Users</a></li>
						<li><a href ="<?php echo base_url('admin/roles');?>">Roles</a></li>
					</ul>
				</li>
				<li class="dropdown <?php if($currentPage == 'COURSE')echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href ="<?php echo base_url('admin/categories');?>">Categories</a></li>
						<li><a href ="<?php echo base_url('admin/courses');?>">Courses</a></li>
						<li><a href ="<?php echo base_url('admin_course/city_content_courses');?>">City Content</a></li>
						<li><a href ="<?php echo base_url('admin/testimonials');?>">Testimonials</a></li>
					</ul>
				</li>
				<li class="dropdown <?php if($currentPage == 'SESSION')echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sessions <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href ="<?php echo base_url('admin_course/courses/classroom');?>">Classroom</a></li>
						<li><a href ="<?php echo base_url('admin_course/courses/virtual');?>">Virtual</a></li>
						<li><a href ="<?php echo base_url('admin_course/online_courses');?>">E-learning</a></li>
					</ul>
				</li>
				<li class="dropdown <?php if($currentPage == 'LOCATION')echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Location <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href ="<?php echo base_url('admin/countries');?>">Country</a></li>
						<li><a href ="<?php echo base_url('admin/states');?>">State</a></li>
						<li><a href ="<?php echo base_url('admin/cities');?>">City</a></li>
						<li><a href ="<?php echo base_url('admin/currencies');?>">Currency</a></li>
					</ul>
				</li>
				<li class="dropdown <?php if($currentPage == 'DISCOUNT')echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Discount <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href ="<?php echo base_url('admin/group_discounts');?>">Group Discount</a></li>
						<li><a href ="<?php echo base_url('admin/special_discounts');?>">Special Discount</a></li>
					</ul>
				</li>
			</ul> 
		</div>
	</div>
</nav>
<?php } ?>