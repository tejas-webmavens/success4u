<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  Datatables CSS  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/media/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/Editor/css/dataTables.editor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">

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
    
<style>
input, select {
    width: 120px;
}
</style>
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
        <div class="chute chute-center pt30">
        <!-- <form name="" method="post" action="<?php echo base_url();?>admin/shipping" id="form-add-shipping"> -->
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="section row mb20">
                                <?php if($this->session->flashdata('error_message')) { ?>    
                                    <div class="col-md-12 bg-danger pt10 pb10 ">
                                        <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                    </div>
                                <?php } ?>
                                
                                <?php if($this->session->flashdata('success_message')) { ?>    
                                    <div class="col-md-12 bg-success pt10 pb10 ">
                                        <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="panel-title hidden-xs">
                                <?php echo $this->lang->line('page_title'); ?>
                            </div>
                        </div>
                        <div class="panel-body pn">
                        
                            <div class="table-responsive" id="shipping_api_method" class="allcp-form theme-primary tab-pane">
                                <form name="" method="post" action="<?php echo base_url();?>admin/captcha" id="captcha_api_form">
                                    <div class="tab-content pn br-n allcp-form theme-primary">

                                        <div class="section row mbn">
                                            
                                            <div class="col-md-12 ph10">

                                                <div class="section">
                                                    <label class="field-label" for=""><?php echo $this->lang->line('label_siteKey'); ?> <sup class="state-error1">*</sup></label>
                                                    <input type="text" placeholder="Site Key" class="gui-input" id="siteKey" name="siteKey" value="<?php echo set_value('siteKey',isset($siteKey) ? $siteKey : ''); ?>">
                                                    <?php echo form_error('siteKey'); ?>
                                                </div>

                                                <div class="section">
                                                    <label class="field-label" for=""><?php echo $this->lang->line('label_secretKey'); ?> <sup class="state-error1">*</sup></label>
                                                    <input type="text" placeholder="Secret Key" class="gui-input" id="secretKey" name="secretKey" value="<?php if(isset($secretKey)) echo $secretKey;?>">
                                                    <?php echo form_error('secretKey'); ?>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="short alt">

                                        <div class="section mbn text-right">
                                            <p class="text-right">
                                                <button class="btn btn-bordered btn-primary" type="button" onclick="validateFunc()"><?php echo $this->lang->line('btn_update_api');?></button>
                                            </p>
                                        </div>
                                        <!--  /section  -->

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
            
        </div>
        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->


<!--  Scripts  -->

<!--  jQuery  -->
<?php $this->load->view('admin/footer');?>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>

<script type="text/javascript">
function validateFunc() {
	console.log('click');
    if ($('#captcha_api_form').valid()) {
    	$('#captcha_api_form').submit();
    }
}	
</script>  
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        $("#captcha_api_form").validate({

            // States

            errorClass: "state-error1",
            validClass: "state-success",
           

            // Rules

            rules: {
                siteKey: {
                    required: true
                },
                secretKey: {
                    required: true
                }
                
            },

            // error message
            messages: {
                siteKey: {
                    required: 'Please enter google captcha site key'
                },
                secretKey: {
                    required: 'Please enter google captcha secret key'
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
</script>                          
