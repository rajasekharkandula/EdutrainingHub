<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('project_name');?></title>
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
			<h4 class="text-center <?php if($this->session->flashdata('registerStatus'))echo 'text-success';else echo 'text-danger';?>"><?php echo $this->session->flashdata('registerMessage');?></h4>
			<div class="login mt-65">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<h3 class="text-center">Admin Login</h3>
						<form class="form-horizontal" method="post" action="#" onsubmit="return false;" role="login" id="login_form">
							<div>
								<div class="input-group mt-10">
									<div class="input-group-addon no-radius"><i class="fa fa-user"></i></div>
									<input type="text" class="form-control no-radius" id="user_name" name="username" placeholder="Email">
								</div>
							</div>
							<div>
								<div class="input-group mt-10">
									<div class="input-group-addon no-radius"><i class="fa fa-key"></i></div>
									<input type="password" class="form-control no-radius" name="password" id="userpassword" placeholder="Password">
								</div>
							</div>
							<button class="btn no-radius mt-10" style="width:100%;" id="login_btn">Login</button>
						</form>
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	
	<!-- Footer start -->
	<?php //echo $footer; ?>
	<!-- Footer end -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function checkemail(email){
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
			return 1;
		}
		return 0;
	}
   $("#login_btn").on('click',function(){
		$(".login .text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		if($('#user_name').val() == ""){$('#user_name').parent().parent().append(text_error);error++;}
		if($('#userpassword').val() == ""){$('#userpassword').parent().parent().append(text_error);error++;}
		if(error == 0){
			$("#login_btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#login_btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('admin/login_check');?>',
				type:'POST',
				data:{'username':$('#user_name').val(),'password':$('#userpassword').val()},
				dataType:'JSON'
			}).success(function(data){
				$(".login .text-danger").remove();
				if(data.status){
					window.location.reload();
				}				
				else{
					$("#login_form").prepend('<div class="text-danger mt-10">Invalid username or password </div>');
					$("#login_btn").html('Login');
					$("#login_btn").attr('disabled',false);
				}
			});
		}
	});
	
</script>
	
</body>
</html>