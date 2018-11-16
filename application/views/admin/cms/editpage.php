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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.min.css">
    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <link href="<?php echo BASE_uRL(); ?>assets/admin/css/pages/dashboard.css" rel="stylesheet">

    
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
            <div class="row">
                <div class="col-xs-12">
                    <div role="tabpanel" id="" class="allcp-form theme-primary tab-pane">
                        <div class="panel">
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
                            </div>
                            <div class="panel-body pn">
                                <form id="contentForm" method="post" action="<?php echo base_url();?>admin/pages/editconfirm">

                                    <div class="section">
                                        <p><?php echo $this->lang->line('label_page_title');?> <sup class="state-error1">*</sup></p>
                                        <label class="field prepend-icon" for="pageTitle">
                                            <input type="text" value="<?php echo set_value('pageTitle',isset($pages->pageTitle) ? $pages->pageTitle : ''); ?>" placeholder="Page title" class="gui-input" id="pageTitle" name="pageTitle">
                                            <label class="field-icon" for="pageTitle">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                         <?php echo form_error('pageTitle');?>
                                    </div>

                                    <div class="section">
                                        <p><?php echo $this->lang->line('label_nav_title');?> <sup class="state-error1">*</sup></p>
                                        <label class="field prepend-icon" for="navTitle">
                                            <input type="text" value="<?php echo set_value('navTitle',isset($pages->navTitle) ? $pages->navTitle : ''); ?>" placeholder="Menu Name" class="gui-input" id="navTitle" name="navTitle">
                                            <label class="field-icon" for="navTitle">
                                                <i class="ad ad-lines"></i>
                                            </label>
                                        </label>
                                         <?php echo form_error('navTitle');?>
                                    </div>

                                    <div class="section">
                                        <p><?php echo $this->lang->line('select_language');?> <sup class="state-error1">*</sup></p>
                                        <label for="languagename" class="field select">
                                            <?php 
                                                $lang_id = isset($pages->LanguageId) ? $pages->LanguageId : '';
                                            ?>
                                            <select name="languagename">
                                                <option value="" selected="selected"><?php echo ucwords($this->lang->line('select_language'));?></option>
                                                <?php 
                                                    foreach ($languages as $language) {
                                                ?>
                                                    <option <?php if($lang_id==$language->LanguageId) echo 'selected';?> value="<?php echo $language->LanguageId;?>"><?php echo ucwords($language->LanguageName);?></option>
                                                <?php   
                                                    }
                                                ?>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>

                                    <div class="section mb10">
                                        <div class="panel-body pn of-h" id="summer-demo">
                                            <textarea id="summernote_text" name="content" class="ckeditor gui-input" style="display: none;"><?php echo set_value('content',isset($pages->pageContent) ? urldecode($pages->pageContent) : ''); ?></textarea>
                                        </div>
                                        <?php echo form_error('content'); ?>
                                    </div>
                                    <input type="hidden" value="<?php echo set_value('content',isset($pages->pageID) ? $pages->pageID : ''); ?>" name="pageID"/>

                                    <div class="section">
                                        <div class="pull-right">
                                            <button class="btn btn-bordered btn-primary" type="submit"> <?php echo $this->lang->line('label_update');?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->




<!--  jQuery  -->
<?php $this->load->view('admin/footer');?>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<!--<script src="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/underscore.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/eventable.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sortable.min.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor-bootstrap.js"></script>

<script src="<?php echo BASE_uRL(); ?>assets/js/pages/user-forms-editors.js"></script>-->
<script src="<?php echo BASE_uRL(); ?>assets/js/plugins/ckeditor/ckeditor.js"></script>


<script type="text/javascript">
// function formSubmit(){
//     SirTrevor.onBeforeSubmit();
//     document.getElementById("contentForm").submit();
// }
</script>

</body>

</html>
