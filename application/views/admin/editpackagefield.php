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
                    <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_packageedit')); ?></span>
                    <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/packagesetting" data-original-title="Back"><i class="fa fa-close"></i></a></span>

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
                    <?php //print_r(form_error());

                    ?>

                </div>

                <div class="panel-body br-t">

                    <div class="allcp-form theme-primary">


                        <div class="section row mb10">
                            <label for="packagename" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('packagename')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-7 ph10">
                                <label for="packagename" class="field prepend-icon">
                                    <input type="text" name="packagename" id="packagename" placeholder="<?php echo  ucwords($this->lang->line('packagename')); ?>"
                                    class="gui-input" value="<?php echo set_value('packagename', isset($this->data['fielddata']->PackageName) ? $this->data['fielddata']->PackageName : '');?>" >
                                    <label for="packagename" class="field-icon">
                                        <i class="fa fa-info"></i>
                                    </label>
                                </label>
                                <?php echo form_error('packagename');?>
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="packagefee" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('packagefee')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-7 ph10">
                                <label for="packagefee" class="field prepend-icon">
                                    <input type="text" name="packagefee" id="packagefee" placeholder="<?php echo  ucwords($this->lang->line('packagefee')); ?>"
                                    class="gui-input" value="<?php echo set_value('packagefee', isset($this->data['fielddata']->PackageFee) ? $this->data['fielddata']->PackageFee : '');?>" >
                                    <label for="packagefee" class="field-icon">
                                        <i class="fa fa-money"></i>
                                    </label>
                                </label>
                                <?php echo form_error('packagefee');?>
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="renewalstatus"
                            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('renewalstatus')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-5 ph10">


                               <?php //echo $this->data['allowpicture'];?>
                               <div class="option-group field">
                                <label class="col-md-4 block mt15 option option-primary">

                                    <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->RenewalStatus) {echo "checked='checked'";} ?> name="renewalstatus">
                                    <span class="radio"></span>
                                    <?php echo  ucwords($this->lang->line('enable'))?>
                                </label>

                                <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->RenewalStatus) {echo "checked='checked'";} ?> name="renewalstatus">
                                    <span class="radio"></span>
                                    <?php echo  ucwords($this->lang->line('disable'))?>
                                </label>
                            </div>
                            <label for="renewalstatus" class="field-icon">

                            </label>
                            <?php echo form_error('renewalstatus');?>
                        </div>
                    </div>


                    <div class="section row mb10">
                        <label for="renewalfee" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('renewalfee')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-7 ph10">
                            <label for="renewalfee" class="field prepend-icon">
                                <input type="text" name="renewalfee" id="renewalfee" placeholder="<?php echo  ucwords($this->lang->line('renewalfee')); ?>"
                                class="gui-input" value="<?php echo set_value('renewalfee', isset($this->data['fielddata']->RenewalFee) ? $this->data['fielddata']->RenewalFee : '');?>" >
                                <label for="renewalfee" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                            <?php echo form_error('renewalfee');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="recurringstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('recurringstatus')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-5 ph10">


                           <?php //echo $this->data['allowpicture'];?>
                           <div class="option-group field">
                            <label class="col-md-4 block mt15 option option-primary">

                                <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->RecurringStatus) {echo "checked='checked'";} ?> name="recurringstatus">
                                <span class="radio"></span>
                                <?php echo  ucwords($this->lang->line('enable'))?>
                            </label>

                            <label class="col-md-4 block mt15 option option-primary">
                                <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->RecurringStatus) {echo "checked='checked'";} ?> name="recurringstatus">
                                <span class="radio"></span>
                                <?php echo  ucwords($this->lang->line('disable'))?>
                            </label>
                        </div>
                        <label for="recurringstatus" class="field-icon">

                        </label>
                        <?php echo form_error('recurringstatus');?>
                    </div>
                </div>


                <div class="section row mb20">
                    <label for="recurringfee" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('recurringfee')); ?><sup><em class="state-error"><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></em></sup></label>

                    <div class="col-sm-7 ph10">
                        <label for="recurringfee" class="field prepend-icon">
                            <input type="text" name="recurringfee" id="recurringfee" placeholder="<?php echo  ucwords($this->lang->line('recurringfee')); ?>"
                            class="gui-input" value="<?php echo set_value('recurringfee', isset($this->data['fielddata']->RecurringFee) ? $this->data['fielddata']->RecurringFee : '');?>" >
                            <label for="recurringfee" class="field-icon">
                                <i class="fa fa-money"></i>
                            </label>
                        </label>
                        <?php echo form_error('recurringfee');?>
                    </div>
                </div>

                <div class="section row mb10">
                    <label for="autodebitstatus"
                    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('autodebitstatus')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                    <div class="col-sm-5 ph10">


                       <?php //echo $this->data['allowpicture'];?>
                       <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">

                            <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->AutoDebitStatus) {echo "checked='checked'";} ?> name="autodebitstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('enable'))?>
                        </label>

                        <label class="col-md-4 block mt15 option option-primary">
                            <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->AutoDebitStatus) {echo "checked='checked'";} ?> name="autodebitstatus">
                            <span class="radio"></span>
                            <?php echo  ucwords($this->lang->line('disable'))?>
                        </label>
                    </div>
                    <label for="autodebitstatus" class="field-icon">

                    </label>
                    <?php echo form_error('autodebitstatus');?>
                </div>
            </div>

            <div class="section row mb10">
                <label for="autocreateorderstatus"
                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('autocreateorderstatus')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                <div class="col-sm-5 ph10">


                   <?php //echo $this->data['allowpicture'];?>
                   <div class="option-group field">
                    <label class="col-md-4 block mt15 option option-primary">

                        <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->AutoCreateOrderStatus) {echo "checked='checked'";} ?> name="autocreateorderstatus">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('enable'))?>
                    </label>

                    <label class="col-md-4 block mt15 option option-primary">
                        <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->AutoCreateOrderStatus) {echo "checked='checked'";} ?> name="autocreateorderstatus">
                        <span class="radio"></span>
                        <?php echo  ucwords($this->lang->line('disable'))?>
                    </label>
                </div>
                <label for="autocreateorderstatus" class="field-icon">

                </label>
                <?php echo form_error('autocreateorderstatus');?>
            </div>
        </div>


        <div class="section row mb10">
            <label for="product"
            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('product')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

            <div class="col-sm-7 ph10">
                <?php 
                
                ?>
                <label for="product" class="field select">
                    <select id="product" name="product">
                        <option value=""><?php echo  ucwords($this->lang->line('choosefield')); ?></option>
                        <?php 
                        for($i=0; $i<count($this->data['productdetail']); $i++) {      ?>

                        <option <?php if($this->data['productdetail'][$i]->ProductId == $this->data['fielddata']->ProductId) {echo "selected";} ?> value="<?php echo $this->data['productdetail'][$i]->ProductName;?>" ><?php echo  ucwords($this->data['productdetail'][$i]->ProductName);?></option>

                        <?php }

                        ?>


                    </select>
                    <i class="arrow double"></i>
                </label>

                <label for="fieldname" class="field-icon">
                    <i class="fa "></i>
                </label>
                <?php echo form_error('product');?>
            </div>
        </div>





        <div class="section row mb10">
            <label for="owncommission" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('owncommission')); ?><sup><em class="state-error"><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></em></sup></label>

            <div class="col-sm-7 ph10">
                <label for="owncommission" class="field prepend-icon">
                    <input type="text" name="owncommission" id="owncommission" placeholder="<?php echo  ucwords($this->lang->line('owncommission')); ?>"
                    class="gui-input" value="<?php echo set_value('owncommission', isset($this->data['fielddata']->OwnCommission) ? $this->data['fielddata']->OwnCommission : '');?>" >
                    <label for="owncommission" class="field-icon">
                        <i class="fa fa-money"></i>
                    </label>
                </label>
                <?php echo form_error('owncommission');?>
            </div>
        </div>


        <div class="section row mb10">
            <label for="levelcompletedcommission" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('levelcomamount')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

            <div class="col-sm-7 ph10">
                <label for="levelcompletedcommission" class="field prepend-icon">
                    <input type="text" name="levelcompletedcommission" id="levelcompletedcommission" placeholder="<?php echo  ucwords($this->lang->line('levelcompletedcommission')); ?>"
                    class="gui-input" value="<?php echo set_value('levelcompletedcommission', isset($this->data['fielddata']->LevelCompletedCommission) ? $this->data['fielddata']->LevelCompletedCommission : '');?>" >
                    <label for="levelcompletedcommission" class="field-icon">
                        <i class="fa fa-money"></i>
                    </label>
                </label>
                <?php echo form_error('levelcompletedcommission');?>
            </div>
        </div>

        <div class="section row mb10">
            <label for="matrixcompletedcommission" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('matrixcomamount')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

            <div class="col-sm-7 ph10">
                <label for="matrixcompletedcommission" class="field prepend-icon">
                    <input type="text" name="matrixcompletedcommission" id="matrixcompletedcommission" placeholder="<?php echo  ucwords($this->lang->line('matrixcompletedcommission')); ?>"
                    class="gui-input" value="<?php echo set_value('matrixcompletedcommission', isset($this->data['fielddata']->MatrixCompletionCommission) ? $this->data['fielddata']->MatrixCompletionCommission : '');?>" >
                    <label for="matrixcompletedcommission" class="field-icon">
                        <i class="fa fa-money"></i>
                    </label>
                </label>
                <?php echo form_error('matrixcompletedcommission');?>
            </div>
        </div>

        <div class="section row mb10" id="levelcommissiondivp">
            <label for="levelcommission" class="field-label col-sm-4 ph10  text-left"><?php echo  ucwords($this->lang->line('levelcommission')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
            <div class="col-sm-3 ph10">

                <input type='button' value='+' id='addlvlButton'  class="btn btn-bordered btn-primary"  />
                <input type='button' value='-' id='removelvlButton' class="btn btn-bordered btn-primary" />
            </div>  
             <?php echo form_error('levelcommission');?>
        </div>



        <?php

        $lvlcomms =explode(",",$this->data['fielddata']->LevelCommissions);


        for($i=0;$i<count($lvlcomms);$i++)
        {
            $lvl=$i+1;
            ?>
            <div class="section row mb10" id="<?php echo"levelcommission".$lvl;?>">

                <label for="levelcommission" class="field-label col-sm-3 ph10">
                              <?//echo ucwords($this->lang->line('level'));echo $lvl." ". ucwords($this->lang->line('comamount')); ?>

                    </label>
                    <div class="col-sm-7 ph10 mb10" id="<?php echo"levelcommission".$lvl;?>">
                       <input type="text" name="levelcommission[]" id="levelcommission[]" placeholder="<?php echo  ucwords($this->lang->line('level'));echo $lvl." ". ucwords($this->lang->line('comamount')); ?>"
                       class="gui-input" value="<?php echo $lvlcomms[$i];?>" >
                   </div></div>

                           <?php }


                           ?>
                           <div class="section row mb10" id="levelcommissiondiv">
                            
                            
                        </div>

                       

                        <div class="section row mb10" id="productlevelcommissiondivp">
                            <label for="productlevelcommission" class="field-label col-sm-4 ph10  text-left"><?php echo  ucwords($this->lang->line('productlevelcommission')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                            <div class="col-sm-3 ph10 ">

                                <input type='button' value='+' id='addprtButton'  class="btn btn-bordered btn-primary"  />
                                <input type='button' value='-' id='removeprtButton' class="btn btn-bordered btn-primary" />
                            </div>
                            <?php  echo form_error('productlevelcommission');?>
                        </div>

                     <?php $plvlcomms =explode(",",$this->data['fielddata']->ProductLevelCommissions);


                        for($i=0;$i<count($plvlcomms);$i++)
                        {
                            $plvl=$i+1;
                            ?>
                            <div class="section row mb10"  id="<?php echo"productlevelcommission".$plvl;?>" >
                               <label for="productlevelcommission" class="field-label col-sm-3 ph10  ">
                                   <?//echo ucwords($this->lang->line('productlevel'));echo $plvl." ". ucwords($this->lang->line('comamount')); ?>

                               </label>
                               <div class="col-sm-7 ph10 mb10" id="<?php echo"productlevelcommission".$plvl;?>">

                                   <input type="text" name="productlevelcommission[]" id="productlevelcommission[]" placeholder="<?php echo  ucwords($this->lang->line('productlevel'));echo $plvl." ". ucwords($this->lang->line('comamount')); ?>"
                                   class="gui-input" value="<?php echo $plvlcomms[$i];?>" >
                               </div></div>
                     <?php }?>

                               <div class="section row mb10" id="productlevelcommissiondiv">
                                
                                <label for="productlevelcommission" class="field prepend-icon col-sm-5 ">

                                </label>
                               
                                
                            </div>


 
                   <!--  <div class="section row mb10">
                        <label for="levelcommission" class="field prepend-icon"> </label>
                            <div class="col-sm-9 ph10"> </div>
                                <div class="col-sm-3 ph10">
                                            <input type='button' value='+' id='addprtButton'  class="btn btn-bordered btn-primary"  />
                                            <input type='button' value='-' id='removeprtButton' class="btn btn-bordered btn-primary" />
                            </div>
                    </div>
                -->

                <div class="panel-footer text-right">
                    <input type="hidden" id="lvlprtcount" name="lvlprtcount" value="<?php echo count($plvlcomms);?>">
                     <input type="hidden" id="lvlcount" name="lvlcount" value="<?php echo count($lvlcomms);?>">
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

        $("#addlvlButton").click(function () {

           var counter = parseFloat(document.getElementById("lvlcount").value);
           counter++;
           document.getElementById("lvlcount").value = counter;

           if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   

        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'levelcommission' + counter).attr("class", 'section row mb10');

        levelcommissiondiv.after().html('<label class="field-label col-sm-3 ph10 "></label></div><div class="col-sm-7 ph10 "><input type="text" name="levelcommission[]" placeholder="Level'+ counter+' Commission Amount" id="levelcommission'+ counter+'" value="" class="gui-input" >');

        levelcommissiondiv.appendTo("#levelcommissiondiv");


        counter++;
    });

        $("#removelvlButton").click(function () {
           var counter = parseFloat(document.getElementById("lvlcount").value);
           if(counter==1){
              alert("No more textbox to remove");
              return false;
          }   


          $("#levelcommission" + counter).remove();
          counter--;
          document.getElementById("lvlcount").value = counter;

      });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
              msg += "\n levelcommissiondiv #" + i + $('#levelcommissiondiv' + i).val();
          }
          alert(msg);
      });
    });


