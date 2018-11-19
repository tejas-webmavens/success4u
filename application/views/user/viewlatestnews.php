<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		 <?php $this->load->view('user/meta');?>
		<link href="<?php echo base_url();?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/simplePagination.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/user/css/style.css" />
		<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700' rel='stylesheet' type='text/css' />
	
	</head>
	<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
		<div class="se-pre-con"></div>
		<div id="wrapper">
			<?php $this->load->view('user/header');?>
			<div class="clearfix"></div>
			<div class="shtbnr clearfix">
				<div class="col-lg-12">
					<div class="row">
						<div class="bskt">
							<h1><?php echo  ucwords($this->lang->line('page_title'));?></h1>
							<p><?php echo  ucwords($this->lang->line('page_content'));?></p> 
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="prodcts">
				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
						<div id="st-accordion" class="st-accordion">
                    <ul>
                       
                        
                        <?php
								if($latestnews) { 
									$i = 0;
									foreach ($latestnews as $row) {
										
											// $image = base_url().'assets/user/img/abticon03.png';
							?>
                        <li>
                            <a href="#"><?php echo  urldecode($row->NewsHeader);?> <span class="st-arrow">Open or Close</span></span><em><?php echo "  -    ". date('d M Y H:i A', strtotime($row->DateAdded));?></em></a>
                            <div class="st-content">
                                <p><?php echo urldecode($row->NewsDescription);?></p>
                                </div>
                        </li>
                       <?php } }?>
                    </ul>
                </div>
                <?php /*?>
							<br />
							<ul class="timeline">

							<?php
								if($latestnews) { 
									$i = 0;
									foreach ($latestnews as $row) {
										
											$image = base_url().'assets/user/img/abticon02.png';
							?>
										<li class="time-label">
						                  <span class="bg-red">
						                  <?php echo date('d M Y', strtotime($row->DateAdded));?>
						                  </span>
						                </li>
						                <li>
						                  	<img src="<?php echo $image;?>"  width="60"/>
						                  	<div class="timeline-item">
						                    	<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('d M Y H:i', strtotime($row->DateAdded));?></span>
						                    	<h3 class="timeline-header"><a href="#"><?php echo  $row->NewsHeader;?></a></h3>
						                    	<div class="timeline-body">
							                      <?php echo urldecode($row->NewsDescription);?>
							                    </div>
							                   
						                  	</div>
						                </li>

							<?php
									}
								}
							?>
				                
				                <!-- <li>
				                    <i class="fa fa-camera bg-purple"></i>
				                    <div class="timeline-item">
					                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
					                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
					                    <div class="timeline-body">
					                      <img src="http://placehold.it/150x100" alt="..." class="margin">
					                      <img src="http://placehold.it/150x100" alt="..." class="margin">
					                      <img src="http://placehold.it/150x100" alt="..." class="margin">
					                      <img src="http://placehold.it/150x100" alt="..." class="margin">
					                    </div>
				                  	</div>
				                </li> -->
				                <li>
				                  <i class="fa fa-clock-o bg-gray"></i>
				                </li>
				            </ul>
              				<br />  <?*/ ?>
						</div>
					</div>
				</div>
			</div>
			<div id="testing_content">
			</div>
			<div class="clearfix"></div>
			<?php $this->load->view('user/footer');?>
		</div>
	</body>
	<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/css3-animate-it.js"></script>
	
	<script src="<?php echo base_url();?>assets/user/js/jPages.js"></script>
	<script type="text/javascript">
		jQuery('.carousel').carousel({
			interval: 7000
		})
		
		$(window).load(function() {
			$(".se-pre-con").fadeOut("slow");;
		});
		

	/* when document is ready */
	  $(function(){
	    /* initiate the plugin */
	    $("div.holder").jPages({
	        containerID  : "itemContainer",
	        perPage      : 9,
	        startPage    : 1,
	        startRange   : 1,
	        midRange     : 5,
	        endRange     : 1
	    });
	    // $(".popup_carts").load("<?php echo base_url();?>user/shop/info");
	});

	</script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/user/js/jquery.accordion.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/user/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
			
				$('#st-accordion').accordion();
				
            });
        </script>
	<?php $this->load->view('user/common_script');?>
</html>
