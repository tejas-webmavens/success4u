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
                <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_smtp')); ?></span>
            </div>
            
            <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } ?>
                                </div>
            <div class="panel-body br-t">
            
                <div class="allcp-form theme-primary">

                    <div class="section row mb10">
                        <label for="smtpstatus"
                        class="field-label col-sm-2 ph10 text-center"><?php echo  ucwords($this->lang->line('smtpstatus')); ?></label>

                        <div class="col-sm-10 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['smtpstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="smtpstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if($this->data['smtpstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="smtpstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="smtpstatus" class="field-icon">
                                   
                                </label>
                            
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="smtpmail" class="field-label col-sm-2 ph10  text-center"><?php echo  ucwords($this->lang->line('smtpmail')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="smtpmail" class="field prepend-icon">
                                <input type="text" name="smtpmail" id="smtpmail" placeholder="<?php echo  ucwords($this->lang->line('smtpmail')); ?>"
                                class="gui-input" value="<?php echo set_value('smtpmail', isset($this->data['smtpmail']) ? $this->data['smtpmail'] : '');?>" >
                                <label for="smtpmail" class="field-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </label>
                            </label>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="smtppassword"
                        class="field-label col-sm-2 ph10 text-center"> <?php echo  ucwords($this->lang->line('smtppassword')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="smtppassword" class="field prepend-icon">
                                <input type="password" name="smtppassword" id="smtppassword"
                                class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('smtppassword')); ?>"
                                value="<?php echo set_value('smtppassword', isset($this->data['smtppassword']) ? $this->data['smtppassword'] : '');?>">
                                <label for="smtppassword" class="field-icon">
                                    <i class="fa fa-list"></i>
                                </label>
                            </label>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="smtpport"
                        class="field-label col-sm-2 ph10 text-center"><?php echo  ucwords($this->lang->line('smtpport')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="smtpport" class="field prepend-icon">
                                <input type="text" name="smtpport" id="smtpport"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('smtpport')); ?>"
                                value="<?php echo set_value('smtpport', isset($this->data['smtpport']) ? $this->data['smtpport'] : '');?>">
                                <label for="smtpport" class="field-icon">
                                    <i class="fa fa-list"></i>
                                </label>
                            </label>
                        </div>
                    </div>
                    <div class="section row mb10">
                        <label for="smtphost"
                        class="field-label col-sm-2 ph10 text-center"><?php echo  ucwords($this->lang->line('smtphost')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="smtphost" class="field prepend-icon">
                                <input type="text" name="smtphost" id="smtphost"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('smtphost')); ?>"
                                value="<?php echo set_value('smtphost', isset($this->data['smtphost']) ? $this->data['smtphost'] : '');?>">
                                <label for="smtphost" class="field-icon">
                                    <i class="fa fa-link"></i>
                                </label>
                            </label>
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
                smtpstatus: {
                    required: true
                    
                },
                smtpmail: {
                    required: true,
                    email:true
                },
                smtppassword: {
                    required: true,
                    number: true,
                    minlength: 4,
                    maxlength: 12
                },
                smtpport: {
                    required: true,
                    number: true
                },
                smtphost: {
                    required: true,
                    url:true
                },
               
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
                smtpstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                smtpmail: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    email: '<?php echo ucwords($this->lang->line('erroremail')); ?>'
                },
                smtpport: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                smtppassword: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                smtphost: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     url: '<?php echo ucwords($this->lang->line('errorurl')); ?>'
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
