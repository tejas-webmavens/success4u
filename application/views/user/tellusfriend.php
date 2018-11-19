<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>

<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
	<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		
		<div class="content-wrapper">
			<section class="content">
					
				<?php $this->load->view('user/pagelink');?>
				<?php $this->load->view('user/userinfo');?>
				<?php //print_r($users);?>
				<div class="bskt">
                    <?php if($this->session->flashdata('error_message')) { ?>  
                    	<div class="alert alert-danger alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<?php echo $this->session->flashdata('error_message');?>
                    	</div>  
                        
                    <?php } ?>
                    
                    <?php if($this->session->flashdata('success_message')) { ?>    
                    	<div class="alert alert-success alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<?php echo $this->session->flashdata('success_message');?>
                    	</div>
                    <?php } ?>
                </div>
                <?php 
                	if($tellus){
                			$message = urldecode($tellus->Message);
                			$refer_link = '<a href="'.base_url().'user/register/process/'.$member->ReferralName.'" target="_blank">Click here</a>';
                			$site_link = '<a href="'.base_url().'" target="_blank">Click here</a>';
                			
                			$user_name = $this->session->userdata('full_name');
                			$message = str_replace('[YOUR_NAME]', $user_name, $message);
                			$message = str_replace('[REFER_LINK]', $refer_link, $message);
                			$message = str_replace('[SITE_LINK]', $site_link, $message);
                		}
                ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Tell a Friend</h3>
								<div class="box-tools pull-right">
									<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
									<button data-widget="remove" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<form class="form-horizontal" id="tellus-forms" method="post" action="<?php echo base_url();?>user/tellus/add" >
									<div class=""> 
										<span class="">
											<ul class="nav panel-tabs">
												<li  class="active"><a href="#tab1" data-toggle="tab"> Friend Email </a></li>
												<li id="message-content"><a> Message</a></li>
												<!-- <li><a href="#tab3" data-toggle="tab"> Bookmarks</a></li> -->
											</ul>
										</span> 
									</div>

									<div class="panel-body">
										<div class="tab-content">
											<div class="tab-pane active" id="tab1">
												<br/><br/>
												<div class="row mt40">
													<div class="col-sm-12">
													<table id="example1" class="table table-bordered table-striped">
														<tr>
															<td><label for="inputName" class="control-label">First Name</label></td>
															<td><label for="inputName" class="control-label">Last Name</label></td>
															<td><label for="inputName" class="control-label">Email</label></td>
														</tr>
														<tr>
															<td><input type="text" class="form-control"  id="firstname1" name="firstname[]" placeholder="firstname"></td>
															<td><input type="text" class="form-control"  id="lastname1" name="lastname[]" placeholder="lastname"></td>
															<td><input type="email" class="form-control" id="email1"  name="email[]" placeholder="Email"></td>
														</tr>
														<tr>
															<td><input type="text" class="form-control"  name="firstname[]" placeholder="firstname"></td>
															<td><input type="text" class="form-control"  name="lastname[]" placeholder="lastname"></td>
															<td><input type="email" class="form-control"  name="email[]" placeholder="Email"></td>
														</tr>
														<tr>
															<td><input type="text" class="form-control"  name="firstname[]" placeholder="firstname"></td>
															<td><input type="text" class="form-control"  name="lastname[]" placeholder="lastname"></td>
															<td><input type="email" class="form-control"  name="email[]" placeholder="Email"></td>
														</tr>
														<tr>
															<td><input type="text" class="form-control"  name="firstname[]" placeholder="firstname"></td>
															<td><input type="text" class="form-control"  name="lastname[]" placeholder="lastname"></td>
															<td><input type="email" class="form-control"  name="email[]" placeholder="Email"></td>
														</tr>
														<tr>
															<td><input type="text" class="form-control"  name="firstname[]" placeholder="firstname"></td>
															<td><input type="text" class="form-control"  name="lastname[]" placeholder="lastname"></td>
															<td><input type="email" class="form-control"  name="email[]" placeholder="Email"></td>
														</tr>

													</table>
														<!--<div class="form-group">
															<label for="inputName" class="col-sm-2 control-label">Email 1</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="inputName1" name="inputName[]" placeholder="Email 1">
															</div>
														</div>

														<div class="form-group">
															<label for="inputName" class="col-sm-2 control-label">Email 2</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="inputName2" name="inputName[]" placeholder="Email 2">
															</div>
														</div>
														<div class="form-group">
															<label for="inputName" class="col-sm-2 control-label">Email 3</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="inputName3" name="inputName[]" placeholder="Email 3">
															</div>
														</div>
														<div class="form-group">
															<label for="inputName" class="col-sm-2 control-label">Email 4</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="inputName4" name="inputName[]" placeholder="Email 4">
															</div>
														</div>
														<div class="form-group">
															<label for="inputName" class="col-sm-2 control-label">Email 5</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="inputName5" name="inputName[]" placeholder="Email 5">
															</div>
														</div>-->

														<div class="form-group">
															<div class="col-sm-offset-10 col-sm-10">
																<button type="button" id="button_add" class="btn btn-danger">Next</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab2">
												<br/><br/>
												<div class="row mt40">
													<div class="col-sm-12">

														<div class="form-group">
															<textarea id="compose-textarea" class="form-control" style="height: 300px" name="message">
										                    	<?php 

										                    	if($tellus){ echo $message; } else { echo ""; } ?>
										                    </textarea>
										                </div>
										                <div class="form-group">
															<div class="col-sm-offset-10 col-sm-10">
																<button type="submit" id="button_message" class="btn btn-danger">Submit</button>
															</div>
														</div>
									                </div>
									            </div>
												
											</div>
											<!-- <div class="tab-pane" id="tab3">
												<br/><br/>
												<div class="row mt40">
													<div class="col-sm-12">
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																<button type="button" onClick="tellusFunc()" class="btn btn-danger">Submit</button>
															</div>
														</div>
													</div>
												</div>
											</div> -->
										</div>
									</div>
								</form>
							</div>
						</div>
		            </div>
              	</div>
             </section>
		</div>
		<div class="control-sidebar-bg"></div>
	</div>
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
	function tellusFunc() {
		if ($('#tellus-forms').valid()) {
			if($('#firstname1').val()!=='' && $('#lastname1').val()!=='' && $('#email1').val()!=='')
			// if($('#inputName1').val()!=='')
			{
				$('#tellus-forms').submit();
			}
		}
	}
