<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Home</title> 
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
 
 <div class="banner-wrap">
    <div class="container">
      <div class="search-wrap text-center">
        <h1><span>World's leading</span>certification training provider</h1>
        <form class="search-from">
          <div class="form-group search">
            <input type="text" class="form-control"  placeholder="search course here">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>
        </form>
        <p class="course-catg">
          <a href="#">PMP<sup>&reg;</sup>  certification</a>
          <a href="#">Scrum master</a>
          <a href="#">PRINCE2<sup>&reg;</sup></a>
          <a href="#">Digital marketing</a>
          <a href="#">Big data </a>
          <a href="#">Android</a>
        </p>
        <p class="course-catg">
          <a href="#">PMP<sup>&reg;</sup>  certification</a>
          <a href="#">Scrum master</a>
          <a href="#">PRINCE2<sup>&reg;</sup></a>
          
        </p>
      </div>
    </div>
 </div>
<section class="popular-courses">
  <div class="container">
    <div class="row">
      <h3 class="col-md-12 heading">Popular Courses <a class="pull-right" href="<?php echo base_url('home/courses');?>">View All</a></h3>
      <ul class="main-courses-list">
          <?php $ii=0;foreach($courses as $course){ 
		  if($ii< 4){
		  ?>
		  <li class="col-md-3">
			  <div class="main-courses-wrap">
				  <div class="course-img-wrap">
					<a href="<?php echo base_url($course->categorySlug.'/'.$course->slug); ?>" class="course-img-det">
						<img src="<?php echo base_url($course->image); ?>" alt="<?php echo $course->courseName; ?>">
					</a>
					<div class="download-brow"> 
						<a href="<?php echo base_url($course->brochure); ?>" target="_blank"><i class="fa fa-download"></i> <span>Download</span></a>
						<a href="#"><i class="fa fa-heart-o"></i> <span>Favourite</span></a>
					</div> 
				  </div>

				  <a href="<?php echo base_url($course->categorySlug.'/'.$course->slug); ?>" class="course-img">
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
					  <a href="<?php echo base_url($course->categorySlug.'/'.$course->slug); ?>" class="know-m">View Details</a> 
				  </div>
				</div>
			</li>
		  <?php } $ii++;} ?>                  
                               
        </ul>
      </div>
  </div>
</section>
<section class="our-features">
  <div class="container">
    <h3 class="heading text-center">Our Features</h3>
    <div class="col-md-5 text-right">
      <div class="classroom-wrap">
        <div class="training-wrap pull-left">
          <h5><a href="#">Classroom Training</a></h5>
          <p>containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus</p>
        </div>
        <div class="training-icon pull-right"><i class="fa fa-pencil-square-o"></i></div>
      </div> 
      <div class="classroom-wrap">
        <div class="training-wrap pull-left">
          <h5><a href="#">Virtual Training</a></h5>
          <p>containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus</p>
        </div>
        <div class="training-icon pull-right"><i class="fa fa-photo"></i></div>
      </div> 
    </div>
    <div class="col-md-2 text-center"><span class="logo-icon"></span></div>
    <div class="col-md-5">
      <div class="classroom-wrap">
        <div class="training-icon pull-left"><i class="fa fa-file-audio-o"></i></div>
        <div class="training-wrap pull-left">
          <h5><a href="#">Online Training</a></h5>
          <p>containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus</p>
        </div>
      </div> 
      <div class="classroom-wrap">
        <div class="training-icon pull-left"><i class="fa fa-fax"></i></div> 
        <div class="training-wrap pull-left">
          <h5><a href="#">Corporate Training</a></h5>
          <p>containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus</p>
        </div>
      </div> 
    </div>
  </div>
</section>
<section class="homepage-testimonial">
  <div class="container">
    <div class="home-testimonials"> 
        <div class="testimonial-block ptb ptb-sm ptb-xs">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <h2 class="heading-block"><span>Happy CLients </span> Testimonials </h2>
              </div>
              <div class="col-xs-12 testimonial-slider-block">
                <div class="testimonial-thumbs author-content owl-carousel owl-theme">
                 <?php foreach($testimonials as $t){ ?>
					<blockquote class="item author-text">
                    <p>
                      <?php echo $t->review;?>
                    </p>
                    <span class="dash"></span>
                  </blockquote>
				 <?php } ?>  
                  
                </div>  
                <div class="owl-controls clickable">
                  <div class="owl-pagination">
                    <div class="owl-page"><span class=""></span></div>
                    <div class="owl-page"><span class=""></span></div>
                    <div class="owl-page"><span class=""></span></div>
                  </div>
                </div>
                                </div>
                <div class="client-block">
                  <div class="testimonial-slider-info owl-carousel owl-theme">
                      <?php foreach($testimonials as $t){ ?>
						 <div class="item client-section clearfix">
						  <figure class="client-image"><img src="<?php echo base_url($t->image); ?>" alt="image">
						  </figure>
						  <span class="client-info"><strong><?php echo $t->name; ?></strong> <span><?php echo $t->designation; ?></span> </span>
						</div>
					  <?php } ?>
                                 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center testimonial"><a href="#">More Testimonials</a></div>
    </div>
  </div>
</section>
<section class="what-makes text-center">
  <div class="container">
    <h3>What Makes us Different?</h3>
    <div class="row">
      <div class="col-md-4 text-center">
        <p><img src="<?php echo base_url(); ?>assets/images/support.svg" alt="Best Support System" width="110" height="110"></p>
        <h4>Best Support System</h4>
        <p>Support through the journey of training right up to certification.</p>
      </div>
      <div class="col-md-4 text-center">
        <p><img src="<?php echo base_url(); ?>assets/images/follow-up.svg" alt="Follow up Sessions" width="110" height="110"></p>
        <h4>Follow up Session</h4>
        <p>One-on-one clarification session with the Trainer and clients.</p>
      </div>
      <div class="col-md-4 text-center">
        <p><img src="<?php echo base_url(); ?>assets/images/money-back.svg" alt="Money Back Guarantee" width="110" height="110"></p>
        <h4>Money Back Guarantee</h4>
        <p>7 Day 100% Money Back Guarantee</p>
      </div>
    </div>
  </div>
</section>

<?php echo $footer; ?>

<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

</body>
</html>