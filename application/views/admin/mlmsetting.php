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
                <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_mlm')); ?></span>
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
                        <label for="matrixwidth" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('matrixwidth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-5 ph10">
                            <label for="matrixwidth" class="field prepend-icon">
                                <input type="text" name="matrixwidth" id="matrixwidth" placeholder="<?php echo  ucwords($this->lang->line('matrixwidth')); ?>"
                                class="gui-input" value="<?php echo set_value('matrixwidth', isset($this->data['matrixwidth']) ? $this->data['matrixwidth'] : '');?>" >
                                <label for="matrixwidth" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                             <?php echo form_error('matrixwidth'); ?>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="matrixdepth"
                        class="field-label col-sm-3 ph10 text-left"> <?php echo  ucwords($this->lang->line('matrixdepth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-5 ph10">
                            <label for="matrixdepth" class="field prepend-icon">
                                <input type="text" name="matrixdepth" id="matrixdepth"
                                class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('matrixdepth')); ?>"
                                value="<?php echo set_value('matrixdepth', isset($this->data['matrixdepth']) ? $this->data['matrixdepth'] : '');?>">
                                <label for="matrixdepth" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                            <?php echo form_error('matrixdepth'); ?>
                        </div>
                    </div>
                    
                     <div class="section row mb10">
                        <label for="changedirect"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('changedirect')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['changedirect'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="changedirect">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['changedirect']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="changedirect">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="changedirect" class="field-icon">
                                   
                                </label>
                                <?php print_r(form_error());
                                echo form_error('changedirect'); ?>
                            
                        </div>
                    </div>

                   

                    <div class="section row mb10">
                        <label for="freemember"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('freemember')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['freemember'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="freemember">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['freemember']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="freemember">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="freemember" class="field-icon">
                                   
                                </label>
                                <?php print_r(form_error());
                                echo form_error('freemember'); ?>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="earncommisionstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('earncommisionstatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['earncommisionstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="earncommisionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('afterupgrade'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['earncommisionstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="earncommisionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('aftersignup'))?>
                        </label>
                        </div>
                                <label for="earncommisionstatus" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('earncommisionstatus'); ?>
                            
                        </div>
                    </div>


                    <div class="section row mb10">
                        <label for="levelcommissionstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissionstatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['levelcommissionstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="levelcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['levelcommissionstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="levelcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="levelcommissionstatus" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('levelcommissionstatus'); ?>
                            
                        </div>
                    </div>


                    <div class="section row mb10">
                        <label for="levelcommissiontype"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissiontype')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['levelcommissiontype'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="levelcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('amount'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['levelcommissiontype']=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="levelcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('percentage'))?>
                                    </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['levelcommissiontype']=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="levelcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('points'))?>
                                    </label>

                        </div>
                                <label for="levelcommissiontype" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('levelcommissiontype'); ?>
                            
                        </div>
                    </div>

                     
                    <div class="section row mb10">
                        <label for="directcommissionstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissionstatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['directcommissionstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="directcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['directcommissionstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="directcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="directcommissionstatus" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('directcommissionstatus'); ?>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="directcommissiontype"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissiontype')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['directcommissiontype'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="directcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('amount'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['directcommissiontype']=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="directcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('percentage'))?>
                                    </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['directcommissiontype']=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="directcommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('points'))?>
                                    </label>

                        </div>
                                <label for="directcommissiontype" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('directcommissiontype'); ?>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="owncommissionstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissionstatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['owncommissionstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="owncommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['owncommissionstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="owncommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="owncommissionstatus" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('owncommissionstatus'); ?>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="owncommissiontype"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissiontype')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['owncommissiontype'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="owncommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('amount'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['owncommissiontype']=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="owncommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('percentage'))?>
                                    </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['owncommissiontype']=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="owncommissiontype">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('points'))?>
                                    </label>

                        </div>
                                <label for="owncommissiontype" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('owncommissiontype'); ?>
                            
                        </div>
                    </div>


                    <div class="section row mb10">
                        <label for="matrixcommission"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixcommission')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['matrixcommission'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="matrixcommission">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('levelcommission'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['matrixcommission']=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="matrixcommission">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('levelcompletedcommission'))?>
                                    </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['matrixcommission']=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="matrixcommission">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('matrixcompletedcommission'))?>
                                    </label>

                        </div>
                                <label for="matrixcommission" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('matrixcommission'); ?>
                            
                        </div>
                    </div>

                     <div class="section row mb10">
                        <label for="repeatcommissionstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('repeatcommissionstatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['repeatcommissionstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="repeatcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('creditonce'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['repeatcommissionstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="repeatcommissionstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('creditboth'))?>
                        </label>
                        </div>
                                <label for="repeatcommissionstatus" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('repeatcommissionstatus'); ?>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="spilloversystem"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('spilloversystem')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['spilloversystem'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="spilloversystem">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('spreadevenly'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['spilloversystem']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="spilloversystem">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('fifo'))?>
                        </label>
                        </div>
                                <label for="spilloversystem" class="field-icon">
                                   
                                </label>
                                <?php echo form_error('spilloversystem'); ?>
                            
                        </div>
                    </div>

                     <div class="section row mb10">
                        <label for="recyclestatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('recyclestatus')); ?></label>

                        <div class="col-sm-9 ph10">
                                                
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['recyclestatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="recyclestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['recyclestatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="recyclestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="recyclestatus" class="field-icon">
                                   
                                </label>
                                <?php print_r(form_error());
                                echo form_error('recyclestatus'); ?>
                            
                        </div>
                    </div>




                     <div class="panel-footer text-right">
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
<?php $this->load->view('admin/activemenu');?>

<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/sales-stats-clients.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

 
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
                matrixwidth: {
                    required: true,
                    number: true
                },
                matrixdepth: {
                    required: true,
                    number: true
                },
                changedirect: {
                    required: true
                },
                freemember: {
                    required: true
                },
                earncommisionstatus: {
                    required: true
                },
                levelcommissionstatus: {
                    required: true
                },
                levelcommissiontype: {
                    required: true
                },
                directcommissionstatus: {
                    required: true
                },
                directcommissiontype: {
                    required: true
                },
                owncommissionstatus: {
                    required: true
                },
                owncommissiontype: {
                    required: true
                },
                matrixcommission: {
                    required: true
                },
                repeatcommissionstatus: {
                    required: true
                },
                spilloversystem: {
                    required: true
                },
                recyclestatus: {
                    required: true
                }
               
               /* sitebanner: {
                    extension: "jpg|png|gif|jpeg"
                }
                
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                }*/
            },

            // error message
            messages: {
                matrixwidth: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                matrixdepth: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },                
                changedirect: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                freemember: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                earncommisionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                levelcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                levelcommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                directcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                directcommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                matrixcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                repeatcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                spilloversystem: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                recyclestatus: {
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