</script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
<script type="text/javascript">

(function($) {

    $(document).ready(function() {

    	// $('input[type=email]').attr("pattern","[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$");

    	// $("input['type=email']").attr("pattern","[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$");
    	$.validator.methods.smartCaptcha = function(value, element, param) {
            return value == param;
        };


        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
        });

        $("#tellus-forms").validate({

            // States
            

            errorClass: "text-danger",
            validClass: "text-success",
            errorElement: "em",

            // Rules

            rules: {
                firstname1: {
                    required: true,
                    alpha: true,
                    minlength: 3

                },
                lastname1: {
                    required: true,
                    alpha: true
                },
                email1: {
                	required: true,
                    email: true
                }
                
            },

            // error message
            messages: {
            	firstname1: {
                    required: 'Please enter firstname',
                    alpha: 'Enter only characters',
                    minlength: 'please enter minimum 3 characters'

                },
                lastname1: {
                    required: 'Please enter firstname',
                    alpha: 'Enter only characters'
                },
                email1: {
                	required: 'Please enter Email',
                    email: 'Enter a VALID email address'
                }

            },


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

</script>


<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });

	$(document).delegate('#button_add', 'click', function() {
		if ($('#tellus-forms').valid()) {
			if($('#firstname1').val()==='') {
				$('#firstname1').css('border', '1px solid red');
			} else {
				$('#firstname1').css('border', '1px solid #ccc');
			}
			if($('#lastname1').val()==='') {
				$('#lastname1').css('border', '1px solid red');
			} else {
				$('#lastname1').css('border', '1px solid #ccc');
			}
			if($('#email1').val()!=='')
			{
				$('#message-content').html('<a data-toggle="tab" href="#tab2"> Message</a>');
				$('#email1').css('border', '1px solid #ccc');
				$('a[href=\'#tab2\']').trigger('click');
			} else {
				$('#email1').css('border', '1px solid red');
			}
			
		}
  			
	});

</script>

</body>
</html>
