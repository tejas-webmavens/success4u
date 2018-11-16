<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <meta charset="utf-8">
    <title>ARMCIP</title>
    <meta name="keywords" content="HTML5, Bootstrap 3, Admin Template, UI Theme"/>
    <meta name="description" content="Alliance - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

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

<body class="user-forms-additional-inputs"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

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
                    <span class="panel-title"> Select to Export</span>
                </div>
                <div class="panel-body p25 pb10">
                    <form class="form-horizontal" role="form" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Table</label>

                            <div class="col-md-8">
                            <?php
                            $table_option='';
                                //$tables = $this->db->list_tables();
                            if(is_array($this->data['tables']))
                            {
                                $tables = $this->data['tables'];

                                

                                foreach ($tables as $table) {
                                    $table = str_replace('arm_', '', $table);
                                    $table_option .='<option value="'.strtolower($table).'">'.ucfirst($table).'</option>';
                                }
                            }
                             else
                             {
                                $table_option .='<option value="'.strtolower($tables).'">'.ucfirst($tables).'</option>';
                             }


                            ?>
                                <select class="select2-single form-control" name="table">

                                    <?php echo $table_option; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Column</label>

                            <div class="col-md-8">
                            <?php

                                $option = '';
                             

                            if(is_array($this->data['tables']))
                            {
                                
                                $fields = $this->db->list_fields($this->data['tables'][0]);
                            }
                            else
                            {
                                $fields = $this->db->list_fields('arm_'.$tables);
                            }



                                foreach ($fields as $field) {
                                    $option .='<option value="'.strtolower($field).'">'.ucfirst($field).'</option>';
                                }
                                
                            ?>
                            <select class="select2-multiple form-control select-primary" multiple="multiple" id="columnss" name="exportedfields[]">
                                    <?php echo $option; ?>
                            </select>
                            </div>
                        </div>
                        
               
                        
                        <div class="section row mb10">
                            <label class="field-label col-sm-2 ph10 text-center" for="format">Export Format</label>

                            <div class="col-sm-10 ph10">
                                <div class="option-group field">

                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" name="format" value="csv" class="format" checked="checked" id="radio_csv">
                                        <label for="radio_csv"><span class="radio"></span> CSV </label>
                                    </label>
                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" name="format" class="format" value="xml" id="radio_xml">
                                        <label for="radio_xml"><span class="radio"></span> XML </label>
                                    </label>
                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" name="format" class="format" value="pdf" id="radio_pdf">
                                        <label for="radio_pdf"><span class="radio"></span> PDF <label>
                                    </label>
                                </div>
                                <label class="field-icon" for="format"> </label>
                                
                            </div>
                        </div>
                        
                            
                            
                        
                        <input class="pull-right btn btn-bordered btn-primary" id="btn_export" type="submit" name="submit" value="Export" />

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


<!--  jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  Time/Date Dependencies JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/globalize/globalize.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/moment/moment.min.js"></script>

<!--  BS Dual Listbox JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!--  Bootstrap Maxlength JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/maxlength/bootstrap-maxlength.min.js"></script>

<!--  Select2 JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/select2/select2.min.js"></script>

<!--  Typeahead JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/typeahead/typeahead.bundle.min.js"></script>

<!--  TagManager JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/tagmanager/tagmanager.js"></script>

<!--  DateRange JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/daterange/daterangepicker.min.js"></script>

<!--  DateTime JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>

<!--  BS Colorpicker JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!--  MaskedInput JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/jquerymask/jquery.maskedinput.min.js"></script>

<!--  HighCharts Plugin  -->
<script src="<?php echo base_url();?>assets/js/plugins/highcharts/highcharts.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/user-forms-additional-inputs.js"></script>
    <?php $this->load->view('admin/activemenu');?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.select2-single').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            $("#columnss > option").remove();
            // console.log(valueSelected);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/export/getColumns/"+valueSelected,
                success: function(columns) //we're calling the response json array 'cities'
                {
                 
                    $.each(columns,function(id,name) {
                        var opt = $('<option />'); 
                        opt.val(name);
                        opt.text(name);
                        // opt.html("<input type='hidden' name='column[]' value='"+name+"'/>"+name);
                        $('#columnss').append(opt);
                    });
                }
            });
        });

    });
</script>

</body>

</html>
