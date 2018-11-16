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
        <form name="" method="post" action="<?php echo base_url();?>admin/banned/add" id="form-add-ip">
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
                                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/banned" data-original-title="Back"><i class="fa fa-reply"></i></a></span>
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                                <!-- <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addrules();" type="button" data-original-title="Add additional field"><i class="fa fa-plus-circle"></i></button> -->
                            </div>
                        </div>
                        
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive" id="ip_api_method">

                                <div class="tab-content pn br-n allcp-form theme-primary">

                                    <div class="section row mbn">
                                        
                                        <div class="col-md-12 ph10">

                                            <div class="section">
                                                <label class="field-label" for="ip"><?php echo $this->lang->line('label_banned_name'); ?></label>
                                                <label class="field prepend-icon" for="ip">
                                                    <input type="text" placeholder="IP Address" class="gui-input" id="ip" name="ip" value="<?php echo set_value('ip',isset($ip) ? $ip : ''); ?>">
                                                    <label class="field-icon" for="ip">
                                                        <i class="fa fa-user"></i>
                                                    </label>
                                                </label>
                                                <?php echo form_error('ip'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for="banned_status"><?php echo $this->lang->line('label_banned_status'); ?></label>
                                                <label for="banned_status" class="field select">
                                                    <select id="filter-type" name="banned_status" class="">
                                                        <option value="" selected="selected"><?php echo $this->lang->line('option_select_status'); ?></option>
                                                        <option value="1" <?php if(isset($Status)=='1') echo 'selected'; ?><?php echo set_select('banned_status'); ?>><?php echo $this->lang->line('option_banned_block'); ?></option>
                                                        <option value="0" <?php if(isset($Status)=='0') echo 'selected'; ?><?php echo set_select('banned_status'); ?>><?php echo $this->lang->line('option_banned_unblock'); ?></option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('banned_status'); ?>
                                            </div>

                                        </div>
                                    </div>

                                    <hr class="short alt">

                                    <div class="section mbn text-right">
                                        <p class="text-right">
                                            <button class="btn btn-bordered btn-primary" type="submit"><?php if(isset($banned->bannedId)) echo $this->lang->line('btn_update_ip'); else echo $this->lang->line('btn_add_ip'); ?></button>
                                        </p>
                                    </div>
                                    <!--  /section  -->

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
            <!--  /Column Center  -->
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

<!--  Datatables JS  
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>-->

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>


<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        $("#form-add-ip").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                ip: {
                    required: true
                },
                banned_status: {
                    required: true
                }
            },

            // error message
            messages: {
                ip: {
                    required: 'Please enter user IP Address'
                },
                banned_status: {
                    required: 'Please select banned status'
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

<!--  /Scripts  -->
<script type="text/javascript">
$("#selectall").on('click',function(){
    var chk=$('#selectall:checked').length ? true : false;
    if(chk){
        $('.case').prop('checked',true);
    } else {
        $('.case').prop('checked',false);
    }
});

function deleteAll(){
    if($('.case:checked').length) {
     confirm('Are you sure?') ? $('#form-customer').submit() : false;
    }
}

</script>
</body>

</html>
