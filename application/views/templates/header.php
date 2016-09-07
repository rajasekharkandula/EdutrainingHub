<header class="header"> 
    <div class="container">
      <div class="row">
            <!-- LOGO -->
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt=""></a>
            
            <a href="#" class="nav-taggle"><i class="fa fa-sun-o"></i> Courses</a> 
            <!-- Menus -->
            <nav id="bs-navbar" class="collapse navbar-collapse dropdown-main-menu"> 
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a href="#"><i class="fa fa-sun-o"></i> Courses</a>
                        <ul class="dropdown-menu">
                                <li>
                                    <div class="col-sm-5 dropdown-catery"> 
                                        <ul> 
                                            <?php $i=0; foreach($categories as $category){ ?>
											<li <?php if($i==0) echo 'class="selected"'; ?>><a href="<?php echo base_url($category->categorySlug); ?>"><?php echo $category->categoryName; ?> </a></li> 
											<?php $i++; } ?>
										</ul> 
                                    </div>
                                   <?php $i=0; foreach($categories as $category){ ?>
									<div class="col-sm-7 dropdown-courses-list <?php if($i!=0) echo 'hide'; ?>"> 
                                        <ul>
										 <?php foreach($courses as $course){ ?>
											 <?php if($course->categoryID == $category->categoryID){ ?>
											   <li><a href="<?php echo base_url($category->categorySlug.'/'.$course->slug); ?>"><?php echo $course->courseName; ?></a></li> 
											 <?php } ?>
										 <?php } ?>
                                        </ul>
                                    </div>
                                    <?php $i++; } ?>
                                </li> 
                            </ul> 
                    </li>
                    <li class="dropdown"><a href="#"><i class="fa fa-sun-o"></i> Agile Services</a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="col-sm-5 dropdown-catery"> 
                                    <ul> 
                                        <li class="selected"><a href="javascript:void(0);">Agile Management </a></li> 
                                        <li><a href="#">Finance</a></li>
                                        <li><a href="javascript:void(0);">IT Security</a></li> 
                                        <li><a href="javascript:void(0);">Information Technology</a></li> 
                                        <li><a href="#">Project Management</a></li>
                                        <li><a href="javascript:void(0);">Quality Management</a></li> 
                                        <li><a href="javascript:void(0);">Risk Management</a></li> 
                                    </ul> 
                                </div>
                                <div class="col-sm-7 dropdown-courses-list"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">Agile Management1</a></li> 
                                       <li><a href="javascript:void(0)">Agile Management2</a></li> 
                                       <li><a href="javascript:void(0)">Agile Management3</a></li> 
                                       <li><a href="javascript:void(0)">Agile Management4</a></li> 
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="#">Finance1</a></li>
                                       <li><a href="#">Finance1</a></li>
                                       <li><a href="#">Finance1</a></li>
                                       <li><a href="#">Finance1</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">IT Security</a></li> 
                                       <li><a href="javascript:void(0)">IT Security</a></li>
                                       <li><a href="javascript:void(0)">IT Security</a></li>
                                       <li><a href="javascript:void(0)">IT Security</a></li>
                                       <li><a href="javascript:void(0)">IT Security</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">Information Technology</a></li> 
                                       <li><a href="javascript:void(0)">Information Technology</a></li>
                                       <li><a href="javascript:void(0)">Information Technology</a></li> 
                                       <li><a href="javascript:void(0)">Information Technology</a></li> 
                                       <li><a href="javascript:void(0)">Information Technology</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">Project Management</a></li> 
                                       <li><a href="javascript:void(0)">Project Management</a></li> 
                                       <li><a href="javascript:void(0)">Project Management</a></li> 
                                       <li><a href="javascript:void(0)">Project Management</a></li> 
                                       <li><a href="javascript:void(0)">Project Management</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">Quality Management1</a></li> 
                                       <li><a href="javascript:void(0)">Quality Management1</a></li>
                                       <li><a href="javascript:void(0)">Quality Management1</a></li> 
                                       <li><a href="javascript:void(0)">Quality Management1</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-7 dropdown-courses-list hide"> 
                                    <ul>
                                       <li><a href="javascript:void(0)">Risk Management</a></li> 
                                       <li><a href="javascript:void(0)">Risk Management</a></li>
                                       <li><a href="javascript:void(0)">Risk Management</a></li>
                                       <li><a href="javascript:void(0)">Risk Management</a></li> 
                                       <li><a href="javascript:void(0)">Risk Management</a></li>
                                    </ul>
                                </div>
                            </li> 
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><i class="fa fa-sun-o"></i> Corporate</a></li>
                    <li><a href="#"><i class="fa fa-sun-o"></i> Partner With Us</a></li>
                    <?php if($this->session->userdata("login")){ ?>
						<li><a href="<?php echo base_url("home/logout");?>"><?php echo $this->session->userdata("name"); ?></a></li>
                    <?php }else{ ?>
						<li><a href="<?php echo base_url('home/login'); ?>"><i class="fa fa-sun-o"></i> Login / Register</a></li>
					<?php } ?>
					<li class="last-child shopin-cart"><a href="<?php echo base_url('cart'); ?>"><span class="fa fa-shopping-cart"><strong><?php if($this->session->userdata('cart'))echo count($this->session->userdata('cart'));else echo '0';?></strong></span></a></li>
			   </ul>
            </nav>
          </div>
    </div>
 </header>
