<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<div class="wrapper">
        <?php $this->load->view('user/user_header');?>
        <?php $this->load->view('user/user_aside');?>
        
                        
        <div class="content-wrapper">
                <section class="content">
                        <!-- <section class="content-header">
                                <ol class="breadcrumb">
                                        <li><a href="<?php echo  base_url().'user';?>"> <i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                                        <li><a href="#"> <i class="fa fa-database"></i> INNER PAGE</a></li>
                                        <li class="active"> <i class="fa fa-dedent"></i> INNER INNER PAGE</li>
                                </ol>
                        </section> -->
                        <?php $this->load->view('user/pagelink');?>
                        <?php $this->load->view('user/userinfo');?>

                        <!-- //starts -->

                        <div class="row">
                                <div class="col-md-12">
                                        <div class="box">
                                                <div class="box-header with-border">
                                                        <h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle'));?></h3>
                                                        <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                </div>
                                                <div class="box-body">
                                                        <div class="row">
                                                                <div class="prfle">

                                                                        <!-- <div class="col-md-6">
                                                                                <div class="col-md-6"> <img src="img/dshusr.png" class="img-responsive" /> </div>
                                                                                <div class="col-md-6">
                                                                                        <p class="nme-hdbg">Default Profile Icon</p>
                                                                                        <p>Lorem Lipsum dummy texthere liskgps ds Lorem Lipsum dummy texthere liskgps </p>
                                                                                        <input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                                                                                        <label for="file"><strong>Browse</strong></label>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <div class="dshfrom">
                                                                                        <h3>Username</h3>
                                                                                        <input type="text">
                                                                                        <h4>error info here *</h4>
                                                                                        <h3>Username</h3>
                                                                                        <input type="text">
                                                                                        <h4>error info here *</h4>
                                                                                </div>
                                                                        </div> -->
                                                                        <div class="col-lg-12">
                                                                        
                                                                            

                                                                            <?php if($this->session->flashdata('error_message')) { ?>    
                                                                                
                                                                                    <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
                                                                            
                                                                            <?php unset($_SESSION['error_message']); } ?>
                                                                            
                                                                            <?php if($this->session->flashdata('success_message')) { ?>    
                                                                                
                                                                                    <label class="label label-success col-lg-12"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
                                                                             
                                                                            <?php unset($_SESSION['success_message']); } ?>
                                                                        </div>

                                                                        <div class="col-md-6">

                                                                            <?php       if($paymentdetails->PaymentName=='paypal')
                                                                                    {
                                                                                        if($paymentdetails->PaymentMode == 0)
                                                                                        {
                                                                    

                                                                                            $paymemturl=$paymentdetails->PaymentTestUrl;
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $paymemturl=$paymentdetails->PaymentLiveUrl;
                                                                                        }
                                                                                        $ddata = array("page"=>'upgrade',"payby"=>"paypal");
                                                                                        $customdata = json_encode($ddata);
                                                                                    ?>
                                                                                    <div style="float: left;">
                                                                               <form name="paypalFrm" id="paypalFrm" action="<?php echo $paymemturl;?>" method="post" >
                                                                                   <div class="dshfrom">
                                                                                    <input type="hidden" name="cmd" value="_xclick">
                                                                                    <input type="hidden" name="return" value="<?php echo base_url();?>user/upgrade/paymentsuccess">
                                                                                    <input type="hidden" name="cancel_return" value="<?php echo base_url();?>user/">
                                                                                    <input type="hidden" name="notify_url" value="<?php echo base_url();?>user/upgrade">
                                                                                    <input type="hidden" name="custom" value="<?php echo 'upgrade,paypal,'.$userdetails->MemberId;?>">
                                                                                    <input type="hidden" name="business" value="<?php echo $paymentdetails->PaymentMerchantId;?>">
                                                                                    <input type="hidden" name="item_name" value="<?php echo $packages->PackageName;?>">
                                                                                    <input type="hidden" name="item_number" value="<?php echo $packages->PackageId;?>">
                                                                                    <input type="hidden" name="amount" value="<?php echo $packages->PackageFee;?>">
                                                                                    <input type="hidden" name="currency_code" value="USD">
                                                                                    <input type="hidden" name="username" value="<?php echo $userdetails->UserName;?>">
                                                                                   
                                                                                    <button><img float="left" src="<?php echo base_url().$paymentdetails->PaymentLogo;?>"><br></button>
                                                                                    </div>
                                                                                </form>
                                                                                    </div>
                                                                                <?php }  ?>

                                                                                <?php if($paymentdetails->PaymentName =='bitcoin')
                                                                                {
                                                                                        echo $this->lang->line('bitmsg');
                                                                                }
                                                                                
                                                                                if($paymentdetails->PaymentName =='epin')
                                                                                {
                                                                                        $ddata = array("page"=>'upgrade',"payby"=>"epin");
                                                                                        $customdata = json_encode($ddata);
                                                                                    ?>

                                                                                  <div style="float: left;">
                                                                                  <form action="<?php echo base_url()?>user/upgrade/checkepin/<?php echo $userdetails->MemberId;?>" id="form-register" name="registerform" class="form" method="post">
                                                                                     <div class="dshfrom">
                                                                                     <h3><?php echo  ucwords($this->lang->line('epincode'));?> <sup><em class="state-error1">*</em></sup></h3>
                                                                                   <input type="text" name="epincode" required >
                                                                                   <input type="hidden" name="check" value="check">
                                                                                   <input type="hidden" name="package" value="<?php echo $packages->PackageId?>">
                                                                                  <input type="submit" value="<?php echo  ucwords($this->lang->line('upgradenow')); ?>"/>
                                                                                   </div>
                                                                                    </form>
                                                                               </div>

                                                                                <?php }  ?>
                                                                          </div>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="box-footer">
                                                        <div class="row">
                                                                <div class="col-md-12">
                                                                        <div class="dshfrom text-center">
                                                                                <!-- //<input type="button" value="update now" /> -->
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>

                
                        
                </section>
                <div class="control-sidebar-bg"></div>
        </div>
</div>
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--<script src="plugins/fastclick/fastclick.min.js"></script>-->
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>

<!--    <script src="js/js/demo.js"></script>-->





</body>
</html>

                      
                       

                           