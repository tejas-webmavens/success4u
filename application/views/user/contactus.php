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
                    <h1><?php echo  $this->lang->line('page_title');?></h1>
                    <p><?php echo  $this->lang->line('page_content');?></p> 
                </div>
            </div>
        </div>
      </div>

      <div class="clearfix"></div>
        <div class="regform">
          <div class="row">
            <div class="col-lg-12">
              <div class="bskt">
                 <div class="row">
                    <div class="col-lg-9">
                      <h1><?php echo  $this->lang->line('page_title');?></h1>
                    </div>
                    <div class="col-lg-9">
                      <?php if($this->session->flashdata('error_message')) { ?>

                        <label class="label label-danger col-lg-9"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
                      
                      <?php unset($_SESSION['error_message']); } ?>
                      
                      <?php if($this->session->flashdata('success_message')) { ?>

                        <label class="label label-success col-lg-9"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
                       
                      <?php unset($_SESSION['success_message']); } ?>
                   </div>
                   
                      <form method="post" action="" id="form-register" name="registerform">
                        <div class="col-lg-9">
                            
                            
                          
                               
                                  <h3><?php echo  ucwords($this->lang->line('name'));?><sup> <em class="state-error">*</em> </sup></h3>
                                  <input type="text" name="name" id="name" class="gui-input" placeholder="Enter <?php echo  ucwords($this->lang->line('name'));?>" value="" required>
                                  <h4> <?php echo form_error('name');?></h4>
                             

                                  <h3><?php echo  ucwords($this->lang->line('email'));?><sup> <em class="state-error">*</em> </sup></h3>
                                  <input type="text" name="email" id="email" class="gui-input" placeholder="Enter <?php echo  ucwords($this->lang->line('email'));?>" value="" required>
                                  <h4> <?php echo form_error('email');?></h4>
                             

                                  <h3><?php echo  ucwords($this->lang->line('subject'));?><sup> <em class="state-error">*</em> </sup></h3>
                                  <input type="text" name="subject" id="subject" class="gui-input" placeholder="Enter <?php echo  ucwords($this->lang->line('subject'));?>" value="" required>
                                  <h4> <?php echo form_error('subject');?></h4>
                             
                                  <h3><?php echo  ucwords($this->lang->line('message'));?><sup> <em class="state-error">*</em> </sup></h3>
                                  <!-- <input type="text" name="message" id="message" class="gui-input" placeholder="Enter <?php echo  ucwords($this->lang->line('message'));?>" value="" required>
                                   --><h3><textarea style="width:100%;" class="ml80" name="message" id="message" required ></textarea></h3>
                                  <h4> <?php echo form_error('message');?></h4>
                             
                             
                                  

                              

                              
                              <input type="submit" name="action" value="contact"/> 
                         
                              
                          </div>
                          <div class="col-lg-3">
                              <h2><?php echo  ucwords($this->lang->line('page_righttitle'));?></h2>
                              <p><?php echo  ucwords($this->lang->line('page_rightsidecontent'));?></p>

                              <p class="ylw"> <?php echo  ucwords($this->lang->line('page_rightsidenote'));?></p>
                              <hr class="hrzntl"/>
                              <h2><?php echo  ucwords($this->lang->line('membershipplan'));?></h2>
                                   </div> 
                         <!--  <div class="col-lg-9 text-center">
                          <img src="<?php echo  base_url();?>assets/user/img/register.jpg" class="responsive">
                          </div> -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <?php $this->load->view('user/footer'); ?>
   </div>
</body>

<script src="<?php echo  base_url(); ?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
<script src="<?php echo  base_url(); ?>assets/user/js/bootstrap.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo  base_url(); ?>assets/user/js/loadImg.js"></script>-->
<script src="<?php echo  base_url(); ?>assets/user/js/css3-animate-it.js"></script>

<script type="text/javascript">
	jQuery('.carousel').carousel({
		interval: 7000
	})
	
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

<!-- check password-->

<script type="text/javascript">
(function($) {

    $(document).ready(function() {

 $('#form-register').on('submit', function(event) {
/*
         $('input.comment').each(function() {
                $(this).rules("add", 
                    {
                        required: true
                    })
*/
      })
 // set handler for addInput button click
    

        // initialize the validator
        $('form.registerform').validate();

 });

})(jQuery);
</script>
</html>
