<!DOCTYPE html>
<html>
<?php error_reporting(0); 

//print_r($this->data);

?>
<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <!--  IE8 HTML5 support   -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

    <!--  Customizer  -->
    <?php $this->load->view('admin/customizer');?>
    <!--  /Customizer  -->

    <!--  Body Wrap   -->
    <div id="main">


    <!--  Header   -->
    <?php $this->load->view('admin/topnav');?>
    <!--  /Header   -->

    <!--  Sidebar   -->
    <?php $this->load->view('admin/sidebar');?>

<!--  Main Wrapper  -->
<section id="content_wrapper">

<!--  Topbar Menu Wrapper  -->
    <?php $this->load->view('admin/toper'); ?>
<!--  Content  -->
<section id="content" class="table-layout animated fadeIn">

<!--  Column Left  -->
<aside class="chute chute-left chute290" data-chute-height="match">

<!--  Menu Block  -->
<!--       <div class="allcp-form theme-primary">

<h6 class="mb15">Store Name</h6>

<div class="section mb15">
<label for="store-name" class="field prepend-icon">
<input type="text" name="store-name" id="store-name" class="gui-input"
value="My Store">
<label for="store-name" class="field-icon">
<i class="fa fa-shopping-cart"></i>
</label>
</label>
</div>

<h6 class="mb15">Store URL</h6>

<div class="section mb15">
<label for="store-url" class="field prepend-icon">
<input type="text" name="store-url" id="store-url" class="gui-input"
value="http://yoursite.com/shop">
<label for="store-url" class="field-icon">
<i class="fa fa-link"></i>
</label>
</label>
</div>

<h6 class="mb15">Store Image</h6>

<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-preview thumbnail mb20">
<img data-src="holder.js/100%x100" alt="holder">
</div>
<span class="btn btn-primary light btn-file btn-block ph5">
<span class="fileupload-new">Upload image</span>
<span class="fileupload-exists">Upload image</span>
<input type="file">
</span>
</div>
</div> 

</aside>-->
<!--  /Column Left  -->

