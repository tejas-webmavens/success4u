<div id="payment-address-content" class="panel-collapse collapse in" style="padding: 15px;">
<form method="post" action="<?php echo base_url();?>user/checkout/guest" id="existing-customer">
  <?php if ($addresses) { ?>
  <div class="radio">
    <label>
      <input type="radio" name="payment_address" value="existing" checked="checked" />
      <?php echo $this->lang->line('label_existing_account');?></label>
  </div>

  <div id="payment-existing">
    <select name="address_id" class="form-control">
      
      <?php echo $addresses->FirstName; ?>
      <?php
      $checkcountry=$this->common_model->GetRow("country_id='".$addresses->Country."'","arm_country");

      ?>
      <option value="" selected="selected"><?php echo $addresses->FirstName; ?> <?php echo $addresses->LastName; ?>, <?php echo $addresses->Address; ?>, <?php echo $addresses->City; ?>, <?php echo $addresses->Zip; ?>, <?php echo $checkcountry->name; ?></option>
      
      
    </select>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="payment_address" value="new" />
      <?php echo $this->lang->line('label_new_address');?></label>
  </div>
  <?php } ?>
  <br />
  
<div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
  
  <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="firstname"><?php echo $this->lang->line('label_firstname');?> <span class="require">*</span></label>
          <input type="text" id="firstname" name="firstname" class="form-control" value="">
        </div>
      
        <div class="form-group">
          <label for="lastname"><?php echo $this->lang->line('label_lastname');?> <span class="require">*</span></label>
          <input type="text" id="lastname" name="lastname" class="form-control">
        </div>
        <div class="form-group">
          <label for="telephone"><?php echo $this->lang->line('label_telephone');?> <span class="require">*</span></label>
          <input type="text" id="telephone" name="phone" class="form-control">
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
          <label for="region-state"><?php echo $this->lang->line('label_firstname');?>Region/State <span class="require">*</span></label>
          <select class="form-control input-sm" id="region-state" name="state">
            <option value=""> --- <?php echo $this->lang->line('option_select');?> --- </option>
          </select>
        </div>

        
      </div>
    </div>
      
      </div>
      <div class="row">
      <!-- <input type="text" name="referal" value="<?php echo $ref;?>"> -->
      <button class="btn btn-primary  pull-right" type="button" onClick="newaddress()" id="button-saved-address">Continue</button>
      </div>
      
    </form>
</div>

<script type="text/javascript">
$('input[name=\'payment_address\']').on('change', function() {
  if (this.value == 'new') {
    $('#payment-existing').hide();
    $('#payment-new').show();
  } else {
    $('#payment-existing').show();
    $('#payment-new').hide();
  }
});

function newaddress() {

  if ($('#existing-customer').valid()) {

        $.ajax({
            url: 'checkout/shipping',
            type: 'POST',
            data: $('#payment-address-content :input'),
            beforeSend: function() {
                $('#button-saved-address').button('loading');
            },
            complete: function() {
                $('#button-saved-address').button('reset');
            },
            success: function(html) {
                $('#shipping-method .panel-heading').after(html);

                $('#shipping-method-content').parent().find('.panel-heading .panel-title').html('<a href="#shipping-method-content" data-toggle="collapse" data-parent="#checkout-page" class="accordion-toggle"> <i class="fa fa-dollar"></i> Shipping Method </a>');
                
                $('#payment-address-content').removeClass('in');
                $('#shipping-method-content').addClass('in');
                // $('a[href=\'#payment-method\']').trigger('click');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
  }
</script>
<script type="text/javascript">


(function($) {

    $(document).ready(function() {

      

        $.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };

        $.validator.addMethod("alpha", function(value, element) {
            // return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
            return this.optional(element) || value == value.match(/^[a-z0-9\-\s]+$/i);
        });

        $("#existing-customer").validate({

            // States

            errorClass: "text-danger",
            validClass: "text-success",
            errorElement: "em",

            // Rules

            rules: {
                
                firstname: {
                    required: true,
                    alpha: true,
                    minlength: 3,
                },
                lastname: {
                    required: true,
                    alpha: true
                },
                address: {
                    required: true,
                    minlength: 10,
                },
                city: {
                    required: true,
                    alpha: true,
                    minlength: 3,
                },
                zip: {
                    required: true,
                    alpha: true,
                    minlength: 3,
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
                    maxlength: 15
                }
                
            },

            // error message
            messages: {
                firstname: {
                    required: 'Please enter first name',
                    alpha: 'Please enter only alpha numeric characters.',
                    minlength: 'Please enter firstname is minimum 3 characters'
                },
                lastname: {
                    required: 'Please enter last name',
                    alpha: 'Please enter only alpha numeric characters.'
                },
                address: {
                    required: 'Please enter User Address',
                    minlength: 'Please enter address is minimum 10 characters'
                },
                city: {
                    required: 'Please enter User City',
                    alpha: 'Please enter only alpha numeric characters.',
                    minlength: 'Please enter city is minimum 3 characters'
                },
                zip: {
                    required: 'Please enter postal code',
                    alpha: 'Please enter only numeric characters.',
                    minlength: 'Please enter postal code is minimum 4 digit',
                    maxlength: 'Please enter postal code is maximum 8 digit'
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