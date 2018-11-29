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
<?php $this->load->view('admin/customizer'); ?>
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

        <section id="content" class="table-layout animated fadeIn">

                <!--  Column Left  -->
                <aside class="chute chute-left chute290" data-chute-height="match">

                    <div class="chute chute-center">

                        <div class="mw1000 center-block">

                            <!--  General Information  -->
                            <div class="panel mb35">
                                <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
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
                                        <?php //print_r(form_error());

                                        ?>

                                    </div>

                                    <div class="panel-body br-t">

                                        <div class="allcp-form theme-primary" id="levelcommissiondiv">


                                            <div class="section row mb10">
                                                <label for="level" class="field-label col-sm-3 ph10  text-left"><?= $this->lang->line('levelSettings') ?><sup><em class="state-error">*</em></sup></label>
                                                <div class="col-sm-3 ph10">
                                                    <input type='button' value='+' id='addlvlButton'  class="btn btn-bordered btn-primary"  />
                                                    <input type='button' value='-' id='removelvlButton' class="btn btn-bordered btn-primary" />
                                                </div>
                                            </div>
                                            <div class="section row mb10">
                                                <div class="col-sm-3 ph10">
                                                </div>
                                                <div class="col-sm-3 ph10">
                                                    <label for="level" class="field prepend-icon">
                                                        <p><?= $this->lang->line('levelNumber') ?></p>
                                                    </label>
                                                    <?php echo form_error('level');?>
                                                </div>
                                                <div class="col-sm-3 ph10">
                                                    <label for="increase_per_trans" class="field prepend-icon">
                                                        <p><?= $this->lang->line('TransactionsCount') ?></p>
                                                    </label>
                                                    <?php echo form_error('increase_per_trans');?>
                                                </div>
                                                <div class="col-sm-3 ph10">
                                                    <label for="increase_per_refer" class="field prepend-icon">
                                                        <p><?= $this->lang->line('ReferCount') ?></p>
                                                    </label>
                                                    <?php echo form_error('increase_per_refer');?>
                                                </div>
                                            </div>
                                            <?php
                                            if($this->data['levelcount']>0){
                                                foreach($this->data['field'] as $_data){
                                            ?>
                                                <div class="section row mb10">
                                                    <div class="col-sm-3 ph10">
                                                        <input type="hidden" name="id[]" value="<?= set_value('id', isset($_data->id) ? $_data->id : ''); ?>">
                                                    </div>
                                                    <div class="col-sm-3 ph10">
                                                        <label for="level" class="field prepend-icon">
                                                            <input type="number" name="level[]" id="level" placeholder="<?= $this->lang->line('levelNumber') ?>"
                                                            class="gui-input" value="<?php echo set_value('level', isset($_data->level) ? $_data->level : '');?>" readonly>
                                                        </label>
                                                        <?php echo form_error('level');?>
                                                    </div>
                                                    <div class="col-sm-3 ph10">
                                                        <label for="increase_per_trans" class="field prepend-icon">
                                                            <input type="number" name="increase_per_trans[]" id="increase_per_trans" placeholder="<?= $this->lang->line('TransactionsCount') ?>"
                                                            class="gui-input" value="<?php echo set_value('increase_per_trans', isset($_data->increase_per_trans) ? $_data->increase_per_trans : '');?>" >
                                                        </label>
                                                        <?php echo form_error('increase_per_trans');?>
                                                    </div>
                                                    <div class="col-sm-3 ph10">
                                                        <label for="increase_per_refer" class="field prepend-icon">
                                                            <input type="number" name="increase_per_refer[]" id="increase_per_refer" placeholder="<?= $this->lang->line('ReferCount') ?>"
                                                            class="gui-input" value="<?php echo set_value('increase_per_refer', isset($_data->increase_per_refer) ? $_data->increase_per_refer : '');?>" >
                                                        </label>
                                                        <?php echo form_error('increase_per_refer');?>
                                                    </div>
                                                </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <input type="hidden" id="lvlcount" name="lvlcount" value="<?php echo $this->data['levelcount'];?>">
                                            <input type="hidden" id="masterlvlcount" value="<?php echo $this->data['levelcount'];?>">
                                            <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

        

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

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.enablestatus').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/packagesetting/disable/'+id,
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
                    url:'<?php echo base_url();?>admin/packagesetting/enable/'+id,
                    success : function(){
                        console.log('fail');
                    }
                });
            }
        });

        $('.requirestatus').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/registersetting/inactive/'+id,
                    success : function()
                    {
                        console.log('fail');
                    }
                });
                // return confirm("Are you sure?");
            } else {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/registersetting/active/'+id,
                    success : function(){
                        console.log('success');
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
<script type="text/javascript">

    $(document).ready(function(){

        var counter = 2;
        $("#addlvlButton").click(function () {
           var counter = parseFloat(document.getElementById("lvlcount").value);
           counter++;
           document.getElementById("lvlcount").value = counter;

           if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   

        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'levelcommission' + counter).attr("class", 'section row mb10');

        var text = '<div class="section row mb10"><div class="col-sm-3 ph10"></div><div class="col-sm-3 ph10"><label for="level" class="field prepend-icon"><input type="number" name="level[]" id="level" placeholder="<?= $this->lang->line('levelNumber') ?>" value="'+counter+'" class="gui-input" readonly></label></div><div class="col-sm-3 ph10"><label for="increase_per_trans" class="field prepend-icon"><input type="number" name="increase_per_trans[]" id="increase_per_trans" placeholder="<?= $this->lang->line('TransactionsCount') ?>" class="gui-input"></label></div><div class="col-sm-3 ph10"><label for="increase_per_refer" class="field prepend-icon"><input type="number" name="increase_per_refer[]" id="increase_per_refer" placeholder="<?= $this->lang->line('ReferCount') ?>" class="gui-input"></label></div></div>'
        levelcommissiondiv.after().html(text);

        levelcommissiondiv.appendTo("#levelcommissiondiv");


        counter++;
    });

        $("#removelvlButton").click(function () {
           var counter = parseFloat(document.getElementById("lvlcount").value);
           var masterlvlcount = parseFloat(document.getElementById("masterlvlcount").value);
           
           if(counter==masterlvlcount){
              alert("No more textbox to remove");
              return false;
          }   


          $("#levelcommission" + counter).remove();
          counter--;
          document.getElementById("lvlcount").value = counter;

      });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
              msg += "\n levelcommissiondiv #" + i + $('#levelcommissiondiv' + i).val();
          }
          alert(msg);
      });
    });


