?><!DOCTYPE html>
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

    <!--  Summernote  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/summernote/summernote.css">

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <!--  IE8 HTML5 support   -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="basic-messages"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

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

                                <div class="section row mb20">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } ?>
                                </div>

                                <div class="panel-title hidden-xs">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php echo $this->lang->line('page_title'); ?>
                                        </div>
                                        <div class="col-md-1">
                                            <button onclick="CloseTicket()" class="btn btn-primary" title="" data-toggle="tooltip" type="button" data-original-title="Close Ticket"><i class="fa fa-ticket"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                        <div class="col-md-1">
                                            <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/ticket/add" data-original-title="<?php echo $this->lang->line('label_add_new'); ?>"><i class="fa fa-plus"></i></a></span>
                                        </div>
                                        <!-- <a class="pull-right" href="#">Create User</a> -->
                                    </div>
                                </div>
                                <hr class="short">
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <form method="post" action="<?php echo base_url();?>admin/ticket/closeall" id="form-tickets">
                                            <!-- <table id="message-table" class="table tc-checkbox-1 allcp-form theme-warning br-t"> -->
                                            <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                                <thead>
                                                <tr class="">
                                                    <th class="text-center hidden-xs">
                                                        <label class="option block mn">
                                                            <input type="checkbox" id="selectall" value="" name="selectall">
                                                            <span class="checkbox mn"></span>
                                                        </label>
                                                    </th>
                                                    <th class="text-center">ID</th>
                                                    <th><?php echo $this->lang->line('label_sender'); ?></th>
                                                    <th><?php echo $this->lang->line('label_subject'); ?></th><!-- 
                                                    <th class="hidden-xs"><?php echo $this->lang->line('label_attachement'); ?></th> -->
                                                    <th class="hidden-xs"><?php echo $this->lang->line('label_status'); ?></th>
                                                    <th class="text-center"><?php echo $this->lang->line('label_date'); ?></th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $tickets = $this->data['tickets'];
                                                if($tickets) {
                                                    foreach ($tickets as $row) {
                                                                                      
                                                        $customer = $this->common_model->GetCustomer($row->MemberId);
                                                        if($customer) {
                                                         
                                                    
                                                ?>
                                                <tr class="message-unread">
                                                    <td class="hidden-xs text-center">
                                                        <label class="option block mn ">
                                                            <input type="checkbox" name="tickets[]" value="<?php echo $row->TicketId;?>" class="text-center case ">
                                                            <span class="checkbox mn"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center fw600"><?php echo $row->TransactionId;?></td>
                                                    <td class=""><a href="<?php echo base_url().'admin/ticket/view/'.$row->TicketId;?>"><?php echo $customer->FirstName;?></a></td>
                                                    <td class=""><a href="<?php echo base_url().'admin/ticket/view/'.$row->TicketId;?>"><?php echo $row->Subject;?></a></td>
                                                    <?php 

                                                            if($row->Status=='1') {
                                                                $tic_status = 'btn-primary';
                                                                $ticketsts = $this->lang->line('label_open');
                                                            } else if($row->Status=='2') {
                                                                $tic_status = 'btn-success';
                                                                $ticketsts = $this->lang->line('label_progress');
                                                            } else {
                                                                $tic_status = 'btn-danger';
                                                                $ticketsts = $this->lang->line('label_close');
                                                            }

                                                        ?>
                                                    
                                                    
                                                    <td class="allcp-form">
                                                        
                                                        <div class="btn-group text-right">
                                                        
                                                            <button aria-expanded="true" data-toggle="dropdown" class="btn <?php echo $tic_status;?> br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo ucwords($ticketsts); ?>
                                                                <span class="caret ml5"></span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li>
                                                                    <a href="<?php echo base_url().'admin/ticket/open/'.$row->TicketId;?>"><?php echo $this->lang->line('label_open'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url().'admin/ticket/progress/'.$row->TicketId;?>"><?php echo $this->lang->line('label_progress'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url().'admin/ticket/close/'.$row->TicketId;?>"><?php echo $this->lang->line('label_close'); ?></a>
                                                                </li> 
                                                                <li>
                                                                    <a href="<?php echo base_url().'admin/ticket/delete/'.$row->TicketId;?>"><?php echo $this->lang->line('label_delete'); ?></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class="text-center fw600"><?php echo date('Y-m-d',strtotime($row->DateAdded));?></td>
                                                   
                                                   
                                                </tr>
                                                <?php 

                                                    }
                                                }

                                                } else {

                                            ?>
                                                <tr>
                                                    <td colspan="6"><?php echo $this->lang->line('label_no_records'); ?></td>
                                                </tr>
                                            <?php 
                                                }
                                            ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
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
    <?php $this->load->view('admin/sidebar_right'); ?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Quick Compose  -->
<div class="quick-compose-form">
    <form id="">
        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
        <input type="text" class="form-control" id="inputSubject" placeholder="Subject">

        <div class="summernote-quick">Compose your message here...</div>
    </form>
</div>

<!--  Scripts  -->

<!--  jQuery  -->
<?php $this->load->view('admin/footer'); ?>
<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>



<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<!--<script src="<?php echo base_url();?>assets/js/pages/basic-messages.js"></script>-->
<!--  /Scripts  -->
<?php $this->load->view('admin/activemenu'); ?>

<script type="text/javascript">

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/ticket/close/'+id,
                    success : function()
                    {
                        console.log('sc');
                    }
                });
                // return confirm("Are you sure?");
            } else {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/ticket/open/'+id,
                    success : function(){
                        console.log('fail');
                    }
                });
            }
        });

        $("#selectall").on('click',function(){
            var chk=$('#selectall:checked').length ? true : false;
            if(chk){
                $('.case').prop('checked',true);
            } else {
                $('.case').prop('checked',false);
            }
        });

        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
    });

 })(jQuery);

 function refreshPage() {
    location.reload();
 }
 function CloseTicket() {
     if($('.case:checked').length) {
     confirm('Selected ticket are closed?') ? $('#form-tickets').submit() : false;
    }
 }
</script>
</body>

</html>
