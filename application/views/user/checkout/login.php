<div id="checkout-content" class="panel-collapse collapse in">
	<div class="panel-body row">
	<div class="col-md-6 col-sm-6">
	  <h3><?php echo $this->lang->line('label_new_customer');?></h3>
	  <p><?php echo $this->lang->line('label_checkout_options');?></p>
	  <div class="radio-list">
	    <label>
	      <input type="radio" name="account"  value="register"> <?php echo $this->lang->line('label_register_account');?>
	    </label>
	    <label>
	      <input type="radio" name="account" checked="checked" value="guest"> <?php echo $this->lang->line('label_guest_checkout');?>
	    </label> 
	  </div>
	  <p><?php echo $this->lang->line('label_login_info_page');?></p>
	  <button id="button-account" class="btn btn-primary" ><?php echo $this->lang->line('label_continue');?></button>
	</div>
	<!-- <div class="col-md-6 col-sm-6">
	  <h3><?php echo $this->lang->line('label_returning');?></h3>
	  <p><?php echo $this->lang->line('label_returning_customer');?>  </p>

	  <form role="form" action="<?php echo base_url();?>user/checkout/login" method="post" id="allcp-form">
	    <div class="form-group">
	      <label for="email-login"><?php echo $this->lang->line('label_email');?></label>
	      <input type="text" id="email-login" class="form-control" name="email">
	    </div>
	    <div class="form-group">
	      <label for="password-login"><?php echo $this->lang->line('label_password');?></label>
	      <input type="password" id="password-login" class="form-control" name="password">
	    </div>
	    <a href="#"><?php echo $this->lang->line('label_forgot_password');?></a>
	    <div class="padding-top-20">                  
	      <button id="button-login" class="btn btn-primary" type="button"><?php echo $this->lang->line('label_login');?></button>
	    </div>
	    <hr>
	    <div class="login-socio">
	      <p class="text-muted"><?php echo $this->lang->line('label_login_using');?></p>
	      <ul class="social-icons">
	        <li><a href="#" data-original-title="facebook" class="facebook" title="facebook"></a></li>
	        <li><a href="#" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>
	        <li><a href="#" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>
	        <li><a href="#" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>
	      </ul>
	    </div>
	  </form>
	</div> -->
	</div>
</div>

<script src="http://192.168.2.13/saravanan/armcip/assets/allcp/forms/js/jquery.validate.min.js"></script>
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

        $("#allcp-form").validate({

            // States

            errorClass: "text-danger",
            validClass: "text-success",
            errorElement: "em",

            // Rules

            rules: {
                email: {
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
                email: {
                    required: 'Please enter username'
                },
                password: {
                    required: 'Please enter password'
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