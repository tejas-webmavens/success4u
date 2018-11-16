<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo  base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo  base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<link rel="stylesheet" href="<?php echo  base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo  base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo  base_url();?>assets/user/js/plugins/morris/morris.css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
<style type="text/css">
	.prd-ovrvew .social a {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    color: #fc4242;
    float: left;
    font-family: "Socialico";
    font-size: 32px;
    margin: 0 5px;
    padding: 0;
    text-transform: uppercase;
}
.prd-ovrvew a {
    background: #fc4242 none repeat scroll 0 0;
    border-radius: 3px;
    color: #fff;
    float: left;
    font-size: 16px;
    margin: 0 40px 0 0;
    padding: 15px 20px;
    text-align: center;
    text-shadow: 1px 2px 1px rgba(0, 0, 0, 0.17);
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		
		<div class="content-wrapper">
			<section class="content">
				<div class="bskt">
					<?php if($this->session->flashdata('success_message')) { ?>
						<div class="alert alert-success alert-dismissable">
		                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                    <i class="icon fa fa-check"></i> 
		                    <?php echo $this->session->flashdata('success_message');?>
	                  	</div>
	                <?php } ?>
	                  	
                  	<?php if($this->session->flashdata('error_message')) { ?>
	                  	<div class="alert alert-warning alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<i class="icon fa fa-warning"></i> 
		                    <?php echo $this->session->flashdata('error_message');?>
	                  	</div>
                  	<?php } ?>
                </div>
						
				<?php $this->load->view('user/pagelink');?>
				<?php $this->load->view('user/userinfo');?>

				<div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title"><?php echo $this->lang->line('label_credit_debit');?></h3>
	                  <div class="box-tools pull-right">
	                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	                  </div>
	                </div>
	                <div class="box-body">
	                  <div class="chart">
	                    <canvas id="areaChart" style="height:450px"></canvas>
	                  </div>
	                </div>
	            </div>
		        
		        <!-- <div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Credit</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<input type="hidden" class="json_report" value="">

								<div class="row">
									<div class="col-md-12">
										<div class="nav-tabs-custom">
											<div class="tab-content no-padding">
												<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Debit</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<input type="hidden" class="json_report" value="">

								<div class="row">
									<div class="col-md-12">
										<div class="nav-tabs-custom">
											<div class="tab-content no-padding">
												<div class="chart tab-pane active" id="revenue-chart1" style="position: relative; height: 300px;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $this->lang->line('label_signup_orders');?></h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-lg-12">
										<div id="g1"></div>
										<div id="g5"></div>
										<p class="text-center"><?php echo $total_spillover;?><?php echo" ".ucwords($this->lang->line('label_team'));?> </p>
										<div class="inivte text-center"> <i class="fa fa-pagelines"></i>
											<a href="<?php echo base_url();?>user/tellus"><input value="invite" type="button"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo $this->lang->line('label_mywebsite');?></h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th><?php echo $this->lang->line('label_website_url');?></th>
													<th><?php echo $this->lang->line('label_status');?></th>
												</tr>
											</thead>
											<tbody>
											<?php
											
												if($leadpage) {
													foreach ($leadpage as $lead) {
											?>
                                      <tr>
													<td><a target="_blank" href="<?php echo base_url().$lead->PageUrl.'?ref='.$member->ReferralName;?>" ><?php echo base_url().$lead->PageUrl.'?ref='.$member->ReferralName;?></a></td>
													<td><?php echo $member->MemberStatus;?></td>
												</tr>
												<tr>
													<td>
														<div class="prd-ovrvew">
														<?php $refurl = base_url().$lead->PageUrl.'?ref='.$member->ReferralName;?>
															<div class="social share-buttons">
																<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $refurl;?>" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='<?php echo $refurl;?>'&t=' + encodeURIComponent(document.URL)); return false;" class="rtte">f</a> 
																<a href="https://plus.google.com/share?url=<?php echo $refurl;?>" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;" class="rtte">g</a>
																<a href="https://twitter.com/intent/tweet?source=<?php echo $refurl;?>&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;" class="rtte">t</a>
																<a href="http://pinterest.com/pin/create/button/?url=<?php echo $refurl;?>&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;" class="rtte">p</a>
															</div>
														</div>
													</td>
												</tr>

											<?php } } else { ?>
												<tr>
													<td><a target="_blank" href="<?php echo base_url().'user/register?ref='.$member->ReferralName;?>" ><?php echo base_url().'user/register?ref='.$member->ReferralName;?></a></td>
													<td><?php echo $member->MemberStatus;?></td>
												</tr>
												<tr>
													<td>
														<div class="prd-ovrvew">
														<?php $refurl = base_url().'user/register?ref='.$member->ReferralName;?>
															<div class="social share-buttons">
																<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $refurl;?>" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='<?php echo $refurl;?>'&t=' + encodeURIComponent(document.URL)); return false;" class="rtte">f</a> 
																<a href="https://plus.google.com/share?url=<?php echo $refurl;?>" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;" class="rtte">g</a>
																<a href="https://twitter.com/intent/tweet?source=<?php echo $refurl;?>&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;" class="rtte">t</a>
																<a href="http://pinterest.com/pin/create/button/?url=<?php echo $refurl;?>&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;" class="rtte">p</a>
															</div>
														</div>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<?php
							$sponser = $this->common_model->GetCustomer($member->DirectId);
						?>

						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $this->lang->line('label_your_sponsers');?></h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="smbgbx">
									<div class="text-center"> <a href="" class="redbx"><?php echo $this->lang->line('label_your_sponser');?></a>
										<h2><?php echo $sponser->FirstName.' '.$sponser->LastName;?></h2>
										<p><?php echo $this->lang->line('label_sponsor_details');?></p>
										<a href="" class="grenbx"><i class="fa fa-user"></i>Username</a>
										<p> <?php echo $sponser->FirstName.' '.$sponser->LastName;?></p>
										<a href="" class="blubx"><i class="fa fa-envelope-o"></i>Email id</a>
										<p><?php echo $sponser->Email;?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo $this->lang->line('label_my_profile');?></h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<?php 
										$profiles = $this->common_model->GetCustomer($this->session->MemberID);
										if($profiles->ProfileImage)
										{
											$profile_image = base_url().$profiles->ProfileImage;
										} else {
											$profile_image = base_url().'assets/user/img/usr.png';
										}
									?>
									<ul class="profile-list clearfix">
										<li>
				                        	<img style="width:95px;height:96px;" class="img-circle" alt="User Image" src="<?php echo $profile_image;?>">
				                          	<a href="#" class="users-list-name"><?php echo $profiles->UserName;?></a>
				                          	<span class="users-list-date"><a href="<?php echo  base_url().'login/logout';?>">Not you? Click here!</a></span>
				                        </li>
				                        <li>
				                        	<?php echo $profiles->Email;?><br>
											<?php echo $this->lang->line('label_distributor');?> <?php echo date('M d, Y',strtotime($profiles->DateAdded));?><br>
	                                        <?php echo $this->lang->line('label_ip');?> <?php echo $profiles->Ip;?>
				                        </li>
				                    </ul>

									<!-- <table>
										<tr>
											<td class="text-center">
												<img alt="User Image" src="<?php echo $profile_image;?>">
												<p><?php echo "Hi ".$profiles->UserName;?></p>
												<p><a href="<?php echo  base_url().'user/logout';?>">Not you? Click here!</a></p>
											</td>
											<td class="text-center">
												<div class="avatar-detail">
												  	Rank: Bronze Class<br>
													Distributor Since: Jun 13, 2010<br>
			                                        Apr 05, 2016 11:01 PM<br>
			                                        IP: 122.164.157.226
			                                        <div id="plex-notification-leftmenustatscount"><span>2 Sales</span><span>34 Recruits</span><span>170 MyCircle</span></div>
												</div>
											</td>
										</tr>
									</table> -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo $this->lang->line('label_due_billing');?></h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th><?php echo $this->lang->line('label_no');?></th>
													<th><?php echo $this->lang->line('label_type');?></th>
													<th><?php echo $this->lang->line('label_amount');?></th>
													<th><?php echo $this->lang->line('label_status');?></th>
													<th><?php echo $this->lang->line('label_action');?></th>
												</tr>
											</thead>
											<tbody>
											<?php
												if($member->MemberStatus!='Active') {
											?>	
												<tr>
													<td>1</td>
													<td><?php echo ($member->PackageId) ? $member->PackageId : 'Standard';?></td>
													<td><span class="label label-danger">$35.00</span></td>
													<td><?php echo $member->MemberStatus;?></td>
													<td><a title="" alt="" href="#" class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i> Pay</a></td>
												</tr>
											<?php 
												} else {
											?>
												<tr>
													<td class="text-center" colspan="5"><?php echo $this->lang->line('label_no_subscription');?></td>
												</tr>
											<?php 
												}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo $this->lang->line('label_latest_orders');?></h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th><?php echo $this->lang->line('label_order_no');?></th>
														<th><?php echo $this->lang->line('label_amount');?></th>
														<th><?php echo $this->lang->line('label_status');?></th>
														<th><?php echo $this->lang->line('label_date');?></th>
													</tr>
												</thead>
												<tbody>
												<?php
												
													if($latestorders) {

														foreach ($latestorders as $order) {
												?>	
														<tr>
															<td class="text-left"><?php echo $order->OrderNumber;?></td>
					                                        <td class="text-right"><?php echo currency().$order->OrderTotal;?></td>
					                                        <td class="text-center"><?php echo ucwords($order->Status);?></td>
					                                        <td class="text-center"><?php echo date('Y-m-d',strtotime($order->DateAdded));?></td>
														</tr>
												<?php 
														
														}
													} else { 
												?>
													<tr>
														<td colspan="4" class="text-center"><?php echo  $this->lang->line('label_no_orders');?></td>
													</tr>
												<?php
													}
												?>
														
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
								
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo  $this->lang->line('label_mycircle');?></h3>
										<div class="box-tools pull-right">
											<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
											<button data-widget="remove" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<ul class="users-list clearfix">
												
												<?php 
													if($spillovers) {
														foreach ($spillovers as $spillover) {
															$spillover->MemberId;
															$downs = $this->common_model->GetCustomer($spillover->MemberId);
															if($downs) {
																if($downs->ProfileImage)
																{
																	$spilllover_image = base_url().$downs->ProfileImage;
																} else {
																	$spilllover_image = base_url().'assets/user/img/usr.png';
																}


																$current = strtotime(date("Y-m-d"));
	 															$date    = $downs->DateAdded;
																$datediff = $date - $current;
	 															$difference = floor($datediff/(60*60*24));
																

																if($difference == 0) {
																    $day = 'Today';
																} elseif($difference == 1) {
																    if($difference == 0) {
																        $day = 'Yesterday';
																    } else {
																        $day = 'Tomorrow';
																    }
																} else {
																	$day = date('Y-m-d', strtotime($date));
																}

												?>	
																<li>
										                        	<img class="img-circle" alt="User Image" src="<?php echo $spilllover_image;?>">
										                        	<a href="#" class="users-list-name" data-toggle="tooltip" title="<?php echo $downs->UserName;?>"><?php echo ($downs->UserName) ? $downs->UserName : $downs->FirstName ;?></a>
										                          	<!-- <a href="#" class="users-list-name"><?php echo $downs->UserName;?></a> -->
										                          	<span class="users-list-date"><?php echo $day;?></span>
										                        </li>
												<?php 
															}
													}
													
												} else {
												?>
									                        <li>
									                        	<img alt="No user" src="">
									                          	<a href="#" class="users-list-name"><?php echo  $this->lang->line('label_no_in_circle');?></a>
									                          	<span class="users-list-date"><?php echo  $this->lang->line('label_today');?></span>
									                        </li>
							                    <?php } ?> 
		                      					</ul>
		                      				</div>
										</div>
									</div>
									<div class="box-footer">
										<div class="row">
											<div class="col-lg-12 text-center">
											 <a class="label label-warning" href="<?php echo base_url();?>user/mydownline"><?php echo  $this->lang->line('label_view_all_users');?></a>
											 </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo  $this->lang->line('label_purchased_items');?></h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th><?php echo  $this->lang->line('label_image');?></th>
											<th><?php echo  $this->lang->line('label_product_name');?></th>
											<th><?php echo  $this->lang->line('label_purchase_date');?></th>
											<th><?php echo  $this->lang->line('label_status');?></th>
											<th><?php echo  $this->lang->line('label_action');?></th>
										</tr>
									</thead>
									<tbody>
									<?php
										// print_r($purchased);
										if($purchased) {
											foreach ($purchased as $purchase) {
												$condition = "ProductId='".$purchase->ProductId."'";
												$purchase_product = $this->common_model->GetRow($condition, 'arm_product');
												$img = '';
												if($purchase_product) {
												
													if($purchase_product->Image) {
														$Images = explode(',', $purchase_product->Image);
														$img = base_url().'uploads/admin/product/'.$Images[0];
													} 
													else {
														$img = base_url().'uploads/noimage.png';
													}
												}
									?>	
											<tr>
												<td class="text-center"><img style="width: 50px;" src="<?php echo $img; ?>"></td>
		                                        <td class="text-left"><?php echo $purchase->ProductName;?></td>
		                                        <td class=""><?php echo date('Y-m-d',strtotime($purchase->DateAdded));?></td>
		                                        <td class=""><?php echo ucwords($purchase->Status);?></td>
		                                        <td class=""><a href="<?php echo base_url().'user/shop/addcart/'.$purchase->ProductId;?>" class="btn btn-primary">add to cart</a></td>
											</tr>
									<?php 
												
											}
										} else { 
									?>
											<tr>
												<td colspan="4" class="text-center"><?php echo  $this->lang->line('label_no_item_purchased');?></td>
											</tr>
									<?php
										}
									?>
											
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
				</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo  $this->lang->line('label_news');?></h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<ul class="products-list product-list-in-box">
										<?php 
											if($news) {
												foreach ($news as $new) {
													// print_r($new);
										?>
												<li class="item item1">
													<div class="product-img"> <span><?php echo date('F d, Y', strtotime($new->DateAdded));?></span> </div>
													<div class="product-info"> 
														<span style="padding-left: 30px;"><a href="#" class="product-title product-title"><?php echo substr($new->NewsDescription, 0, 255);?></a></span>
													</div>
												</li>

										<?php
												}
											} else {
										?>
												<li class="item item1">
													<div class="product-info"> <a href="#" class="product-title product-title1"><?php echo  $this->lang->line('label_no_news');?> </a> </div>
												</li>
										<?php 
											} 
										?>
											
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="box box-primary">
										<div class="box-header with-border">
											<h3 class="box-title"><?php echo  $this->lang->line('label_tickets');?></h3>
											<div class="box-tools pull-right">
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
												<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
											</div>
										</div>
										<div class="box-body">
											<div class="nav-tabs-custom">
												<div class="tab-content">
													<div class="active tab-pane" id="activity">
													<?php 
														if($tickets) {
															foreach ($tickets as $ticket) {
													?>
															<div class="post">
																<p> <i class=" fa  fa-bell-o"></i> <strong><?php echo $ticket->Subject;?> :</strong> 
																	<a href="<?php echo base_url();?>user/ticket/view/<?php echo $ticket->TicketId;?>"><?php echo substr($ticket->Description, 0, 255); ?></a></p>
															</div>

													<?php
															}
														} else {
													?>
															<div class="post">
																<p><?php echo  $this->lang->line('label_no_tickets');?></p>
															</div>
													<?php 
														} 
													?>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?//?>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title"><?php echo $this->lang->line('label_package');?></h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table">
												<thead>
												<tr>
												<th colspan="5" class="text-center"><?php echo ucwords($this->lang->line('label_selectpackage'));?></th>
												</tr>
													<tr>
														<th><?php echo ucwords($this->lang->line('label_packagename'));?></th>
														<th><?php echo ucwords($this->lang->line('label_amount'));?></th>
														<th><?php echo ucwords($this->lang->line('label_owncommission'));?></th>
														<th><?php echo ucwords($this->lang->line('label_directcommission'));?></th>
														<th><?php echo ucwords($this->lang->line('label_levelcommission'));?></th>
														<th><?php echo ucwords($this->lang->line('label_productlevelcommission'));?></th>
														
													</tr>
												</thead>
												<tbody>
												<?php
												
													if($package) {
														if(isset($package->LevelCommissions))
															$lvl=explode(",", $package->LevelCommissions);
														else
															$lvl = array('0'=>'0');
														$l=1;
														if(isset($package->ProductLevelCommissions))
															$plvl=explode(",", $package->ProductLevelCommissions);
														else
															$plvl=array('0'=>'0');
														$j=1;
													?>	
														<tr>
															<td class="text-left"><?php echo ucwords($package->PackageName);?></td>
					                                        <td class="text-left"><?php echo currency().$package->PackageFee;?></td>
															<td class="text-center"><?php echo number_format($package->OwnCommission,0);?></td>
															<td class="text-center"><?php echo $lvl[0];?></td>
															<td class="text-left"><?php foreach ($lvl as $lvl) {echo ucwords("level ".$l++." commision - ".$lvl."<br>");} ?></td>
															<td class="text-left"><?php foreach ($plvl as $plvl) {echo ucwords("level ".$j++."commision - ".$plvl."<br>");} ?></td>
					                                        
														</tr>
												<?php 
														
														
													} else { 
												?>
													<tr>
														<td colspan="4" class="text-center"><?php echo  $this->lang->line('label_no_package');?></td>
													</tr>
												<?php
													}
												?>
														
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?//?>
							
						</div>
						<!-- <div class="row">
							<div class="col-lg-12">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">Tickets</h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="nav-tabs-custom">
											<div class="tab-content">
												<div class="active tab-pane" id="activity">
												<?php 
													if($tickets) {
														foreach ($tickets as $ticket) {
												?>
														<div class="post">
															<p> <i class=" fa  fa-bell-o"></i> <strong><?php echo $ticket->Subject;?> :</strong> 
																<a href="<?php echo base_url();?>user/ticket/view/<?php echo $ticket->TicketId;?>"><?php echo substr($ticket->Description, 0, 255); ?></a></p>
														</div>

												<?php
														}
													} else {
												?>
														<div class="post">
															<p> No Tickets Available</p>
														</div>
												<?php 
													} 
												?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div> -->
						<div class="modal in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  	<div class="modal-dialog">
							    <div class="modal-content">
							    	<div class="modal-header">
							        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        	<h4 class="modal-title" id="myModalLabel"><?php echo  $this->lang->line('label_welcome');?></h4>
							      	</div>
							      	<div class="modal-body">
							          <?php echo  $this->lang->line('label_welcome_message');?>
							      	</div>
							    </div><!-- /.modal-content -->
						  	</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
				</section>
				<div class="control-sidebar-bg"></div>
		</div>
	</div>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo base_url();?>assets/user/js/jquery-ui.min.js"></script>
	<script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<script src="<?php echo  base_url();?>assets/user/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/morris/morris.min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/knob/jquery.knob.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="<?php echo  base_url();?>assets/user/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!--<script src="plugins/fastclick/fastclick.min.js"></script>-->
	<script src="<?php echo  base_url();?>assets/user/js/js/app.min.js"></script>
	<!--<script src="<?php echo  base_url();?>assets/user/js/js/pages/dashboard.js"></script>-->
	<!--    <script src="js/js/demo.js"></script>-->
	<script src="<?php echo  base_url();?>assets/user/js/justgage.js"></script>

	<script>
		$(function () {
			$('.box ul.nav a').on('shown.bs.tab', function () {
			    area.redraw();
		  	});
		})

	    var g1;
		<?php $new_signup = $this->common_model->GetNewMembers($this->session->MemberID); ?>
	    document.addEventListener("DOMContentLoaded", function(event) {
	        g1 = new JustGage({
	            id: "g1",
	            value: <?php echo $new_signup;?>,
	            label: "New Signup user"
	        });

		<?php $new_ord = ($this->common_model->GetNewOrdersTotal($this->session->MemberID)) ? $this->common_model->GetNewOrdersTotal($this->session->MemberID) : '0'?>   
	 	var g5 = new JustGage({
	        id: "g5",
	        value: <?php echo $new_ord;?>,
	        label: "New Orders",
	        startAnimationTime: 2000,
	        startAnimationType: ">",
	        refreshAnimationTime: 1000,
	        refreshAnimationType: "bounce"
	      });
	        
	    });
	    $(document).ready(function() { 
	    	<?php 
	    		$userid = $this->session->MemberID;
				$condition = "UserId='".$userid."' AND LoginDate LIKE'%".date('Y-m-d h:i')."%'";
				$user_login_win = $this->dashboard_model->DashResults($condition, 'arm_member_activity','1', '0');
				
	    		if($user_login_win) {
	    	?>
	    		$('#myModal').modal('show');		
	    	<?php
	    		}
	    	?>
		});
	</script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo  base_url();?>assets/user/js/plugins/chartjs/Chart.min.js"></script>
	<script>
      $(function () {

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              label: "Credit",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php echo $income_chart_data;?>]
            },
            {
              label: "Debit",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php echo $outcome_chart_data;?>]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

        
      });
    </script>
    
</body>
</html>
