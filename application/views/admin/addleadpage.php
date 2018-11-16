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

            <?php $this->load->view('admin/topmenu');?>

            <!--  Content  -->
                <section id="content" class="table-layout animated fadeIn">

                    <!--  Column Center  -->
                    <div class="chute chute-center">
                     
                        <div class="mw1000 center-block">

                            <!--  General Information  -->
                            <div class="panel mb35">
                                <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
                                    <div class="panel-heading">
                                        <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_addleadcapture')); ?></span>
                                        <span class="allcp-form"><a class="btn btn-primary pull-right ml10" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/leadcapture" data-original-title="Back"><i class="fa fa-close"></i></a></span>
                                       
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>landingpage/sample.zip" data-original-title="Download"><i class="fa fa-download"></i></a></span>
                                                      
                                    </div>
                                    
                                    <div class="section row mbn">
                                        <?php if($this->session->flashdata('error_message')) { ?>    
                                            <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                                <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                            </div>
                                        <?php } ?>
                                        
                                        <?php if($this->session->flashdata('success_message')) { ?>    
                                            <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                                <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                            </div>
                                        <?php } ?>
                                        
                                    </div>

                                    <div class="panel-body br-t">
                                        <div class="allcp-form theme-primary">

                                            <div class="section row mb10">
                                                <label for="pagename" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('pagename')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-7 ph10">
                                                    <label for="pagename" class="field prepend-icon">
                                                        <input type="text" name="pagename" id="pagename" placeholder="<?php echo  ucwords($this->lang->line('pagename')); ?>"
                                                        class="gui-input" value="" >
                                                        <label for="pagename" class="field-icon">
                                                            <i class="fa fa-newspaper-o"></i>
                                                        </label>
                                                    </label>
                                                     <?php echo form_error('pagename');?>
                                                </div>
                                            </div>

                                           
                                            <div class="section row mb10">
                                                <label for="metakey" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('metakey')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-7 ph10">
                                                   <label for="metakey" class="field prepend-icon">
                                                        <input type="text" id="metakey" name="metakey" class="gui-input fs13" placeholder="<?php echo  ucwords($this->lang->line('metakey')); ?>" value="<?php echo set_value('limitation');?>">
                                                        <label class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                    <?php echo form_error('metakey');?>
                                                </div>
                                            </div>

                                            <div class="section row mb10">
                                                <label for="metacontent" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('metacontent')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-7 ph10">
                                                    <label for="metacontent" class="field prepend-icon">
                                                        <input type="text" id="metacontent" name="metacontent" class="gui-input fs13" placeholder="<?php echo  ucwords($this->lang->line('metacontent')); ?>" value="<?php echo set_value('limitation');?>">
                                                        <label class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                    <?php echo form_error('metacontent');?>
                                                </div>
                                            </div>
                                        

                                             <div class="section row mb10">
                                                <label for="sourcefile" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('sourcefile')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                    <div class="col-md-7 ph10">
                                                        <div class="section">
                                                            <label class="field prepend-icon append-button file">
                                                                <span class="button btn-primary"><?php echo  ucwords($this->lang->line('choosefile')); ?></span>
                                                                <input type="file" onchange="document.getElementById('sourcefilepath').value = this.value;" id="sourcefile" name="sourcefile" class="gui-file">
                                                                <input type="text" placeholder="<?php echo  ucwords($this->lang->line('sourcefile')); ?>" id="sourcefilepath" class="gui-input">
                                                                <label class="field-icon">
                                                                    <i class="fa fa-cloud-upload"></i>
                                                                </label>
                                                            </label>
                                                            <?php echo form_error('sourcefile');?>
                                                        </div>
                                                    </div>
                                            </div>


                                            <div class="section row mb10">
                                                <label for="pagestatus"
                                                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('pagestatus')); ?></label>

                                                <div class="col-sm-7 ph10">
                                                
                                                    <div class="option-group field">
                                                        <label class="col-md-3 block mt15 option option-primary">
                                                            <input type="radio"  value='1' name="pagestatus">
                                                            <span class="radio"></span>
                                                            <?php echo  ucwords($this->lang->line('on'))?>
                                                        </label>

                                                        <label class="col-md-3 block mt15 option option-primary">
                                                            <input type="radio"  value='0' name="pagestatus">
                                                            <span class="radio"></span>
                                                            <?php echo  ucwords($this->lang->line('off'))?>
                                                        </label>
                                                    </div>
                                                    <label for="pagestatus" class="field-icon">
                                                    </label>
                                                    <?php echo form_error('pagestatus');?>
                                                </div>
                                            </div>
                                            
                                            <div class="panel-footer text-right">
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
        <?php $this->load->view('admin/sidebar_right');?>
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
                pagename: {
                    required: true
                },
                 metakey: {
                    required: true
                },
                metacontent: {
                    required: true
                },
                pagestatus: {
                    required: true
                },
                sourcefile: {
                    extension: "zip"
                }
                
                
            },

            // error message
            messages: {
                pagename: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                metakey: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                metacontent: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                pagestatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                sourcefile: {
                    required: '<?php echo ucwords($this->lang->line('errorextension_zip')); ?>'
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
