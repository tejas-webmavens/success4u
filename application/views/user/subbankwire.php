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


<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<div class="se-pre-con"></div>
<div id="wrapper">
     <?php $this->load->view('user/header'); ?>
    <div class="clearfix"></div>
    <div class="shtbnr clearfix">
        <div class="col-lg-12">
        <div class="row">
        <div class="bskt">
        <h1>user Subscription payment </h1>
        <p>User Subscription payment.</p> 
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

                       
                            <h2><?php echo  ucwords($this->lang->line('bankwire'));?><span><strong><?php echo  ucwords($this->lang->line('details'));?></strong></span></h2>
                            <?//echo"<pre>"; print_r($this->data); echo"</pre>"; ?>
                            <div class="col-lg-9">
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
                    
                   </div>
                        <?php 
                            $recdetails =$this->common_model->GetRow("MemberId='".$id."'","arm_members");
                            // print_r($recdetails);
                            // $userdetails =$this->common_model->GetRow("MemberId='".$recdetails->SpilloverId."'","arm_members");
                            $admindetails =$this->common_model->GetRow("MemberId='1'","arm_members");
                            $paydetail = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
                              // print_r($userdetails);?>
                            
                            <div class="col-lg-8">
                            <h3><?php echo ucwords($this->lang->line('payment')." ".$this->lang->line('details'));?></h3>
                           
                                <hr class="hrzntl"/>
                                <?php echo  "<p><strong>".$paydetail->PaymentMerchantId."<br>".$paydetail->PaymentMerchantPassword."<br>".$paydetail->PaymentMerchantKey."<br>".$paydetail->PaymentMerchantApi."</strong></p>";
                                ?>
                           <form name="bankwirefrm" id="bankwirefrm" action="<?php echo  base_url();?>user/register/subbankwire/<?php echo  $id;?>" method="post" enctype="multipart/form-data" >

                               <hr class="hrzntl"/>
                                 <?php echo validation_errors(); ?>
                               <h3><?php echo  ucwords($this->lang->line('bankwireid'));?> <sup><em class="state-error">*</em></sup></h3>
                               <input type="text" name="transactionid" required >
                               <!-- <h4><?php echo  form_error('transactionid');?></h4> -->
                               <!-- <h4><?php echo  form_error('memberid');?></h4> -->
                               <h3><?php echo  ucwords($this->lang->line('bankwireref'));?> <sup><em class="state-error">*</em></sup></h3>
                               <input type="file" name="referfile">
                               <h4><?php echo  form_error('referfile');?></h4>
                                 <input type="submit" name="checkwire" value="check">     
                                 <input type="hidden" name="memberid" value="<?php echo  $id; ?>"> 
                                 <input type="hidden" name="amount" value="<?php echo  $amount; ?>"> 
                                                           
                                
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
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

    $("#bankwirefrm").validate({

            // States
          

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                 referfile: {
                    extension: 'jpg|png|gif|jpeg'
                }
            },
             messages: {
                referfile: {
                    extension: '<?php echo ucwords($this->lang->line('errorextension')); ?>'
                }
            },

            /* @validation highlighting + error placement
             ---------------------------------------------------- */

            highlight: function(element, errorClass, validClass) {
                $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio") || element.is(":checkbox")) {
                    element.closest('.option-group').after(error);
                } else {
                    error.insertAfter(element.parent());
                }
            }
        });

    });

})(jQuery);
</script> 


</html>
