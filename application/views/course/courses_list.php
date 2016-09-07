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
          <li class="active">Courses</li>
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
							</div>
							<?php foreach($categories as $category){ ?>
							<div class="col-md-12 filter-wrap">
                                <h1><?php echo $category->categoryName; ?></h1>
                                <p><?php echo $category->description; ?></p>
                             </div>
                            <!-- Courses list start -->
                            <ul class="main-courses-list">
                                <?php foreach($courses as $course){ 
								if($course->categoryID == $category->categoryID){ 
								?>
								<li class="col-md-4">
                                    <div class="main-courses-wrap">
										<div class="course-img-wrap">
											<a href="<?php echo base_url($category->categorySlug.'/'.$course->slug); ?>" class="course-img-det">
												<img src="<?php echo base_url($course->image); ?>" alt="<?php echo $course->courseName; ?>">
											</a>
											<div class="download-brow"> 
												<a href="<?php echo base_url($course->brochure); ?>" target="_blank"><i class="fa fa-download"></i> <span>Download</span></a>
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
                                <?php } } ?>
                            </ul>
							<?php } ?>
                            <!-- Courses list end --> 
                        </div>
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