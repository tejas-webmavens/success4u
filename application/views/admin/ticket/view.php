?><!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

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
        <section id="content" class="table-layout">
           
            <!--  /Column Left  -->

            <!--  Column Center  -->
            <div class="chute chute-center pn bg-light">
                <div class="panel m40">

                    <div class="panel-menu pn">
                        <div class="row">

                            <!--  Left Button Group  -->
                            <div class="col-md-3 va-m hidden-xs hidden-sm ">
                                <div class="btn-group">
                                    <a data-original-title="Refresh" href="javascript:void(0)" onclick="refreshPage()" data-toggle="tooltip" title="" class="btn btn-default light"><i class="fa fa-refresh"></i></a>
                                    <a data-original-title="Close Ticket" href="javascript:void(0)" onclick="CloseTicket()" data-toggle="tooltip" title="" class="btn btn-default light"><i class="fa fa-pencil"></i></a>
                                    
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <!--  panel-body  -->
                    <div class="panel-body pn br-t-n">

                        <form name="" method="post" id="view-ticket-form" action="<?php echo base_url();?>admin/ticket/closeall">
                            <input type="hidden" name="tickets[]" value="<?php if(isset($ticket_info->TicketId)){echo $ticket_info->TicketId;}?>"/>
                        </form>

                        <!--  Message  -->
                        <div class="message-view">

                            <div class="message-meta">
                                <!-- <span class="pull-right text-muted"><?php echo date('Y-m-d H:i:s',strtotime($ticket_info->DateAdded));?></span>  -->

                                <h3 class="subject">Subject - <?php echo $ticket_info->Subject; ?></h3>

                                
                            </div>
                            <?php 
                                foreach ($tickets as $ticket) {
                            ?>
                                <hr class="mt20 mb15">
                                <div class="message-header">
                                <?php  
                                    $customer = $this->common_model->GetCustomer($ticket->SenderId);?>
                                    <img src="<?php echo base_url();?>assets/img/avatars/1.jpg" class="img-responsive mw40 pull-left mr20">
                                    <span class="pull-right text-muted"><?php echo date('Y-m-d H:i:s',strtotime($ticket->DateAdded));?></span> 
                                    <h4 class="mt15 mb5">From: <?php if($customer) {echo $customer->FirstName.' '.$customer->LastName;}?></h4>
                                    <small class="text-muted clearfix">From: <?php if($customer) { echo $customer->Email; } ?></small>
                                </div>

                                <hr class="mb15 mt15">

                                <div class="message-body">
                                    <?php echo $ticket->Description; ?>
                                </div>

                                <?php if($ticket->Attatchement) { ?>

                                <div class="row">
                                    <a target="_blank" href="<?php echo base_url().'uploads/ticket/'.$ticket->Attatchement;?>" download class="pull-right btn btn-bordered btn-primary"><i class="fa fa-download"></i> Download</a>
                                </div>

                            <?php
                                    }
                                }
                            ?>

                        </div>
                        <?php if($ticket_info->Status!='0') { ?>
                        <form method="post" action="<?php echo base_url();?>admin/ticket/view/<?php echo $ticket_info->TicketId; ?>" name="reply-ticket-from" enctype="multipart/form-data">
                            <div class="message-reply bg-light">
                                <!-- <div class="summernote"></div> -->
                                <textarea class="ckeditor" id="summernote_text" name="description" style="display: block;"><?php echo set_value('description'); ?></textarea>
                            </div>
                            <?php echo form_error('description'); ?>
                            <?php 
                                if($ticket->SenderId == $this->session->userdata('MemberID')) { 
                                    $toid = $ticket->MemberId;
                                } else {
                                    $toid = $ticket->SenderId;
                                }
                            ?>
                            <input type="hidden" name="SenderId" value="<?php echo $toid ?>">
                            <input type="hidden" name="TicketId" value="<?php echo $ticket_info->TicketId; ?>">
                            <hr class="short alt">

                            <input type="file" name="attatchement" value="" class="" />

                            <div class="section mbn text-right">
                                <p class="text-right">
                                    <button class="btn btn-bordered btn-primary" type="submit"><?php echo $this->lang->line('btn_post_ticket'); ?></button>
                                </p>
                            </div>
                        </form>
                        <?php } else {?>



                        <?php } ?>

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

<style>
    /* demo styles - disable several summernote buttons */
    .note-editor .note-toolbar > .note-fontname,
    .note-editor .note-toolbar > .note-help,
    .note-editor .note-toolbar > .note-style {
        display: none;
    }
</style>



<?php $this->load->view('admin/footer'); ?>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>




 <!-- /Scripts  

<script src="<?php echo base_url();?>assets/js/pages/user-forms-editors.js"></script>-->
<script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/activemenu'); ?>


<script type="text/javascript">
    function refreshPage() {
        location.reload();
     }
    function CloseTicket() {
        confirm('Selected ticket are closed?') ? $('#view-ticket-form').submit() : false;
    }

</script>
<!--  /Scripts  -->

</body>

</html>
