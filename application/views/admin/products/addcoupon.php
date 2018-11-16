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

<body class="sales-stats-products"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

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
            <div class="chute chute-center pt30">
                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-visible" id="spy6">
                            <div class="panel-heading">

                            <h5><?php echo $this->lang->line('page_title_add'); ?></h5>
                
                            <form method="post" action="<?php echo base_url();?>admin/coupon/add/<?php if(isset($coupon->CouponId)) echo $coupon->CouponId;?>" id="form-add-coupon" enctype="multipart/form-data">
                            
                                <div class="panel-body pn">
                                
                                <?php // echo strtoupper(random_string('alnum', 16));
                                // if(isset($this->data['coupon'])) {
                                    // print_r($this->data['coupon'])
                                // }
                                ?>
                                    <div class="tab-content pn br-n allcp-form theme-primary">

                                            <div class="section row mbn">
                                                
                                                <div class="col-md-12 ph10">
                                                    
                                                    <div class="section mb10">
                                                        <label for="coupon_name" class="field prepend-icon">
                                                            <input type="text" name="coupon_name" id="coupon_name"
                                                                   class="event-name gui-input br-light light"
                                                                   placeholder="<?php echo $this->lang->line('label_name'); ?>" value="<?php echo set_value('coupon_name',isset($coupon->CouponName) ? $coupon->CouponName : ''); ?>">
                                                            <label for="coupon_name" class="field-icon">
                                                                <i class="fa fa-tag"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('coupon_name'); ?>
                                                    </div>

                                                    <!--<div class="section mb10">
                                                        <label for="coupon_product" class="field select">
                                                            <select id="coupon_product" name="coupon_product">
                                                                <option value="0" selected="selected"><?php echo $this->lang->line('label_product'); ?></option>
                                                                <?php
                                                                    $products = $this->data['product'];
                                                                    foreach($products as $product) {
                                                                        
                                                                ?>
                                                                    <option <?php echo set_select('coupon_product'); ?> value="<?php echo $product->ProductId;?>"><?php echo $product->ProductName;?></option>
                                                                    
                                                                <?php } ?>
                                                                
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('coupon_category'); ?>
                                                    </div>-->

                                                    <div class="section mb10">
                                                        <label for="coupon_category" class="field select">
                                                            <select id="coupon_category" name="coupon_category">
                                                                <option value="" selected="selected"><?php echo $this->lang->line('label_category'); ?></option>
                                                                <?php
                                                                    $category = $this->data['category'];
                                                                    foreach($category as $key => $value) {
                                                                ?>
                                                                    <option <?php if(isset($coupon->CategoryId)) if($key==$coupon->CategoryId) echo "selected";?> value="<?php echo $key;?>" <?php echo set_select('coupon_category', $key, False); ?>><?php echo trim($value);?></option>
                                                                    
                                                                <?php } ?>
                                                                
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('coupon_category'); ?>
                                                    </div>
                                                    <?php 
                                                        if(isset($coupon->CouponId)) {
                                                            $products = $this->coupon_model->GetCouponProduct($coupon->CouponId);
                                                        }
                                                    ?>
                                                    <div class="section">
                                                        <label class="field select-multiple">
                                                            <select name="productname[]" id="productname" class="productname" multiple="multiple" size="4">
                                                                
                                                                <?php
                                                                    if(isset($products)) {
                                                                        foreach ($products as $product) { ?>
                                                                            <option value="<?php echo $product->ProductId;?>" selected><?php echo $product->ProductName;?></option>
                                                                            
                                                                    <?php  
                                                                          }
                                                                    } else {
                                                                ?>
                                                                <option value="">Select Product</option>
                                                                <?php } ?>
                                                            </select>
                                                        </label>
                                                    </div>

                                                    <div class="section mb10">
                                                        <?php $selected = (isset($coupon->CouponType)) ? $coupon->CouponType : '';   ?>
                                                        <label for="product_type" class="field select">
                                                            <select id="filter-type" name="coupon_type" class="">
                                                            <?php 
                                                                if(isset($coupon->CouponId)) {
                                                                    if($coupon->CouponType == 'p') {
                                                                        $CouponType = 'p';
                                                                    } else {
                                                                        $CouponType = 'f';
                                                                    }
                                                                } else {
                                                                    $CouponType ='';
                                                                }

                                                            ?>
                                                                <option <?php if($CouponType=='p') echo "selected";?> value="p" <?php echo set_select('coupon_type','p'); ?>><?php echo $this->lang->line('option_coupon_type1'); ?></option>
                                                                <option <?php if($CouponType=='f') echo "selected";?> value="f" <?php echo set_select('coupon_type', 'f'); ?>><?php echo $this->lang->line('option_coupon_type2'); ?></option>
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('product_type'); ?>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label for="discount_price" class="field prepend-icon">
                                                            <input type="text" name="discount_price" id="discount_price" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_discount'); ?>" value="<?php echo set_value('discount_price',isset($coupon->Total) ? $coupon->Total : ''); ?>">
                                                            <label for="discount_price" class="field-icon">
                                                                <i class="fa fa-usd"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('discount_price'); ?>
                                                    </div>
                                                    
                                                    <div class="section mb10">
                                                        <label for="per_user" class="field prepend-icon">
                                                            <input type="text" name="per_user" id="per_user"
                                                                   class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_per_user'); ?>" value="<?php echo set_value('per_user',isset($coupon->UsedTotal) ? $coupon->UsedTotal : ''); ?>">
                                                            <label for="per_user" class="field-icon">
                                                                <i class="fa fa-tag"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('per_user'); ?>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label for="datepicker1" class="field prepend-icon mb5">
                                                            <input type="text" id="datepicker1" name="datepicker1" class="gui-input fs13" placeholder="<?php echo $this->lang->line('label_datepicker1'); ?>" value="<?php echo set_value('datepicker1', isset($coupon->StartDate) ? date('Y-m-d', strtotime($coupon->StartDate)) : '');?>">
                                                            <label class="field-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </label>
                                                        </label>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label for="datepicker2" class="field prepend-icon">
                                                            <input type="text" id="datepicker2" name="datepicker2" class="gui-input fs13" placeholder="<?php echo $this->lang->line('label_datepicker2'); ?>" value="<?php echo set_value('datepicker2', isset($coupon->EndDate) ? date('Y-m-d', strtotime($coupon->EndDate)) : '');?>">
                                                            <label class="field-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </label>
                                                        </label>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label class="field select">
                                                            <select id="coupon_status" name="coupon_status">
                                                            <?php 
                                                                if(isset($coupon->CouponId)) {
                                                                    if($coupon->Status) {
                                                                        $status = 'enabled';
                                                                    } else {
                                                                        $status = 'disabled';
                                                                    }
                                                                } else {
                                                                    $status ='';
                                                                }

                                                            ?>
                                                                <option value="" selected><?php echo $this->lang->line('label_status'); ?></option>
                                                                <option <?php if($status=='enabled') echo "selected";?>  value="1" <?php echo set_select('coupon_status', '1', TRUE); ?>>Enable</option>
                                                                <option <?php if($status=='disabled') echo "selected";?> value="0" <?php echo set_select('coupon_status', '0'); ?> >Disable</option>
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('coupon_status'); ?>
                                                    </div>
                                            
                                                    <input type="hidden" name="CouponId" value="<?php if(isset($coupon->CouponId)) echo $coupon->CouponId;?>"/>

                                                </div>
                                            </div>

                                            <hr class="short alt">

                                            <div class="section mbn text-right">
                                                <p class="text-right">
                                                    <button class="btn btn-bordered btn-primary" type="submit"><?php if(isset($coupon->CouponId)) echo $this->lang->line('btn_update_coupon'); else echo $this->lang->line('btn_add_coupon'); ?></button>
                                                </p>
                                            </div>
                                            <!--  /section  -->

                                    </div>
                                </div>

                            </form>
                
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
    <?php $this->load->view('admin/sidebar_right'); ?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer'); ?>


