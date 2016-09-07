<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Payment</title> 
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
          <li><a href="<?php echo base_url();?>" class="first-child"><i class="icon-arrow-left"></i> Back to home</a></li> 
		  <li><a href="<?php echo base_url('cart');?>">Cart</a></li> 
          <li class="active">Payment</li>
        </ol>
    </div>
 </section>
 
  <section class="payment-wrap">
    <div class="container">
      <div class="payment-title-wrap">
        <h1 class="payment-title">Secure Payment</h1>
        <div class="payment1">
          <div class="secure-pay-name">
            <h5>Payment Summary</h5>
          </div>
           <?php foreach($cart as $c){ 
			foreach($contents as $d){
			if($d->sessionID == $c['id']){
		  ?>
		  <div class="secure-pay-course">
            <p><?php echo $d->courseName.' - '.$d->cityName; ?>  <span class="pull-right">Payble Payment <strong><?php echo $d->currencyCode; ?> <?php echo $c['amount']; ?></strong></span></p>
          </div>
		  <?php } } } ?>
		   <div class="secure-pay-course total-pay">
            <?php echo $currency.' '.$amount['grandTotal']; ?>
          </div>
        </div>
		
      </div>
      <div class="payment-inner-wrap">
        <div class="secure-pay-name">
          <h5>Choose Your Payment mode</h5>
        </div>
        <div class="row"> 
          <div class="col-md-3">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#home" data-toggle="tab">
                  <img src="<?php echo base_url(); ?>assets/images/pay_you.png" width="110" alt="" />
                </a>
              </li>
              <li role="presentation"><a href="#profile" data-toggle="tab">
                <img src="<?php echo base_url(); ?>assets/images/cc_avenue.png" width="110" alt="" />
              </a></li>
              <li role="presentation"><a href="#messages" data-toggle="tab">
                <img src="<?php echo base_url(); ?>assets/images/icici_logo.png" width="110" alt="" />
              </a></li>
              <li role="presentation"><a href="#settings" data-toggle="tab">
                <img src="<?php echo base_url(); ?>assets/images/paypal.png" width="110" alt="" />
              </a></li>
              <li role="presentation"><a href="#online-tra" data-toggle="tab">
                <i class="fa fa-money"></i> Online Tranfer
              </a></li>
              <li role="presentation"><a href="#po-invoice" data-toggle="tab">
                <i class="fa fa-ticket"></i> PO/Invoice
              </a></li>
              <li role="presentation"><a href="#cheque" data-toggle="tab">
                <i class="fa fa-list-alt"></i> Cheque
              </a></li>
            </ul>
          </div>
          <div class="col-md-9">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
                <p>YOU WILL BE CHARGED <span><?php echo $currency.' '.$amount['grandTotal']; ?></span> ON YOUR PAYMENT CARD THROUGH PAYYOU PAYMENT GATEWAY</p>
                <div class="pay-now"><a href="#">Pay Now</a></div>
              </div>
              <div role="tabpanel" class="tab-pane" id="profile">
                <p>YOU WILL BE CHARGED <span><?php echo $currency.' '.$amount['grandTotal']; ?></span> ON YOUR PAYMENT CARD THROUGH CC AVENUE PAYMENT GATEWAY</p>
                <div class="pay-now"><a href="#">Pay Now</a></div>
              </div>
              <div role="tabpanel" class="tab-pane" id="messages">
                <p>YOU WILL BE CHARGED <span><?php echo $currency.' '.$amount['grandTotal']; ?></span> ON YOUR PAYMENT CARD THROUGH ICICI PAYMENT GATEWAY</p>
                <div class="pay-now"><a href="#">Pay Now</a></div>
              </div>
              <div role="tabpanel" class="tab-pane" id="settings">
                <p>YOU WILL BE CHARGED <span><?php echo $currency.' '.$amount['grandTotal']; ?></span> ON YOUR PAYMENT CARD THROUGH PAYPAL PAYMENT GATEWAY</p>
                <div class="pay-now"><a href="#">Pay Now</a></div> 
              </div>
              <div role="tabpanel" class="tab-pane" id="online-tra">
                <p><strong>PAY THROUGH ONLINE TRANSFER</strong></p>

                <p>Please contact the support team at <a href="#">support@adhopskills.com</a></p>
                <p>or </p>
                <p>call us at 080-021456 for more details.</p>
              </div>
              <div role="tabpanel" class="tab-pane" id="po-invoice">
                <p><strong>PAY THROUGH PO/INVOICE</strong></p>
                <p>Please contact our team at <a href="#">invoice@adhopskills.com</a> </p>
                <p>or</p> 
                <p class="pay-now"><a href="javascript:void(0)" data-toggle="modal" data-target="#Request-po-invoice">Request For PO/Invoice</a></p> 
              </div>
              <div role="tabpanel" class="tab-pane" id="cheque">
              <p><strong>YOU CAN MAKE PAYMENT THROUGH CHEQUE IN FAVOUR OF KNOWLEDGEHUT SOLUTIONS PVT. LTD.</strong></p>

              <p>PLEASE SEND THE CHEQUE TO:</p>

              <p>No.10, 14th main road,<br>
                Sector 5, <br>
                HSR Layout, <br>
                Bangalore-560102<br> 
                Karnataka, India </p>
              <p>Note: Please send us the scanned copy of the cheque to <a href="#">account@adhopskills.com</a> Your course registration will be final only after we receive the confirmation of the payment.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="back">
            In case you have any queries, please contact our support team by writing in to <a href="#">support@adhopskills.com</a>
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