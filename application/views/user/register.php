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
                    <h1><?php echo $this->lang->line('registrationform');?></h1>
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
                      <h1><?php echo $this->lang->line('registration');?> <span><?php echo $this->lang->line('form');?></span></h1>
                    </div>
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
                      <?php //echo "6".random_string('numeric', 9);?>                   
                      <form method="post" action="" id="form-register" name="registerform">
                        <div class="col-lg-7">
                                           <?php 
                              $mlsetting   = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                              if($mlsetting->Id==9) {
                                $package="Plan 0"
                            ?>

                           <div class="">
                            
                              <h2><?php echo $this->lang->line('membershippackage');?></h2>
                              <hr width="100%" size="1" nosade="">

                                 <input type="text" name="Package" id="Package" class="gui-input" placeholder="" disabled="" value="<?php echo $package;?>" >
                            
              
                            </div>
                            <?php } else{?>
                            <div class="">

                              <h2><?php echo $this->lang->line('membershippackage');?></h2>
                              <hr width="100%" size="1" nosade="">
                              <h3><?php echo  ucwords($this->lang->line('selectpackage'));?><sup> <em class="state-error">*</em> </sup></h3> 
                              <select id="PackageId" name="PackageId" class="field select" required>
                                <option value="" selected="selected"><?php echo $this->lang->line('selectpackage');?></option>
                                <?php foreach($package as $prows) { ?>
                                <option value="<?php echo $prows->PackageId;?>" <?php if($prows->PackageId == set_value('PackageId')) { echo"selected";} ?> ><?php echo $prows->PackageName;?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                              <h4> <?php echo form_error('PackageId','<em class="state-error">','</em>');?></h4>
                            </div>
                            <?}?>
                                 <?php 
                              $mlsetting   = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                              if($mlsetting->Id==9) {
                               
                            ?>

                            <div class="">
                              <h2><?php echo $this->lang->line('sponsordetails');?></h2>
                              <hr width="100%" size="1" nosade="">
                              <h3><?php echo  ucwords($this->lang->line('sponsorreferralname'));?><sup> <em class="state-error">*</em> </sup></h3>
                              <input type="text" name="SponsorName" id="SponsorName" class="gui-input" placeholder="Enter SponsorName" value="<?php echo set_value('SponsorName',isset($SponsorName)? $SponsorName : '');?>" disabled>
                              <h4> <?php echo form_error('SponsorName','<em class="state-error">','</em>');?></h4>
                            </div>
                            <?}else{?>

                                                        <div class="">
                              <h2><?php echo $this->lang->line('sponsordetails');?></h2>
                              <hr width="100%" size="1" nosade="">
                              <h3><?php echo  ucwords($this->lang->line('sponsorreferralname'));?><sup> <em class="state-error">*</em> </sup></h3>
                              <input type="text" name="SponsorName" id="SponsorName" class="gui-input" placeholder="Enter SponsorName" value="<?php echo set_value('SponsorName',isset($SponsorName)? $SponsorName : '');?>" required>
                              <h4> <?php echo form_error('SponsorName','<em class="state-error">','</em>');?></h4>
                            </div>
                            <?}?>

                           <div class="">
                            <?php 
                              $mlsetting   = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                              if($mlsetting->Id==4 && $mlsetting->MatrixUpline==1) {
                            ?>

                            <div class="">
                              <h2><?php echo $this->lang->line('uplinedetails');?></h2>
                              <hr width="100%" size="1" nosade="">
                              <h3><?php echo  ucwords($this->lang->line('place_uplineid'));?><sup> <em class="state-error">*</em> </sup></h3>
                              <input type="text" name="uplineid" id="uplineid" class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('place_uplineid'));?>" value="<?php echo set_value('uplineid',isset($SponsorName)? $SponsorName : '');?>" required>
                              <h4> <?php echo form_error('uplineid');?></h4>
                            </div>
                            <?php 
                                } 
                            ?>

                            <?php 
                              $mlsetting   = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                              if($mlsetting->Id==9 && $mlsetting->MatrixUpline==1) {
                            ?>

                            <div class="">
                              <h2><?php echo $this->lang->line('uplinedetails');?></h2>
                              <hr width="100%" size="1" nosade="">
                              <h3><?php echo  ucwords($this->lang->line('place_uplineid'));?><sup> <em class="state-error">*</em> </sup></h3>
                              <input type="text" name="uplineid" id="uplineid" class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('place_uplineid'));?>" value="<?php echo set_value('uplineid',isset($SponsorName)? $SponsorName : '');?>" required>
                              <h4> <?php echo form_error('uplineid');?></h4>
                            </div>
                            <?php 
                                } 
                            ?>

                            <?php 
                              if($mlsetting->Id==4 && $mlsetting->Position==1) { 
                            ?>
                              <div class="">
                                <h2><?php echo $this->lang->line('selectposition');?></h2>
                                <hr width="100%" size="1" nosade="">
                                <h3><?php echo  ucwords($this->lang->line('selectposition'));?><sup> <em class="state-error">*</em> </sup></h3> 
                                <select id="position" name="position" class="field select" required>
                                  <option value="" selected="selected"><?php echo $this->lang->line('selectposition');?></option>
                                  <option value="Left" <?php if(set_value('position', isset($position) ? $position : '')=='Left') echo 'selected'; ?> ><?php echo ucfirst($this->lang->line('lbl_left'));?></option>
                                  <option value="Right" <?php if(set_value('position', isset($position) ? $position : '')=='Right') echo 'selected'; ?> ><?php echo ucfirst($this->lang->line('lbl_right'));?></option>
                                </select>
                                <h4> <?php echo form_error('position');?></h4>
                              </div>
                             <?php } ?>

                              <?php 
                              if($mlsetting->Id==9 && $mlsetting->Position==1) { 
                            ?>
                              <div class="">
                                <h2><?php echo $this->lang->line('selectposition');?></h2>
                                <hr width="100%" size="1" nosade="">
                                <h3><?php echo  ucwords($this->lang->line('selectposition'));?><sup> <em class="state-error">*</em> </sup></h3> 
                                <select id="position" name="position" class="field select" required>
                                  <option value="" selected="selected"><?php echo $this->lang->line('selectposition');?></option>
                                  <option value="Left" <?php if(set_value('position', isset($position) ? $position : '')=='Left') echo 'selected'; ?> ><?php echo ucfirst($this->lang->line('lbl_left'));?></option>
                                  <option value="Right" <?php if(set_value('position', isset($position) ? $position : '')=='Right') echo 'selected'; ?> ><?php echo ucfirst($this->lang->line('lbl_right'));?></option>
                                </select>
                                <h4> <?php echo form_error('position');?></h4>
                              </div>
                             <?php } ?>
                             </div>






                              <div class="">
                                <h2><?php echo ucwords($this->lang->line('memberaccessinformation'));?></h2>
                                <hr width="100%" size="1" nosade="">
    							              <h4> <?php echo form_error('IP');?></h4>
                                <?php
                                foreach ($requirefields as $row) {
                                    if($row->FieldEnableStatus==1 && $row->ReuireFieldName!='Password' && $row->ReuireFieldName!='Email' && $row->ReuireFieldName!='Country'  && $row->ReuireFieldName!='Gender')
                                    {
                                        ?>

                                        <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                        
                                        <input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input " placeholder="<?php echo  ($this->lang->line('place_'.$row->ReuireFieldName)) ? $this->lang->line('place_'.$row->ReuireFieldName) : $row->ReuireFieldName; ?>" value="<?php echo  set_value($row->ReuireFieldName); ?>" <?php echo  $st;?> >
                                       
                                        <h4><?php echo form_error($row->ReuireFieldName,'<em class="state-error">','</em>'); ?></h4>
                                        <?php
                                        $st='';
                                    }

                                    elseif ($row->ReuireFieldName=='Password') {   ?>
                                    <?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>
                                        <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                    
                                    <input type="password" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input" placeholder="<?php echo  $this->lang->line('place_'.$row->ReuireFieldName); ?>" value="" <?php echo  $st;?>>
                                    <h4><?php echo form_error($row->ReuireFieldName,'<em class="state-error">','</em>'); ?></h4>

                                        <h3><?php echo  ucwords(($this->lang->line('lbl_re_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_re_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                    

                                    <input type="password" name="RepeatPassword" id="RepeatPassword" class="gui-input" placeholder="<?php echo  $this->lang->line('place_re_'.$row->ReuireFieldName); ?>" value="" <?php echo  $st;?>>
                                    <h4><?php echo form_error('RepeatPassword','<em class="state-error">','</em>'); ?></h4>

                                    <?php $st=''; } 

                                    elseif ($row->ReuireFieldName=='Email') {   ?>
                                    <?php if($row->ReuireFieldStatus=='1') {$st = 'email required';}else{$st="";}?>
                                        <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                    <input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input" placeholder="<?php echo  $this->lang->line('place_'.$row->ReuireFieldName); ?>" value="<?php echo set_value($row->ReuireFieldName); ?>" <?php echo  $st;?>>
                                    <h4><?php echo form_error($row->ReuireFieldName,'<em class="state-error">','</em>'); ?></h4>
                                    <?php $st=''; }

                                    elseif($row->ReuireFieldName=='Country') { 

                                      if($row->ReuireFieldStatus=='1') {
                                        $st = 'required';}else{$st="";
                                      } 
                                    ?>
                                        <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                    <select id="Country" name="Country" class="field select" <?php echo  $st;?> >
                                      <option value="" selected="selected"><?php echo $this->lang->line('selectcountry');?></option>
                                      <?php
                                        foreach($country as $crows) { 
                                      ?>
                                      <option value="<?php echo $crows->country_id;?>" <?php if($crows->country_id == set_value('Country')) { echo"selected";}?> ><?php echo $crows->name;?></option>
                                      <?php } ?>
                                    </select>
                                    <h4><?php echo form_error('Country','<em class="state-error">','</em>'); ?></h4>
                              <?php }
                                elseif($row->ReuireFieldName=='Gender') { 

                                      if($row->ReuireFieldStatus=='1') {
                                        $st = 'required';}else{$st="";
                                      } 
                                    ?>
                                        <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>
                                    <select id="Gender" name="Gender" class="field select" <?php echo  $st;?> >
                                      <option value="" selected="selected"><?php echo $this->lang->line("choose"); ?></option>
                                      <option value="Male" <?php if('Male'== set_value('Gender')) { echo"selected";}?>> <?php echo ucfirst($this->lang->line('lbl_male'));?></option>
                                      <option value="Female" <?php if('Female'== set_value('Gender')) { echo"selected";}?> > <?php echo ucfirst($this->lang->line('lbl_female'));?></option>
                                    </select>
                                    <h4><?php echo form_error('Gender','<em class="state-error">','</em>'); ?></h4>
                              <?php }
                              } ?>
                              <?php   
                                $captchaset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='usecaptcha'", "arm_setting");

                                if($captchaset->ContentValue=="On") {
                                  $sitekey = $this->common_model->GetRow("Page='reCaptcha' AND KeyValue='siteKey'", "arm_setting");
                                  if ($sitekey->ContentValue) {
                                   
                              ?>
                                  <h3><?php echo ucwords($captchaset->KeyValue);?><sup> <em class="state-error">*</em> </sup></h3>
                                  <div class="g-recaptcha" data-sitekey="<?php echo $sitekey->ContentValue;?>" style="padding-left: 40px;"></div>
                                  <h4><?php echo form_error('g-recaptcha-response','<em class="state-error">','</em>'); ?></h4>
                                    
                              <?php 
                                 } }
                              ?>

                              <h3><input type="checkbox" name="terms" <?php if(set_value('terms')){ echo"checked='checked'";} ?> /> <?php echo  $this->lang->line('terms');?></h3>
                               <h4> <?php echo form_error('terms','<em class="state-error">','</em>'); ?></h4>
                      <?php
                      if($mlsetting->Id==9)
                      {
                        ?>
                               <input type="hidden" name="SponsorName" id="SponsorName" class="gui-input" placeholder="Enter SponsorName"  value="<?php echo set_value('SponsorName',isset($SponsorName)? $SponsorName : '');?>" >

                      <?}  ?>
                              <input type="submit" name="reg" value="Register Now"/> 
                          </div>

                          </div>
                          
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


<?php $this->load->view('user/common_script');?>
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>
