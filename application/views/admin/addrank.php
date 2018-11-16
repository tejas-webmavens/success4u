<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

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
    <style type="text/css">
        p
        {
            color: red;
        }
    </style>

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
            <?php $this->load->view('admin/toper'); ?>
            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

                

                <!--  Column Center  -->
                <div class="chute chute-center">

                    <div class="mw1000 center-block">

                        <!--  General Information  -->
                        <div class="panel mb35">
                            <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
                                <div class="panel-heading">
                                    <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_pvedit')); ?></span>
                                    <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/ranksetting" data-original-title="Back"><i class="fa fa-close"></i></a></span>
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

                                <div class="panel-body br-t">

                                    <div class="allcp-form theme-primary">

                                        <div class="section row mb10">
                                            <label for="rewardrank" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('downlinecount')); ?></label>

                                            <div class="col-sm-7 ph10">
                                                <label for="rewardrank" class="field prepend-icon">
                                                    <input type="text" name="downlinemembercount" id="rewardrank" placeholder="<?php echo  ucwords($this->lang->line('downlinecount')); ?>"
                                                    class="gui-input" value="<?php echo set_value('rewardrank', isset($this->data['fielddata']->Membercount) ? $this->data['fielddata']->Membercount : '');?>" >
                                                    <label for="rewardrank" class="field-icon">
                                                        <i class="fa fa-info"></i>
                                                    </label>
                                                </label>
                                                <!-- <?php echo form_error('downlinemembercount');?> -->

                                              
                                            </div>
                                        </div>

                                        <div class="section row mb10">
                                            <label for="referalcount" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('referalcount')); ?></label>

                                            <div class="col-sm-7 ph10">
                                                <label for="rewardpoint" class="field prepend-icon">
                                                    <input type="text" name="referalcount" id="rewardpoint" placeholder="<?php echo  ucwords($this->lang->line('referalcount')); ?>"
                                                    class="gui-input" value="<?php echo set_value('rewardpoint', isset($this->data['fielddata']->points) ? $this->data['fielddata']->points : '');?>" >
                                                    <label for="rewardpoint" class="field-icon">
                                                          <i class="fa fa-info"></i>
                                                    </label>
                                                </label>
                                                <!-- <?php echo form_error('referalcount');?> -->

                                       
                                            </div>
                                        </div>

                                             <div class="section row mb10">
                                            <label for="rewardpoint" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('balanceamount')); ?></label>

                                            <div class="col-sm-7 ph10">
                                                <label for="rewardpoint" class="field prepend-icon">
                                                    <input type="text" name="targetbalance" id="balanceamount" placeholder="<?php echo  ucwords($this->lang->line('balanceamount')); ?>"
                                                    class="gui-input" value="<?php echo set_value('rewardpoint', isset($this->data['fielddata']->points) ? $this->data['fielddata']->points : '');?>" >
                                                    <label for="rewardpoint" class="field-icon">
                                                        <i class="fa fa-money"></i>
                                                    </label>
                                                </label>
                                                <!-- <?php echo form_error('targetbalance');?> -->

                                              
                                            </div>
                                        </div>
                    
                                        <div class="section row mb10">
                                            <label for="reward" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('rank')); ?></label>

                                            <div class="col-sm-7 ph10">
                                                <label for="reward" class="field prepend-icon">
                                                    <input type="text" name="rank" id="reward" placeholder="<?php echo  ucwords($this->lang->line('rank')); ?>"
                                                    class="gui-input" value="<?php echo set_value('reward', isset($this->data['fielddata']->reward) ? $this->data['fielddata']->reward : '');?>" >
                                                    <label for="reward" class="field-icon">
                                                        <i class="fa fa-info"></i>
                                                    </label>
                                                </label>
                                               <!-- <?php echo form_error('rank');?> -->
                                            </div>
                                        </div>

                              <div class="section row mb10">
                                <label for="sitestatus"
                                class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('status')); ?></label>

                                <div class="col-sm-8 ph10">
                                
                                
                                     <div class="option-group field">
                                <label class="col-md-3 block mt15 option option-primary">
                                           
                                            <input type="radio" <?php if(isset($this->data['fielddata']->Status)==1){echo "checked='checked'";}else{echo "";}?> value='1' name="status">
                                            <span class="radio"></span>
                                                <?php echo  ucwords($this->lang->line('on'))?>
                                                </label>

                                            <label class="col-md-3 block mt15 option option-primary">
                                            <input type="radio" <?php if(isset($this->data['fielddata']->Status)==0){echo "checked='checked'";}else{echo "";}?> value='0' name="status">
                                            <span class="radio"></span>
                                                <?php echo  ucwords($this->lang->line('off'))?>
                                </label>
                                </div>
                                <label for="sitestatus" class="field-icon">
                                   
                                </label>
                           <!--  <?php echo ucwords(form_error('sitestatus')); ?> -->
                        </div>
                    </div>
                                    
                                        <div class="panel-footer text-right">
                                            
                                            <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div> <!-- panel md35 ends-->
                    </div>
                </div>
                <!--  /Column Center  -->

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


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

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
            var levelcommissiondiv = $(document.createElement('div')).attr("id", 'matchingbonus' + counter).attr("class", 'section row mb10');
            levelcommissiondiv.after().html('<label class="field-label col-sm-3 ph10 "></label></div><div class="col-sm-7 ph10 "><input type="text" name="matchingbonus[]" placeholder="Level'+ counter+' matching bonus" id="matchingbonus'+ counter+'" value="" class="gui-input" >');
            levelcommissiondiv.appendTo("#matchingbonusdiv");
            counter++;
        });

        $("#removelvlButton").click(function () {
            var counter = parseFloat(document.getElementById("lvlcount").value);
            if(counter==1){
                alert("No more textbox to remove");
                return false;
            }
            $("#matchingbonus" + counter).remove();
            counter--;
            document.getElementById("lvlcount").value = counter;

        });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n matchingbonusdiv #" + i + $('#matchingbonusdiv' + i).val();
            }
            alert(msg);
        });
    });

    $(document).ready(function(){

        $("#addlvlsub").click(function () {
            
            var counter = parseFloat(document.getElementById("lvlsubcount").value);
            counter++;
            document.getElementById("lvlsubcount").value = counter;
            if(counter>15){
                alert("Only 15 textboxes allow");
                return false;
            } 
         
            var levelcommissiondiv = $(document.createElement('div')).attr("id", 'subcomm' + counter).attr("class", 'section row mb10');
            levelcommissiondiv.after().html('<label class="col-sm-3 ph10 "></label><div class="col-sm-7 ph10 mb10"><input type="text" name="subcomm[]" placeholder="Level'+ counter+' pv" id="pv'+ counter+'" value="" class="gui-input" ></div>');
            levelcommissiondiv.appendTo("#subdiv");
            counter++;
        });
     
        $("#removelvlsub").click(function () {
            var counter = parseFloat(document.getElementById("lvlsubcount").value);
            if(counter==1){
                alert("No more textbox to remove");
                return false;
            }
            $("#subcomm" + counter).remove();
            counter--;
            document.getElementById("lvlsubcount").value = counter;
            
        });
     
        $("#getButtonValue").click(function () {
            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n subdiv #" + i + $('#subdiv' + i).val();
            }
            alert(msg);
        });

    });

    $(document).ready(function(){

     
        $("#addlvlpv").click(function () {
            
            var counter = parseFloat(document.getElementById("lvlpvcount").value);
            counter++;
            document.getElementById("lvlpvcount").value = counter;
            if(counter>15){
                alert("Only 15 textboxes allow");
                return false;
            } 
         
            var levelcommissiondiv = $(document.createElement('div')).attr("id", 'pv' + counter).attr("class", 'section row mb10');
            levelcommissiondiv.after().html('<label class="col-sm-3 ph10 "></label><div class="col-sm-7 ph10 mb10"><input type="text" name="pv[]" placeholder="Level'+ counter+' pv" id="pv'+ counter+'" value="" class="gui-input" ></div>');
            levelcommissiondiv.appendTo("#pvdiv");
            counter++;
        });
     
        $("#removelvlpv").click(function () {
            var counter = parseFloat(document.getElementById("lvlpvcount").value);
            if(counter==1){
                alert("No more textbox to remove");
                return false;
            }
            $("#pv" + counter).remove();
            counter--;
            document.getElementById("lvlpvcount").value = counter;
            
        });
     
        $("#getButtonValue").click(function () {
            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n pvdiv #" + i + $('#pvdiv' + i).val();
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

<script type="text/javascript">
    (function($) {

        $(document).ready(function() {

        // "use strict";
        // // Init Theme Core
        // Core.init();

        // // Init Demo JS
        // Demo.init();

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#allcp-form").validate({

            // States


            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                packagename: {
                    required: true
                },
                packagefee: {
                    required: true,
                    number:true
                },
                renewalstatus: {
                    required: true
                },
                renewalfee: {
                    required: true,
                    number:true
                },
                recurringstatus: {
                    required: true
                },
                recurringfee: {
                    required: true,
                    number:true
                },
                autodebitstatus: {
                    required: true
                },
                autocreateorderstatus: {
                    required: true
                },
                product: {
                    required: true
                },
                owncommission: {
                    required: true,
                    number:true
                },
                levelcompletedcommission: {
                    required: true,
                    number:true
                },
                matrixcompletedcommission: {
                    required: true,
                    number:true
                },
                levelcommission: {
                    required: true,
                    number:true
                },
                productlevelcommission: {
                    required: true,
                    number: true
                }
                
            },

            // error message
            messages: {
                packagename: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                packagefee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                renewalstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                renewalfee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                recurringstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                recurringfee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                autodebitstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                autocreateorderstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                product: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                levelcompletedcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('require')); ?>'
                },
                matrixcompletedcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                levelcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number:'<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                productlevelcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                }
                
            },

            /* @validation highlighting + error placement
            ---------------------------------------------------- */

            highlight: function(element, errorClass, validClass) {
                $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio") || element.is(":checkbox")) {
                    element.closest('.option-group').after(error);
                } else {
                    error.insertAfter(element.parent());
                }
            }
        });

});

})(jQuery);
</script>                                                                                                                                                                                                                       <!--  /Scripts  -->

</body>

</html>
