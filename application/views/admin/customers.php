<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <!-- <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> -->

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
                                Filter User 
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="allcp-form theme-primary">
                            <form method="post" action="<?php echo base_url().'admin/customers/search';?>" name="search_form">

                                <div class="section row mb20">
                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by First name</h6>
                                        <label for="firstname" class="field prepend-icon">
                                            <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="First Name" value="<?php echo set_value('firstname');?>">
                                            <label for="firstname" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>

                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by User Name</h6>
                                        <label for="username" class="field prepend-icon mb5">
                                            <input type="text" name="username" id="username" class="gui-input" placeholder="User Name" value="<?php echo set_value('username');?>">
                                            <label for="username" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>

                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by User Email</h6>
                                        <label for="email" class="field prepend-icon">
                                            <input type="text" name="email" id="email" class="gui-input" placeholder="User Email" value="<?php echo set_value('email');?>">
                                            <label for="email" class="field-icon">
                                                <i class="fa fa-envelope"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10 mt40 pull-right">
                                        <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/customers';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right"><i class="fa fa-eraser"></i></a>
                                    </div>

                                </div>

                                <div class="section row mb20">
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by Status</h6>
                                        <label class="field select">
                                            <select id="filter-categories" name="status">
                                                <option value="0" selected="selected">Filter by Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">In active</option>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by date</h6>
                                        <label for="datepicker1" class="field prepend-icon mb5">
                                            <input type="text" id="datepicker1" name="datepicker1" class="gui-input fs13" placeholder="From" value="<?php echo set_value('datepicker1');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> to date</h6>
                                        <label for="datepicker2" class="field prepend-icon">
                                            <input type="text" id="datepicker2" name="datepicker2" class="gui-input fs13" placeholder="To" value="<?php echo set_value('datepicker2');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <button class="btn btn-primary pull-right ph30" type="submit" name="search">Search</button>
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
                                 
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo $this->lang->line('page_title'); ?>
                                    </div>
                                    <!-- <div class="col-md-2 pull-right">
                                        <a data-original-title="Export" data-toggle="tooltip" title="" href="<?php echo base_url();?>admin/export/archive/members" class="pull-right btn btn-bordered btn-primary"><i class="fa fa-download"></i> Export</a>
                                    </div> -->
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/customers/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-danger " title="" data-toggle="tooltip" href="javascript:void(0)" onclick="deleteAll()" data-original-title="Delete Selected"><i class="fa fa-remove"></i></a></span>
                                    </div>
                                </div>
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive">
                            <form id="form-customer" method="post" action="<?php echo base_url();?>admin/customers/deleteall">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th>
                                        <th class="va-m">Name</th>
                                        <th class="va-m">User Name</th>
                                        <th class="va-m">Email</th>
                                        <th class="va-m">Sponsor</th>
                                        <th class="va-m">Registered</th>
                                        <th class="va-m">Ip Address</th>
                                        <th class="va-m">Active</th>
                                        <th class="va-m">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $customers = $this->data;
                                        if($customers['customers']) {
                                        foreach ($customers['customers'] as $row) {
                                            if($row->DirectId) {
                                                $Sponsor = $this->common_model->GetCustomer($row->DirectId);
                                                if($Sponsor)
                                                $SponsorName = $Sponsor->UserName;
                                            }
                                            
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <label class="option block mn">
                                                <input type="checkbox" name="customer[]" value="<?php echo $row->MemberId;?>" class="case">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td>
                                        <td class=""><?php echo $row->FirstName.' '.$row->LastName;?></td>
                                        <td class=""><?php echo $row->UserName;?></td>
                                        <td class=""><?php echo $row->Email;?></td>
                                        <td class=""><?php echo (isset($SponsorName)) ? $SponsorName : 'admin' ;?></td>
                                        <td class=""><?php echo date('m/d/Y', strtotime($row->DateAdded));?></td>
                                         <td class=""><?php echo $row->Ip;?></td>
                                        <td class="allcp-form">
                                            <label class="block mt15 switch switch-primary">
                                                <input type="checkbox" <?php if($row->MemberStatus=='Active') echo 'checked'; ?> id="t<?php echo $row->MemberId;?>" name="status" class="status" value="<?php echo $row->MemberId;?>">
                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->MemberId;?>"></label>
                                                <span><?php //echo $row->MemberStatus;?></span>
                                            </label>

                                        </td>

                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> Action
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/add/'.$row->MemberId;?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/profile/'.$row->MemberId;?>">Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/reset/'.$row->MemberId;?>">Reset Password</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/genealogy/view/'.$row->MemberId;?>">View Genealogy</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/delete/'.$row->MemberId;?>">Delete</a>
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
                                        <td class="text-center" colspan="8">No Records Found!</td>
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

<?php /*$this->load->view('admin/activemenu');*/?>

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
                    url:'<?php echo base_url();?>admin/customers/inactive/'+id,
                    success : function(resp)
                    {
                        if(resp)
                            window.location.href = "<?php echo base_url();?>admin/customers";
                        else
                            console.log('fail');
                    }
                });
                // return confirm("Are you sure?");
            } else {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/customers/active/'+id,
                    success : function(resp){
                        if(resp)
                            window.location.href = "<?php echo base_url();?>admin/customers";
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
</script>
</body>

</html>
