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
                <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_updatemarketingtext')); ?></span>
                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/marketingtool" data-original-title="Back"><i class="fa fa-close"></i></a></span>
                              
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
                                    <?php //print_r(form_error());?>
                                    
                                </div>

            <div class="panel-body br-t">
            
                <div class="allcp-form theme-primary">
               
                    <div class="section row mb10">
                        <label for="marketingtitle" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('marketingtitle')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-7 ph10">
                            <label for="marketingtitle" class="field prepend-icon">
                                <input type="text" name="marketingtitle" id="marketingtitle" placeholder="<?php echo  ucwords($this->lang->line('marketingtitle')); ?>"
                                class="gui-input" value="<?php echo set_value('marketingtitle', isset($this->data['MarketingTitle']) ? $this->data['MarketingTitle'] : '');?>" >
                                <label for="marketingtitle" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                             <?php echo form_error('marketingtitle');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="marketingtype"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('marketingtype')); ?></label>

                        <!-- <div class="col-sm-8 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['MarketingType'])) { if(isset($this->data['MarketingType'])=='text'){ echo "checked='checked'";}}?> value='text' name="marketingtype" onclick="changetexttype()">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('text'))?>
                                    </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['MarketingType'])) { if($this->data['MarketingType']=='image') { echo "checked='checked'"; }}?> value='image' name="marketingtype" onclick="changeimagetype()">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('image'))?>
                                    </label>

                                     <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['MarketingType'])) { if($this->data['MarketingType']=='video') { echo "checked='checked'"; }}?> value='video' name="marketingtype" onclick="changevideotype()">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('video'))?>
                                    </label>
                        </div>
                                <label for="marketingtype" class="field-icon">
                                   
                                </label> -->
                                <div class="col-sm-7 ph10">
                            <label for="marketingtype" class="field prepend-icon">
                                <input type="text" name="marketingtype" id="marketingtype" readonly placeholder="<?php echo  ucwords($this->lang->line('marketingtype')); ?>"
                                class="gui-input" value="<?php echo set_value('marketingtype', isset($this->data['MarketingType']) ? $this->data['MarketingType'] : '');?>" >
                                <label for="marketingtype" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                                 <?php echo form_error('marketingtype'); ?>
                            
                        </div>
                    </div>
                     <?php if(isset($this->data['MarketingType'])) {if($this->data['MarketingType']=='text') { ?>
                    <div class="section row mb10" id="textdiv" style="display: block;">
                    <?php }  else { ?>
                    <div class="section row mb10" id="textdiv" style="display: none;">
                    <?php }} else { ?>
                    <div class="section row mb10" id="textdiv" style="display: none;">
                    <?php }  ?>
                        <label for="marketingtext" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('marketingtext')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-7 ph10">
                            <label for="marketingtext" class="field prepend-icon">

                                <textarea name="marketingtext" id="marketingtext" placeholder="<?php echo  ucwords($this->lang->line('marketingext')); ?>" class="ckeditor gui-input" ><?php if(isset($this->data['MarketingText'])){ echo $this->data['MarketingText'];}?></textarea>
                                
                                
                            </label>
                             <?php echo form_error('marketingtext');?>
                        </div>
                    </div>

                    <?php if(isset($this->data['MarketingType'])) {if($this->data['MarketingType']=='image') { ?>
                        <div class="section row mb10" id="imagediv" style="display: block;">
                     <?php } else { ?>
                        <div class="section row mb10" id="imagediv" style="display: none;">
                    <?php }} else { ?>
                    <div class="section row mb10" id="imagediv" style="display: none;">
                    <?php }  ?>
                    <label for="marketingimage"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('marketingimage')); ?></label>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                     <label class="col-md-7 ph10 block mt15 option option-primary">
                        <div class="fileupload-preview thumbnail mb20">
                            <?// <img data-src="holder.js/100%x100" alt="holder"> ?>
                            <img src="<?php echo base_url(); if(isset($this->data['MarketingImage'])){echo $this->data['MarketingImage']; }?>" alt="<?php echo ucwords($this->lang->line('marketingtext'));?>">
                        
                        </div>
                        <span class="btn btn-primary light btn-file btn-block ph5">
                            <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <input type="file"  name="marketingimage" value="<?php if(isset($this->data['MarketingImage'])){echo $this->data['MarketingImage']; }?>">
                             </span>
                              <?php echo form_error('marketingimage'); ?>
                             </label>
                    </div>
                    </div>

                    <?php if(isset($this->data['MarketingType'])) {if($this->data['MarketingType']=='document') { ?>
                        <div class="section row mb10" id="documentdiv" style="display: block;">
                     <?php } else { ?>
                        <div class="section row mb10" id="documentdiv" style="display: none;">
                    <?php }} else { ?>
                    <div class="section row mb10" id="documentdiv" style="display: none;">
                    <?php }  ?>
                    <label for="marketingdocument"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('marketingdocument')); ?></label>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                     <label class="col-md-7 ph10 block mt15 option option-primary">
                        <div class="fileupload-preview thumbnail mb20">
                            <?// <img data-src="holder.js/100%x100" alt="holder"> ?>
                            <img src="<?php echo base_url(); if(isset($this->data['MarketingDocument'])){echo $this->data['MarketingDocument']; }?>" alt="<?php echo ucwords($this->lang->line('marketingtext'));?>">
                        
                        </div>
                        <span class="btn btn-primary light btn-file btn-block ph5">
                            <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <input type="file"  name="marketingdocument" value="<?php if(isset($this->data['MarketingDocument'])){echo $this->data['MarketingDocument']; }?>">
                             </span>
                              <?php echo form_error('marketingdocument'); ?>
                             </label>
                    </div>
                    </div>

                     <?php  if(isset($this->data['MarketingType'])) {if($this->data['MarketingType']=='video') { ?>
                     <div class="section row mb10" id="videodiv" style="display: block;">
                     <?php } else { ?>
                    <div class="section row mb10" id="videodiv" style="display:none ;">
                    <?php }} else { ?>
                    <div class="section row mb10" id="videodiv" style="display: none;">
                    <?php }  ?>
                        <label for="marketingvideolink" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('marketingvideolink')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-7 ph10">
                            <label for="marketingvideolink" class="field prepend-icon">
                                <input type="text" name="marketingvideolink" id="marketingvideolink" placeholder="<?php echo  ucwords($this->lang->line('marketingvideolink')); ?>"
                                class="gui-input" value="<?php if(isset($this->data['MarketingVideoLink'])){echo $this->data['MarketingVideoLink']; }?>" >
                                <label for="marketingvideolink" class="field-icon">
                                    <i class="fa fa-money"></i>
                                </label>
                            </label>
                             <?php echo form_error('marketingvideolink');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="marketingstatus"
                        class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('marketingstatus')); ?></label>

                        <div class="col-sm-5 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                        <label class="col-md-4 block mt15 option option-primary">
                                   
                                    <input type="radio" <?php if(isset($this->data['Status'])){ if($this->data['Status']=='1')echo 'checked'; }?> value='1' name="marketingstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('enable'))?>
                                        </label>

                                    <label class="col-md-4 block mt15 option option-primary">
                                    <input type="radio" <?php if(isset($this->data['Status'])){ if($this->data['Status']=='0')echo 'checked'; } ?> value='0' name="marketingstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('disable'))?>
                        </label>
                        </div>
                                <label for="marketingstatus" class="field-icon">
                                   
                                </label>
                            <?php echo form_error('marketingstatus'); ?>
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

