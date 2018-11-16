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
<?php error_reporting(0);?>
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

        <?php  ?>
            <div class="row">
            <!--  Column search  -->

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <?php echo ucwords($this->lang->line('filter'));?>
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="allcp-form theme-primary">
                            <form method="post" action="<?php echo base_url().'admin/epin/searchexpiryepin';?>" name="search_form">

                                <div class="section row mb20">
                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo ucwords($this->lang->line('filtername'));?></h6>
                                        <label for="username" class="field prepend-icon">
                                            <input type="text" name="username" id="username" class="gui-input" placeholder="<?php echo ucwords($this->lang->line('username'));?>" value="<?php echo set_value('username');?>">
                                            <label for="username" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>

                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"><?php echo ucwords($this->lang->line('filterpackage'));?></h6>
                                        <label for="package" class="field prepend-icon mb5">
                                            <input type="text" name="package" id="package" class="gui-input" placeholder="<?php echo ucwords($this->lang->line('package'));?>" value="<?php echo set_value('package');?>">
                                            <label for="package" class="field-icon">
                                                <i class="fa fa-info"></i>
                                            </label>
                                        </label>
                                    </div>

                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"><?php echo ucwords($this->lang->line('filterepin'));?></h6>
                                        <label for="epin" class="field prepend-icon">
                                            <input type="text" name="epin" id="epin" class="gui-input" placeholder="<?php echo ucwords($this->lang->line('epin'));?>" value="<?php echo set_value('epin');?>">
                                            <label for="epin" class="field-icon">
                                                <i class="fa fa-envelope"></i>
                                            </label>
                                        </label>
                                    </div>
                                   <div class="col-md-3 ph10 mt40">
                                        <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/epin/expiryepin';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right "><i class="fa fa-eraser"></i></a>
                                    </div>
                                </div>

                                <div class="section row mb20">
                                     <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by Status</h6>
                                        <label class="field select">
                                            <select id="filter-categories" name="status">
                                            <?php if(isset($_POST['status'])) { $status=$_POST['status'];}else{$status="";}?>
                                                <option value="" selected="selected">Filter by Status</option>
                                                <option value="0" <?php if($_POST['status']!='') {if($_POST['status']==0) { echo "selected";}}?> ><?php echo ucwords($this->lang->line('unused'));?></option>
                                                <option value="1" <?php if($_POST['status']!='') {if($_POST['status']==1) { echo "selected";}}?> ><?php echo ucwords($this->lang->line('used'));?></option>
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
                                    <div class="col-md-2 ph10 pull-right">
                                    <h6 class="mb40"> </h6>

                                        <button class="btn btn-primary pull-right ph25" type="submit" name="search"><?php echo ucwords($this->lang->line('search'));?></button>
                                    </div>
                                </div>

                                
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!--  /Column Search  -->
            </div> <?php  ?>
                <!--  Column Center  -->
           

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            

                            <div class="panel-title hidden-xs">
                                <?php echo ucwords($this->lang->line('pagetitle_expiryepin'));?>
                                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/epin/addpin" data-original-title="<?php echo ucwords($this->lang->line('pagetitle_addepin'));?>"><i class="fa fa-plus"></i></a></span>
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                         <div class="section row mb10">
                         <label for="expirynote"  class="field-label col-sm-12 ph10 text-right"><?php echo ucwords($this->lang->line('expirynote'));?></label>
                         </div>
                        <div class="section row mbn">
                                <?php if($this->session->flashdata('error_message')) { ?>    
                                    <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                        <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                    </div>
                                <?php unset($_SESSION['error_message']); } ?>
                                
                                <?php if($this->session->flashdata('success_message')) { ?>    
                                    <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                        <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                    </div>
                                <?php unset($_SESSION['success_message']); } ?>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <!-- <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th> -->
                                        <th class="va-m"><?php echo $this->lang->line('label_sno');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_expiry');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_package');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_fee');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_transaction');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_status');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_allocateuser');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_useduser');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_action');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

                                        $packages = $this->data;
                                       
                                         if($packages['field']!="")
                                        {
                                             $ii=1;
                                        foreach ($packages['field']  as $row) {
                                            
                                    ?>
                                    <tr>
                                       <!--  <td class="text-center">
                                            <label class="option block mn">
                                                <input type="checkbox" name="inputname[]" value="<?php echo $row->PackageId;?>" class="case">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td> -->
                                        <td class=""><?php echo $ii++;?></td>
                                        <td class=""><?php echo date("Y-m-d",strtotime($row->ExpiryDay));?></td>
                                        <td class=""><?php $user = $this->Epin_model->Getfielddata($row->EpinPackageId); echo $user->PackageName;?></td>
                                        <td class=""><?php echo $row->EpinAmount;?></td>
                                        <td class=""><?php echo $row->EpinTransactionId;?></td>
                                        <td class=""><?php if($row->EpinStatus=='1') { echo $this->lang->line('used'); } else { echo $this->lang->line('unused');}?></td>
                                        <td class=""><?php if($row->AllocatedBy=='0') { echo "---";} else{ $user = $this->common_model->GetCustomer($row->AllocatedBy); echo $user->UserName;}?></td>
                                        <td class=""><?php if($row->UsedBy=='0')     { echo "---";} else{ $user = $this->common_model->GetCustomer($row->UsedBy); echo $user->UserName;}?></td>
                                        
                                       <td class="">
                                               <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo ucwords($this->lang->line('action'));?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/epin/reactive/'.$row->EpinRecordId;?>"><?php echo ucwords($this->lang->line('reactiveepin'));?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/epin/expdelete/'.$row->EpinRecordId;?>"><?php echo ucwords($this->lang->line('deleteepin'));?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                       
                                        
                                       
                                    </tr>
                                    <?php 
                                        }   }
                                    ?>
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

function deleteAll(){
    if($('.case:checked').length) {
     confirm('Are you sure?') ? $('#form-customer').submit() : false;
    }
}

(jQuery);
 $(document).ready(function() {
    $('#datatable2').DataTable();
} );

</script>
</body>

</html>
