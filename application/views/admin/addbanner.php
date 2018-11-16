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
        <form method="post" action="<?php echo base_url(); ?>admin/banner/addbanner" id="allcp-form" enctype="multipart/form-data">
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
                                <input type="text" name="imgname" id="imagname" placeholder="<?php echo  ucwords($this->lang->line('sitename')); ?>"
                                class="gui-input" value="<?php if(isset($product->banner_name)){echo $product->banner_name;}else{echo "";}?>" >
                                <label for="sitename" class="field-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </label>
                            </label>
                            <?php echo ucwords(form_error('sitename')); ?>
                        </div>
                    </div>




                    <div class="section row mb10">
                        <label for="sitemetadescription"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('sitemetadescription')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-8 ph10">
                            <label for="sitemetadescription" class="field prepend-icon">
                                <input type="text" name="sitemetadescription" id="sitemetadescription"
                                class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('sitemetadescription')); ?>"
                                value="<?php if(isset($product->description)){echo $product->description;}else{echo "";}?>">
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
                                   
                                    <input type="radio" <?php if(isset($product->status)==1){echo "checked='checked'";}else{echo "";}?> value='1' name="sitestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($product->status)==0){echo "checked='checked'";}else{echo "";}?> value='0' name="sitestatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                        </label>
                        </div>
                                <label for="sitestatus" class="field-icon">
                                   
                                </label>
                            <?php echo ucwords(form_error('sitestatus')); ?>
                        </div>
                    </div>

                




                    <!-- <hr class="short alt"> -->
                    

                    <h6 class="mb15"><?php echo  ucwords($this->lang->line('sitelogo')); ?></h6>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail mb20">
                            <img src="../<?php if(isset($product->banner_image)){echo $product->banner_image; }?>" alt="holder">
                        </div>
                        <span class="btn btn-primary light btn-file btn-block ph5">
                            <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <input type="file"  name="sitelogo"  value="if(isset($product->banner_image){echo $product->banner_image;}?>">
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
