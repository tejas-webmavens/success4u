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
            
                </div>

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
                                            <?php echo ucwords($this->lang->line('page_title'));?>
                                        </div>
                                        <!-- <div class="col-md-2 pull-right">
                                            <a data-original-title="Export" data-toggle="tooltip" title="" href="<?php echo base_url();?>admin/export/archive/members" class="pull-right btn btn-bordered btn-primary"><i class="fa fa-download"></i> Export</a>
                                        </div> -->

                                        <div class="col-md-1 pull-right">
                                            <span class="allcp-form"><a class="btn btn-danger " title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/customers" data-original-title="Back"><i class="fa fa-remove"></i></a></span>
                                        </div>
                                    </div>
                                    <!-- <a class="pull-right" href="#">Create User</a> -->
                                </div>
                            </div>
                            <hr class="short">
                            <div class="panel-body pn">
                                <br><br><br>
                                <?php
                                    $mlsetting  = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                                    if($mlsetting->Id==1)
                                    {
                                        $path="force";
                                    }
                                    else if($mlsetting->Id==2)
                                    {
                                        $path="unilevel";
                                    }
                                    else if($mlsetting->Id==3)
                                    {
                                        $path   ="monoline";
                                    }
                                    else if($mlsetting->Id==4)
                                    {
                                        $path= "binary";
                                    }
                                    else if($mlsetting->Id==5)
                                    {
                                        $path= "board";
                                    }
                                    else if($mlsetting->Id==6)
                                    {
                                        $path= "xup";
                                    }
                                    else if($mlsetting->Id==7)
                                    {
                                        $path= "oddeven";
                                    }
                                     else if($mlsetting->Id==8)
                                    {
                                        $path= "board1";
                                    }
                                     else if($mlsetting->Id==9)
                                    {
                                        $path= "binaryhyip";
                                    }
                                ?>

                                <div class="col-md-12">

                                    <?php if($mlsetting->Id==5) { ?> 
                                        <div class="regform">
                                    
                                            Select Board : 
                                            <select name="board" id="board"  class="board field select" onchange="showgen(this.value)">
                                            <?php

                                                $bplan = $this->db->query("SELECT DISTINCT(BoardId) FROM `arm_boardmatrix` WHERE `MemberId`='".$id."' ");
                                                

                                                for($i=0;$i< $bplan->num_rows(); $i++)
                                                {
                                                    $bpid = ""; 
                                                    $bpid = $bplan->row($i)->BoardId;
                                                    $bdet = $this->common_model->GetRow("PackageId='".$bpid."'","arm_boardplan");
                                                    ?>
                                                <option value="<?php echo $i;?>" <?//if($i==0){echo"selected";}?>><?php echo $bdet->PackageName?></option>
                                            <?php } ?>
                                            </select>
                                        
                                        </div><?php } 
                                          
                                        ?>

                                    <?php 
                                    if($mlsetting->Id==8)
                                    {
                                        ?>
                                        <div class="regform">

                                        
                                            Select Board : 
                                            <select name="board" id="board"  class="board field select" onchange="showgen(this.value)">
                                            <?php

                                            $bplan = $this->db->query("SELECT DISTINCT(BoardId) FROM `arm_boardmatrix1` WHERE `MemberId`='".$id."' ");
                                            
                                                for($i=0;$i< $bplan->num_rows(); $i++)
                                                {
                                                    $bpid = ""; 
                                                    $bpid = $bplan->row($i)->BoardId;
                                                    $bdet = $this->common_model->GetRow("PackageId='".$bpid."'","arm_boardplan");
                                                    ?>
                                                <option value="<?php echo $i;?>" <?//if($i==0){echo"selected";}?>><?php echo $bdet->PackageName?></option>
                                            <?php } ?>
                                            </select>
                                            
                                        </div>
                                    <?php 
                                    } 
                                    ?>
                                    <br><br>
                                    
                                    <?php 
                                    if($mlsetting->Id==5 || $mlsetting->Id==8)
                                    {   
                                        for($i=0; $i< $bplan->num_rows(); $i++)
                                        {  
                                    ?>
                                           <iframe style ="display:none;" class="genview <?php echo  "gen_".$i;?>" id="<?php echo  "gen_".$i;?>" width="900px" height="700px" src="<?php echo base_url()."genealogy/".$path;?>/genealogyview/view/<?php  echo $bplan->row($i)->BoardId?>/<?php  echo $id;?>" style="padding-top:5px; margin-top:-80px;  margin-right: 2px;"></iframe>

                                    <?php
                                        }
                                    }
                                    elseif($mlsetting->Id==4)
                                    {   
                                    ?>
                                        <iframe class="col-md-12" height="700px" src="<?php echo base_url()."genealogy/".$path;?>/genealogyview1/view/<?php echo $id?>" style="padding-top:5px; margin-top:-80px;  margin-right: 2px;"></iframe>
                                    <?php  
                                    }  
                                    else
                                    {?>
                                        <iframe class="col-md-12" height="700px" src="<?php echo base_url()."genealogy/".$path;?>/genealogyview/view/<?php echo $id?>" style="padding-top:5px; margin-top:-80px;  margin-right: 2px;"></iframe>

                                   
                               <?php } 
                                    ?>   
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

function showgen(id)
{
    // console.log("hi");
    // alert("hi");
    var shid ='gen_'+id;
    $('.genview').css("display","none");
    $('#'+shid).css("display","block");
    
}
 $(document).ready(function() {
    // alert($('#board').val());
    var id = $('#board').val();
    var shid ='gen_'+id;
    $('#'+shid).css("display","block");
} );

</script>
</body>

</html>
