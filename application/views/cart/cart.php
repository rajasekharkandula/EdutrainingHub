<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Cart</title> 
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
          <li class="active">My Cart</li>
        </ol>
    </div>
 </section>
 
 <section class="login-wrap"> 
    <div class="container">
      <div class="cart-wrap">
          <div class="content-left-wrap col-md-12"> 
          <h1 class="login-title">Shopping Cart</h1> 
          <?php if($cart){ ?>
		  <table class="table cart table-hover table-striped">
            <thead> 
              <tr>
                <th>Course Name </th>
                <th>No. of Participants </th>
                <th>Discount</th>
                <th>Remove </th>
                <th>Sub Total </th>
              </tr>
              <?php foreach($cart as $c){ 
					foreach($contents as $d){
					if($d->sessionID == $c['id']){
			  ?>
			  
			  <tr class="remove-data">
                <td class="product"><?php echo $d->courseName.' - '.$d->cityName; ?> 
				<small><span><?php echo $d->courseType.' - '.date('d M',strtotime($d->startDate)).' - '.date('d M Y',strtotime($d->endDate)); ?></span></small></td>
                <td class="participants"><input type="text" class="form-control" value="<?php echo $c['qty']; ?>"> </td>
                <td class="quantity">
                  <?php echo $c['discount']; ?>%                     
                </td>
                <td class="remove"><a class="btn btn-remove"><i class="fa fa-remove"></i></a></td>
                <td class="amount"><?php echo $d->currencyCode; ?> <?php echo $c['amount']; ?> </td>
              </tr>
              <?php } } } ?>
			  
            </thead>
          </table>
          <div class="coupon-code-wrap col-md-12">
            <div class="row"> 
              <div class="col-md-7 coupon-code">
                <form class="form-inline" id="continue-form">
                   <?php if(!$this->session->userdata("login")){ ?>
				  <div class="form-group">
                    <label class="sr-only" for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php if(isset($user['name']))echo $user['name'];?>">
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php if(isset($user['email']))echo $user['email'];?>">
                  </div>
                  <div class="form-group inhouse-phone-wrap">
                    <div class="inhouse-phone">
                      <label class="sr-only" for="phone">Phone</label>
                      <select class="form-control pull-left">
                        <option>IN - India</option>
                          <option>AU - Australia</option>
                          <option>PK - Pakistan</option>
                          <option>GB - United Kingdoms</option>
                      </select>
                      <input type="text" class="form-control pull-left" name="phone" id="phone" placeholder="Phone" value="<?php if(isset($user['phone']))echo $user['phone'];?>">
                    </div>
                  </div>
				   <?php } ?>
                  <div class="form-group coupon-codes">
                    <input type="text" class="form-control" value="" placeholder="Coupon Code">
                    <div class="form-group apply-coupon">
                      <input type="submit" class="btn btn-default" value="Appy Coupon">
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-6 pull-right">
                <div class="total-wrap row">
                  <div class="text-right">
                    Total <span><?php echo $currency.' '.$amount['subTotal']; ?></span>
                  </div>
                </div>
                <div class="total-wrap row">
                  <div class="text-right">
                    Discount(<?php echo $amount['discountPercentage']; ?>%) <span><?php echo $currency.' '.$amount['discountAmount']; ?></span>
                  </div>
                </div>
                
                <div class="total-wrap row">
                  <div class="text-right grand-total">
                    Grand Total <span><?php echo $currency.' '.$amount['grandTotal']; ?></span>
                    <small>(Include 15% service tax)</small>
                  </div>
                </div>
                
              </div>
            </div> 
          </div>
		  
		  <?php }else{ ?>
		  <h5>Your cart is empty</h5>
		   <?php } ?>
		  <br>
          <div class="continue-shoping">
            <a href="<?php echo base_url(); ?>" class="add-course">Add Course</a>
			<?php if($cart){ 
			if($this->session->userdata("login")){ ?>
				<a href="<?php echo base_url('cart/payment');?>" class="continue pull-right">Continue</a>
			<?php }else{ ?>
				<a href="#" class="continue pull-right" id="continue">Continue</a>
			<?php } } ?>
          </div>
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

<script type="text/javascript">
	$("#continue").on('click',function(e){
		e.preventDefault();
		$("#continue-form .text-danger").remove();
		var text_error = '<div class="text-danger"> This field is required </div>',error=0;
		
		if($("#name").val() == ""){$(text_error).insertAfter("#name");error++;}
		if($("#email").val() == ""){$(text_error).insertAfter("#email");error++;}
		if($("#phone").val() == ""){$(text_error).insertAfter("#phone");error++;}
				
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test($("#email").val()) && $("#email").val() != ""){ $('<div class="text-danger"> Please enter valid mail </div>').insertAfter("#email");error++;}
		
		if(error == 0){
			$("#continue").html('Please wait... <i class="fa fa-spinner fa-pulse"></i>');
			$("#continue").attr('disabled','disabled');
			$.ajax({
				url:'<?php echo base_url('cart/save_cart_user');?>',
				type:'POST',
				data:$("#continue-form").serialize(),
				dataType:'JSON'
			}).success(function(data){
				window.location = '<?php echo base_url('cart/payment');?>';
				$("#continue").html('Continue');
				$("#continue").attr('disabled',false);
			});
		}
	});
</script>
</body>
</html>