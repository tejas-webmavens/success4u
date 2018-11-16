<!DOCTYPE html>
<html>

<!-- Login Header -->
<?php $this->load->view('admin/login_header'); ?>
<?php //print_r($this->data);exit;?>
<body class="utility-page sb-l-c sb-r-c"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

<!--  Body Wrap   -->
<div id="main" class="animated fadeIn">

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!--  Content  -->
        <section id="content">

            <!--  Login Form  -->
            <div class="allcp-form theme-primary mw320" id="login">
                <div class="text-center mb20">
                    <img src="<?php echo base_url();?>assets/img/logo_login_form.png" class="img-responsive" alt="Logo"/>
                </div>
                <div class="panel mw320">

                    <div class="section row mbn">
                        <?php if($this->session->flashdata('error_message')) { ?>    
                            <div class="col-md-12 bg-danger pt10 pb10 ">
                                <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                            </div>
                        <?php unset($_SESSION['error_message']); } ?>
                    </div>
                    
                    <form method="post" action="" id="allcp-form">
                        <div class="panel-body pn mv10">

                            <div class="section">
                                <label for="username" class="field prepend-icon">
                                    <input type="text" name="username" id="username" class="gui-input" placeholder="Username" value="<?php echo set_value('username');?>">
                                    <label for="username" class="field-icon">
                                        <i class="fa fa-user"></i>
                                    </label>
                                </label>
                                <?php echo form_error('username'); ?>
                            </div>
                            <!--  /section  -->

                            <div class="section">
                                <label for="password" class="field prepend-icon">
                                    <input type="password" name="password" id="password" class="gui-input" placeholder="Password" value="">
                                    <label for="password" class="field-icon">
                                        <i class="fa fa-lock"></i>
                                    </label>
                                </label>
                                <?php echo form_error('password'); ?>
                            </div>

                             <div class="section">
                                <label for="captcha" class="field prepend-icon">
                                    <input type="captcha" name="captcha" id="captcha" class="gui-input" placeholder="captcha" value="">
                                    <label for="captcha" class="field-icon">
                                        <i class="fa fa-refresh"></i>
                                    </label>
                                </label>
                                <?php echo form_error('captcha'); ?>
                            </div>

                            <div class="section">
                                <label for="captcha" class="field prepend-icon"><?php echo $captcha['image'];?></label>
                                </div>
                            <!--  /section  -->

                            <div class="section">
                                <div class="bs-component pull-left pt5">
                                    <div class="radio-custom radio-primary mb5 lh25">
                                        <input type="radio" id="remember" name="remember">
                                        <label for="remember">Remember me</label>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-bordered btn-primary pull-right" value="Log in"/>
                                <!-- <button type="submit" class="btn btn-bordered btn-primary pull-right">Log in</button> -->
                            </div>
                            <!--  /section  -->

                        </div>
                        <!--  /Form  -->
                    </form>
                </div>
                <!--  /Panel  -->
            </div>
            <!--  /Spec Form  -->

        </section>
        <!--  /Content  -->

    </section>
    <!--  /Main Wrapper  -->

</div>
<!--  /Body Wrap   -->

<!--  Login Footer   -->
<?php $this->load->view('admin/login_footer');?>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        "use strict";
        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        $.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };

        $("#allcp-form").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                username: {
                    required: true
                },
                captcha: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                }
            },

            // error message
            messages: {
                username: {
                    required: 'Please Enter Username'
                },
                password: {
                    required: 'Please Enter Password'
                },
                captcha: {
                    required: 'Please Enter Captcha'
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
</script>
</body>

</html>
