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
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/navpopup.css">
    
    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">


<link href="<?php echo BASE_uRL(); ?>assets/admin/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/css/style.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery-ui-1.9.2.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery.nestable.js"></script> 

<script src="<?php echo BASE_uRL(); ?>assets/admin/js/excanvas.min.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/bootstrap.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/base.js"></script> 
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor-icons.css" rel="stylesheet">

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
                                <div class="panel-title hidden-xs">
                                 
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php echo $this->lang->line('menu_header'); ?>
                                        </div>
                                        
                                        <div class="col-md-1 pull-right">
                                            <span class="allcp-form"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/navigation/new" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <hr class="short">
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th> <?php echo $this->lang->line('menu_table_title'); ?> </th>
                                        <th class="text-right"> <?php echo $this->lang->line('menu_action'); ?></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($nav as $n):?>
                                        <tr>
                                            <td class=""><?php echo $n['navTitle']?></td>
                                            <td class="text-right">
                                                <a href="<?php echo base_url();?>admin/navigation/edit/<?php echo $n['navSlug']?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a>
                                                <a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt<?php echo $n['navSlug']?>"><i class="btn-icon-only icon-remove"> </i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php echo $this->pagination->create_links(); ?>

        <?php foreach ($nav as $n) { ?>

            <div id="dlt<?php echo $n['navSlug'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel"><?php echo $this->lang->line('menu_delete').''.$n['navTitle'].' ?';?></h3>
                </div>
                <div class="modal-body">
                    <?php if ($n['navSlug'] == "header") {  ?>
                        <p><?php echo $this->lang->line('menu_delete_message_header');?></p>
                    <?php 
                        } else {
                    ?>
                    <p><?php echo $this->lang->line('menu_delete_message');?></p>
                    <?php  } ?>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('btn_cancel');?></button>
                    <?php if ($n['navSlug'] != "header") { ?>
                       <a class="btn btn-danger" href="<?php echo BASE_URL().'/admin/navigation/delete/'.$n['navSlug'];?>"><?php echo $this->lang->line('btn_delete');?></a>
                     <?php } ?>
                 </div>
            </div>
         <?php } ?>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<style type="text/css">
.navbar-fixed-top {
    position: fixed;
}
</style>


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



<script type="text/javascript">
function formSubmit(){
    SirTrevor.onBeforeSubmit();
    document.getElementById("contentForm").submit();
}
$(document).ready(function() {
    $('#datatable2').DataTable();
} );
</script>

</body>

</html>
