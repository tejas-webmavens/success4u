<div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                  <form method="post" action="<?php echo base_url();?>user/checkout/register" class="customer-forms">
                    <div class="col-md-6 col-sm-6">
                      <h3><?php echo $this->lang->line('label_personal_info');?></h3>
                      <div class="form-group">
                        <label for="firstname"><?php echo $this->lang->line('label_firstname');?> <span class="require">*</span></label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="">
                      </div>
                      <?php echo form_error('firstname');?>
                      <div class="form-group">
                        <label for="lastname"><?php echo $this->lang->line('label_lastname');?> <span class="require">*</span></label>
                        <input type="text" id="lastname" name="lastname" class="form-control">
                      </div>
                      <?php echo form_error('lastname');?>
                      <div class="form-group">
                        <label for="email"><?php echo $this->lang->line('label_email');?> <span class="require">*</span></label>
                        <input type="text" id="email" name="email" class="form-control">
                      </div>
                      <?php echo form_error('email');?>
                      <div class="form-group">
                        <label for="telephone"><?php echo $this->lang->line('label_telephone');?> <span class="require">*</span></label>
                        <input type="text" id="telephone" name="phone" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="fax"><?php echo $this->lang->line('label_telephone');?></label>
                        <input type="text" id="fax" class="form-control">
                      </div>

                      <h3><?php echo $this->lang->line('label_password_info');?></h3>
                      <div class="form-group">
                        <label for="password"><?php echo $this->lang->line('label_password');?> <span class="require">*</span></label>
                        <input type="password" id="password" name="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm"><?php echo $this->lang->line('label_password_confirm');?> <span class="require">*</span></label>
                        <input type="password" id="password-confirm" name="confirmPassword" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3><?php echo $this->lang->line('label_your_address');?></h3>
                      <div class="form-group">
                        <label for="company"><?php echo $this->lang->line('label_company');?></label>
                        <input type="text" id="company" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="address1"><?php echo $this->lang->line('label_address_1');?> <span class="require">*</span></label>
                        <input type="text" id="address" name="address" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="address2"><?php echo $this->lang->line('label_address_2');?></label>
                        <input type="text" id="address2" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="city"><?php echo $this->lang->line('label_city');?> <span class="require">*</span></label>
                        <input type="text" id="city" name="city" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="post-code"><?php echo $this->lang->line('label_post_code');?> <span class="require">*</span></label>
                        <input type="text" id="post-code" name="zip" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="country"><?php echo $this->lang->line('label_country');?> <span class="require">*</span></label>
                        <select class="form-control input-sm" id="country" name="country" onchange="SelectZone(this)">
                          <option value=""> --- <?php echo $this->lang->line('option_select');?> --- </option>
                          <?php foreach ($country as $row) { ?>
                            <option value="<?php echo $row->country_id;?>"><?php echo $row->name;?></option>  
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="region-state"><?php echo $this->lang->line('label_state');?> <span class="require">*</span></label>
                        <select class="form-control input-sm" id="region-state" name="state">
                          <option value=""> --- <?php echo $this->lang->line('option_select');?> --- </option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12">                      
                    <div class="col-md-12">    
					           <div class="checkbox">
                        <label>
                          <input type="checkbox" checked="checked"> <?php echo $this->lang->line('label_delivery_address');?>
                        </label>
                      </div>
					          </div>
                      
                      <button class="btn btn-primary  pull-right" type="button" onclick="registration()" id="button-registe22r reg-btn"><?php echo $this->lang->line('label_countine');?></button>
                      <div class="checkbox pull-right">
                        <label for="reg_aggree">
                          <input type="checkbox" name="aggree" id="reg_aggree"> <a title="Privacy Policy" target="_blank" href="<?php echo base_url();?>user/cms/privacy"><?php echo $this->lang->line('privacy');?> </a> &nbsp;&nbsp;&nbsp; 
                        </label>
                      </div>                        
                    </div>
                    </form>
                  </div>
                </div>

<script type="text/javascript">


(function($) {

    $(document).ready(function() {

      

        $.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };

        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-z0-9\-\s]+$/i);
        });

        $(".customer-forms").validate({

            // States

            errorClass: "text-danger",
            validClass: "text-success",
            errorElement: "em",

            // Rules

            rules: {
                
                firstname: {
                    required: true,
                    alpha: true,
                    minlength: 3
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                // username: {
                //     required: true,
                //     alpha : true,
                //     minlength: 5,
                //     maxlength: 16
                // },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                confirmPassword: {
                    equalTo : "#password"
                },
                address: {
                    required: true,
                    minlength: 10
                },
                city: {
                    required: true,
                    alpha: true,
                    minlength: 3
                },
                zip: {
                    required: true,
                    alpha: true,
                    minlength: 4,
                    maxlength: 8
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13
                },
                aggree: {
                  required: true
                }
                
            },

            // error message
            messages: {
                firstname: {
                    required: 'Please enter first name',
                    alpha: 'Please enter only alpha numeric characters.',
                    minlength: 'Firstname minimum 3 characters'
                },
                lastname: {
                    required: 'Please enter last name',
                    alpha: 'Please enter only alpha numeric characters.'
                },
                email: {
                    required: 'Please enter Email',
                    email: 'Enter a VALID email address'
                },
                // username: {
                //     required: 'Please enter User name',
                //     alpha: 'Please enter only alpha numeric characters.',
                //     minlength: 'Please enter user name is minimum 5 letters',
                //     maxlength: 'Please enter user name is maximum 16 letters'
                // },
                password: {
                    required: 'Please enter password',
                    minlength: 'Please enter password is minimum 6 length',
                    maxlength: 'Please enter password is maximum 16 length'
                },
                confirmPassword: {
                    equalTo: 'Please enter confirm password'
                },
                address: {
                    required: 'Please enter User Address'
                },
                city: {
                    required: 'Please enter User City',
                    alpha: 'Please enter only alpha numeric characters.',
                    minlength: 'City minimum 3 characters'
                },
                zip: {
                    required: 'Please enter postal code',
                    number: 'Please enter only numeric characters.',
                    minlength: 'Please enter phone number is minimum 4 digit',
                    maxlength: 'Please enter phone number is maximum 8 digit'
                },
                country: {
                    required: 'Please select country'
                },
                state: {
                    required: 'Please select state'
                },
                phone: {
                    required: 'Please enter Phone Number',
                    number: 'Please enter only numeric characters.',
                    minlength: 'Please enter phone number is minimum 10 digit',
                    maxlength: 'Please enter phone number is maximum 13 digit'
                },
                aggree: {
                  required: 'Please check terms and conditions'
                }

            },


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