$(document).ready(function(){

    var counter = 2;

    $("#addprtButton").click(function () {
        var counter = parseFloat(document.getElementById("lvlprtcount").value);
        counter++;
        document.getElementById("lvlprtcount").value = counter;

        if(counter>15){
            alert("Only 15 textboxes allow");
            return false;
        }   
        var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'productlevelcommission' + counter).attr("class", 'section row mb10');

      /*  var levelcommissiondiv = $(document.createElement('div'))
        .attr("id", 'productlevelcommission' + counter).attr("class", 'col-sm-7 ph10 mb10');
*/

        levelcommissiondiv.after().html('<label class="field-label col-sm-3 ph10 "></label><div class="col-sm-7 ph10 "><input type="text" name="productlevelcommission[]" placeholder="productLevel'+ counter+' Commission Amount" id="productlevelcommission'+ counter+'" value="" class="gui-input" ></div>');



        levelcommissiondiv.appendTo("#productlevelcommissiondiv");

        counter++;

    });

    $("#removeprtButton").click(function () {
       var counter = parseFloat(document.getElementById("lvlprtcount").value);
       if(counter==1){
          alert("No more textbox to remove");
          return false;
      }   



      $("#productlevelcommission" + counter).remove();
      counter--;
      document.getElementById("lvlprtcount").value = counter;

  });

    $("#getButtonValue").click(function () {

        var msg = '';
        for(i=1; i<counter; i++){
          msg += "\n productlevelcommissiondiv #" + i + $('#productlevelcommissiondiv' + i).val();
      }
      alert(msg);
  });
});

</script>
</body>

</html>