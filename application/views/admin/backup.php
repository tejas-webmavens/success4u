<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  Plugins CSS  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/tagmanager/tagmanager.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datepicker/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/select2/css/core.css">

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
    <!--  /Sidebar  -->

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <!--  Topbar Menu Wrapper  -->
        <?php $this->load->view('admin/toper');?>
        <!--  /Topbar Menu Wrapper  -->

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>
        <!--  /Topbar  -->

        <!--  Content  -->
        <div id="content" class="animated fadeIn">

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"> Restore Database</span>
                </div>
                <div class="panel-body p25 pb10">
                    <form class="form-horizontal" id="importdb_form" role="form" method="post" action="<?php echo base_url();?>admin/backup/import" enctype="multipart/form-data">
                        <input type="file" name="importdb" class="field" value="<?php echo set_value('importdb');?>"/>
                        <?php echo form_error('importdb');?>
                        <button class="pull-right btn btn-bordered btn-primary" onclick="importDB()" title="" data-toggle="tooltip" form="form-backup" type="submit" data-original-title="Import"><i class="fa fa-upload"></i> Import</button>
                        
                    </form>

                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"> Backup Database</span>
                </div>
                <div class="panel-body p25 pb10">
                    <form class="form-horizontal" role="form" id="exportdb_form" method="post" action="<?php echo base_url();?>admin/backup/export">

                        <!--<div class="form-group">
                            <label for="multiselect2" class="col-md-4 control-label">Backup Database</label>

                            <div class="col-md-8">
                                <select id="multiselect2" class="form-control" multiple="multiple">
                                    <?php 
                                    $backup_table_option ='';
                                    $backup = $this->data['tables'];
                                    //print_r($backup);
                                    foreach ($backup as $table) {
                                        $backup_table = str_replace('arm_', '', $table); ?>
                                        <option value="<?php echo strtolower($backup_table);?>"><?php echo ucfirst($backup_table);?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>-->
                        <button class="pull-right btn btn-bordered btn-primary" onclick="exportDB()" title="" data-toggle="tooltip" form="form-backup" type="submit" data-original-title="Export"><i class="fa fa-download"></i> Export</button>
                        

                    </form>

                </div>
            </div>

        </div>

        <!--  /Content  -->

    </section>
    <!--  /Main Wrapper  -->

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<?php $this->load->view('admin/footer');?>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    function exportDB(){
        $('#exportdb_form').submit();
    }
    function importDB(){
        $('#importdb_form').submit();
    }
</script>
<script type="text/javascript">
//'use strict';
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        // $.validator.addMethod("alpha", function(value, element) {
        //     return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
        // });

        $("#importdb_form1").validate({

            // States

            errorClass: "state-error1",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                importdb: {
                    required: true
                }
                
            },

            // error message
            messages: {
                importdb: {
                    required: 'required<?php echo $this->lang->line('required_sponsorname');?>'
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
</body>

</html>
