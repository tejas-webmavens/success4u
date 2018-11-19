<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<?php
		    $site_datas = site_info();
		?>
		<title><?php echo $site_datas['sitename'];?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
		<!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
		<link rel="stylesheet" href="js/plugins/morris/morris.css">
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	</head>
	<body onLoad="window.print();"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
	    <div class="wrapper">
	      	<section class="invoice">
					
				<div class="row">
				<?php $order = $this->data['order'][0]; ?>
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Invoice</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="row">

									<section class="invoice">
										<!-- title row -->
										<div class="row">
											<div class="col-xs-12">
												<h2 class="page-header">
												<?php 
													$sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting'); 
													if($sitelogo) {
												?>
														<img style="height:49px;" src="<?php echo base_url().$sitelogo->ContentValue;?>" />
												<?php } else { ?>
														<img style="height:49px;" src="<?php echo base_url();?>assets/user/img/logo.png" />
												<?php	
													}
												?>
													<!-- <img src="<?php echo base_url();?>assets/user/img/rlogo.png" /> -->
													<small class="pull-right">Date: <?php echo date('d/m/Y',strtotime($order->DateAdded)); ?></small>
												</h2>
											</div><!-- /.col -->
										</div>
										<!-- info row -->
										<div class="row invoice-info">
											<div class="col-sm-4 invoice-col">
												From
												<address>
												<?php
												$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'",'arm_setting'); 
												$adminmailid = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='adminmailid'",'arm_setting'); 
												$siteaddress = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='address'",'arm_setting'); 

												?>
													<strong><?php echo $sitename->ContentValue;?></strong><br>
													<?php echo $siteaddress->ContentValue;?>
													
													Email: <?php echo $adminmailid->ContentValue;?>
												</address>
											</div><!-- /.col -->
											<div class="col-sm-4 invoice-col">
												To
												<address>
													<strong><?php echo $order->ShipFirstName.' '.$order->ShipLastName; ?></strong><br>
													<?php echo $order->ShipAddress1.'<br>'.$order->ShipAddress2; ?><br>
													<?php echo $order->ShipCity.' - '.$order->ShipZip; ?>
													<?php echo $order->ShipState.', '.$order->ShipCountry; ?><br>
													Phone: <?php echo $order->Phone; ?><br>
													Email: <?php echo $order->Email; ?>
												</address>
											</div><!-- /.col -->
											<div class="col-sm-4 invoice-col">
												<b>Invoice #007612</b><br>
												<br>
												<b>Order ID:</b> <?php echo $order->OrderNumber; ?><br>
												<b>Payment Due:</b> 2/22/2014<br>
												<b>Account:</b> 968-34567
											</div><!-- /.col -->
										</div><!-- /.row -->

										<!-- Table row -->
										<div class="row">
											<div class="col-xs-12 table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>Qty</th>
															<th>Product</th>
															<th>Serial #</th>
															<th>Price</th>
															<th>Subtotal</th>
														</tr>
													</thead>
													<tbody>
														<?php 
					                                    $products = $this->order_model->GetOrderProducts($order->OrderId);
					                                    
					                                    foreach ($products as $row) { ?>
					                                        <tr>
					                                            <td><b><?php echo $row->Quantity;?></b></td>
					                                            <td><?php echo $row->ProductName;?></td>
					                                            <td><?php echo $row->OrderId;?></td>
					                                            <td><?php echo currency().number_format($row->Price,2); ?></td>
					                                            <td><?php echo currency().number_format($row->Total,2); ?></td>
					                                        </tr>
					                                    <?php 
					                                        } 
					                                    ?>
														
													</tbody>
												</table>
											</div><!-- /.col -->
										</div><!-- /.row -->

										<div class="row">
											<!-- accepted payments column -->
											<div class="col-xs-6">
												<p class="lead">Payment Methods:</p>
												
												<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
													<?php echo ucwords($order->PaymentMethod);?>
												</p>
											</div><!-- /.col -->
											<div class="col-xs-6">
											
												<p class="lead"><?php echo date('d/m/Y',strtotime($order->DateAdded)); ?></p>
												<div class="table-responsive">
													<table class="table">
													<?php 
														foreach ($cart_total_res as $rows) {
															// print_r($cart_total_res);
															if($rows->code=='sub_total') { 
													?>
														<tr style="width:50%">
															<th><?php echo $rows->title;?> :</th>
															<td><?php echo currency().number_format($rows->value,2);?></td>
														</tr>
																
													<?php 
															} else { 
													?>
														<tr>
															<th><?php echo $rows->title;?> :</th>
															<td><?php echo currency().number_format($rows->value,2);?></td>
														</tr>
													<?php
															}
														}
													?>
													</table>
												</div>
											</div><!-- /.col -->
										</div><!-- /.row -->

										<!-- this row will not appear when printing -->
										<!-- <div class="row no-print">
											<div class="col-xs-12">
												<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
												<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
												<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
											</div>
										</div> -->
									</section>
								</div>
							</div>
				
						</div>
					</div>
				</div>

			</section>
			<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
		</div>
	</body>
</html>
