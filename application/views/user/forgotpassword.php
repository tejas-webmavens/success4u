<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <?php $metatitle = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetatitle'",'arm_setting');
      $metakey = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetakeyword'",'arm_setting');
      $metadesp = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetadescription'",'arm_setting');
      $sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting');
   ?>
              
    <title><?php echo  $metatitle->ContentValue;?></title>
    <meta name="keywords" content="<?php echo  $metakey->ContentValue;?>"/>
    <meta name="description" content="<?php echo  $metadesp->ContentValue;?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/main.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
p em.text-danger{font-weight: bold;
text-transform: uppercase;
background: rgb(255, 255, 255) none repeat scroll 0% 0% !important;
padding: 10px;
border-radius: 4px;}
    </style>
  </head>
  <body class="hold-transition lockscreen"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper text-center">
      <div class="lockscreen-logo">
        <a href="<?php echo  base_url();?>"><img height="69px" src="<?php echo base_url(). $sitelogo->ContentValue;?>" /></a>
      </div>
      <!-- User name -->
      <p>Hello User, Enter Your Username & Password to Login website!</p>
      
            <!--<span><img src="<?php echo base_url();?>assets/user/img/usr.png" alt="User Image" class=""></span>-->
            
            <div class="lockscreen-name"><h3>welcome user !</h3></div>

              <?php if($this->session->flashdata('success_message')) { ?>
              <div class="flashmessage">
              <div class="alert alert-success alert-dismissable">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
               <?php echo ucwords($this->session->flashdata('success_message')); ?>
              </div></div> <br> 
             <?php } ?> 

              <?php if($this->session->flashdata('error_message')) { ?>
               
              <div class="flashmessage">
              <div class="alert alert-danger alert-dismissable">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo ucwords($this->session->flashdata('error_message')); ?>
              </div></div><br>
               <?php } ?>
             
             <h4> <?php    echo ucwords(form_error('error_message')); ?> </h4>
            
          <form class="" method="post" action="" autocomplete="off">
          <div class="lockscreen-item">
            
            <div class="lockscreen-image">
              <img src="<?php echo base_url();?>assets/user/img/usericon.png" alt="User Image">
            </div>
      
            
            <div class="input-group lockscreen-credentials">
                <input type="text" name="useremail" class="form-control" placeholder="Your User Email here" required>
            </div>
            <?php  echo form_error('useremail'); ?>
            

          </div>   <?php /*// echo form_error('username');  ?>
          <div class="lockscreen-item">
             
            <div class="lockscreen-image">
              <img src="<?php echo base_url();?>assets/user/img/lck.png" alt="User Image">
            </div>
      
            
              <div class="input-group lockscreen-credentials">
                <input type="password" name="password" class="form-control" placeholder="Your password here" required>
                <!--<div class="input-group-btn">
                  <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>-->
                
              </div>
              <?php // echo form_error('password'); ?>


            
          </div> 
          <?php */ ?>

      <!--<div class="help-block text-center">
        Enter your password to retrieve your session
      </div>-->
    
            <div class="text-center">
                <input type="submit" value="submit">
            </div>
        </form>
       <div class="help-block text-center">
        <a href="<?php echo base_url();?>login"> Sign in using different account</a>
      </div>
       <div class="help-block text-center">
       <a href="<?php echo base_url();?>user/register">Create a new account
</a>
      
      </div>
      <!--<div class="lockscreen-footer text-center">
        Copyright &copy; 2014-2015 <b><a href="#" class="text-black">Almsaeed Studio</a></b><br>
        All rights reserved
      </div>-->
    </div><!-- /.center -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