<!--  FileUpload JS  -->

<!--  Tagmanager JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<!--  /Scripts  -->

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        var optionSelected = $( "#coupon_category option:selected" ).val();

        // if(optionSelected) {
        //     var valueSelected = optionSelected;
        //     $(".productname > option").remove();
        //     $.ajax({
        //         type: "GET",
        //         url: "<?php echo base_url();?>admin/coupon/GetProduct/"+valueSelected,
        //         success: function(columns) 
        //         {
        //             $.each(columns,function(id,name) {
        //                 var opt = $('<option />');
        //                 opt.val(id);
        //                 opt.text(name);
        //                 $('.productname').append(opt);
        //             });
        //         }
        //     });
        // }
        

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#form-add-coupon").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                coupon_name: {
                    required: true
                },
                coupon_category: {
                  required: true  
                },
                discount_price: {
                    required: true,
                    number: true
                },
                per_user: {
                    required: true,
                    number: true
                },
                datepicker1: {
                    required: true
                },
                datepicker2: {
                    required: true
                },
                coupon_status: {
                  required: true  
                }
                
                
            },

            // error message
            messages: {
                coupon_name: {
                    required: 'Please enter coupon name'
                },
                coupon_category: {
                    required: 'Please select category' 
                },
                discount_price: {
                    required: 'Please enter coupon discount price',
                    number: 'Discount price is allowed only decimal number example 1.00'
                },
                per_user: {
                    required: 'Please enter maximum time used coupon per user',
                    number: 'Coupon per user is allowed only number'
                },
                datepicker1: {
                    required: 'Please coupon start date'
                },
                datepicker2: {
                    required: 'Please enter coupon end date'
                },
                coupon_status: {
                  required: 'Please select coupon status'  
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

        $('#show_info').click(function() {

            if ($(this).is(':checked')) {
                $('#additional-option').css('display', 'block');
            } else {
                $('#additional-option').css('display', 'none');
            }
        })

         $('#coupon_category').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            $(".productname > option").remove();
            //console.log(valueSelected);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url();?>admin/coupon/GetProduct/"+valueSelected,
                success: function(columns) //we're calling the response json array 'cities'
                {
                 
                    $.each(columns,function(id,name) {
                        //console.log(id);
                        // console.log(name);
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        // opt.html("<input type='hidden' name='column[]' value='"+name+"'/>"+name);
                        $('.productname').append(opt);
                    });
                }
            });
        });

    });

})(jQuery);
</script>



</body>

</html>
