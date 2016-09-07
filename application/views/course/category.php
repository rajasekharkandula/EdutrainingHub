<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Courses page</title> 
    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'/>  
    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'/>
    <!-- font-family: 'Monda', sans-serif;    font-family: 'Arvo', serif; --> 
    <!-- Css -->
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
 
 <!-- Header -->
 <?php echo $header; ?>
 <!-- Breadcrums -->
 
 <section class="breadcrumb-wrap">
 	<div class="container">
    	<ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>" class="first-child"><i class="icon-arrow-left"></i> Back to home</a></li> 
          <li class="active"><?php echo $category->categoryName; ?></li>
        </ol>
    </div>
 </section>
<section class="content-wrap">
	<div class="container">
    	<div class="container-wrap">
        	<div class="row">
                <div class="col-md-3">
                    <div class="left-content">
                        <div class="course-cat">
                            <h4>Courses Categories</h4>
                            <ul class="courses-list">
                               <?php foreach($categories as $category){ ?> 
								<li><a href="<?php echo base_url($category->categorySlug);?>"><i class="icon-chevron-right"></i> <?php echo $category->categoryName; ?> <span><?php echo $category->courseCount; ?> </span></a></li>
							   <?php } ?>
                            </ul>
                         </div>
                         <div class="inhouse-training" data-toggle="modal" data-target="#inhouse-training"> 
                          <i class="fa fa-group"></i>
                          <strong>Group (or) Inhouse Training
                            <span>Get Court Now</span></strong>
                        </div>
                        <div class="drop-query">
                <h4>Drop a Query</h4>
                  <form id="query_form">
                        <div class="form-group">
                          <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group phone">
                          <select class="form-control pull-left">
                            <?php foreach($countries as $country){ ?>
							<option value="<?php echo $country->countryName; ?>" <?php if($city->countryID == $country->countryID)echo 'selected'; ?>><?php echo $country->countryCode.' - '.$country->countryName; ?></option>
							<?php } ?>
                          </select>
                          <input type="text" class="form-control pull-right" id="phone" name="phone" placeholder="+91" />
                        </div>
                        <div class="form-group">
                          <select class="form-control">
                            <option value="">Select Course</option> 
							<?php foreach($courses as $crse){ ?>
                            <option value="<?php echo $crse->courseName; ?>"><?php echo $crse->courseName; ?></option>
							<?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" rows="2"></textarea> 
                        </div>
                        <div class="form-group">
                          <label class="control-text">Looking for training for</label>
                          <label class="control control--radio">My Self
                            <input type="radio" name="radio" checked="checked"/>
                            <div class="control__indicator"></div>
                          </label>
                          <label class="control control--radio">Second radio
                            <input type="radio" name="radio"/>
                            <div class="control__indicator"></div>
                          </label>
                          <label class="control control--checkbox">I agree to be contacted over email
                            <input type="checkbox"/>
                            <div class="control__indicator"></div>
                          </label>
                        </div>
                        <input type="button" class="btn btn-primary" value="Submit" id="query_btn"/>  
                  </form>
                </div>
                    </div>
                </div> 
                <div class="col-md-9">
                	<div class="row">
                        <div class="right-content">
                        	<div class="col-md-12 filter-wrap">
								<div class="search-filter-wrap">
									<input name="search" class="form-control" type="search" placeholder="Type the course name here.." autocomplete="off">
									<i class="fa fa-search input-icon"></i>
								</div>
                                <h1><?php echo $category->categoryName; ?></h1>
                                <p><?php echo $category->description; ?></p>
                             </div>
                            <!-- Courses list start -->
                            <ul class="main-courses-list">
                                <?php foreach($courses as $course){ ?>
								<li class="col-md-4">
                                    <div class="main-courses-wrap">
										<div class="course-img-wrap">
											<a href="<?php echo base_url($category->categorySlug.'/'.$course->slug); ?>" class="course-img-det">
												<img src="<?php echo base_url($course->image); ?>" alt="<?php echo $course->courseName; ?>">
											</a>
											<div class="download-brow"> 
												<a href="#"><i class="fa fa-download"></i> <span>Download</span></a>
												<a href="#"><i class="fa fa-heart-o"></i> <span>Favourite</span></a>
											</div> 
										</div>
									
									
									
                                        <a href="<?php echo base_url($category->categorySlug.'/'.$course->slug); ?>" class="course-img">
                                           <span><?php echo $course->courseName; ?></span>
                                        </a>
                                        <div class="know-more">
                                            <span>
												<?php 
												if($course->rating > 0 && $course->rating < 5)
													$rating = $course->rating;
												else
													$rating = 4;
												$r = 5-$rating; ?>
												<?php for($i=1;$i<=$rating;$i++){ ?>
												<i class="fa fa-star"></i>
												<?php } ?>
												<?php for($i=1; $i<=$r; $i++){ ?>
												<i class="fa fa-star" style="color:#9E9E9E;"></i>
												<?php } ?>
                                            </span>
                                        </div>
										<div class="course-date">
                                          <a href="<?php echo base_url($category->categorySlug.'/'.$course->slug); ?>" class="know-m">View Details</a> 
										</div>
                                      </div>
                                </li>
                                <?php } ?>
                                
                            </ul>
                            <!-- Courses list end --> 
                        </div>
                      </div> 
                </div>
             </div>
         </div>
    </div>
</section>

<footer class="footer">
  <div class="container">
      <div class="row">
            <div class="col-md-3">
              <h6>Company</h6>
                <ul class="nav">
                  <li><a href="#">About Us</a></li>
          <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
          <li><a href="#">In the media</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Help &amp; Support</a></li> 
                </ul>
            </div>
            <div class="col-md-3">
              <h6>Work With US</h6>
                <ul class="nav">
                  <li><a href="#">Become an instructor</a></li>
          <li><a href="#">Become an affiliate</a></li>
          <li><a href="#">Blog as guest</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Contact No.</h6>        
                <p>UK: +44-22-2222-2222</p>
                <p>US: +1-222-222-2222</p>
                <p>AUS: +61-222-222-22 </p>
                <p>CAN: +1-222-222-2222 </p>
                <p>IND: +91-22-22222222 / 3 </p>
            </div> 
            <div class="col-md-3">
              <h6>Social Links</h6>         
                <ul class="nav social">
                  <li><a href="#"><i class="icon-facebook"></i> Facebook</a></li>
          <li><a href="#"><i class="icon-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="icon-google-plus"></i> Google Plus</a></li>
          <li><a href="#"><i class="icon-youtube"></i> Youtube</a></li>
          <li><a href="#"><i class="icon-linkedin"></i> Linkedin</a></li>
                </ul>
                <div class="form-subscribe">
          <form action="" method="post" class="subscribe">
            <input class="form-control" type="email" placeholder="Enter your email ID" name="email">
            <button class="subscribe-submit" type="submit">Submit</button> 
          </form>
        </div>
            </div>
            <div class="col-md-12">
                <div class="disclamer">
                    <p>"CSM" "CSPO" "CSD" are registered trademark of Scrum Alliance | "PMI®", "PMBOK®" "PMP®" and "PMI-ACP®" "PMI-PBA®" "PMI-RMP®" are registered marks of the Project Management Institute, Inc. | COBIT® is a Registered Trade Mark of the Information Systems Audit and Control Association (ISACA) and the IT Governance Institute</p>

          <p>ITIL®/PRINCE2®/PRINCE2 Agile® is a trade mark of AXELOS Limited, used under permission of AXELOS Limited. All rights reserved.</p>
                </div>
             </div>
         </div>
    </div>
</footer>
<div class="subfooter">
    <div class="container">
        <div class="row">
           <div class="col-md-12"> 
              <div class="pull-left copy-right">&copy; 2016 Adaptskills. All Rights Reserved</div>
                <div class="pull-right">
                  <a href="#" class="help-supp"><i class="fa fa-support"></i> Help and Support</a>
                    <a href="javascript:void(0)" class="callback" data-toggle="modal" data-target="#Request-call-back"><i class="fa fa-phone"></i> Request a callback</a>
                </div>
             </div>
        </div>
     </div>
</div>


<!-- Inhouse Training Start-->
<div class="modal fade" id="inhouse-training" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Inhouse Training</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="inhouse_form">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Name<sup>*</sup></label>
            <div class="col-sm-9">
              <input type="text" class="form-control"  placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Email<sup>*</sup></label>
            <div class="col-sm-9">
              <input type="Email" class="form-control"  placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Phone<sup>*</sup></label>
            <div class="col-sm-9 inhouse-phone">
              <select class="form-control pull-left">
				<?php foreach($countries as $country){ ?>
				<option value="<?php echo $country->countryName; ?>" <?php if($city->countryID == $country->countryID)echo 'selected'; ?>><?php echo $country->countryCode.' - '.$country->countryName; ?></option>
				<?php } ?>
			  </select>
                <input type="text" class="form-control pull-right" name="phone" placeholder="+91" />
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Select Course<sup>*</sup></label>
            <div class="col-sm-9">
             <select class="form-control">
				<option value="">Select Course</option> 
				<?php foreach($courses as $crse){ ?>
				<option value="<?php echo $crse->courseName; ?>"><?php echo $crse->courseName; ?></option>
				<?php } ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Company Name<sup>*</sup></label>
            <div class="col-sm-9">
              <input type="text" class="form-control"  placeholder="Company Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Looking for<sup>*</sup></label>
            <div class="col-sm-9">
              <select class="form-control">
                <option selected disabled hidden>Looking for</option>
                  <option>Online license training</option>
                  <option>Onsite training</option>
                  <option>Online virtual training</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Your Query</label>
            <div class="col-sm-9">
              <textarea class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-9">
              <label class="control control--radio">I agree to be contacted over mail
                <input type="radio" name="radio" />
                <div class="control__indicator"></div>
              </label>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="inhouse_btn">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Inhouse Training End-->


<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script>
$(document).ready(function() {
	
});

$("#query_btn").on("click",function(){
	$(".text-danger").remove();
	var text_error = '<span class="text-danger"> This field is required </span>',error=0;
	$("#query_form .form-control").each(function(){if($(this).val() == "" && $(this).data('req') != false){$(this).parent().append(text_error);error++;}});
	if(!checkemail($("#email").val()) && $("#email").val() != ""){$("#email").parent().append('<span class="text-danger"> Invalid email </span>');error++;}
});
$("#inhouse_btn").on("click",function(){
	$(".text-danger").remove();
	var text_error = '<span class="text-danger"> This field is required </span>',error=0;
	$("#inhouse_form .form-control").each(function(){if($(this).val() == "" && $(this).data('req') != false){$(this).parent().append(text_error);error++;}});
	if(!checkemail($("#email").val()) && $("#email").val() != ""){$("#email").parent().append('<span class="text-danger"> Invalid email </span>');error++;}
});
</script>
</body>
</html>