<!--  Column Center  -->
<div class="chute chute-center">
 
    <div class="mw1000 center-block">

        <!--  General Information  -->
        <div class="panel mb35">
        <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
            <div class="panel-heading">
                <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_reward')); ?></span>
            </div>
            
            <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } ?>
                                </div>
                                <?php print_r(form_error());?>
            <div class="panel-body br-t">
            
                <div class="allcp-form theme-primary">

                <div class="panel-footer text-right">
                <label for="rewardinfo" ><?//echo ucwords($this->lang->line('rewardinfo')); ?></label>

                </div>

                <div class="section row mb10">
                    <label for="dailyrewardstatus"
                    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('dailyrewardstatus')); ?></label>

                    <div class="col-sm-9 ph10">

                       <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">

                            <input type="radio" <?php if(isset($this->data['dailyrewardstatus'])) {if($this->data['dailyrewardstatus']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="dailyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('on'))?>
                        </label>

                        <label class="col-md-4 block mt15 option option-primary">
                            <input type="radio" <?php if(isset($this->data['dailyrewardstatus'])) {if($this->data['dailyrewardstatus']=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="dailyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                    </div>
                    <label for="dailyrewardstatus" class="field-icon">

                    </label>
                    <?php echo form_error('dailyrewardstatus'); ?>

                </div>
                </div>

<!-- 
                <div class="section row mb10">
                <label for="dailyrewardcommissiontype"
                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('dailyrewardcommissiontype')); ?></label>

                <div class="col-sm-9 ph10">

                   <div class="option-group field">
                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['dailyrewardcommissiontype'])){if($this->data['dailyrewardcommissiontype']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="dailyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('amount'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['dailyrewardcommissiontype'])){if($this->data['dailyrewardcommissiontype']=='2'){ echo "checked='checked'"; } else {echo'';}}?> value='2' name="dailyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('percentage'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['dailyrewardcommissiontype'])){if($this->data['dailyrewardcommissiontype']=='3'){ echo "checked='checked'"; } else {echo'';}}?> value='3' name="dailyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('points'))?>
                    </label>

                </div>
                <label for="dailyrewardcommissiontype" class="field-icon">

                </label>
                <?php echo form_error('dailyrewardcommissiontype'); ?>

            </div>
            </div>
 -->
          
                     <div class="section row mb10" id="dailyReferraldivp">
                        <label for="dailyReferral" class="field-label col-sm-4 ph10  text-left"><?php echo  ucwords($this->lang->line('dailyReferral')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                            <div class="col-sm-3 ph10">
                                          
                                    <input type='button' value='+' id='adddailyButton'  class="btn btn-bordered btn-primary"  />
                                <input type='button' value='-' id='removedailyButton' class="btn btn-bordered btn-primary" />
                            </div>
                             <?php  echo form_error('dailyReferral');
                                print_r(form_error());
                             ?>
                      </div>

                     <div class="section row mb10" id="dailyReferraldivp">
                      <div class="col-sm-7 ph10"></div>
                            <label for="dailyReferral" class="field prepend-icon">
                               
                            </label>
                            

                            <?php

                              $drdetails =explode(",",$this->data['dailyReferral']);

                              
                             for($i=0;$i<count($drdetails);$i++)
                             {
                                $dlvl=$i+1;

                                $drsdetails='';
                                $drsdetails=explode("-",$drdetails[$i]);
                               
                             ?>

                             
                             <div class="section row mb10" id="<?php echo"dailyReferral".$dlvl;?>">
                             <label for="dailyReferral" class="field-label col-sm-3 ph10" ></label>
                             <div class="col-sm-4 ph10" id="<?php echo"dailyReferral".$dlvl;?>">

                                <input type="text" name="dailyReferralcount[]" id="dailyReferralcount[]" placeholder="<?php echo  ucwords($this->lang->line('dailyReferralcount'));echo " ".$dlvl." ". ucwords($this->lang->line('dailyReferralcount1')); ?>"
                                class="gui-input" value="<?php echo $drsdetails[0];?>" >
                            </div>
                            <div class="col-sm-4 ph10" id="<?php echo"dailyReferral".$dlvl;?>">
                                <input type="text" name="dailyReferralcommission[]" id="dailyReferralcommission[]" placeholder="<?php echo  ucwords($this->lang->line('dailyReferralcommission'));echo $dlvl." ". ucwords($this->lang->line('dailyReferralcommission1')); ?>"
                                class="gui-input" value="<?php echo $drsdetails[1];?>" >
                        </div>
                        </div>
                         <?php }?>
                          
                    </div>




                    <div class="section row mb10" id="dailyReferraldiv">
                    </div>

                     <!-- -->

                    <div class="section row mb10">
                    <label for="weeklyrewardstatus"
                    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('weeklyrewardstatus')); ?></label>

                    <div class="col-sm-9 ph10">

                       <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">

                            <input type="radio" <?php if(isset($this->data['weeklyrewardstatus'])) {if($this->data['weeklyrewardstatus']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="weeklyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('on'))?>
                        </label>

                        <label class="col-md-4 block mt15 option option-primary">
                            <input type="radio" <?php if(isset($this->data['weeklyrewardstatus'])) {if($this->data['weeklyrewardstatus']=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="weeklyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                    </div>
                    <label for="weeklyrewardstatus" class="field-icon">

                    </label>
                    <?php echo form_error('weeklyrewardstatus'); ?>

                </div>
                </div>

<!-- 
                <div class="section row mb10">
                <label for="weeklyrewardcommissiontype"
                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('weeklyrewardcommissiontype')); ?></label>

                <div class="col-sm-9 ph10">

                   <div class="option-group field">
                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['weeklyrewardcommissiontype'])){if($this->data['weeklyrewardcommissiontype']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="weeklyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('amount'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['weeklyrewardcommissiontype'])){if($this->data['weeklyrewardcommissiontype']=='2'){ echo "checked='checked'"; } else {echo'';}}?> value='2' name="weeklyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('percentage'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['weeklyrewardcommissiontype'])){if($this->data['weeklyrewardcommissiontype']=='3'){ echo "checked='checked'"; } else {echo'';}}?> value='3' name="weeklyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('points'))?>
                    </label>

                </div>
                <label for="weeklyrewardcommissiontype" class="field-icon">

                </label>
                <?php echo form_error('weeklyrewardcommissiontype'); ?>

            </div>
            </div>
 -->

                    <div class="section row mb10" id="weeklyReferraldivp">
                        <label for="weeklyReferral" class="field-label col-sm-4 ph10  text-left"><?php echo  ucwords($this->lang->line('weeklyReferral')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                            <div class="col-sm-3 ph10">
                                          
                                    <input type='button' value='+' id='addweeklyButton'  class="btn btn-bordered btn-primary"  />
                                <input type='button' value='-' id='removeweeklyButton' class="btn btn-bordered btn-primary" />
                            </div>
                             <?php  echo form_error('weeklyReferral');?>
                      </div>

                     <div class="section row mb10" id="weeklyReferraldivp">
                      <div class="col-sm-7 ph10"></div>
                            <label for="weeklyReferral" class="field prepend-icon">
                               
                            </label>
                            

                            <?php

                              $wrdetails =explode(",",$this->data['weeklyReferral']);

                         
                             for($i=0;$i<count($wrdetails);$i++)
                             {
                                $wlvl=$i+1;
                                $wrsdetails='';
                                $wrsdetails=explode("-",$wrdetails[$i]);
                             ?>
                             <div class="section row mb10" id="<?php echo"weeklyReferral".$plvl;?>">
                             <label for="dailyReferral" class="field-label col-sm-3 ph10" ></label>
                             <div class="col-sm-4 ph10" id="<?php echo"weeklyReferral".$plvl;?>">

                                <input type="text" name="weeklyReferralcount[]" id="weeklyReferralcount[]" placeholder="<?php echo  ucwords($this->lang->line('weeklyReferralcount'))." ".$wlvl; ?>"
                                class="gui-input" value="<?php echo $wrsdetails[0];?>" >
                            </div>
                            <div class="col-sm-4 ph10" id="<?php echo"weeklyReferral".$plvl;?>">
                                <input type="text" name="weeklyReferralcommission[]" id="weeklyReferralcommission[]" placeholder="<?php echo  ucwords($this->lang->line('weeklyReferralcommission'))." ".$wlvl;?>"
                                class="gui-input" value="<?php echo $wrsdetails[1];?>" >
                        </div></div>
                         <?php }?>
                          
                    </div>

                   

                    <div class="section row mb10" id="weeklyReferraldiv">
                    </div>

                    <!-- -->

                    <div class="section row mb10">
                    <label for="monthlyrewardstatus"
                    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('monthlyrewardstatus')); ?></label>

                    <div class="col-sm-9 ph10">

                       <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">

                            <input type="radio" <?php if(isset($this->data['monthlyrewardstatus'])) {if($this->data['monthlyrewardstatus']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="monthlyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('on'))?>
                        </label>

                        <label class="col-md-4 block mt15 option option-primary">
                            <input type="radio" <?php if(isset($this->data['monthlyrewardstatus'])) {if($this->data['monthlyrewardstatus']=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="monthlyrewardstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                    </div>
                    <label for="monthlyrewardstatus" class="field-icon">

                    </label>
                    <?php echo form_error('monthlyrewardstatus'); ?>

                </div>
                </div>

<!-- 
                <div class="section row mb10">
                <label for="monthlyrewardcommissiontype"
                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('monthlyrewardcommissiontype')); ?></label>

                <div class="col-sm-9 ph10">

                   <div class="option-group field">
                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['monthlyrewardcommissiontype'])){if($this->data['monthlyrewardcommissiontype']=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="monthlyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('amount'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['monthlyrewardcommissiontype'])){if($this->data['monthlyrewardcommissiontype']=='2'){ echo "checked='checked'"; } else {echo'';}}?> value='2' name="monthlyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('percentage'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" <?php if(isset($this->data['monthlyrewardcommissiontype'])){if($this->data['monthlyrewardcommissiontype']=='3'){ echo "checked='checked'"; } else {echo'';}}?> value='3' name="monthlyrewardcommissiontype">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('points'))?>
                    </label>

                </div>
                <label for="monthlyrewardcommissiontype" class="field-icon">

                </label>
                <?php echo form_error('monthlyrewardcommissiontype'); ?>

            </div>
            </div>
 -->
            
                    <div class="section row mb10" id="monthlyReferraldivp">
                        <label for="monthlyReferral" class="field-label col-sm-4 ph10  text-left"><?php echo  ucwords($this->lang->line('monthlyReferral')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                            <div class="col-sm-3 ph10">
                                          
                                    <input type='button' value='+' id='addmonthlyButton'  class="btn btn-bordered btn-primary"  />
                                <input type='button' value='-' id='removemonthlyButton' class="btn btn-bordered btn-primary" />
                            </div>
                             <?php  echo form_error('monthlyReferral');?>
                      </div>

                     <div class="section row mb10" id="monthlyReferral">
                      <div class="col-sm-7 ph10"></div>
                            <label for="monthlyReferral" class="field prepend-icon">
                                
                            </label>
                            

                            <?php

                              $mrdetails =explode(",",$this->data['monthlyReferral']);

                         
                             for($i=0;$i<count($mrdetails);$i++)
                             {
                                $mlvl=$i+1;
                                $mrsdetails='';
                                $mrsdetails=explode("-",$mrdetails[$i]);

                             ?>
                             <div class="section row mb10" id="<?php echo"monthlyReferral".$mlvl;?>">
                             <label for="monthlyReferral" class="field-label col-sm-3 ph10" ></label>
                             <div class="col-sm-4 ph10" id="<?php echo"monthlyReferral".$mlvl;?>">

                                <input type="text" name="monthlyReferralcount[]" id="monthlyReferralcount[]" placeholder="<?php echo  ucwords($this->lang->line('monthlyReferralcount'));echo " ".$mlvl." ". ucwords($this->lang->line('dailyReferralcount1')); ?>"
                                class="gui-input" value="<?php echo $mrsdetails[0];?>" >
                            </div>
                            <div class="col-sm-4 ph10" id="<?php echo"monthlyReferral".$mlvl;?>">
                                <input type="text" name="monthlyReferralcommission[]" id="monthlyReferralcommission[]" placeholder="<?php echo  ucwords($this->lang->line('monthlyReferralcommission'));echo $mlvl." ". ucwords($this->lang->line('dailyReferralcommission1')); ?>"
                                class="gui-input" value="<?php echo $mrsdetails[1];?>" >
                        </div></div>
                         <?php }?>
                          
                    </div>

                    

                    <div class="section row mb10" id="monthlyReferraldiv">
                    </div>
                    


                     <div class="panel-footer text-right">
                     
                     <input type="hidden" id="drcount" name="drcount" value="<?php echo count($drdetails);?>">
                     <input type="hidden" id="wrcount" name="wrcount" value="<?php echo count($wrdetails);?>">
                     <input type="hidden" id="mrcount" name="mrcount" value="<?php echo count($mrdetails);?>">
                                <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
<!--                                 <button type="reset" class="btn btn-bordered mb5"><?php echo  ucwords($this->lang->line('cancel')); ?></button>
 -->                            </div>


</div>
</div>

 </form>
 </div> <!-- panel md35 ends-->


</div>
</div>
<!--  /Column Center  -->

</section>
<!--  /Content  -->

</section>

<!--  Sidebar Right  -->
<aside id="sidebar_right" class="nano affix">

<!--  Sidebar Right Content  -->
<div class="sidebar-right-wrapper nano-content">

<div class="sidebar-block br-n p15">

<h6 class="title-divider text-muted mb20"> Visitors Stats
<span class="pull-right"> 2015
<i class="fa fa-caret-down ml5"></i>
</span>
</h6>

<div class="progress mh5">
<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34"
aria-valuemin="0"
aria-valuemax="100" style="width: 34%">
<span class="fs11">New visitors</span>
</div>
</div>
<div class="progress mh5">
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66"
aria-valuemin="0"
aria-valuemax="100" style="width: 66%">
<span class="fs11 text-left">Returnig visitors</span>
</div>
</div>
<div class="progress mh5">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
aria-valuemin="0"
aria-valuemax="100" style="width: 45%">
<span class="fs11 text-left">Orders</span>
</div>
</div>

<h6 class="title-divider text-muted mt30 mb10">New visitors</h6>

<div class="row">
<div class="col-xs-5">
<h3 class="text-primary mn pl5">350</h3>
</div>
<div class="col-xs-7 text-right">
<h3 class="text-warning mn">
<i class="fa fa-caret-down"></i> 15.7% </h3>
</div>
</div>

<h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

<div class="row">
<div class="col-xs-5">
<h3 class="text-primary mn pl5">660</h3>
</div>
<div class="col-xs-7 text-right">
<h3 class="text-success-dark mn">
<i class="fa fa-caret-up"></i> 20.2% </h3>
</div>
</div>

<h6 class="title-divider text-muted mt25 mb10">Orders</h6>

<div class="row">
<div class="col-xs-5">
<h3 class="text-primary mn pl5">153</h3>
</div>
<div class="col-xs-7 text-right">
<h3 class="text-success mn">
<i class="fa fa-caret-up"></i> 5.3% </h3>
</div>
</div>

<h6 class="title-divider text-muted mt40 mb20"> Site Statistics
<span class="pull-right text-primary fw600">Today</span>
</h6>
</div>
</div>
</aside>
<!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer');?>


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

        var counter = 2;

        $("#adddailyButton").click(function () {

           var counter = parseFloat(document.getElementById("drcount").value);
           counter++;
           document.getElementById("drcount").value = counter;

           if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   

        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'dailyReferral' + counter).attr("class", 'section row mb10');

        levelcommissiondiv.after().html('<label for="dailyReferral" class="field-label col-sm-3 ph10" ></label><div class="col-sm-4 ph10 id="dailyReferral'+ counter+'"><input type="text" name="dailyReferralcount[]" placeholder="Daily Referral Count '+ counter+'" id="dailyReferralcount'+ counter+'" value="" class="gui-input" ></div><div class="col-sm-4 ph10 id="dailyReferral'+ counter+'"><input type="text" name="dailyReferralcommission[]" placeholder="Daily Referral Commission '+ counter+'" id="dailyReferralcommission'+ counter+'" value="" class="gui-input" ></div>');

        levelcommissiondiv.appendTo("#dailyReferraldiv");


        counter++;
    });

        $("#removedailyButton").click(function () {
           var counter = parseFloat(document.getElementById("drcount").value);
           if(counter==1){
              alert("No more textbox to remove");
              return false;
          }   


          $("#dailyReferral" + counter).remove();
          counter--;
          document.getElementById("drcount").value = counter;

      });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
              msg += "\n dailyReferraldiv #" + i + $('#dailyReferraldiv' + i).val();
          }
          alert(msg);
      });
    });

    $(document).ready(function(){

        var counter = 2;

        $("#addweeklyButton").click(function () {

           var counter = parseFloat(document.getElementById("wrcount").value);
           counter++;
           document.getElementById("wrcount").value = counter;

           if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   

        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'weeklyReferral' + counter).attr("class", 'section row mb10');

        levelcommissiondiv.after().html('<label for="weeklyReferral" class="field-label col-sm-3 ph10" ></label><div class="col-sm-4 ph10 id="weeklyReferral'+ counter+'"><input type="text" name="weeklyReferralcount[]" placeholder="Weekly Referral Count '+ counter+'" id="weeklyReferralcount'+ counter+'" value="" class="gui-input" ></div><div class="col-sm-4 ph10 id="weeklyReferral'+ counter+'"><input type="text" name="weeklyReferralcommission[]" placeholder="Weekly Referral Commission '+ counter+'" id="weeklyReferralcommission'+ counter+'" value="" class="gui-input" ></div>');

        levelcommissiondiv.appendTo("#weeklyReferraldiv");


        counter++;
    });

        $("#removeweeklyButton").click(function () {
           var counter = parseFloat(document.getElementById("wrcount").value);
           if(counter==1){
              alert("No more textbox to remove");
              return false;
          }   


          $("#weeklyReferral" + counter).remove();
          counter--;
          document.getElementById("wrcount").value = counter;

      });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
              msg += "\n weeklyReferraldiv #" + i + $('#weeklyReferraldiv' + i).val();
          }
          alert(msg);
      });
    });

    $(document).ready(function(){

        var counter = 2;

        $("#addmonthlyButton").click(function () {

           var counter = parseFloat(document.getElementById("mrcount").value);
           counter++;
           document.getElementById("mrcount").value = counter;

           if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   

        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'monthlyReferral' + counter).attr("class", 'section row mb10');

        levelcommissiondiv.after().html('<label for="monthlyReferral" class="field-label col-sm-3 ph10" ></label><div class="col-sm-4 ph10 id="monthlyReferral'+ counter+'"><input type="text" name="monthlyReferralcount[]" placeholder="Monthly Referral Count '+ counter+'" id="monthlyReferralcount'+ counter+'" value="" class="gui-input" ></div><div class="col-sm-4 ph10 id="monthlyReferral'+ counter+'"><input type="text" name="monthlyReferralcommission[]" placeholder="Monthly Referral Commission '+ counter+'" id="monthlyReferralcommission'+ counter+'" value="" class="gui-input" ></div>');

        levelcommissiondiv.appendTo("#monthlyReferraldiv");


        counter++;
    });

        $("#removemonthlyButton").click(function () {
           var counter = parseFloat(document.getElementById("mrcount").value);
           if(counter==1){
              alert("No more textbox to remove");
              return false;
          }   


          $("#monthlyReferral" + counter).remove();
          counter--;
          document.getElementById("mrcount").value = counter;

      });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
              msg += "\n monthlyReferraldiv #" + i + $('#monthlyReferraldiv' + i).val();
          }
          alert(msg);
      });
    });



</script>
 
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // "use strict";
        // // Init Theme Core
        // Core.init();

        // // Init Demo JS
        // Demo.init();

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#allcp-form").validate({

            // States
          

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                
               
               /* smtppassword: {
                    required:true,
                    extension: "jpg|png|gif|jpeg"
                }
                
                smtphost: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                }*/
            },

            // error message
            messages: {
               /*
                smtppassword: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                    
                },
                smtphost: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     url: '<?php echo ucwords($this->lang->line('errorurl')); ?>'
                }*/
                
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
</script>                                                                                                                                                                                                                       <!--  /Scripts  -->

</body>

</html>
