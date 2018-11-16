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
    <?php $this->load->view('user/header');?>
    <div class="clearfix"></div>
    <div class="shtbnr clearfix">
        <div class="col-lg-12">
        <div class="row">
        <div class="bskt">
        <h1>user subscription payment </h1>
        <p>user subscription payment.</p> 
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
                           
                       
                            <h2>Users <span>Subscription <strong>payment</strong></span></h2>
                             <h3></h3>

                            
                            <?php
                                  
                                // print_r($paymentdetails);
                                    if($bwcount>0)
                                        { ?>

                                <hr class="hrzntl"/>
                                <h3> <?php echo ucwords($this->lang->line("pendingupgrademsg"));?><a href="<?php echo  base_url();?>login"><?php echo ucwords($this->lang->line("login"));?></a></h3>
                              <?php } 
                              else
                                {
                                    ?>
                                    <select name="payment_method" onChange="PaymentMethod(this.value)">
                                        <option value=""> --select payment-- </option>
                                    <?php 
                                if($paymentdetails) {
                                    foreach ($paymentdetails as $row) {
                                        if($row->PaymentStatus)
                                        {
                                            ?>
                                            <div class="radio-list">
                                            
                                              <option value="<?php echo $row->PaymentName;?>"><?php echo $row->PaymentName;?></option>
                                            
                                                
                                            </div>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                                </select>
                                <?php
        
                                for($i=0;$i<count($paymentdetails);$i++){
                                  //  echo "SD ".$i.$paymentdetails[$i]->PaymentName;
                                if($paymentdetails[$i]->PaymentName=='paypal')
                                {
                                    if($paymentdetails[$i]->PaymentMode == 0)
                                    {
                

                                        $paymemturl=$paymentdetails[$i]->PaymentTestUrl;
                                    }
                                    else
                                    {
                                        $paymemturl=$paymentdetails[$i]->PaymentLiveUrl;
                                    }
                                    $ddata = array("page"=>'register',"payby"=>"paypal");
                                    $customdata = json_encode($ddata);
                                   
                                    

                                ?>
                                <br>
                                <div class="payment_mode" style="float: left;">

                                </div>
                                <!-- <div style="float: left;">
                           <form name="paypalFrm" id="paypalFrm" action="<?php echo $paymemturl;?>" method="post" >
                               
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="return" value="<?php echo base_url();?>user/register/paymentsuccess">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url();?>user/">
                                <input type="hidden" name="notify_url" value="<?php echo base_url();?>user/">
                                <input type="hidden" name="custom" value="<?php echo 'register,paypal,'.$userdetails->MemberId;?>">
                                <input type="hidden" name="business" value="<?php echo $paymentdetails[$i]->PaymentMerchantId;?>">
                                <input type="hidden" name="item_name" value="<?php echo $packagedetails->PackageName;?>">
                                <input type="hidden" name="item_number" value="<?php echo $packagedetails->PackageId;?>">
                                <input type="hidden" name="amount" value="<?php echo $packagedetails->PackageFee;?>">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="username" value="<?php echo $userdetails->UserName;?>">
                               
                                <button><img float="left" src="<?php echo base_url().$paymentdetails[$i]->PaymentLogo;?>"><br></button>
                                
                            </form>
                                </div> -->
                            <?php }  ?>

                            <?php
                            
                            if($paymentdetails[$i]->PaymentName =='epin')
                            {
                                    $ddata = array("page"=>'register',"payby"=>"epin");
                                    $customdata = json_encode($ddata);
                                ?>

                              <!-- <div style="float: left;">
                              <form method="post" action="<?php echo base_url()?>user/register/checkepin/<?php echo $userdetails->MemberId;?>" >

                                <button name="epinstatus" value="1"><img float="right" src="<?php echo base_url().$paymentdetails[$i]->PaymentLogo;?>" width="128px" height="80px"><br></button>
                                </form>
                           </div> -->

                            <?php }  ?>

                            <?php /* elseif($paymentdetails->PaymentName == 'perfectmoney') { ?>

                           <form name="paypalFrm" id="paypalFrm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                               <hr class="hrzntl"/>
                                <input type="hidden" name="cmd" value="_ext-enter">
                                <input type="hidden" name="redirect_cmd" value="_xclick-subscriptions">
                                <input type="hidden" name="return" value="<?php echo base_url();?>">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url();?>">
                                <input type="hidden" name="notify_url" value="<?php echo base_url();?>">
                                <input type="hidden" name="custom" value="<?php echo 'register';?>">
                                <input type="hidden" name="business" value="<?php echo 'merhant';?>">
                                <input type="hidden" name="item_name" value="<?php echo 'ultra';?>">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="a3" value="<?php echo '100';?>">  
                                <input type="hidden" name="p3" value="1">  
                                <input type="hidden" name="t3" value="M">   
                                <input type="hidden" name="src" value="1">
                                <input type="hidden" name="sra" value="1">
                                <input type="hidden" name="srt" value="12">
                                <input type="hidden" name="first_name" value="<?php echo 'arun';?>">
                                <input type="hidden" name="lc" value="<?php echo 'india';?>">
                                <input type="hidden" name="email" value="<?php echo 'arun@gmail.com';?>">
                                <button><img src="<?php echo base_url();?>uploads/payment/paypal.jpg"><br></button>
                                
                            </form>

                            <?php }  */

                           } } 
                      ?>
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
    function PaymentMethod(payment) {
        payment
        var url = '<?php echo base_url();?>payment/'+payment+'/subscription';
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
                // $('a[href=\'#confirm-content\']').trigger('click');
            }
        });
        
    }
</script>
<?php $this->load->view('user/common_script');?>
</html>
