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
    
<style>
input, select {
    width: 120px;
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
        <?php $this->load->view('admin/toper');?>
        <!--  /Topbar Menu Wrapper  -->

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>
        <!--  /Topbar  -->

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">
        <div class="chute chute-center pt30">
        <!-- <form name="" method="post" action="<?php echo base_url();?>admin/shipping" id="form-add-shipping"> -->
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
                                <!-- <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/shipping/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                                
                            </div>
                        </div>
                        <div class="row mt20">
                            <div class="col-md-6">
                                <div class="">
                                    <div class="radio-custom square radio-info mb5">
                                        <input type="radio" name="shipping" id="shipping_total" checked="<?php if(isset($easypost_status)!=1) echo 'checked';?>">
                                        <label for="shipping_total">Shipping by Sale total</label>
                                    </div>
                                <div class="btn btn-system btn-xs" id="source-button" style="display: none;">&lt; &gt;</div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <div class="radio-custom square radio-info mb5">
                                        <input type="radio" name="shipping" id="shipping_api" checked="<?php if(isset($easypost_status)==1) echo 'checked';?>">
                                        <label for="shipping_api">Real time integration</label>
                                    </div>
                                <div class="btn btn-system btn-xs" id="source-button" style="display: none;">&lt; &gt;</div></div>
                            </div>
                        </div>
                        
                        <!-- <hr class="short"> -->

                        <div class="panel-body pn" id="shipping_method_view">
                            

                            
                            
                        </div>
                    </div>
                </div>

            </div>
        <!-- </form> -->
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


<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>



<!--  /Scripts  -->
<script type="text/javascript">
// $("#selectall").on('click',function(){
//     var chk=$('#selectall:checked').length ? true : false;
//     if(chk){
//         $('.case').prop('checked',true);
//     } else {
//         $('.case').prop('checked',false);
//     }
// });

// function deleteAll(){
//     if($('.case:checked').length) {
//      confirm('Are you sure?') ? $('#form-customer').submit() : false;
//     }
// }

// $('.gui-input').addEventListener("change", myFunction(this));

// function myFunction(keys) {
//     alert(keys);
//     // if(isNaN(keys.value)) {
//     // }
//     // var x = document.getElementById("fname");
//     // x.style = 'border:1px solid red';
//     // x.value = x.value.toUpperCase();

// }

// function CheckValues(keys) {
//     console.log(keys.value);
//     if(isNaN(keys.value)) {
//         alert('only numeric');
//         console.log(keys.class);
//     }
// }
(function($) {

    $(document).ready(function() {

        var attrs = 1;
        function addrules() {

            // html1 = '<tr id="row_' + attrs  + '"> <td> <select name="country[]" class="gui-input"> <option value="0" selected="selected">-- Select Country -- </option> <?php foreach($country as $row) { ?> <option value="<?php echo $row->country_id;?>"><?php echo htmlentities($row->name);?></option> <?php } ?>  </select> </td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td> <button class="btn btn-danger" type="button" onclick="$(\'#row_' + attrs  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </td> </tr>';
            html1 = '<tr id="row_' + attrs  + '"> <td> <select name="country[]" class="gui-input"> <option value="0" selected="selected">-- Select Country -- </option> <?php foreach($country as $row) { ?> <option value="<?php echo $row->country_id;?>"><?php echo htmlentities($row->name);?></option> <?php } ?>  </select> </td> <td class=""><input type="text" name="min[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="max[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="rates[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="fast[]" class="gui-input" value=""/></td><td> <button class="btn btn-danger" type="button" onclick="$(\'#row_' + attrs  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </td> </tr>';
    
            $('#shipping_rules').append(html1);

            attrs++;
        }

        // $(document).ready(function(){
        //     $('#form-add-shipping input').not([type="submit"]).addClass('required');
        // });

        $("#shipping_total_form input, #shipping_total_form select").each(function () {
          $(this).rules("add", {
            required: true,
            number: true
          });
        });

        // console.log('sdsd');
        // $('.status').click(function() {
        //     if (!$(this).is(':checked')) {
        //         var id = $(this).val();
        //         $.ajax({
        //             type: 'post',
        //             url:'<?php echo base_url();?>admin/shipping/inactive/'+id,
        //             success : function()
        //             {
        //                 console.log('sc');
        //             }
        //         });
        //         // return confirm("Are you sure?");
        //     } else {
        //         var id = $(this).val();
        //         $.ajax({
        //             type: 'post',
        //             url:'<?php echo base_url();?>admin/shipping/active/'+id,
        //             success : function(){
        //                 console.log('fail');
        //             }
        //         });
        //     }
        // });
    });

 })(jQuery);
 $(document).ready(function() {
    
    if ($('#shipping_total').is(':checked')) {
        $.ajax({
            url:'<?php echo base_url();?>admin/shipping/view',
            type: 'POST',
            dataType: 'html',
            success: function(html) {
                $('#shipping_method_view').html(html);
            }
        })
    } else {
        $.ajax({
            url:'<?php echo base_url();?>admin/shipping/apiview',
            type: 'POST',
            dataType: 'html',
            success: function(html) {
                $('#shipping_method_view').html(html);
            }
        })
    }

    $('#datatable2').DataTable();
    if($('#easypost_status').is(':checked')) {
        $('#shipping_total_method').css('display', 'block');
        $('#shipping_api_method').css('display', 'none');
    } else {
        $('#shipping_total_method').css('display', 'none');
        $('#shipping_api_method').css('display', 'block');
    }

} );




$('#shipping_total').click(function() {
    if ($(this).is(':checked')) {
        $.ajax({
            url:'<?php echo base_url();?>admin/shipping/view',
            type: 'POST',
            dataType: 'html',
            success: function(html) {
                $('#shipping_method_view').html(html);
            }
        })
    }
})
$('#shipping_api').click(function() {
    if ($(this).is(':checked')) {
        $.ajax({
            url:'<?php echo base_url();?>admin/shipping/apiview',
            type: 'POST',
            dataType: 'html',
            success: function(html) {
                $('#shipping_method_view').html(html);
            }
        })
    }
})

    // $('#shipping_total').click(function() {
    //     if ($(this).is(':checked')) {
    //         $('#shipping_total_method').css('display', 'block');
    //         $('#shipping_api_method').css('display', 'none');
    //         $('#api_method').val('0');
    //     } 
    // })
    // $('#shipping_api').click(function() {
    //     if ($(this).is(':checked')) {
    //         $('#shipping_total_method').css('display', 'none');
    //         $('#shipping_api_method').css('display', 'block');
    //         $('#api_method').val('1');
    //     }
    // })
    // $('#freeshipping').click(function() {
    //     if ($(this).is(':checked')) {
    //         $('#free_ship').css('display', 'block');
    //     } else {
    //         $('#free_ship').css('display', 'none');
    //     }
    // })
    // $('#fast_delivry').click(function() {
    //     if ($(this).is(':checked')) {
    //         $('#fast_delivery').css('display', 'block');
    //     } else {
    //         $('#fast_delivery').css('display', 'none');
    //     }
    // })



</script>
</body>

</html>
