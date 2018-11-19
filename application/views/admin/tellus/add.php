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
            <?php $this->load->view('admin/toper');?>
            <!--  /Topbar Menu Wrapper  -->

            <!--  Topbar  -->
            <?php $this->load->view('admin/topmenu');?>
            <!--  /Topbar  -->

            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

                <!--  Column Center  -->
                <div class="chute chute-center">
                 
                    <div class="mw1000 center-block">

                        <!--  General Information  -->
                        <div class="panel mb35">
                            <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
                                <div class="panel-heading">
                                    <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_add_tell_us')); ?></span>
                                    <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/tellus" data-original-title="back"><i class="fa fa-reply"></i></a></span> 
                                </div>
                            
                                <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 mt10 mb20 ">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } 

                                    ?>
                                </div>

                                <div class="panel-body br-t">
                            
                                    <div class="allcp-form theme-primary">

                                        <div class="section row mb10">
                                            <label for="subject" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('subject')); ?><?php echo  ucwords($this->lang->line('star')); ?></label>

                                            <div class="col-sm-9 ph10">
                                                <label for="subject" class="field prepend-icon">
                                                    <input type="text" name="subject" id="subject" placeholder="<?php echo  ucwords($this->lang->line('subject')); ?>"
                                                    class="gui-input" value="<?php echo set_value('subject', isset($tellus->Subject) ? $tellus->Subject : '');?>" >
                                                    <label for="subject" class="field-icon">
                                                        <i class="fa fa-info"></i>
                                                    </label>
                                                </label>
                                                 <?php echo form_error('subject');?>
                                            </div>
                                        </div>

                                        <div class="section row mb10">
                                            <label for="message" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('message')); ?><?php echo  ucwords($this->lang->line('star')); ?></label>

                                            <div class="col-sm-9 ph10">
                                                <label for="message" class="field prepend-icon">

                                                    <textarea name="message" id="message" placeholder="<?php echo  ucwords($this->lang->line('message')); ?>" class="ckeditor gui-input" ><?php echo set_value('message', isset($tellus->Message) ? urldecode($tellus->Message) : '');?></textarea>
                                                    
                                                    
                                                </label>
                                                 <?php echo form_error('message');?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="TellusId" value="<?php echo isset($tellus->TellusId) ? $tellus->TellusId : '';?>">
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
<?php $this->load->view('admin/activemenu');?>

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
                emailid: {
                    required: true,
                    email:true
                },
                 memberid: {
                    required: true
                },
                subject: {
                    required: true
                    
                },
                message: {
                    required: true
                },
                status: {
                    required: true
                }
                
                
            },

            // error message
            messages: {
                emailid: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    email:'<?php echo ucwords($this->lang->line('erroremail')); ?>'
                },
                memberid: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                subject: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                message: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'    
                },
                 status: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                
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
