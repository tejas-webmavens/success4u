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
            <!--  Column search  -->
                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <?php echo $this->lang->line('label_filter_title'); ?>
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="allcp-form theme-primary">
                            <form method="post" action="<?php echo base_url().'admin/mtapay/search';?>" name="search_form">

                                <div class="section row mb20">

                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_bycustomer'); ?></h6>
                                        <label class="field select">
                                            <select id="filter-status" name="member">
                                                <option value="" selected="selected"><?php echo $this->lang->line('label_filter_customer'); ?></option>
                                                <?php
                                                    $members = $this->data['members'];
                                                    foreach($members as $row) { ?>
                                                    <option value="<?php echo $row->MemberId;?>" <?php echo set_select('member', $row->MemberId); ?>><?php echo $row->UserName;?></option>
                                                <?php } ?>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>

                                     <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_fromdate'); ?></h6>
                                        <label for="datepicker1" class="field prepend-icon mb5">
                                            <input type="text" id="datepicker1" name="datepicker1" class="gui-input fs13" placeholder="From" value="<?php echo set_value('datepicker1');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_todate'); ?></h6>
                                        <label for="datepicker2" class="field prepend-icon">
                                            <input type="text" id="datepicker2" name="datepicker2" class="gui-input fs13" placeholder="To" value="<?php echo set_value('datepicker2');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                   
                                    <div class="col-md-3 ph10 mt40">
                                    <button class="btn btn-primary pull-right ph10 ml20 " type="submit" name="search"><?php echo $this->lang->line('btn_filter_search'); ?></button>
                                        <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/mtapay';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right ml20"><i class="fa fa-eraser lm20"></i></a>
                                        
                                    </div>
                                   

                                </div>

                                
                                
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!--  /Column Search  -->
            </div>
                <!--  Column Center  -->
           

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
                                <!-- <a data-original-title="Export" data-toggle="tooltip" title="" href="<?php echo base_url();?>admin/export/archive/history" class="pull-right btn btn-bordered btn-primary"><i class="fa fa-download"></i> Export</a> -->
                               <!--  <span class="allcp-form"><a class="pull-right btn btn btn-primary " title="" data-toggle="tooltip" href="javascript:void(0)" id="btnExport" data-original-title="Export"><i class="fa fa-download"></i> Export</a></span>
                                --> <!-- <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/coupon/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive export_content">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="va-m"><?php echo $this->lang->line('label_sno'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_payby'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_receiveby'); ?></th>
                                       <!--  <th class="va-m"><?php echo $this->lang->line('label_mid'); ?></th> -->
                                        <th class="va-m"><?php echo $this->lang->line('label_date'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_package'); ?></th>
                                         <th class="va-m"><?php echo $this->lang->line('label_amount'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_aid'); ?></th>
                                        
                                        <th class="va-m"><?php echo $this->lang->line('label_action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($this->data['transactions']) {
                                    // print_r($this->data);
                                        $transactions = $this->data['transactions'];
                                        
                                        
                                        $i=1;
                                        foreach ($transactions as $row) {
                                    ?>
                                    <tr>
                                        <td class=""><?php echo  $i++;?></td>
                                        <?php $paymem = $this->common_model->GetRow("MemberId='".$row->MemberId."'","arm_members"); ?>
                                        <td><?php if($paymem){echo $paymem->UserName;}else{echo"--";}?></td>
                                        <?php $payrec = $this->common_model->GetRow("MemberId='".$row->ReceiveBy."'","arm_members"); ?>
                                        <td><?php if($payrec){echo $payrec->UserName;}else{echo"--";}?></td>
                                        <!-- <td><?php if($row->MPaymentAttachemt!='') {?>
                                            <a target="_blank" href="<?php echo base_url().$row->MPaymentAttachemt; ?>">
                                            <?php if($row->MPaymentReference!=''){echo $row->MPaymentReference;}else{echo"--";} echo"</a>";}
                                            else{
                                                if($row->MPaymentReference!=''){echo $row->MPaymentReference;}else{echo"--";}}?>
                                        </td>
                                         -->
                                        <td class=""><?php echo date('Y-m-d',strtotime($row->DateAdded));?></td>
                                        <?php $package = $this->common_model->GetRow("PackageId='".$row->PackageId."'","arm_package"); ?>
                                        <td><?php if($package){echo $package->PackageName;} else{echo"---";}?></td>
                                        <td><?php echo  $CurrencySymbol." ".$row->PaymentAmount;?></td>
                                        <td>
                                            <?php
                                                if($row->APaymentReference!=''){echo $row->APaymentReference;}else{echo"--";}?>
                                        </td>
                                        
                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo $this->lang->line('label_action'); ?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                <?php if($row->AdminStatus=='0'){?>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/Mtapay1/accept/'.$row->Payid;?>"><?php echo ucwords($this->lang->line('label_accept')); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/Mtapay1/decline/'.$row->Payid;?>"><?php echo ucwords($this->lang->line('label_decline')); ?></a>
                                                    </li>
                                                    <?php }?>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/Mtapay1/delete/'.$row->Payid;?>"><?php echo ucwords($this->lang->line('label_delete')); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td> 
                                    </tr>
                                    <?php 
                                            } 
                                        } else {   
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="9"><?php echo $this->lang->line('label_no_records'); ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
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
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/sales-stats-clients.js"></script>

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
     confirm('Are you sure?') ? $('#form-customer').submit() : false;
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
                    url:'<?php echo base_url();?>admin/transaction/inactive/'+id,
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
                    url:'<?php echo base_url();?>admin/transaction/active/'+id,
                    success : function(){
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

</script>
<script src="<?php echo base_url();?>assets/js/jquery.table2excel.js"></script>
<script>
    $(function() {
        $("#btnExport").click(function(){
        $(".export_content").table2excel({
            exclude: ".noExl",
            name: "epins"
        }); 
         });
    });
</script>
</body>

</html>
