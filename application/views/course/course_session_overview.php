<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Courses Show Page</title> 
    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'/>  
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'/>
    <!-- font-family: 'Monda', sans-serif;    font-family: 'Arvo', serif; --> 
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
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
          <li><a href="<?php echo base_url($category->categorySlug);?>"><?php echo $category->categoryName;?></a></li> 
          <li class="active"><?php echo $course->courseName;?></li>
        </ol>
    </div>
 </section>
<section class="content-show-main-wrap">
  <div class="content-show-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <h1 class="page-title"><?php echo $course->courseName;?></h1> 
          <div class="ratings">
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
                    <strong><?php echo $course->ratingCount;?> rating</strong>
                </span>
                <span><i class="fa fa-graduation-cap"></i> <strong><?php echo $course->usersEnrolled;?> Learner</strong></span>
            </div>
            <h2>Key Features</h2>
            <ul class="key-features col-md-12">
              <li><i class="fa fa-check"></i><?php echo $course->feature1;?></li>
              <li><i class="fa fa-check"></i><?php echo $course->feature2;?></li>
              <li><i class="fa fa-check"></i><?php echo $course->feature3;?></li>
              <li><i class="fa fa-check"></i><?php echo $course->feature4;?></li>
              <li><i class="fa fa-check"></i><?php echo $course->feature5;?></li>
            </ul>
        </div>
        <div class="col-md-3">
          <ul class="training-type open-sans">
            <li class="item-first"><a class="jumper" href="#calender">Classroom</a></li>
            <li class="item-second"><a class="jumper" href="#calender">Live Virtual</a></li>
            <li class="item-third"><a class="jumper" href="#calender">Online</a></li>
            <li class="item-fouth"><a href="javascript:void(0)" data-toggle="modal" data-target="#inhouse-training">Group/Private</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="content-main-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-9"> 
          <h3 id="calender">Classroom Training in <?php echo $city->cityName.', '.$city->countryName; ?> <a data-toggle="modal" data-target="#change-city" href="javascript:void(0)">(Change Location)</a></h3>
          <h4>Select a batch of your convenience</h4>
          <div class="check-box-wrap course_type">
            <span><label class="control control--checkbox">
              <input type="checkbox" value="classroom"/> <strong>Classroom Batches</strong>
              <div class="control__indicator"></div>
            </label></span>
            <span><label class="control control--checkbox">
              <input type="checkbox" value="virtual" /> <strong>Virtual Classroom Batches</strong>
              <div class="control__indicator"></div>
            </label></span>
            <span><label class="control control--checkbox">
              <input type="checkbox"/> <strong>Online Batches</strong>
              <div class="control__indicator"></div>
            </label></span>
          </div>
          <div class="calender open-sans">
            <div class="col-md-3"><strong><i class="fa fa-calendar"></i> Date</strong></div>
            <div class="col-md-3"><strong><i class="fa fa-clock-o"></i> Time</strong></div>
            <div class="col-md-2"><strong><i class="fa fa-th-list"></i> Course Type</strong></div>
            <div class="col-md-2"><strong><i class="fa fa-tags"></i> Price</strong></div>
            <div class="col-md-2"><strong><i class="fa fa-paypal"></i> Enroll</strong></div>
          </div>
			<?php foreach($sessions as $session){ ?>
			 <div class="calender-list open-sans <?php echo $session->courseType; ?>">
				<div class="col-md-3"><strong><?php echo date('M d',strtotime($session->startDate)); ?> - <?php echo date('M d',strtotime($session->endDate)); ?></strong> 
				
				<span class="no-of-days">( <?php echo $session->daysCount; ?> Days ) 
                <a href="#">Detail</a>
					<div class="no-of-days-wrap">
						<h5>Batch Schedule Date </h5>
						<?php foreach($session->days as $month => $day){ ?>
						<div class="pull-left">
						  <strong><?php echo $month; ?></strong>
						  <ul class="dates-days">
						  <?php foreach($day as $d){ ?>
							<li><span><?php echo $d['day']; ?></span><?php echo $d['date']; ?></li>
							<?php } ?>
						  </ul>
						</div>
						<?php } ?>
					</div>
				</span>
				</div>
				<div class="col-md-3"><?php echo date('h:i A',strtotime($session->startTime)); ?> - <?php echo date('h:i A',strtotime($session->endTime)); ?></div>
				<div class="col-md-2"><a href="#"><?php if($session->courseType == 'classroom')echo 'Classroom';else echo 'Virtual Classroom'; ?> </a></div>
				<div class="col-md-2">
				<?php if(strtotime(date('Y-m-d')) <= strtotime($session->offerDate)){ ?>
				<span class="line-through"><?php echo $session->currencyCode.' '.$session->amount; ?> </span>
				<span><strong><?php echo $session->currencyCode.' '.$session->offerAmount; ?></strong></span> valid till : <?php echo date('d M',strtotime($session->offerDate)); ?>
				<?php }else{ ?>
				<span><strong><?php echo $session->currencyCode.' '.$session->amount; ?></strong></span>
				<?php } ?>
				</div>
				<div class="col-md-2 capital enroll-now"><a href="#" class="enroll" data-id="<?php echo $session->sessionID; ?>"><strong>Enroll Now</strong></a></div>
			  </div>
			<?php } ?> 
			<?php if(count($sessions) == 0){ ?>
			<div style="margin: 10px 5px 0px;float: left;"> Can't find convenient schedule? Let Us Know</div>
			<?php } ?>
          <!-- Tab wrap start -->
          <div class="tab-wrap open-sans">
            <h4>Description</h4>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">Overview</a></li>
              <li role="presentation"><a href="#agenda" aria-controls="agenda" role="tab" data-toggle="tab">Agenda</a></li>
              <li role="presentation"><a href="#benefits" aria-controls="benefits" role="tab" data-toggle="tab">Benefits</a></li>
              <li role="presentation"><a href="#certification" aria-controls="certification" role="tab" data-toggle="tab">Certification</a></li>
              <li role="presentation"><a href="#attend" aria-controls="attend" role="tab" data-toggle="tab">Who Can Attend?</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content open-sans">
              <div role="tabpanel" class="tab-pane active" id="overview">
                <p><?php echo $course->description;?></p>
              </div>
              <div role="tabpanel" class="tab-pane" id="agenda">
				<?php echo $course->agenda;?>
			  </div>
              <div role="tabpanel" class="tab-pane" id="benefits">
                <?php echo $course->benfits;?>
              </div>
              <div role="tabpanel" class="tab-pane" id="certification">
				<?php echo $course->certifications;?>
			  </div>
              <div role="tabpanel" class="tab-pane" id="attend">
				<?php echo $course->whoCanAttend;?>
			  </div>
            </div>
          </div>
          <!-- Tab wrap END -->
          <div class="tab-wrap open-sans">
            <h4>Frequently Asked Questions</h4>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#classroom" aria-controls="classroom" role="tab" data-toggle="tab">General</a></li>
              <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online Classroom</a></li>
            </ul>
            <div class="tab-content open-sans">
              <div role="tabpanel" class="tab-pane active" id="classroom">
                  <?php $i=1;foreach($faqs as $faq){ ?>
				  <p><strong><?php echo $i; ?>. <?php echo $faq->question; ?></strong></p>
                  <p class="answer"><?php echo $faq->answer; ?></p>
                  <?php $i++; } ?>
				 
              </div>
              <div role="tabpanel" class="tab-pane" id="online">
                  
                  <p><strong>1. What prerequisites are expected for this course?</strong></p>
                  <p class="answer">The trainers at KnowledgeHut are highly qualified and certified instructors who have years of industry experience and passion for the subject they teach.</p>
                  <p><strong>2. Who will be my instructors?</strong></p>
                  <p class="answer">The trainers at KnowledgeHut are highly qualified and certified instructors who have years of industry experience and passion for the subject they teach.</p>
                  <p><strong>3. Who will be my instructors?</strong></p>
                  <p class="answer">The trainers at KnowledgeHut are highly qualified and certified instructors who have years of industry experience and passion for the subject they teach.</p>
                  <p><strong>4. Who will be my instructors?</strong></p>
                  <p class="answer">The trainers at KnowledgeHut are highly qualified and certified instructors who have years of industry experience and passion for the subject they teach.</p>
                  <p><strong>5. Who will be my instructors?</strong></p>
                  <p class="answer">The trainers at KnowledgeHut are highly qualified and certified instructors who have years of industry experience and passion for the subject they teach.</p>
                 
              </div>
            </div>
          </div>
          <div class="tab-wrap open-sans">
            <h4>Venu</h4>
            <p>Adaptskills Solutions Pvt. Ltd. NO 10, 14th Main Road, Sector 5, HSR Layout, Bangalore - 560102 India</p>
          </div>
          <div class="tab-wrap open-sans">
            <h4>Customer Reviews</h4>
            <div class="media">
              <a class="media-left pull-left">
                <img src="<?php echo base_url(); ?>assets/images/hilda-johnson.jpg" alt="falculty" class="img-review">
              </a>
              <div class="media-body">
                <div class="media-block clearfix">
                  <h5 class="media-heading pull-left">Shuchi Sablania </h5>
                </div>
                <p>"One stop for everything, all under the same roof!"</p>
              </div>
            </div>

            <div class="media">
              <a class="media-left pull-left">
                <img src="<?php echo base_url(); ?>assets/images/hilda-johnson.jpg" alt="falculty" class="img-review">
              </a>
              <div class="media-body">
                <div class="media-block clearfix">
                  <h5 class="media-heading pull-left">Shuchi Sablania </h5>
                </div>
                <p>"One stop for everything, all under the same roof!"</p>
              </div>
            </div>

            <div class="media">
              <a class="media-left pull-left">
                <img src="<?php echo base_url(); ?>assets/images/hilda-johnson.jpg" alt="falculty" class="img-review">
              </a>
              <div class="media-body">
                <div class="media-block clearfix">
                  <h5 class="media-heading pull-left">Shuchi Sablania </h5>
                </div>
                <p>"One stop for everything, all under the same roof!"</p>
              </div>
            </div>

            <div class="media">
              <a class="media-left pull-left">
                <img src="<?php echo base_url(); ?>assets/images/hilda-johnson.jpg" alt="falculty" class="img-review">
              </a>
              <div class="media-body">
                <div class="media-block clearfix">
                  <h5 class="media-heading pull-left">Shuchi Sablania </h5>
                </div>
                <p>"One stop for everything, all under the same roof!"</p>
              </div>
            </div>
            
          </div>



        </div>
        <div class="col-md-3">
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

              <div class="group-discount">
                <h5><i class="fa fa-group"></i><strong>Group Discount</strong></h5>
                  <ul>
                    <li><strong>5%</strong> for 3-4 people</li>
                      <li><strong>10%</strong> for 5-9 people</li>
                      <li><strong>15%</strong> for 10 and above people</li>
                  </ul>
              </div> 
			  
			  <?php if(count($availableCities)>0){ ?>
              <div class="other-cities">
                <h4>Find this training in other cities</h4> 
                    <ul>
                      <?php foreach($availableCities as $c){ ?>
                     	<li><a href="<?php echo base_url($category->categorySlug.'/'.$course->slug.'-'.$c->slug); ?>"><?php echo $c->cityName;?></a></li>
					 <?php } ?>
                    </ul>
                </div>
			  <?php } ?>
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
	$("#countryID").trigger('change');
});
$("#change_city").on("click",function(){
	window.location='<?php echo base_url($category->categorySlug.'/'.$course->slug);?>-'+$("#cityID").val();
});
$("#countryID").on("change",function(){
	var cityID = '<?php if(isset($city->cityID))echo $city->cityID;?>';
	$.ajax({
		url:'<?php echo base_url('home/getLocation');?>',
		type:'POST',
		data:{'type':'CITIES_BY_COUNTRY','countryID':$('#countryID').val()},
		dataType:'JSON'
	}).done(function(data){
		var html = '<option value=""></option>';
		for(i=0;i<data.length;i++){
			if(cityID == data[i]['cityID'])
				html += "<option value='"+data[i]['slug']+"' selected>"+data[i]['cityName']+"</option>";
			else
				html += "<option value='"+data[i]['slug']+"' >"+data[i]['cityName']+"</option>";
		}
		$('#cityID').html(html);
	});
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
$(".course_type input").on("change",function(){
	$(".calender-list").addClass("hide");
	var check = 0;
	$(".course_type input").each(function(){
		if($(this).is(":checked")){
			$("."+$(this).val()).removeClass("hide");
			check++;
		}
	});
	if(check == 0)$(".calender-list").removeClass("hide");
});

$(".enroll").on("click",function(e){
	e.preventDefault();
	var sessionID = $(this).data("id");
	$.ajax({
		url:'<?php echo base_url('cart/add_cart');?>',
		type:'POST',
		data:{'sessionID':sessionID},
		dataType:'JSON'
	}).done(function(data){
		if(data)window.location='<?php echo base_url('cart'); ?>';
	});
});

</script>
</body>
</html>