$(document).ready(function(){

    var counter = 2;

    $("#addprtButton").click(function () {
        var counter = parseFloat(document.getElementById("lvlprtcount").value);
        counter++;
        document.getElementById("lvlprtcount").value = counter;

        if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   
        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'productlevelcommission' + counter).attr("class", 'section row mb10');

      /*  var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'productlevelcommission' + counter).attr("class", 'col-sm-7 ph10 mb10');
*/
        levelcommissiondiv.after().html('<label class="field-label col-sm-3 ph10 "></label><div class="col-sm-7 ph10 "><input type="text" name="productlevelcommission[]" placeholder="productLevel'+ counter+' Commission Amount" id="productlevelcommission'+ counter+'" value="" class="gui-input" ></div>');

        levelcommissiondiv.appendTo("#productlevelcommissiondiv");

        counter++;

    });

    $("#removeprtButton").click(function () {
       var counter = parseFloat(document.getElementById("lvlprtcount").value);
       if(counter==1){
          alert("No more textbox to remove");
          return false;
      }   



      $("#productlevelcommission" + counter).remove();
      counter--;
      document.getElementById("lvlprtcount").value = counter;

  });

    $("#getButtonValue").click(function () {

        var msg = '';
        for(i=1; i<counter; i++){
          msg += "\n productlevelcommissiondiv #" + i + $('#productlevelcommissiondiv' + i).val();
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
                packagename: {
                    required: true
                },
                packagefee: {
                    required: true,
                    number:true
                },
                renewalstatus: {
                    required: true
                },
                renewalfee: {
                    required: true,
                    number:true
                },
                recurringstatus: {
                    required: true
                },
                recurringfee: {
                    required: true,
                    number:true
                },
                autodebitstatus: {
                    required: true
                },
                autocreateorderstatus: {
                    required: true
                },
                product: {
                    required: true
                },
                owncommission: {
                    required: true,
                    number:true
                },
                levelcompletedcommission: {
                    required: true,
                    number:true
                },
                matrixcompletedcommission: {
                    required: true,
                    number:true
                },
                levelcommission: {
                    required: true,
                    number:true
                },
                productlevelcommission: {
                    required: true,
                    number: true
                }
                
            },

            // error message
            messages: {
                packagename: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                packagefee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                renewalstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                renewalfee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                recurringstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                recurringfee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                autodebitstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                autocreateorderstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                product: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                levelcompletedcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('require')); ?>'
                },
                matrixcompletedcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                levelcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                productlevelcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
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
