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
                                 
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php echo $this->lang->line('page_title'); ?>
                                    </div>
                                     <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/pages/addpage" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-danger " title="" data-toggle="tooltip" href="javascript:void(0)" onclick="deleteAll()" data-original-title="Delete Selected"><i class="fa fa-remove"></i></a></span>
                                    </div>
                                    <div class="allcp-form col-md-4 pull-right">
                                        <form name="selectLanguage" method="post" id="selectLanguage" action="<?php echo base_url();?>admin/pages/filter">
                                        <label for="languagename" class="field select">
                                            <?php 
                                                $lang_id = ($this->input->post('languagename')) ? $this->input->post('languagename') : '';
                                            ?>
                                            <select onChange="SelectedLanguageFunc(this.value)" name="languagename">
                                                <option value="" selected="selected"><?php echo ucwords($this->lang->line('select_language'));?></option>
                                                <?php 
                                                    foreach ($languages as $language) {
                                                ?>
                                                    <option value="<?php echo $language->LanguageId;?>"><?php echo ucwords($language->LanguageName);?></option>
                                                <?php   
                                                    }
                                                ?>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                        </form>
                                    </div>
                                    <!-- <div class="col-md-2 pull-right">
                                        <a data-original-title="Export" data-toggle="tooltip" title="" href="<?php echo base_url();?>admin/export/archive/members" class="pull-right btn btn-bordered btn-primary"><i class="fa fa-download"></i> Export</a>
                                    </div> -->
                                   
                                </div>
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive">
                            <form id="form-pages" method="post" action="<?php echo base_url();?>admin/pages/deleteall">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th>
                                        <th class="va-m"><?php echo $this->lang->line('label_page_url'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_page_title'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_menu_name'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_language'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_date'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_publish'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $pages = $this->data;
                                        if($pages['pages']) {
                                        foreach ($pages['pages'] as $row) {

                                            $condition = "LanguageId='".$row->LanguageId."' AND IsDelete='0'";
                                            $lang_name = $this->common_model->GetRow($condition, 'arm_language');
                                            if($lang_name) {
                                                $content_language = $lang_name->LanguageName;
                                            } else {
                                                $content_language = $this->config->item('language');
                                            }

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <label class="option block mn">
                                                <?php if($row->navTitle=='index' || $row->navTitle=='privacy' || $row->navTitle=='terms') { ?>
                                                    <input type="checkbox" name="page[]" value="" class="case" style="display:none;">
                                                <?php } else {?>
                                                    <input type="checkbox" name="page[]" value="<?php echo $row->pageID;?>" class="case">
                                                <?php } ?>
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td>
                                        <td class=""><?php echo $row->pageUrl;?></td>
                                        <td class=""><?php echo $row->pageTitle;?></td>
                                        <td class=""><?php echo $row->navTitle;?></td>
                                        <td class=""><?php echo $content_language;?></td>
                                        <td class=""><?php echo date('m/d/Y', strtotime($row->pageCreated));?></td>
                                        <td class="allcp-form">
                                            <label class="block mt15 switch switch-primary">
                                                <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->pageID;?>" name="status" class="status" value="<?php echo $row->pageID;?>">
                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->pageID;?>"></label>
                                                <span><?php //echo $row->MemberStatus;?></span>
                                            </label>

                                        </td>
                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo $this->lang->line('label_action'); ?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/pages/editpage/'.$row->pageID;?>"><?php echo $this->lang->line('label_edit'); ?></a>
                                                    </li>
                                                    <?php if($row->navTitle=='index' || $row->navTitle=='privacy' || $row->navTitle=='terms') { ?>
                                                    
                                                    <?php } else {?>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/pages/delete/'.$row->pageID;?>"><?php echo $this->lang->line('label_delete'); ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                            }
                                        } else {   
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo $this->lang->line('label_no_records'); ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>


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
     confirm('Are you sure?') ? $('#form-pages').submit() : false;
    }
}

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/pages/unpublish/'+id,
                    success : function(resp)
                    {
                        if(resp)
                            window.location.href = "<?php echo base_url();?>admin/pages";
                        else
                            console.log('fail');
                    }
                });
                // return confirm("Are you sure?");
            } else {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/pages/publish/'+id,
                    success : function(resp){
                        if(resp)
                            window.location.href = "<?php echo base_url();?>admin/pages";
                        else
                            console.log('fail');
                        
                    }
                });
            }
        });
    });

 })(jQuery);
 $(document).ready(function() {
    $('#datatable2').DataTable();
} );

$(function() {
    var href = $(this).find('a').attr('href');
    //alert(window.location.pathname)
    if (href === window.location.pathname) {
      $(this).addClass('active');
    }
});
function SelectedLanguageFunc(languageid) {
    if(languageid){
        // console.log(languageid);
        $('#selectLanguage').submit();
    }
} 
</script>
</body>

</html>
