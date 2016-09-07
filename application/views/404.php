<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Error 404 Page</title> 
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
 
 
 <section class="breadcrumb-wrap">
  <div class="container">
      <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>" class="first-child"><i class="icon-arrow-left"></i> Back to home</a></li> 
        </ol>
    </div>
 </section>
 <section class="title-banner">
    <div class="container">
      <h1 class="page-title">Error 404 Page</h1>
    </div>
 </section>
  <section class="page-error-wrap text-center">
    <div class="container">
      <div class="error-text1">Error</div>
      <div class="error-img"><img src="<?php echo base_url();?>assets/images/404.png" alt="404 page"></div>
      <div class="error-text2">Page not found</div>
      <div class="error-text3">The page you are looking for is not available and might have been removed, its name changed or is temprarily unavailable.</div>
    </div>
  </section>


<?php echo $footer; ?>

<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

</body>
</html>