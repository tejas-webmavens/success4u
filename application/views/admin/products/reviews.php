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
                                    <div class="col-md-9">
                                        <?php echo $this->lang->line('page_title'); ?>
                                    </div>
                                    <!--<div class="col-md-1">
                                        <button onclick="inStock('in')" class="btn btn-primary" title="" data-toggle="tooltip" type="button" data-original-title="In Stock"><i class="fa fa-stack-overflow"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="inStock('out')" class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Out of Stock"><i class="fa fa-stack-overflow"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                     <div class="col-md-1">
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/product/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                    </div> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive">
                            <form name="form-reviews" id="form-reviews" method="post" action="<?php echo base_url();?>/admin/reviews/activeall">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th>
                                        <th class="va-m"><?php echo $this->lang->line('label_image'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_name'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_username'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_rating'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_status'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        $reviews = $this->data['reviews'];
                                        
                                        if($reviews) {
                                        foreach ($reviews as $row) {
                                            
                                            if($row->MemberId)
                                                $member = $this->common_model->GetCustomer($row->MemberId);
                                            if($member){
                                               $membername = $member->UserName;
                                            }
                                            else{
                                                $membername = "Unknown";
                                            }


                                            $product = $this->product_model->GetProduct($row->ProductId);

                                            if($product) {
                                                if($product->Image) {
                                                    $product_image = explode(',', $product->Image);
                                                    $pimage1 = base_url().'uploads/admin/product/'.$product_image[0];
                                                } else {
                                                    $pimage1 = base_url().'uploads/noimage.png';
                                                }
                                            
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <label class="option block mn">
                                                <input type="checkbox" name="products[]" value="<?php echo $row->ReviewId;?>" class="case">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td>
                                        <td class="w100">
                                            <?php if(isset($pimage1)) { ?>
                                                <img class="img-responsive mw40 ib mr10" title="user" src="<?php echo $pimage1;?>"/>
                                            <?php } ?>
                                        </td>
                                        <!-- <td class=""><?php echo $row->Image;?></td> -->
                                        <td class=""><?php echo $product->ProductName;?></td>
                                        <td class="text-right"><?php echo $membername; ?></td>
                                        <td class="text-right"><?php echo $row->rating;?></td>
                                        
                                        <td class="allcp-form">
                                            <label class="block mt15 switch switch-primary">
                                                <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->ReviewId;?>" name="status" class="status" value="<?php echo $row->ReviewId;?>">
                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->ReviewId;?>"></label>
                                                <span><?php //echo $row->MemberStatus;?></span>
                                            </label>
                                        </td>
                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo $this->lang->line('label_action'); ?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <!-- <li>
                                                        <a href="<?php echo base_url().'admin/reviews/add/'.$row->ReviewId;?>"><?php echo $this->lang->line('label_edit'); ?></a>
                                                    </li> -->
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/reviews/delete/'.$row->ReviewId;?>"><?php echo $this->lang->line('label_delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }
                                            }
                                        } else {   
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo $this->lang->line('label_no_records'); ?></td>
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



(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/reviews/inactive/'+id,
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
                    url:'<?php echo base_url();?>admin/reviews/active/'+id,
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
