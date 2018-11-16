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

                        <!--  Column Left  -->

                        <!--  /Column Left  -->

                        <!--  Column Center  -->
                        <div class="chute chute-center">
                         
                            <div class="mw1000 center-block">

                                <!--  General Information  -->
                                <div class="panel mb35">
                                    <form method="post" action="<?php echo base_url();?>/admin/customfieldsetting/addfield" id="allcp-form" >
                                    <div class="panel-heading">
                                        <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_customadd')); ?></span>
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/customfieldsetting" data-original-title="Back"><i class="fa fa-close"></i></a></span>                              
                                    </div>
                                    
                                    <div class="section row mbn">
                                        <?php if($this->session->flashdata('error_message')) { ?>    
                                            <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                                <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                            </div>
                                        <?php unset($_SESSION['error_message']);} ?>
                                        
                                        <?php if($this->session->flashdata('success_message')) { ?>    
                                            <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                                <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                            </div>
                                        <?php unset($_SESSION['success_message']); } ?>
                                    </div>

                                    <div class="panel-body br-t">
                                    
                                        <div class="allcp-form theme-primary">

                                           
                                            <div class="section row mb10">
                                                <label for="customfieldpage" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('customfieldpage')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-10 ph10">
                                                    <label for="customfieldpage" class="field prepend-icon">
                                                        <input type="text" name="customfieldpage" id="customfieldpage" placeholder="<?php echo  ucwords($this->lang->line('customfieldpage')); ?>"
                                                        class="gui-input" value="<?php echo set_value('customfieldpage', isset($this->data['customfieldpage']) ? $this->data['customfieldpage'] : '');?>" >
                                                        <label for="customfieldpage" class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                     <?php echo form_error('customfieldpage');?>
                                                </div>
                                            </div>

                                            
                                             <div class="section row mb10">
                                                <label for="customfieldlabel" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('customfieldlabel')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-10 ph10">
                                                    <label for="customfieldlabel" class="field prepend-icon">
                                                        <input type="text" name="customfieldlabel" id="customfieldlabel" placeholder="<?php echo  ucwords($this->lang->line('customfieldlabel')); ?>"
                                                        class="gui-input" value="<?php echo set_value('customfieldlabel', isset($this->data['customfieldlabel']) ? $this->data['customfieldlabel'] : '');?>" >
                                                        <label for="customfieldlabel" class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                     <?php echo form_error('customfieldlabel');?>
                                                </div>
                                            </div>

                                            <div class="section row mb10">
                                                <label for="customfieldname" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('customfieldname')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-10 ph10">
                                                    <label for="customfieldname" class="field prepend-icon">
                                                        <input type="text" name="customfieldname" id="customfieldname" placeholder="<?php echo  ucwords($this->lang->line('customfieldname')); ?>"
                                                        class="gui-input" value="<?php echo set_value('customfieldname', isset($this->data['customfieldname']) ? $this->data['customfieldname'] : '');?>" >
                                                        <label for="customfieldname" class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                     <?php echo form_error('customfieldname');?>
                                                </div>
                                            </div>

                                            <div class="section row mb10">
                                                <label for="customfieldtype"
                                                class="field-label col-sm-2 ph10 text-left"><?php echo  ucwords($this->lang->line('customfieldtype')); ?></label>
                                               
                                                <div class="col-sm-10 ph10">
                                                <label for="customfieldtype" class="field select">
                                                    <select id="customfieldtype" name="customfieldtype">
                                                    <option value=""><?php echo  ucwords($this->lang->line('choose')); ?></option>
                                                    <?php

                                                    $datatypes = array('INT','TEXT','PASSWORD','DECIMAL','VARCHAR','DATE','DATETIME');
                                                   foreach ($datatypes as $key => $value)      { ?>
                                                    
                                                    <option value="<?php echo $datatypes[$key];?>"  ><?php echo  ucwords($datatypes[$key])?></option>
                                                    <?php } ?>
                                                     

                                                   
                                                    </select> <i class="arrow double"></i>
                                                </label>

                                                <label for="customfieldtype" class="field-icon">
                                                    <i class="fa "></i>
                                                </label>
                                                <?php echo form_error('customfieldtype');?>
                                                </div>
                                            </div>

                                            <div class="section row mb10">
                                                <label for="customfieldsize" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('customfieldsize')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                                                <div class="col-sm-10 ph10">
                                                    <label for="customfieldsize" class="field prepend-icon">
                                                        <input type="text" name="customfieldsize" id="customfieldsize" placeholder="<?php echo  ucwords($this->lang->line('customfieldsize')); ?>"
                                                        class="gui-input" value="<?php echo set_value('customfieldsize', isset($this->data['customfieldsize']) ? $this->data['customfieldsize'] : '');?>" >
                                                        <label for="customfieldsize" class="field-icon">
                                                            <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                     <?php echo form_error('customfieldsize');?>
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
                fieldname: {
                    required: true
                },
                fieldrequire: {
                    required: true,
                },
                fieldenable: {
                    required: true
                },
                fieldposition: {
                    required: true,
                    number: true
                }
                
            },

            // error message
            messages: {
                fieldname: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                fieldrequire: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'                    
                },
                fieldenable: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },    
                fieldposition: {
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
