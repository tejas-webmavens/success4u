<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <!-- <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> -->

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
<style>
.allcp-form em.state-error {
    color: #de888a;
    display: block !important;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 0.85em;
    font-style: normal;
    line-height: normal;
    margin-top: 6px;
    padding: 0 3px;
}
</style>

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

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">

                <!--  Products Status Table  -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> <span class="pg-danger"></span></span>
                            </div>
                            <div class="panel-body pn">
                                <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php 
                                    unset($_SESSION['error_message']);
                                    } 
                                    ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="table-responsive">
                                    <div class="allcp-form theme-primary tab-pane" id="register" role="tabpanel">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-title">
                                                    <?php if(isset($member->MemberId)) {
                                                        echo $this->lang->line('label_edit_user');
                                                    } else {
                                                        echo $this->lang->line('label_add_user');
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            
                                            <form method="post" class="customer-forms" name="registerform" action="" enctype="multipart/form-data">
                                                <div class="panel-body pn">
                                                <?php //print_r($reqfields);?>
                                                    <?php if(empty($member->MemberId)) {?>
                                                   
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('place_sponsorname');?> <sup class="state-error1">*</sup></p>
                                                        <label for="sponsorname" class="field prepend-icon">
                                                            <input type="sponsorname" name="sponsorname" id="sponsorname" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('place_sponsorname');?>" value="<?php echo set_value('sponsorname',isset($member->sponsorname) ? $member->sponsorname : ''); ?>">
                                                            <label for="sponsorname" class="field-icon">
                                                                <i class="fa fa-user"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('sponsorname','<em class="state-error">','</em>'); ?>
                                                    </div>

                                                    <?php } ?>


<?php  /*?>

                                                    <?php if(in_array('FirstName', $reqfields)) {?>
                                                        <div class="section">
                                                            <p><?php echo $this->lang->line('label_firstname');?> <sup class="state-error1">*</sup></p>
                                                            <label for="firstname" class="field prepend-icon">
                                                                <input type="text" name="firstname" id="firstname"
                                                                       class="gui-input"
                                                                       placeholder="<?php echo $this->lang->line('label_firstname');?>" value="<?php echo set_value('firstname', isset($member->FirstName) ? $member->FirstName : ''); ?>">
                                                                <label for="firstname" class="field-icon">
                                                                    <i class="fa fa-user"></i>
                                                                </label>
                                                            </label>
                                                            <?php echo form_error('firstname'); ?>
                                                        </div>
                                                    <?php } ?>
                                                        <!--  /section  -->
                                                        <?php if(in_array('LastName', $reqfields)) {?>
                                                        <div class="section">
                                                            <p><?php echo $this->lang->line('label_lastname');?> <sup class="state-error1">*</sup></p>
                                                            <label for="lastname" class="field prepend-icon">
                                                                <input type="text" name="lastname" id="lastname" class="gui-input"
                                                                       placeholder="<?php echo $this->lang->line('label_lastname');?>" value="<?php echo set_value('lastname',isset($member->LastName) ? $member->LastName : ''); ?>">
                                                                <label for="lastname" class="field-icon">
                                                                    <i class="fa fa-user"></i>
                                                                </label>
                                                            </label>
                                                            <?php echo form_error('lastname'); ?>
                                                        </div>
                                                         <?php } ?>
                                                        <!--  /section  -->
                                                   
                                                                   
                                                   
                                                        
                                                        
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_username');?> <sup class="state-error1">*</sup></p>
                                                        <label for="username" class="field prepend-icon">
                                                            <input type="text" name="username" id="username" class="gui-input" <?php if(isset($member->MemberId)) { echo 'readonly'; } ?>
                                                                   placeholder="<?php echo $this->lang->line('label_username');?>" value="<?php echo set_value('username',isset($member->UserName) ? $member->UserName : ''); ?>">
                                                            <label for="username" class="field-icon">
                                                                <i class="fa fa-user"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('username'); ?>
                                                    </div>

                                                   

                                                     <?php if(in_array('Address', $reqfields)) {?>
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_address');?> <sup class="state-error1">*</sup></p>
                                                        <label for="Address" class="field prepend-icon">
                                                            <input type="text" name="address" id="address" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_address');?>" value="<?php echo set_value('Address',isset($member->Address) ? $member->Address : ''); ?>">
                                                            <label for="Address" class="field-icon">
                                                                <i class="fa fa-building"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('address'); ?>
                                                    </div>
                                                       <?php }?>
                                                     <?php if(in_array('City', $reqfields)) {?>
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_city');?> <sup class="state-error1">*</sup></p>
                                                        <label for="city" class="field prepend-icon">
                                                            <input type="text" name="city" id="city" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_city');?>" value="<?php echo set_value('city',isset($member->City) ? $member->City : ''); ?>">
                                                            <label for="city" class="field-icon">
                                                                <i class="fa fa-building"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('city'); ?>
                                                    </div>
                                                        <?php }?>
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_phone');?> <sup class="state-error1">*</sup></p>
                                                        <label for="Phone" class="field prepend-icon">
                                                            <input type="text" name="phone" id="phone" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_phone');?>" value="<?php echo set_value('phone',isset($member->Phone) ? $member->Phone : ''); ?>">
                                                            <label for="Phone" class="field-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('phone'); ?>
                                                    </div>

                                                    
<?php*/  ?>
                                                    

                            <?php $customfieldata = json_decode($member->CustomFields);
                            	if($customfieldata)
                            foreach ($customfieldata as $key => $value) {$member->$key = $value; }
                            
                            foreach ($enablefields as $row) {
                                
                                if($row->FieldEnableStatus==1 && $row->ReuireFieldName!='Password' && $row->ReuireFieldName!='Email' && $row->ReuireFieldName!='Country'&& $row->ReuireFieldName!='UserName')
                                {  $fname = $row->ReuireFieldName?>
                                    

                                       <?php if(in_array($row->ReuireFieldName,$customfields)) {?>

                                     <div class="section">
                                            <p><?php echo ucwords($row->ReuireFieldName);?> <?php if($row->ReuireFieldStatus=='1') {$st = 'required'; ?>?<sup class="state-error1">*</sup> <?php } else{$st="";}?></p>
                                            <label for="<?php echo  $row->ReuireFieldName;?>" class="field prepend-icon">
                                                <input type="text" name="<?php echo  $row->ReuireFieldName;?>" id="<?php echo  $row->ReuireFieldName;?>" class="gui-input"
                                                       placeholder="<?php echo $this->lang->line('label_'.strtolower($row->ReuireFieldName).'');?>" value="<?php echo set_value($row->ReuireFieldName,isset($member->$fname) ? $member->$fname : '');?>" <?php echo  $st;?>>
                                                <label for="<?php echo  $row->ReuireFieldName;?>" class="field-icon">
                                                    <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                    <?php echo form_error($row->ReuireFieldName,'<em class="state-error">','</em>'); ?>
                                                </div>
                                         <?php }else{?>
      

                                     <div class="section">
                                            <p><?php echo ucwords($row->ReuireFieldName);?> <sup class="state-error1">*</sup></p>
                                            <label for="<?php echo  $row->ReuireFieldName;?>" class="field prepend-icon">
                                                <input type="text" name="<?php echo  $row->ReuireFieldName;?>" id="<?php echo  $row->ReuireFieldName;?>" class="gui-input"
                                                       placeholder="<?php echo $this->lang->line('label_'.strtolower($row->ReuireFieldName).'');?>" value="<?php echo set_value($row->ReuireFieldName,isset($member->$fname) ? $member->$fname : '');?>">
                                                <label for="<?php echo  $row->ReuireFieldName;?>" class="field-icon">
                                                    <i class="fa fa-info"></i>
                                                        </label>
                                                    </label>
                                                    <?php echo form_error($row->ReuireFieldName,'<em class="state-error">','</em>'); ?>
                                                </div>
                                         <?php }?>

                                <?php 
                                    $st='';
                                }

                                elseif ($row->ReuireFieldName=='Password') 
                                    {   ?>
                                 <?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>

                                <?php if(empty($member->MemberId)) {?>
                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_password');?> <sup class="state-error1">*</sup></p>
                                                        <label for="password" class="field prepend-icon">
                                                            <input type="password" name="password" id="password" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_password');?>" value="">
                                                            <label for="password" class="field-icon">
                                                                <i class="fa fa-lock"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('password','<em class="state-error">','</em>'); ?>
                                                    </div>

                                                    <div class="section">
                                                        <p><?php echo $this->lang->line('label_retype_password');?> <sup class="state-error1">*</sup></p>
                                                        <label for="confirmPassword" class="field prepend-icon">
                                                            <input type="password" name="confirmPassword" id="confirmPassword"class="gui-input"placeholder="<?php echo $this->lang->line('label_retype_password');?>" value="">
                                                            <label for="confirmPassword" class="field-icon">
                                                                <i class="fa fa-unlock-alt"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('confirmPassword','<em class="state-error">','</em>'); ?>
                                                    </div>
                               <?php } ?>



                                <?php $st=''; 
                                    } 

                                elseif ($row->ReuireFieldName=='Email') 
                                    {   ?>
                                <?php if($row->ReuireFieldStatus=='1') {$st = 'email required';}else{$st="";}?>
                                     <div class="section">
                                                <p><?php echo $this->lang->line('label_email');?> <sup class="state-error1">*</sup></p>
                                                <label for="email" class="field prepend-icon">
                                                    <input type="email" name="email" id="email" class="gui-input" <?php if(isset($member->MemberId)) { echo 'readonly'; } ?>
                                                           placeholder="<?php echo $this->lang->line('label_email');?>" value="<?php echo set_value('email',isset($member->Email) ? $member->Email : ''); ?>">
                                                    <label for="email" class="field-icon">
                                                        <i class="fa fa-envelope"></i>
                                                    </label>
                                                </label>
                                                <?php echo form_error('email','<em class="state-error">','</em>'); ?>
                                            </div>

                                <?php $st=''; 
                                    }
                                    elseif ($row->ReuireFieldName=='UserName') 
                                    {   ?>
                                <?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>
                                     <div class="section">
                                                <p><?php echo $this->lang->line('label_username');?> <sup class="state-error1">*</sup></p>
                                                <label for="UserName" class="field prepend-icon">
                                                    <input type="text" name="UserName" id="UserName" class="gui-input" <?php if(isset($member->MemberId)) { echo 'readonly'; } ?>
                                                           placeholder="<?php echo $this->lang->line('label_username');?>" value="<?php echo set_value('UserName',isset($member->UserName) ? $member->UserName : ''); ?>">
                                                    <label for="email" class="field-icon">
                                                        <i class="fa fa-envelope"></i>
                                                    </label>
                                                </label>
                                                <?php echo form_error('UserName','<em class="state-error">','</em>'); ?>
                                            </div>

                                <?php $st=''; 
                                    }

                                elseif($row->ReuireFieldName=='Country')
                                    { if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";} ?>
                                        <div class="section">
                                              <p><?php echo $this->lang->line('label_country');?> <sup class="state-error1">*</sup></p>
                                                <label for="country" class="field select">
                                                <select id="Country" name="Country" class="gui-input">
                                                <?php if(isset($member->Country)) echo $cntry = trim($member->Country);?>
                                                    <option value="" selected="selected"><?php //echo $this->lang->line('label_country');?>-- Select Country -- </option>
                                                    <?php
                                                        foreach($country as $row) { ?>
                                                        <option <?php echo set_select('country'); ?> <?php if($member->Country==$row->country_id) echo "selected";?> value="<?php echo $row->country_id;?>"><?php echo $row->name;?></option>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('Country','<em class="state-error">','</em>'); ?>
                                            </div>

                                 <?php   }

                    } ?>

                                                <p class="mb15"><?php echo  ucwords($this->lang->line('profileimage')); ?></p>

                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail mb20">
                                                        <img src="<?php echo base_url()."uploads/UserProfileImage/"; if(isset($member->ProfileImage)){echo $member->ProfileImage;}?>" alt="holder">
                                                    </div>
                                                    <span class="btn btn-primary light btn-file btn-block ph5">
                                                        <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                                                        <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                                                        <input type="file"  name="profileimage"  value="<?php if(isset($member->ProfileImage)){echo $member->ProfileImage;}?>">
                                                    </span>
                                                    <?php echo form_error('profileimage','<em class="state-error">','</em>'); ?>
                                                </div>


                                                    <input type="hidden" name="memberid" value="<?php echo isset($member->MemberId) ? $member->MemberId : '';?>">
                                                    <br/>
                                                    <div class="section">
                                                        
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-bordered btn-primary"> <?php if(isset($member->MemberId)) { echo $this->lang->line('button_update_user'); } else { echo $this->lang->line('button_create_user'); } ?>
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
<!--  jQuery  -->
<?php $this->load->view('admin/footer');?>


<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>





<!--  Theme Scripts 
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>-->

<?php //$this->load->view('admin/activemenu');?>

<!--<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/userform-validation.js"></script>
<!-<script src="<?php echo base_url();?>assets/js/pages/sales-stats-clients.js"></script>-->


<script type="text/javascript">
//'use strict';
(function($) {

    $(document).ready(function() {

        $.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };

        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
        });

        $(".customer-forms").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                sponsorname: {
                    required: true,
                    alpha : true
                },
                firstname: {
                    required: true,
                    alpha : true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                username: {
                    required: true,
                    alphanumeric : true,
                    minlength: 5,
                    maxlength: 16
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                confirmPassword: {
                    equalTo : "#password"
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13
                }
                
            },

            // error message
            messages: {
                sponsorname: {
                    required: '<?php echo $this->lang->line('required_sponsorname');?>',
                    alpha: '<?php echo $this->lang->line('required_alpha');?>'
                },
                firstname: {
                    required: '<?php echo $this->lang->line('required_firstname');?>',
                    alpha: '<?php echo $this->lang->line('required_alpha');?>'
                },
                lastname: {
                    required: '<?php echo $this->lang->line('required_lastname');?>',
                    alpha: '<?php echo $this->lang->line('required_alpha');?>'
                },
                email: {
                    required: '<?php echo $this->lang->line('required_email');?>',
                    email: '<?php echo $this->lang->line('invalid_email');?>'
                },
                username: {
                    required: '<?php echo $this->lang->line('required_username');?>',
                    alphanumeric: '<?php echo $this->lang->line('required_alpha');?>',
                    minlength: '<?php echo $this->lang->line('username_min');?>',
                    maxlength: '<?php echo $this->lang->line('username_max');?>'
                },
                password: {
                    required: '<?php echo $this->lang->line('required_password');?>',
                    minlength: '<?php echo $this->lang->line('password_min');?>',
                    maxlength: '<?php echo $this->lang->line('password_max');?>'
                },
                confirmPassword: {
                    equalTo: '<?php echo $this->lang->line('required_confirmPassword');?>'
                },
                address: {
                    required: '<?php echo $this->lang->line('required_address');?>'
                },
                city: {
                    required: '<?php echo $this->lang->line('required_city');?>'
                },
                country: {
                    required: '<?php echo $this->lang->line('required_country');?>'
                },
                phone: {
                    required: '<?php echo $this->lang->line('required_phone');?>',
                    number: '<?php echo $this->lang->line('required_number');?>',
                    minlength: '<?php echo $this->lang->line('phone_min');?>',
                    maxlength: '<?php echo $this->lang->line('phone_max');?>'
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
            // ,
            // errorPlacement: function(error, element) {
            //     if (element.is(":select") || element.is(":selected")) {
            //         element.closest('.option-group').after(error);
            //     } else {
            //         error.insertAfter(element.parent());
            //     }
            // }
        });

    });

})(jQuery);
</script>

</body>

</html>