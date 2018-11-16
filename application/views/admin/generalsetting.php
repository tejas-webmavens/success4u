<!DOCTYPE html>
<html>

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


</head>

<body class="sales-stats-page">

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

<!--  /Column Left  -->

<!--  Column Center  -->
<div class="chute chute-center">
 
    <div class="mw1000 center-block">

        <!--  General Information  -->
        <div class="panel mb35">
        <form method="post" action="<?php echo base_url(); ?>admin/Sitesetting/settings" id="allcp-form" enctype="multipart/form-data">
            <div class="panel-heading">
                <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle')); ?></span>
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
            <div class="panel-body br-t">
            
                <div class="allcp-form theme-primary">
                    <div class="section row mb10">
                        <label for="sitename" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('sitename')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitename" class="field prepend-icon">
                                <input type="text" name="sitename" id="sitename" placeholder="<?php echo  ucwords($this->lang->line('sitename')); ?>"
                                class="gui-input" value="<?php echo set_value('sitename', isset($this->data['sitename']) ? $this->data['sitename'] : '');?>" >
                                <label for="sitename" class="field-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitename')); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="siteurl"
                        class="field-label col-sm-3 ph10 text-left"> <?php echo  ucwords($this->lang->line('siteurl')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="siteurl" class="field prepend-icon">
                                <input type="text" name="siteurl" id="siteurl"
                                class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('sitename')); ?>"
                                value="<?php echo set_value('siteurl', isset($this->data['siteurl']) ? $this->data['siteurl'] : '');?>">
                                <label for="siteurl" class="field-icon">
                                    <i class="fa fa-link"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('siteurl')); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="store-email"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('adminmailid')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="adminmailid" class="field prepend-icon">
                                <input type="text" name="adminmailid" id="adminmailid"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('adminmailid')); ?>"
                                value="<?php echo set_value('adminmailid', isset($this->data['adminmailid']) ? $this->data['adminmailid'] : '');?>">
                                <label for="adminmailid" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('adminmailid')); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="sitemetatitle"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitemetatitle')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitemetatitle" class="field prepend-icon">
                                <input type="text" name="sitemetatitle" id="sitemetatitle"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('sitemetatitle')); ?>"
                                value="<?php echo set_value('sitemetatitle', isset($this->data['sitemetatitle']) ? $this->data['sitemetatitle'] : '');?>">
                                <label for="sitemetatitle" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitemetatitle')); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="sitemetakeyword"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitemetakeyword')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitemetakeyword" class="field prepend-icon">
                                <input type="text" name="sitemetakeyword" id="sitemetakeyword"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('sitemetakeyword')); ?>"
                                value="<?php echo set_value('sitemetakeyword', isset($this->data['sitemetakeyword']) ? $this->data['sitemetakeyword'] : '');?>">
                                <label for="sitemetakeyword" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitemetakeyword')); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="sitemetadescription"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitemetadescription')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitemetadescription" class="field prepend-icon">
                                <input type="text" name="sitemetadescription" id="sitemetadescription"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('sitemetadescription')); ?>"
                                value="<?php echo set_value('sitemetadescription', isset($this->data['sitemetadescription']) ? $this->data['sitemetadescription'] : '');?>">
                                <label for="sitemetadescription" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitemetadescription')); ?>
                        </div>
                    </div>

                    


                    <div class="section row mb10">
                        <label for="sitestatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitestatus')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['sitestatus'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="sitestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['sitestatus']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="sitestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="sitestatus" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('sitestatus')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="allowpicture"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('allowpicture')); ?></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['allowpicture'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="allowpicture">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['allowpicture']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="allowpicture">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>

                        </div>
                                <label for="allowpicture" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('allowpicture')); ?>
                        </div>
                    </div>




                    <div class="section row mb10">
                        <label for="emailapproval"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('emailapproval')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['emailapproval'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="emailapproval">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['emailapproval']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="emailapproval">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="emailapproval" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('emailapproval')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="mobileapproval"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('mobileapproval')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                     <div class="col-sm-8 ph10">
                        
                        
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['mobileapproval'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="mobileapproval">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['mobileapproval']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="mobileapproval">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="mobileapproval" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('mobileapproval')); ?>
                     </div>
                    </div>


                    <div class="section row mb10">
                        <label for="usecaptcha"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('usecaptcha')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['usecaptcha'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="usecaptcha">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio"  <?php if($this->data['usecaptcha']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="usecaptcha">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="usecaptcha" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('usecaptcha')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="allowregistration"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('allowregistration')); ?></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['allowregistration'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="allowregistration">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['allowregistration']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="allowregistration">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="allowregistration" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('allowregistration')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="allowlogin"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('allowlogin')); ?></label>

                        <div class="col-sm-8 ph10">
                             
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['allowlogin'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="allowlogin">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['allowlogin']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="allowlogin">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="allowlogin" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('allowlogin')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="uniqueip"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('uniqueip')); ?></label>

                        <div class="col-sm-8 ph10">
                             
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['uniqueip'])){if($this->data['uniqueip']=='On'){ echo "checked='checked'";}else {echo'';}}?> value='On' name="uniqueip">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['uniqueip'])){if($this->data['uniqueip']=='Off') { echo "checked='checked'"; } else {echo'';}}?> value='Off' name="uniqueip">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="uniqueip" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('uniqueip')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="uniquemobile"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('uniquemobile')); ?></label>

                        <div class="col-sm-8 ph10">
                             
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['uniquemobile'])=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="uniquemobile">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['uniquemobile']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="uniquemobile">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="uniquemobile" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('uniquemobile')); ?>
                        </div>
                    </div>


                     <div class="section row mb10">
                        <label for="defaultsponsors"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('defaultsponsors')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                       
                        <div class="col-sm-8 ph10">
                        <label for="defaultsponsors" class="field select">
                            <select id="defaultsponsors" name="defaultsponsors">
                            <option value=""><?php echo  ucwords($this->lang->line('choose')); ?></option>
                            <?php
                           foreach ($this->data['sponsorslist'] as $key => $value) 
                        { ?>
                            

                            <option value="<?php echo $this->data['sponsorslist'][$key]->MemberId;?>" <?php if(($this->data['defaultsponsors']) == $this->data['sponsorslist'][$key]->MemberId) { echo "selected='selected'";} ?> ><?php echo  ucwords($this->data['sponsorslist'][$key]->UserName)?></option>
                       <?php } ?>
                             

                            ?>
                                                </select>
                                            <i class="arrow double"></i>
                                       </label>

                                <label for="defaultsponsors" class="field-icon">
                                    <i class="fa "></i>
                                </label>
                            <?php echo ucwords(form_error('defaultsponsors')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="referrallink"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('referrallink')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                       
                        <div class="col-sm-8 ph10">
                        <label for="referrallink" class="field select">
                            <select id="referrallink" name="referrallink">
                            <option value=""><?php echo  ucwords($this->lang->line('choose')); ?></option>
                           
                            <option value="1" <?php if(($this->data['referrallink']) == 1) { echo "selected='selected'";} ?> ><?php echo  'https://referral.siteurl.com'; ?></option>
                            <option value="2" <?php if(($this->data['referrallink']) == 2) { echo "selected='selected'";} ?> ><?php echo  'https://siteurl.com/?ref=referral'; ?></option>
                       
                                                </select>
                                            <i class="arrow double"></i>
                                       </label>

                                <label for="referrallink" class="field-icon">
                                    <i class="fa "></i>
                                </label>
                            <?php echo ucwords(form_error('referrallink')); ?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="allowusers"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('allowusers')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                        
                        
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if($this->data['allowusers']=='On'){ echo "checked='checked'";}else {echo'';}?> value='On' name="allowusers">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['allowusers']=='Off') { echo "checked='checked'"; } else {echo'';}?> value='Off' name="allowusers">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="allowusers" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('allowusers')); ?>
                        </div>
                    </div>


                     




                     <div class="section row mb10">
                        <label for="sitegooglecode"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitegooglecode')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitegooglecode" class="field prepend-icon">
                                
                                <textarea class="gui-textarea" id="sitegooglecode-desc" name="sitegooglecode"
                                  placeholder="<?php echo  ucwords($this->lang->line('sitegooglecode')); ?>"><?php echo urldecode(set_value('sitegooglecode', isset($this->data['sitegooglecode']) ? $this->data['sitegooglecode'] : ''));?></textarea>
                                <label for="sitegooglecode" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitegooglecode')); ?>
                        </div>
                    </div>

                     <div class="section row mb10">
                        <label for="footercontent"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('footercontent')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="footercontent" class="field prepend-icon">
                                <input type="text" name="footercontent" id="footercontent"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('footercontent')); ?>"
                                value="<?php echo set_value('footercontent', isset($this->data['footercontent']) ? $this->data['footercontent'] : '');?>">
                                <label for="footercontent" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('footercontent')); ?>
                        </div>
                    </div>
                     <div class="section row mb10">
                        <label for="footercontent"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('address')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="address" class="field prepend-icon">
                                <textarea class="gui-textarea ckeditor basic" name="address" id="address" ><?php echo set_value('address', isset($this->data['address']) ? $this->data['address'] : '');?></textarea>
                                <label for="address" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('address')); ?>
                        </div>
                    </div>


                     <div class="section row mb10">
                        <label for="footercontent"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('content')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="address" class="field prepend-icon">
                                <textarea class="gui-textarea ckeditor basic" name="content" id="content" ><?php echo set_value('content', isset($this->data['content']) ? $this->data['content'] : '');?></textarea>
                                <label for="address" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                            <!-- <?php echo ucwords(form_error('address')); ?> -->
                        </div>
                    </div>



                    <hr class="short alt">
                    

                    <h6 class="mb15"><?php echo  ucwords($this->lang->line('sitelogo')); ?></h6>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail mb20">
                            <img src="../<?php if(isset($this->data['sitelogo'])){echo $this->data['sitelogo'];}?>" alt="holder">
                        </div>
                        <span class="btn btn-primary light btn-file btn-block ph5">
                            <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <input type="file"  name="sitelogo"  value="if(isset($this->data['sitelogo'])){echo $this->data['sitelogo'];}?>">
                        </span>
                        <?php echo ucwords(form_error('sitelogo')); ?>
                    </div>
                     

                 
                     <div class="panel-footer text-right mt10">
                                <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
                         </div>


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

 <script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>
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
                sitename: {
                    required: true
                },
                siteurl: {
                    required: true,
                    url:true
                },
                adminmailid: {
                    required: true,
                    email: true
                },
                sitemetatitle: {
                    required: true
                },
                sitemetakeyword: {
                    required: true
                },
                sitemetadescription: {
                    required: true
                },
                sitestatus: {
                    required: true
                },
                sitegooglecode: {
                    required: true
                },
                terms: {
                    required: true
                },
                allowpicture: {
                    required: true
                },
                emailapproval: {
                    required: true
                },
                mobileapproval: {
                    required: true
                },
                usecaptcha: {
                    required: true
                },
                allowlogin: {
                    required: true
                },
                uniqueip: {
                    required: true
                },
                uniqueemailid: {
                    required: true
                },
                uniquemobile: {
                    required: true
                },
                allowusers: {
                    required: true
                },
                defaultsponsors: {
                    required: true
                },
                referrallink: {
                    required: true
                },
                sitelogo: {
                    extension: 'jpg|png|gif|jpeg'
                }
               
            },

            // error message
            messages: {
                sitename: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                siteurl: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    url: '<?php echo ucwords($this->lang->line('errorurl')); ?>'
                },
                adminmailid: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    email: '<?php echo ucwords($this->lang->line('erroremail')); ?>'
                },
                sitemetatitle: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sitemetatitle: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sitemetadescription: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sitestatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sitegooglecode: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                terms: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sitelogo: {
                    extension: '<?php echo ucwords($this->lang->line('errorextension')); ?>'
                },
                allowpicture: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                emailapproval: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                mobileapproval: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                usecaptcha: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                allowlogin: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                uniqueip: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                uniqueemailid: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                uniquemobile: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                allowusers: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                defaultsponsors: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                referrallink: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
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
</script>                                                                                                                                                                                                                       <!--  /Scripts  -->

</body>

</html>
