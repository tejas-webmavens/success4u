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

<body class="tables-datatables" data-spy="scroll" data-target="#nav-spy" data-offset="300">

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

                                    <div class="panel-title hidden-xs">
                                        <?php echo ucwords($this->lang->line('pagetitle_pv'));?>
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/ranksetting/addfield" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                    </div>

                                </div>
                                <hr class="short">
                                <div class="panel-body pn">
                                    <div class="section row mbn">
                                        <?php if($this->session->flashdata('error_message')) { ?>    
                                            <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                                <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                            </div>
                                        <?php unset($_SESSION['error_message']); } ?>
                                        
                                        <?php if($this->session->flashdata('success_message')) { ?>    
                                            <div class="col-md-12 bg-success pt10 pb10 mt10 mb20 ">
                                                <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                            </div>
                                        <?php unset($_SESSION['success_message']); } ?>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="va-m"><?php echo $this->lang->line('label_sno');?></th>
                                                    <th class="va-m"><?php echo $this->lang->line('label_downcount');?></th>
                                                    <th class="va-m"><?php echo $this->lang->line('label_refercount');?></th>
                                                    <th class="va-m"><?php echo $this->lang->line('label_balance');?></th>
                                                    <th class="va-m"><?php echo $this->lang->line('label_rank');?></th>
                                                      <th class="va-m"><?php echo $this->lang->line('label_status'); ?></th>
                                                    <th  class="va-m"><?php echo $this->lang->line('label_action');?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $rewards = $this->data['field'];
                                                    // print_r($rewards);
                                                    $i=0;
                                                    if($rewards) {
                                                        foreach ($rewards  as $row) {
                                                            $i++;
                                                ?>
                                                            <tr>
                                                                <td class=""><?php echo $i;?></td>
                                                                <td class=""><?php 

                                                                if($row->Membercount!="")
                                                                {
                                                                    echo $row->Membercount." Members";
                                                                }
                                                                else
                                                                {
                                                                    echo "Nill";
                                                                }

                                                                 ?></td>
                                                                <td class=""><?php 
                                                                if($row->ReferalCount!="")
                                                                {
                                                                 echo $row->ReferalCount." Members";
 
                                                                }
                                                                else
                                                                {
                                                                    echo "Nill";
                                                                }
                                                                 ?>
                                                                     
                                                                 </td>
                                                                 <td class="">
                                                                 <?php 
                                                                 if($row->balanceAmount!="")
                                                                 {
                                                                    $currecy=$this->common_model->GetRow('Status=1',"arm_currency");
                                                                    echo $currecy->CurrencySymbol.' '.$row->balanceAmount;
                                                                 }
                                                                 else
                                                                 {
                                                                    echo "Nill";
                                                                 }
                                                                 ?>
                                                                     
                                                                 </td>
                                                                  <td class=""><?php 
                                                                  if($row->Rank!="")
                                                                  {
                                                                    echo $row->Rank;
                                                                  }
                                                                  else
                                                                  {
                                                                    echo "Nill";
                                                                  }
                                                                  ?></td>
                                                           <td class="allcp-form">
                                                            <label class="block mt15 switch switch-primary">
                                                                <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->rank_id;?>" name="status" class="status" value="<?php echo $row->rank_id;?>">
                                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->rank_id;?>"></label>
                                                                <span><?php //echo $row->MemberStatus;?></span>
                                                            </label>
                                                              </td>
                                                                <td class="">
                                                                    <div class="btn-group text-right">
                                                                        <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo ucwords($this->lang->line('action'));?>
                                                                            <span class="caret ml5"></span>
                                                                        </button>
                                                                        <ul role="menu" class="dropdown-menu">
                                                                            <li>
                                                                                <a href="<?php echo base_url().'admin/ranksetting/editfield/'.$row->rank_id;?>"><?php echo ucwords($this->lang->line('edit'));?></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="<?php echo base_url().'admin/ranksetting/delete/'.$row->rank_id;?>"><?php echo ucwords($this->lang->line('delete'));?></a>
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
                                                        <td class="text-center" colspan="7">No Records Found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
    <?php $this->load->view('admin/activemenu');?>

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

function inStock(keys){
    if($('.case:checked').length) {
        var input = $("<input>")
            .attr("type", "hidden")
            .attr("name", "stock")
            .val(keys);
        $('#form-product').append($(input));
        confirm('Select Product is '+keys+' stock?') ? $('#form-product').submit() : false;
    }
}
// function outStock(){
//     if($('.case:checked').length) {
//      confirm('Select Product is Out of stock?') ? $('#form-product').submit() : false;
//     }
// }

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/ranksetting/inactive/'+id,
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
                    url:'<?php echo base_url();?>admin/ranksetting/active/'+id,
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

</body>

</html>