<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>
 
<script type="text/javascript">

function changetexttype()
{
        var div1 = document.getElementById("textdiv");
        var div2 = document.getElementById("imagediv");
        var div3 = document.getElementById("videodiv");
        var div4 = document.getElementById("documentdiv");

            div1.style.display = "block";
            div2.style.display = "none";
            div3.style.display = "none";
            div4.style.display = "none";
}

function changeimagetype()
{
        var div1 = document.getElementById("textdiv");
        var div2 = document.getElementById("imagediv");
        var div3 = document.getElementById("videodiv");
        var div4 = document.getElementById("documentdiv");

            div1.style.display = "none";
            div2.style.display = "block";
            div3.style.display = "none";
            div4.style.display = "none";


}

function changevideotype()
{
        var div1 = document.getElementById("textdiv");
        var div2 = document.getElementById("imagediv");
        var div3 = document.getElementById("videodiv");
        var div4 = document.getElementById("documentdiv");

            div1.style.display = "none";
            div2.style.display = "none";
            div3.style.display = "block";
            div4.style.display = "none";
            

}
function changedocumenttype()
{
        var div1 = document.getElementById("textdiv");
        var div2 = document.getElementById("imagediv");
        var div3 = document.getElementById("videodiv");
        var div4 = document.getElementById("documentdiv");
            div1.style.display = "none";
            div2.style.display = "none";
            div3.style.display = "none";
            div4.style.display = "block";


}


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
                marketingtitle: {
                    required: true
                },
                marketingtype: {
                    required: true
                }
                
            },

            // error message
            messages: {
                marketingtitle: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                marketingtype: {
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
