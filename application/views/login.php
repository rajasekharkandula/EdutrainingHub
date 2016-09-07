<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Home page</title> 
    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'/>  
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    
</head>
<body>
 
 <?php echo $header; ?>
 
 <section class="login-wrap"> 
    <div class="container">

      <!-- Form Module-->
      <div class="login-form-wrap col-md-8 col-md-offset-2">
        <div class="row">
          <h1 class="text-center login-title">Login / Register</h1>
          <div class="module form-module">
            <div class="toggle"><i class="fa fa-times fa-pencil"></i>
              <div class="tooltip">Click Me</div>
            </div>
            <div class="form logins-form login">
              <h2>Login to your account</h2>
              <form id="login-form">
                <input id="l-email" type="text" placeholder="Username"/>
                <input id="l-password" type="password" placeholder="Password"/>
                <button type="button" id="login-btn">Login</button>
              </form>
            </div>
            <div class="form register newuser-wr">
              <h2>Create an account</h2>
              <form id="reg-form">
                <input name="name" type="text" placeholder="Username"/>
                <input id="email" name="email" type="email" placeholder="Email Address"/>
                <input name="password" type="password" placeholder="Password"/>
                <input name="phone" type="tel" placeholder="Phone Number"/>
                <select name="countryID" id="countryID">
                  <option value="">Select Country</option>
				  <?php foreach($countries as $country){ ?>
                  <option value="<?php echo $country->countryID; ?>"><?php echo $country->countryName; ?></option>
				  <?php } ?>
               </select>
               <select name="cityID" id="cityID">
                  <option value="">Select City</option>
               </select>
               <select name="courseID">
                  <option value="">Select Course</option>
                  <?php foreach($courses as $course){ ?>
                  <option value="<?php echo $course->courseID; ?>"><?php echo $course->courseName; ?></option>
				  <?php } ?>
               </select>
                <button type="button" id="reg-btn">Register</button>
              </form>
            </div>
            
            <div class="cta"><a data-toggle="modal" data-target="#forgot-pass" href="javascript:void(0)" class="forgotpass">Forgot your password?</a></div>
			 <div class="cta"><a href="javascript:void(0);" class="newuser">Register</a></div>
            <div class="cta"><a href="javascript:void(0);" class="sign-in">Sign/In</a></div>
          </div>
          <div class="login-or">
            <span>OR</span>
          </div>
          <div class="login-social">
            <h2>Login with Social media</h2>
            <ul>
              <li class="facebook"><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
              <li class="googleplus"><a href="#"><i class="fa fa-google-plus"></i> Google Plus</a></li>
              <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i> Linked In</a></li>
            </ul>
          </div>
        </div>
      </div>
	  
      </div>
    </div>
 </section>

<?php echo $footer; ?>

<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script type="text/javascript">
	$("#reg-btn").on('click',function(){
		$(".register .text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		
		$("input,select","#reg-form").each(function(){
			if($(this).val() == ""){$(text_error).insertAfter(this);error++;}
		});
				
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test($("#email").val()) && $("#email").val() != ""){ $('<span class="text-danger"> Please enter valid mail </span>').insertAfter("#email");error++;}
		
		if(error == 0){
			$("#reg-btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#reg-btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('home/register');?>',
				type:'POST',
				data:$("#reg-form").serialize(),
				dataType:'JSON'
			}).success(function(data){
				$(".register .text-danger").remove();
				if(data.status){
					window.location=data.redirectURL;
				}				
				else if(data == 'EXIST'){
					$('<span class="text-danger"> This email is already registered with us </span>').insertAfter("#email");
				}
				$("#reg-btn").html('Register');
				$("#reg-btn").attr('disabled',false);
			});
		}
	});
	$("#login-btn").on('click',function(){
		$(".login .text-danger").remove();
		var text_error = '<span class="text-danger"> This field is required </span>',error=0;
		if($('#l-email').val() == ""){$(text_error).insertAfter("#l-email");error++;}
		if($('#l-password').val() == ""){$(text_error).insertAfter("#l-password");error++;}
		if(error == 0){
			$("#login-btn").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#login-btn").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('home/login_check');?>',
				type:'POST',
				data:{'email':$('#l-email').val(),'password':$('#l-password').val()},
				dataType:'JSON'
			}).success(function(data){
				$(".login .text-danger").remove();
				if(data.status){
					window.location=data.redirectURL;
				}				
				else{
					$("#login-form").prepend('<div class="text-danger mt-10">Invalid username or password </div>');
					$("#login-btn").html('Login');
					$("#login-btn").attr('disabled',false);
				}
			});
		}
	});
	$("#countryID").on("change",function(){
		$.ajax({
			url:'<?php echo base_url('home/getLocation');?>',
			type:'POST',
			data:{'type':'CITIES_BY_COUNTRY','countryID':$('#countryID').val()},
			dataType:'JSON'
		}).done(function(data){
			var html = '<option value="">Select City</option>';
			for(i=0;i<data.length;i++){
				html += "<option value='"+data[i]['slug']+"' >"+data[i]['cityName']+"</option>";
			}
			$('#cityID').html(html);
		});
	});
</script>
</body>
</html>