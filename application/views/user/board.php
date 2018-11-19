<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Armcip </title>
        <link href="<?php echo  base_url(); ?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo  base_url(); ?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href="<?php echo  base_url(); ?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo  base_url(); ?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo  base_url(); ?>assets/user/css/animations.css" type="text/css">
        <style>
            select  {
                margin:0 !important;
                width: 100% !important;
            }
        </style>
    </head>

    <body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
        <div class="se-pre-con"></div>
        <div id="wrapper">
            <div class="header">
                <div class="bskt clearfix">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo">
                                    <a href="#"><img src="<?php echo  base_url(); ?>assets/user/img/logo.png" /></a>
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
                            <h1>Borard Process </h1>
                            <p>user payment for borad process.</p> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="regform cnctinf">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="bskt">
                            <div class="row">
                                <div class="col-lg-8">

                                    <h2><?php echo  ucwords($this->lang->line('epin'));?><span><strong><?php echo  ucwords($this->lang->line('details'));?></strong></span></h2>
                                    
                                    <div class="col-lg-9">
                                        <?php if($this->session->flashdata('error_message')) { ?>
                                            <label class="label label-danger col-lg-9"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
                                        <?php unset($_SESSION['error_message']); } ?>

                                        <?php if($this->session->flashdata('success_message')) { ?>
                                            <label class="label label-success col-lg-9"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
                                        <?php unset($_SESSION['success_message']); } ?>
                                    </div>
                                    
                                    <div class="col-lg-8">
                                        <h3><?php echo $this->lang->line('lbl_package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
                                        <h3><?php echo $this->lang->line('lbl_amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
                                        <form method="post" action="<?php echo base_url()?>user/board/checkbankwire/<?php echo $MemberId;?>" >
                                            <input type="text" name="epincode" required >
                                            <div class="buttons">
                                                <div class="pull-right">
                                                    <input type="submit" class="btn btn-primary" value="confirm">
                                                </div>
                                            </div>
                                            <input type="hidden" name="amt" value="<?php echo number_format($amount,2);?>">
                                            <input  type="hidden" name="checkwire" value="check">
                                        </form>
                                    </div>
                               
                                </div>
                                <div class="col-lg-4">
                                    <div class="coninfo">
                                        <h1>contact <span>info</span></h1>
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
        function PaymentMethod(payment) {
            if(payment) {
                var url = '<?php echo base_url();?>payment/'+payment+'/board';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: $('#checkout-page :input'),
                    dataType: 'html',
                    beforeSend: function() {
                        $('.payment_mode').html('loading..');
                    },
                    success: function(html) {
                        $('.payment_mode').html(html);
                    }
                });
            } else {
                $('.payment_mode').html('<p>Select payment for further process.</p>');
            }
            
        }
    </script>

</html>
