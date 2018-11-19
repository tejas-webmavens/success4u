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
                        <div class="col-lg-12">
                            <br>
                            <?php if($this->session->flashdata('error_message')) { ?>

                            <label class="label label-danger col-lg-9"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
                      
                            <?php unset($_SESSION['error_message']); } ?>
                      
                            <?php if($this->session->flashdata('success_message')) { ?>

                            <label class="label label-success col-lg-9"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
                       
                            <?php unset($_SESSION['success_message']); } ?>
                        </div>
                        <div class="col-xs-8">
                           
                       
                            <h2><?php echo  ucwords($this->lang->line('member')." ".$this->lang->line('to')." ".$this->lang->line('member'));?><span><strong><?php echo ucwords(" ".$this->lang->line('payment'));?></strong></span></h2>
                             <hr class="hrzntl"/>
                            <?php ?>

                            <?php 
                            // print_r($recdetails);
                            $userdetails1 =$this->common_model->GetRow("MemberId='".$userdetails->DirectId."'","arm_members");
                            $admindetails =$this->common_model->GetRow("MemberId='1'","arm_members");
                            $ckip = $this->common_model->GetRowCount("MemberId='".$id."' AND AdminStatus NOT IN ('2','1') AND EntryFor='MTM'","arm_memberpayment");
                              // print_r($userdetails);
                            
                            $mlsetting  = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");


                            if($ckip>0)
                            {
                              $flag=1;
                            } 
                             else{
                              $flag=0;
                             }  
                            if($userdetails->SubscriptionsStatus == 'Free' && $flag == '0'){
                              // echo"<pre>"; print_r($this->data); echo"</pre>";

                                if($mlsetting->MatrixStatus == '1'){ ?>
                                                <form name="memberpayment" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>user/register/mtmpay">
                                    <table>
                                    <tr><td colspan="3" align="left"><h2><?php echo  ucwords($this->lang->line('member')." ".$this->lang->line('payment')." ".$this->lang->line('details'));?></h2></td></tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payto'));?>  </strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $userdetails1->UserName;?></span></td>
                                    </tr>
                                     <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('email'));?></strong> </td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $userdetails1->Email;?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payment')." ".$this->lang->line('amount'));?></strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><strong><?php echo  $CurrencySymbol." ".$packagedetails->PackageFee;?></strong></td>
                                    </tr>
                                     

                                    <?php $cusdata = json_decode($userdetails1->CustomFields); ?>

                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('bitcoin'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php if(isset($cusdata->bitcoin)) { if($cusdata->bitcoin){echo $cusdata->bitcoin;}else{echo"NIL";} } else {echo "NIL";} ?></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paypal'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php  if(isset($cusdata->paypal)) { if($cusdata->paypal){echo $cusdata->paypal;}else{echo"NIL";} } else { echo "NIL"; } ?></td>
                                    </tr>

                                    <td>

                                </table>
                                <hr class="hrzntl"/>
                                    <h3><?php echo ucwords('member Payment Reference Id');?></h3>
                                    <input type="text" name="memberpayid" value="" required>
                                    <h3><?php echo ucwords('member Payment Reference attachment');?></h3>
                                    <input type="file" name="memberfile">
                                    <hr class="hrzntl"/>
                                   
                                    <?php if(isset($packagedetails->AdminFee)) { if($packagedetails->AdminFee>0){?>
                                     <table>
                                    
                                <tr><td colspan="3" align="left"><h2><?php echo  ucwords($this->lang->line('admin')." ".$this->lang->line('payment')." ".$this->lang->line('details'));?></h2></td></tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paytoadmin'));?>  </strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $admindetails->UserName;?></span></td>
                                    </tr>
                                     <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('email'));?></strong> </td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $admindetails->Email;?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payment')." ".$this->lang->line('amount'));?></strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><strong><?php echo  $CurrencySymbol." ".$packagedetails->AdminFee;?></strong></td>
                                    </tr>
                                     

                                    <?php $cusdata = json_decode($admindetails->CustomFields); ?>

                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('bitcoin'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php if(isset($cusdata->bitcoin)) { if($cusdata->bitcoin){echo $cusdata->bitcoin;}else{echo"NIL";} } else {echo "NIL";} ?></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paypal'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php  if(isset($cusdata->paypal)) { if($cusdata->paypal){echo $cusdata->paypal;}else{echo"NIL";} } else { echo "NIL"; } ?></td>
                                    </tr>

                                    <td>

                                </table>
                                <hr class="hrzntl"/> 
                              
                                    <h3><?php echo ucwords('admin Payment Reference Id');?></h3>
                                    <input type="text" name="adminpayid" value="" required>
                                    <h3><?php echo ucwords('admin Payment Reference attachment');?></h3>
                                    <input type="file" name="adminfile">
                                    <?php }  }?>
                                    <input type="hidden" name="adminfee" value="<?php if(isset($packagedetails->AdminFee)) { echo $packagedetails->AdminFee; } ?>">
                                    <input type="hidden" name="packagefee" value="<?php echo  $packagedetails->PackageFee;?>">
                                    <input type="hidden" name="packageid" value="<?php echo  $packagedetails->PackageId;?>">
                                    <input type="hidden" name="memberid" value="<?php echo  $id;?>">
                                    <input type="hidden" name="receiveid" value="<?php echo  $userdetails1->MemberId;?>">
                                    <input type="submit" value="Submit">
                                    </form>
                        <?php        } else{ 
                                ?>
                                
                                <form name="memberpayment" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>user/register/mtmpay">
                                    <table>
                                    <tr><td colspan="3" align="left"><h2><?php echo  ucwords($this->lang->line('member')." ".$this->lang->line('payment')." ".$this->lang->line('details'));?></h2></td></tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payto'));?>  </strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $userdetails->UserName;?></span></td>
                                    </tr>
                                     <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('email'));?></strong> </td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $userdetails->Email;?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payment')." ".$this->lang->line('amount'));?></strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><strong><?php echo  $CurrencySymbol." ".$packagedetails->PackageFee;?></strong></td>
                                    </tr>
                                     

                                    <?php $cusdata = json_decode($userdetails->CustomFields); ?>

                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('bitcoin'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php if(isset($cusdata->bitcoin)) { if($cusdata->bitcoin){echo $cusdata->bitcoin;}else{echo"NIL";} } else {echo "NIL";} ?></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paypal'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php  if(isset($cusdata->paypal)) { if($cusdata->paypal){echo $cusdata->paypal;}else{echo"NIL";} } else { echo "NIL"; } ?></td>
                                    </tr>

                                    <td>

                                </table>
                                <hr class="hrzntl"/>
                                    <h3><?php echo ucwords('member Payment Reference Id');?></h3>
                                    <input type="text" name="memberpayid" value="" required>
                                    <h3><?php echo ucwords('member Payment Reference attachment');?></h3>
                                    <input type="file" name="memberfile">
                                    <hr class="hrzntl"/>
                                   
                                    <?php if(isset($packagedetails->AdminFee)) { if($packagedetails->AdminFee>0){?>
                                     <table>
                                    
                                <tr><td colspan="3" align="left"><h2><?php echo  ucwords($this->lang->line('admin')." ".$this->lang->line('payment')." ".$this->lang->line('details'));?></h2></td></tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paytoadmin'));?>  </strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $admindetails->UserName;?></span></td>
                                    </tr>
                                     <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('email'));?></strong> </td>
                                        <td width="5%">:</td>
                                        <td width="15%"><span><?php echo  $admindetails->Email;?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('payment')." ".$this->lang->line('amount'));?></strong></td>
                                        <td width="5%">:</td>
                                        <td width="15%"><strong><?php echo  $CurrencySymbol." ".$packagedetails->AdminFee;?></strong></td>
                                    </tr>
                                     

                                    <?php $cusdata = json_decode($admindetails->CustomFields); ?>

                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('bitcoin'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php if(isset($cusdata->bitcoin)) { if($cusdata->bitcoin){echo $cusdata->bitcoin;}else{echo"NIL";} } else {echo "NIL";} ?></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><strong><?php echo  ucwords($this->lang->line('paypal'));?></strong></td>
                                         <td width="5%">:</td>
                                         <td width="15%"><?php  if(isset($cusdata->paypal)) { if($cusdata->paypal){echo $cusdata->paypal;}else{echo"NIL";} } else { echo "NIL"; } ?></td>
                                    </tr>

                                    <td>

                                </table>
                                <hr class="hrzntl"/> 
                              
                                    <h3><?php echo ucwords('admin Payment Reference Id');?></h3>
                                    <input type="text" name="adminpayid" value="" required>
                                    <h3><?php echo ucwords('admin Payment Reference attachment');?></h3>
                                    <input type="file" name="adminfile">
                                    <?php }  }?>
                                    <input type="hidden" name="adminfee" value="<?php if(isset($packagedetails->AdminFee)) { echo $packagedetails->AdminFee; } ?>">
                                    <input type="hidden" name="packagefee" value="<?php echo  $packagedetails->PackageFee;?>">
                                    <input type="hidden" name="packageid" value="<?php echo  $packagedetails->PackageId;?>">
                                    <input type="hidden" name="memberid" value="<?php echo  $id;?>">
                                    <input type="hidden" name="receiveid" value="<?php echo  $userdetails1->MemberId;?>">
                                    <input type="submit" value="Submit">
                                    </form>
                                <?php

                                 } }  elseif ($flag == '1') { ?>

                                  <hr class="hrzntl"/>
                                <h3> you are already update member to member payment details wait untill receiver accept it.otherwise, Please contact administrator <a href="<?php echo  base_url();?>login">Back</a></h3>

                                <?php
                                     
                                 } 
                            else{ ?>

                                <hr class="hrzntl"/>
                                <h3> Thank you,You're already paid. Go back to <a href="<?php echo  base_url();?>login">Login</a></h3>
                              <?php } ?>
                        </div>
                        <div class="col-xs-4">
                            <div class="coninfo">
                                <h1>contact <span>info</span></h1>
                                <h3>armcip</h3>
                                <?php echo Siteaddress();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="footer clearfix">
        <div class="col-lg-12">
        <div class="row">
            <div class="bskt">
                <div class="col-lg-3">
                    <h2>quick <span>links</span></h2>
                    <ul>
                        <li><a href="<?php echo  base_url(); ?>user/">home</a></li>            
                        <li><a href="">about us</a></li>              
                        <li><a href="">shop</a></li>             
                        <li><a href="">Opportunity</a></li>              
                        <li><a href="">contact us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h2>quick <span>links</span></h2>
                    <ul>
                        <li><a href="<?php echo  base_url(); ?>user/">home</a></li>            
                        <li><a href="">about us</a></li>              
                        <li><a href="">shop</a></li>             
                        <li><a href="">Opportunity</a></li>              
                        <li><a href="">contact us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h2>quick <span>links</span></h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <input type="text" /><input type="button" value="send"/>
                </div>
                <div class="col-lg-3 text-right"><br /><br />
                    <img src="<?php echo  base_url(); ?>assets/user/img/logo.png" /><br /><br />
                    <p><strong>2016 @ copy rights</strong></p>
                </div>
            </div>
            </div>
        </div>
    </div> 
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
<?php $this->load->view('user/common_script');?>
</html>
