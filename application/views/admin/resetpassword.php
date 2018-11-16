<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.min.css">

    <!--  Plugins  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/c3charts/c3.min.css">

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

<!--  Body Wrap   -->
<div id="main">

    <!--  Header   -->
    <?php $this->load->view('admin/topnav');?>

    <!--  Sidebar   -->
    <?php $this->load->view('admin/sidebar');?>

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <!--  Topbar Menu Wrapper  -->
        <?php $this->load->view('admin/toper');?>

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">

                <!--  Products Status Table  -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <!-- <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Customers</span>
                            </div> -->
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <div class="allcp-form theme-primary tab-pane" id="register" role="tabpanel">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                  <?php echo $this->lang->line('label_change_password');?>
                                                </span>
                                            </div>
                                            <!--  /Panel Heading  -->
                                            <?php //print_r($restpassword->MemberId); ;?>
                                            <form method="post" action="" id="form-register">
                                                <div class="panel-body pn">
                                                    
                                                    <div class="section">
                                                        <label for="password" class="field prepend-icon">
                                                            <input type="password" name="password" id="password" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_password');?>" value="">
                                                            <label for="password" class="field-icon">
                                                                <i class="fa fa-lock"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('password'); ?>
                                                    </div>

                                                    <div class="section">
                                                        <label for="confirmPassword" class="field prepend-icon">
                                                            <input type="password" name="confirmPassword" id="confirmPassword"
                                                                   class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_retype_password');?>" value="">
                                                            <label for="confirmPassword" class="field-icon">
                                                                <i class="fa fa-unlock-alt"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('confirmPassword'); ?>
                                                    </div>
                                                    
                                                    <input type="hidden" name="memberid" value="<?php echo isset($restpassword->MemberId) ? $restpassword->MemberId : '';?>">

                                                    <div class="section">
                                                        
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-bordered btn-primary"> <?php echo $this->lang->line('button_change_password');?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--  /section  -->

                                                </div>
                                                <!--  /Form  -->
                                                <div class="panel-footer"></div>
                                            </form>
                                        </div>
                                        <!--  /Panel  -->
                                    </div>
                                    <!--  /Registration  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            <!--  /Column Center  -->

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>

</div>
<!--  /Body Wrap   -->

<!-- footer -->
<?php $this->load->view('admin/footer');?>
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

        $.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };

        $("#form-register").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                confirmPassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 16,
                    equalTo : "#password"
                }
            },

            // error message
            messages: {
                password: {
                    required: 'Please enter password'
                },
                confirmPassword: {
                    required: 'Please enter confirm password'
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

</body>

</html>
