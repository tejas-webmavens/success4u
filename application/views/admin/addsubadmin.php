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
                                    <?php } ?>
                                    
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
                                            
                                            <form method="post" action="" id="form-register" name="registerform">
                                                <div class="panel-body pn">

                                                    <div class="section row">
                                                        <div class="col-md-6 ph10 mb5">
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
                                                        <!--  /section  -->

                                                        <div class="col-md-6 ph10 mb5">
                                                            <label for="lastname" class="field prepend-icon">
                                                                <input type="text" name="lastname" id="lastname" class="gui-input"
                                                                       placeholder="<?php echo $this->lang->line('label_lastname');?>" value="<?php echo set_value('lastname',isset($member->LastName) ? $member->LastName : ''); ?>">
                                                                <label for="lastname" class="field-icon">
                                                                    <i class="fa fa-user"></i>
                                                                </label>
                                                            </label>
                                                            <?php echo form_error('lastname'); ?>
                                                        </div>
                                                        <!--  /section  -->
                                                    </div>

                                                    <div class="section">
                                                        <label for="email" class="field prepend-icon">
                                                            <input type="email" name="email" id="email" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_email');?>" value="<?php echo set_value('email',isset($member->Email) ? $member->Email : ''); ?>">
                                                            <label for="email" class="field-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('email'); ?>
                                                    </div>

                                                    <div class="section">
                                                        <label for="username" class="field prepend-icon">
                                                            <input type="text" name="username" id="username" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_username');?>" value="<?php echo set_value('username',isset($member->UserName) ? $member->UserName : ''); ?>">
                                                            <label for="username" class="field-icon">
                                                                <i class="fa fa-user"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('username'); ?>
                                                    </div>
                                                    <?php if(empty($member->MemberId)) {?>
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
                                                    <?php } ?>

                                                    <div class="section">
                                                        <label for="Phone" class="field prepend-icon">
                                                            <input type="text" name="phone" id="phone" class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_phone');?>" value="<?php echo set_value('phone',isset($member->Phone) ? $member->Phone : ''); ?>">
                                                            <label for="Phone" class="field-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('phone'); ?>
                                                    </div>
                                                    <?php $mlsetting  = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting"); ?>
                                                    <div class="section">
                                                        <label class="control-label" for="email"><?php echo $this->lang->line('label_permission');?></label>
                                                        <div class="controls">
                                                            <div style="height: 150px; overflow: auto;" class="well well-sm">
                                                                <ul class="nav sidebar-menu1">
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Members</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <!-- <li>
                                                                                <a onclick="$(this).children().find(':checkbox').prop('checked', true);">Select All</a>
                                                                                <a onclick="$(this).children().find(':checkbox').prop('checked', false);">Unselect All</a>
                                                                            </li> -->
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Customers', $pages)) { echo 'checked'; } ?> value="Customers" name="permission[]">
                                                                                        <span class="checkbox"></span> Manage Customers
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Mtapay', $pages)) { echo 'checked'; } ?> value="Mtapay" name="permission[]">
                                                                                        <span class="checkbox"></span> Member to admin payment
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <?php if($mlsetting->Id==6 && $mlsetting->MTMPayStatus==1 ) { ?>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Mtmpay', $pages)) { echo 'checked'; } ?> value="Mtmpay" name="permission[]">
                                                                                        <span class="checkbox"></span> Member to Member payment
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">E-Commerce</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Category', $pages)) { echo 'checked'; } ?> value="Category" name="permission[]">
                                                                                        <span class="checkbox"></span> Category
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Product', $pages)) { echo 'checked'; } ?> value="Product" name="permission[]">
                                                                                        <span class="checkbox"></span> Product
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Reviews', $pages)) { echo 'checked'; } ?> value="Reviews" name="permission[]">
                                                                                        <span class="checkbox"></span> Reviews
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Orders', $pages)) { echo 'checked'; } ?> value="Orders" name="permission[]">
                                                                                        <span class="checkbox"></span> Orders
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Coupon', $pages)) { echo 'checked'; } ?> value="Coupon" name="permission[]">
                                                                                        <span class="checkbox"></span> Coupon
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Shipping</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Shipping', $pages)) { echo 'checked'; } ?> value="Shipping" name="permission[]">
                                                                                        <span class="checkbox"></span> Shipping
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Finance</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Sales', $pages)) { echo 'checked'; } ?> value="Sales" name="permission[]">
                                                                                        <span class="checkbox"></span> Sales Statements
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Income', $pages)) { echo 'checked'; } ?> value="Income" name="permission[]">
                                                                                        <span class="checkbox"></span> Income Statements
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Transaction', $pages)) { echo 'checked'; } ?> value="Transaction" name="permission[]">
                                                                                        <span class="checkbox"></span> Transaction Statements
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Withdraw', $pages)) { echo 'checked'; } ?> value="Withdraw" name="permission[]">
                                                                                        <span class="checkbox"></span> Payout Request & payouts
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">E-wallet</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Ewallet', $pages)) { echo 'checked'; } ?> value="Ewallet" name="permission[]">
                                                                                        <span class="checkbox"></span> Balance & Add to Ewallet
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Preference</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Emailtemplate', $pages)) { echo 'checked'; } ?> value="Emailtemplate" name="permission[]">
                                                                                        <span class="checkbox"></span> Email Templates
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Sms', $pages)) { echo 'checked'; } ?> value="Sms" name="permission[]">
                                                                                        <span class="checkbox"></span> SMS Templates & SMS 
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Newsletter', $pages)) { echo 'checked'; } ?> value="Newsletter" name="permission[]">
                                                                                        <span class="checkbox"></span> Newsletter
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Testimonial', $pages)) { echo 'checked'; } ?> value="Testimonial" name="permission[]">
                                                                                        <span class="checkbox"></span> Testimonial
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Latestnews', $pages)) { echo 'checked'; } ?> value="Latestnews" name="permission[]">
                                                                                        <span class="checkbox"></span> Latestnews 
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Manage Epin</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Epin', $pages)) { echo 'checked'; } ?> value="Epin" name="permission[]">
                                                                                        <span class="checkbox"></span> Create, Request, Cancel & Expired Epins
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Marketing</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Marketingtool', $pages)) { echo 'checked'; } ?> value="Marketingtool" name="permission[]">
                                                                                        <span class="checkbox"></span> Marketing Tool
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Subscriber', $pages)) { echo 'checked'; } ?> value="Subscriber" name="permission[]">
                                                                                        <span class="checkbox"></span> Subscriber List
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Autoresponder</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Autorespond', $pages)) { echo 'checked'; } ?> value="Autorespond" name="permission[]">
                                                                                        <span class="checkbox"></span> Auto Responder Management
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Leadcapture', $pages)) { echo 'checked'; } ?> value="Leadcapture" name="permission[]">
                                                                                        <span class="checkbox"></span> Leadcapture List
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Settings</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Generalsetting', $pages)) { echo 'checked'; } ?> value="Generalsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Site Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Paymentsetting', $pages)) { echo 'checked'; } ?> value="Paymentsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Paymentsetting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Registersetting', $pages)) { echo 'checked'; } ?> value="Registersetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Registersetting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Mlmsetting', $pages)) { echo 'checked'; } ?> value="Mlmsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> MLM Setting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Smtpsetting', $pages)) { echo 'checked'; } ?> value="Smtpsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> SMTP Setting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Rewardsetting', $pages)) { echo 'checked'; } ?> value="Rewardsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Reward Setting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Fundsetting', $pages)) { echo 'checked'; } ?> value="Fundsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Fund Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Languagesetting', $pages)) { echo 'checked'; } ?> value="Languagesetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Language Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Currencysetting', $pages)) { echo 'checked'; } ?> value="Currencysetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Currencysetting
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Recurringsetting', $pages)) { echo 'checked'; } ?> value="Recurringsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Recurring Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Withdrawsetting', $pages)) { echo 'checked'; } ?> value="Withdrawsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Withdraw Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Usersetting', $pages)) { echo 'checked'; } ?> value="Usersetting" name="permission[]">
                                                                                        <span class="checkbox"></span> User Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Customfieldsetting', $pages)) { echo 'checked'; } ?> value="Customfieldsetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Customfield Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Captcha', $pages)) { echo 'checked'; } ?> value="Captcha" name="permission[]">
                                                                                        <span class="checkbox"></span> Captcha Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Packagesetting', $pages)) { echo 'checked'; } ?> value="Packagesetting" name="permission[]">
                                                                                        <span class="checkbox"></span> Package Settings
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">CMS</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Pages', $pages)) { echo 'checked'; } ?> value="Pages" name="permission[]">
                                                                                        <span class="checkbox"></span> Manage Pages
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Navigation', $pages)) { echo 'checked'; } ?> value="Navigation" name="permission[]">
                                                                                        <span class="checkbox"></span> Manage Navigation
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Faq', $pages)) { echo 'checked'; } ?> value="Faq" name="permission[]">
                                                                                        <span class="checkbox"></span> Manage Faq's
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Reports</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Report', $pages)) { echo 'checked'; } ?> value="Report" name="permission[]">
                                                                                        <span class="checkbox"></span> Reports
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Ticket</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Ticket', $pages)) { echo 'checked'; } ?> value="Ticket" name="permission[]">
                                                                                        <span class="checkbox"></span> Create Ticket & Manage Tickets
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="accordion-toggle1">
                                                                            <span class="sidebar-title">Utilities</span>
                                                                        </a>
                                                                        <ul class="nav sub-nav">
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Backup', $pages)) { echo 'checked'; } ?> value="Backup" name="permission[]">
                                                                                        <span class="checkbox"></span> Databse Migration
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="checkbox1">
                                                                                    <label class="option mt5 option-primary">
                                                                                        <input type="checkbox" <?php if(in_array('Banned', $pages)) { echo 'checked'; } ?> value="Banned" name="permission[]">
                                                                                        <span class="checkbox"></span> Banned IP's
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                                <!-- <div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Customers', $pages)) { echo 'checked'; } ?> value="Customers" name="permission[]">
                                                                            <span class="checkbox"></span> members
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Category', $pages)) { echo 'checked'; } ?> value="Category" name="permission[]">
                                                                            <span class="checkbox"></span> Category
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Product', $pages)) { echo 'checked'; } ?> value="Product" name="permission[]">
                                                                            <span class="checkbox"></span> Product
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Orders', $pages)) { echo 'checked'; } ?> value="Orders" name="permission[]">
                                                                            <span class="checkbox"></span> Orders
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Coupon', $pages)) { echo 'checked'; } ?> value="Coupon" name="permission[]">
                                                                            <span class="checkbox"></span> Coupon
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox1">
                                                                        <label class="option mt5 option-primary">
                                                                            <input type="checkbox" <?php if(in_array('Shipping', $pages)) { echo 'checked'; } ?> value="Shipping" name="permission[]">
                                                                            <span class="checkbox"></span> Shipping
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                
                                                            </div>
                                                            <a onclick="$(this).parent().find(':checkbox').prop('checked', true);">Select All</a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);">Unselect All</a>
                                                        </div>
                                                    </div>
                                                    
                                                    <input type="hidden" name="memberid" value="<?php echo isset($member->MemberId) ? $member->MemberId : '';?>">

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

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

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
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13
                }
                
            },

            // error message
            messages: {
                
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
