
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo  base_url(); ?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
<link href="<?php echo  base_url(); ?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href="<?php echo  base_url(); ?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
<link href="<?php echo  base_url(); ?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo  base_url(); ?>assets/user/css/animations.css" type="text/css">

</head>


<body>
<div class="se-pre-con"></div>
<div id="wrapper">
    <div class="header">
        <div class="bskt clearfix">
            <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="logo">
                                <?php 
                            $sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting'); 
                             if($sitelogo) {
                            ?>
                                    <a href="<?php echo base_url();?>"><img style="height:49px;" src="<?php echo base_url().$sitelogo->ContentValue;?>" /></a>
                            <?php } else { ?>
                                    <a href="<?php echo base_url();?>"><img style="height:49px;" src="<?php echo base_url();?>assets/user/img/logo.png" /></a>  
                            <?php   
                                }
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="nav-container">
                                <div class="nav navbar navbar-default">
                                    <div class="row">
                                        <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                            <ul class="nav navbar-nav">
                                                <li><a href="<?php echo  base_url(); ?>user/">home</a></li>
                                                <li><a href="#">About Us</a></li>
                                                <li><a href="#">shop</a></li>
                                                <li><a href="#">Opportunity</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="cart">
                                    <a href=""> cart empty (0) <img src="<?php echo  base_url(); ?>assets/user/img/cart-icon.png"  /></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="socl">
                                <a href="">f</a>
                                <a href="">t</a>
                                <a href="">g</a>
                                <a href="">y</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="shtbnr clearfix">
        <div class="col-lg-12">
        <div class="row">
        <div class="bskt">
        <h1>user payment </h1>
        <p>user register payment.</p> 
        </div>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="regform cnctinf">
        <div class="row">
            <div class="col-lg-12">
                <!-- <img src="<?php echo  base_url(); ?>assets/user/img/mp.jpg" class="mp"/> -->
                <div class="bskt">
                    <div class="row">
                        <div class="col-xs-8">

                       
                            <h2><?php echo  ucwords($this->lang->line('epin'));?><span><strong><?php echo  ucwords($this->lang->line('details'));?></strong></span></h2>
                            <?//echo"<pre>"; print_r($this->data); echo"</pre>"; ?>
                            <div class="col-lg-9">
                      <?php if($this->session->flashdata('error_message')) { ?>

                        <label class="label label-danger col-lg-9"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
                      
                      <?php unset($_SESSION['error_message']); } ?>
                      
                      <?php if($this->session->flashdata('success_message')) { ?>

                        <label class="label label-success col-lg-9"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
                       
                      <?php unset($_SESSION['success_message']); } ?>
                   </div>

                            
                            <div class="col-lg-8">
                           <form name="epinfrm" id="epinfrm" action="" method="post">
                               <hr class="hrzntl"/>
                               <h3><?php echo  ucwords($this->lang->line('epincode'));?> <sup><em class="state-error">*</em></sup></h3>
                               <input type="text" name="epincode" required >
                                 <input type="submit" name="check" value="check">                                
                                
                            </form>
                        </div>
                            

                          
                       
                        </div>
                        <div class="col-xs-4">
                          <div class="coninfo">
                            <h1>contact <span>info</span></h1>
                            <?php echo Siteaddress();?>
                          </div>
                        </div>
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
<!--<script type="text/javascript" src="js/loadImg.js"></script>-->
<script src="<?php echo  base_url(); ?>assets/user/js/css3-animate-it.js"></script>

<script type="text/javascript">
    jQuery('.carousel').carousel({
        interval: 7000
    })
    
    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");;
    });
</script>

</html>
