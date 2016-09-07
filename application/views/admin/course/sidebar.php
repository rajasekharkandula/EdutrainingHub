<div class="col-md-2 panel-sidemenu">
	<ul class="nav">
		<li <?php if($page == 'info')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/info/<?php echo $courseID;?>"><i class="fa fa-info-circle"></i> Course Info <i class="fa fa-check pull-right"></i></a>
		</li>
		<li <?php if($page == 'basic')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/basic/<?php echo $courseID;?>"><i class="fa fa-book"></i> Basic Details <i class="fa fa-check pull-right"></i></a>
		</li>
		<li <?php if($page == 'desc')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/desc/<?php echo $courseID;?>"><i class="fa fa-headphones"></i> Description <i class="fa fa-check pull-right"></i></a>
		</li>
		<li <?php if($page == 'faq')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/faq/<?php echo $courseID;?>"><i class="fa fa-question-circle"></i> Faq`s <i class="fa fa-check pull-right"></i></a>
		</li>
		<li <?php if($page == 'dm')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/dm/<?php echo $courseID;?>"><i class="fa fa-briefcase"></i> Digital Market <i class="fa fa-check pull-right"></i></a>
		</li>
		<li <?php if($page == 'publish')echo 'class="active"';?>>
			<a href="<?php echo base_url();?>admin/course/publish/<?php echo $courseID;?>"><i class="fa fa-arrow-circle-right"></i> Publish <i class="fa fa-check pull-right"></i></a>
		</li>
	</ul>
</div>