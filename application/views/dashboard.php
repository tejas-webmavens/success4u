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
<!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->
</head>


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

				<div class="row">
				<?php /* ?>
					<div class="col-md-12">
			            <div class="col-md-3 col-sm-6 col-xs-12">
			              <div class="info-box bg-aqua" style="background:#00c0ef">
			                <span class="info-box-icon"><i class="fa fa-group"></i></span>
			                <div class="info-box-content">
			                  <span class="info-box-text">New Sign up's</span>
			                  <span class="info-box-number"><?php echo $this->common_model->GetNewMembers($this->session->MemberID);?></span>
			                  <div class="progress">
			                    <div class="progress-bar" style="width: 70%"></div>
			                  </div>
			                  <span class="progress-description">
			                    Today
			                  </span>
			                </div><!-- /.info-box-content -->
			              </div><!-- /.info-box -->
			            </div>
			            <div class="col-md-3 col-sm-6 col-xs-12">
			              <div class="info-box bg-green">
			                <span class="info-box-icon"><i class="fa fa-money"></i></span>
			                <div class="info-box-content">
			                  <span class="info-box-text">Balance</span>
			                  <span class="info-box-number"><?php echo "$ ". $this->common_model->Getcusomerbalance($this->session->MemberID);?></span>
			                  <div class="progress">
			                    <div class="progress-bar" style="width: 70%"></div>
			                  </div>
			                  <span class="progress-description">
			                    Balance info
			                  </span>
			                </div><!-- /.info-box-content -->
			              </div><!-- /.info-box -->
			            </div>
			            <div class="col-md-3 col-sm-6 col-xs-12">
			              <div class="info-box bg-yellow">
			                <span class="info-box-icon"><i class="fa fa-plane"></i></span>
			                <div class="info-box-content">
			                  <span class="info-box-text">New Orders</span>
			                  <span class="info-box-number"><?php echo $this->dashboard_model->GetNewOrdersTotal($this->session->MemberID);?></span>
			                  <div class="progress">
			                    <div class="progress-bar" style="width: 70%"></div>
			                  </div>
			                  <span class="progress-description">
			                    Today
			                  </span>
			                </div><!-- /.info-box-content -->
			              </div><!-- /.info-box -->
			            </div>
			            <div class="col-md-3 col-sm-6 col-xs-12">
			              <div class="info-box bg-red">
			                <span class="info-box-icon"><i class="fa fa-money"></i></span>
			                <div class="info-box-content">
			                  <span class="info-box-text">New Commissions</span>
			                  <span class="info-box-number"><?php echo "$ ". $this->common_model->Getcusomerbalance($this->session->MemberID);?></span>
			                  <div class="progress">
			                    <div class="progress-bar" style="width: 70%"></div>
			                  </div>
			                  <span class="progress-description">
			                    Today
			                  </span>
			                </div>
			              </div>

			            </div>
		            </div>
		            <?*/ ?>
		        </div>

		        
		        <div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Credit and Debit</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
							<!-- <div class="json_report" style="display:none;"></div> -->
							<input type="hidden" class="json_report" value="">

								<div class="row">
									<div class="col-md-12">
										<div class="nav-tabs-custom">
											<div class="tab-content no-padding">
												<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
											</div>
										</div>
									</div>
									<!-- <div class="col-md-4">
										 <div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
											<div class="progress sm">
												<div class="progress-bar progress-bar-red" style="width: 0%"></div>
											</div>
										</div>
										<div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
											<div class="progress sm">
												<div class="progress-bar progress-bar-red" style="width: 80%"></div>
											</div>
										</div>
										<div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
											<div class="progress sm">
												<div class="progress-bar progress-bar-red" style="width: 80%"></div>
											</div>
										</div> 
									</div> -->
								</div>
							</div>
							<!-- <div class="box-footer">
								<div class="row">
									<div class="col-sm-3 col-xs-6">
										<div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
											<h5 class="description-header">$35,210.43</h5>
											<span class="description-text">TOTAL REVENUE</span> 
										</div>
									</div>
									<div class="col-sm-3 col-xs-6">
										<div class="description-block border-right"> <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
											<h5 class="description-header">$10,390.90</h5>
											<span class="description-text">TOTAL COST</span> 
										</div>
									</div>
									<div class="col-sm-3 col-xs-6">
										<div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
											<h5 class="description-header">$24,813.53</h5>
											<span class="description-text">TOTAL PROFIT</span> 
										</div>
									</div>
									<div class="col-sm-3 col-xs-6">
										<div class="description-block"> <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
											<h5 class="description-header">1200</h5>
											<span class="description-text">GOAL COMPLETIONS</span> 
										</div>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">Due Billing</h3>
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
													<th>No #</th>
													<th>Type</th>
													<th>Amount</th>
													<th>Status</th>
													<th>Action</th>
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
													<td class="text-center" colspan="5">you have no subscriptions</td>
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
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">My Website URL</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<?php 
										// print_r($leadpage);
										?>
										<table class="table">
											<thead>
												<tr>
													<!-- <th>Website</th> -->
													<th>Website URL</th>
													<!-- <th>Today's Visitor</th> -->
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
											<?php
											
												// if($leadpage) {
												// 	foreach ($leadpage as $lead) {
											// $member->PackageId
											// $customer = $this->common_model->GetCustomer($ticket->SenderId);
											?>	
													<tr>
														<!-- <td><?php echo ($member->PackageId) ? $member->PackageId : 'Standard';?></td> -->
														<td><a target="_blank" href="<?php echo base_url().'user/register/process/'.$member->ReferralName;?>" ><?php echo base_url().'user/register/process/'.$member->ReferralName;?></a></td>
														<!-- <td><a target="_blank" href="<?php echo base_url().''.$lead->PageUrl.'?ref='.$member->ReferralName;?>">click</a></td> -->
														<!-- <td class="text-center">0</td> -->
														<td><?php echo $member->MemberStatus;?></td>
													</tr>
											<?php 
														
												// 	}
												// }
											?>
													
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">My Profile</h3>
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
				                        	<img class="img-circle" alt="User Image" src="<?php echo $profile_image;?>">
				                          	<a href="#" class="users-list-name"><?php echo $profiles->UserName;?></a>
				                          	<span class="users-list-date"><a href="<?php echo  base_url().'user/logout';?>">Not you? Click here!</a></span>
				                        </li>
				                        <li>
				                        	<?php echo $profiles->Email;?><br>
											Distributor Since: <?php echo date('M d, Y',strtotime($profiles->DateAdded));?><br>
	                                        IP: <?php echo $profiles->Ip;?>
	                                        <div id="plex-notification-leftmenustatscount"><span>2 Sales</span><span>34 Recruits</span><span>170 MyCircle</span></div>
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
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Latest Orders</h3>
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
														<th>Order No</th>
														<th>Amount</th>
														<th>Status</th>
														<th>DATE</th>
													</tr>
												</thead>
												<tbody>
												<?php
												
													if($latestorders) {

														foreach ($latestorders as $order) {
												?>	
														<tr>
															<td class="text-left"><?php echo $order->OrderNumber;?></td>
					                                        <td class="text-right"><?php echo "$".$order->OrderTotal;?></td>
					                                        <td class="text-center"><?php echo ucwords($order->Status);?></td>
					                                        <td class="text-center"><?php echo date('Y-m-d',strtotime($order->DateAdded));?></td>
														</tr>
												<?php 
														
														}
													} else { 
												?>
													<tr>
														<td colspan="4" class="text-center"><?php echo "No Orders";?></td>
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
										<h3 class="box-title">MyCircle</h3>
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
															if($downs->ProfileImage)
															{
																$spilllover_image = base_url().$downs->ProfileImage;
															} else {
																$spilllover_image = base_url().'assets/user/img/usr.png';
															}

															$current = strtotime(date("Y-m-d"));
 															$date    = strtotime($downs->DateAdded);
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
																$day = date('y-m-d', strtotime($date));
															}
												?>	
															<li>
									                        	<img class="img-circle" alt="User Image" src="<?php echo $spilllover_image;?>">
									                        	<a href="#" class="users-list-name" data-toggle="tooltip" title="<?php echo $downs->UserName;?>">Hover over me</a>
									                          	<!-- <a href="#" class="users-list-name"><?php echo $downs->UserName;?></a> -->
									                          	<span class="users-list-date"><?php echo $day;?></span>
									                        </li>
												<?php 
													}
													
												} else {
												?>
									                        <li>
									                        	<img alt="No user" src="">
									                          	<a href="#" class="users-list-name">No one in circle</a>
									                          	<span class="users-list-date">Today</span>
									                        </li>
							                    <?php } ?> 
		                      					</ul>
		                      				</div>
										</div>
									</div>
									<div class="box-footer">
										<div class="row">
											<div class="col-lg-12 text-center">
											 <a class="label label-warning" href="<?php echo base_url();?>user/mydownline">View All Users</a>
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
								<h3 class="box-title">Purchased Items</h3>
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
											<th>Image</th>
											<th>Product Name</th>
											<th>Purchased Date</th>
											<th>Status</th>
											<th>Action</th>
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
														$img = '';
													}
												}
									?>	
											<tr>
												<td class="text-center"><img style="width: 50px;" src="<?php echo $img; ?>"></td>
		                                        <td class="text-left"><?php echo $purchase->ProductName;?></td>
		                                        <td class="text-center"><?php echo date('Y-m-d',strtotime($purchase->DateAdded));?></td>
		                                        <td class="text-center"><?php echo ucwords($purchase->Status);?></td>
		                                        <td class="text-center"><a href="<?php echo base_url().'user/shop/addcart/'.$purchase->ProductId;?>" class="btn btn-primary">add to cart</a></td>
											</tr>
									<?php 
												
											}
										} else { 
									?>
											<tr>
												<td colspan="4" class="text-center"><?php echo "No Item Purchased";?></td>
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
										<h3 class="box-title">News</h3>
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
										?>
												<li class="item item1">
													<div class="product-img"> <span>23445</span> </div>
													<div class="product-info"> <a href="#" class="product-title product-title1">Finance Report Submission Gathering </a> </div>
												</li>

										<?php
												}
											} else {
										?>
												<li class="item item1">
													<div class="product-info"> <a href="#" class="product-title product-title1">No News </a> </div>
												</li>
										<?php 
											} 
										?>
											
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Page Views / Account Info</h3>
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
												<p class="text-center"> THERE ARE <?php echo $total_spillover;?> PEOPLES IN MY TEAMS </p>
												<div class="inivte text-center"> <i class="fa fa-pagelines"></i>
													<a href="<?php echo base_url();?>user/tellus"><input value="invite" type="button"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
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
																<?php echo $ticket->Description; ?></p>
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
							<div class="col-lg-6">
								<?php
									$sponser = $this->common_model->GetCustomer($member->DirectId);
								?>

								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">Your Sponsors</h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="smbgbx">
											<div class="text-center"> <a href="" class="redbx">Your Sponsor</a>
												<h2><?php echo $sponser->FirstName.' '.$sponser->LastName;?></h2>
												<p>Below are your sponsor's contact details. If you have <br>
														trouble contacting your sponsor, feel free to Contact Support.</p>
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
				</section>
				<div class="control-sidebar-bg"></div>
		</div>
</div>
<script src="<?php echo  base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jquery-ui.min.js"></script>
<script>
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
<script src="<?php echo  base_url();?>assets/user/js/js/pages/dashboard.js"></script>
<!--    <script src="js/js/demo.js"></script>-->
<script src="<?php echo  base_url();?>assets/user/js/justgage.js"></script>

<script type="text/javascript">


//function myData() {
// $income_report
<?php $income_data = str_replace('"', '', json_encode($income_report)); ?>
	var area = new Morris.Area({
	    element: 'revenue-chart',
	    resize: true,
	    data: <?php echo $income_data;?>,
	    xkey: 'y',
	    ykeys: ['item1', 'item2'],
	    labels: ['Item 1', 'Item 2'],
	    lineColors: ['#a0d0e0', '#3c8dbc'],
	    hideHover: 'auto'
	});
// $( window ).load(function() { 
// 	$.ajax({
//         url: '<?php echo base_url();?>user/dashboard/reports',
//         dataType: 'text',
//         success: function(jsons) {
//         	if(jsons){
//         		var datas = jsons;
//         		// $('.json_report').val(jsons);
//         		alert(datas);
//         		var area = new Morris.Area({
// 				    element: 'revenue-chart',
// 				    resize: true,
// 				    data: datas,
// 				    xkey: 'y',
// 				    ykeys: ['item1', 'item2'],
// 				    labels: ['Item 1', 'Item 2'],
// 				    lineColors: ['#a0d0e0', '#3c8dbc'],
// 				    hideHover: 'auto'
// 				});
//         		// var array = $('.info-box-number').html();
//         	}
        		
//         }
//     })
//  })  

//}

// var dsdsd = myData();

	// var array = $('.info-box-number').html();
	// console.log(dsdsd);
 //    var area = new Morris.Area({
	//     element: 'revenue-chart',
	//     resize: true,
	//     // data: array,
	//     // data: $('.json_report').val(),
	//       // {y: '2011 Q2', item1: 4321, item2: 2294},
	//       // {y: '2011 Q3', item1: 3412, item2: 1969},
	//       // {y: '2011 Q4', item1: 3767, item2: 3597},
	//       // {y: '2012 Q1', item1: 6810, item2: 1914},
	//       // {y: '2012 Q2', item1: 5670, item2: 4293},
	//       // {y: '2012 Q3', item1: 4820, item2: 3795},
	//       // {y: '2012 Q4', item1: 15073, item2: 5967},
	//       // {y: '2013 Q1', item1: 10687, item2: 4460},
	//       // {y: '2013 Q2', item1: 8432, item2: 5713}
	//     //],
	//     xkey: 'y',
	//     ykeys: ['item1', 'item2'],
	//     labels: ['Item 1', 'Item 2'],
	//     lineColors: ['#a0d0e0', '#3c8dbc'],
	//     hideHover: 'auto'
	// });
	// setInterval(function() {
 //    	area.setData($('.json_report').val());
	// }, 10000);
	//DONUT CHART
	

  //       var donut = new Morris.Donut({
  //         element: 'revenue-chart',
  //         resize: true,
  //         colors: ["#3c8dbc", "#f56954", "#00a65a"],
  //         // data: [document.write(content)],
  //         // data: [
  //         //   {label: "Download Sales", value: 12},
  //         //   {label: "In-Store Sales", value: 30}
            
  //         // ],
  //         hideHover: 'auto'
  //       });
  //       setInterval(function() {
  //   		donut.setData(myData());
		// }, 10000);
</script>
<script>
$(function () {

	$('.box ul.nav a').on('shown.bs.tab', function () {
	    area.redraw();
  	});
})

    var g1;

    document.addEventListener("DOMContentLoaded", function(event) {
        g1 = new JustGage({
            id: "g1",
            value: 20,
            /*title: "Lone Ranger",*/
            label: "miles traveled"
        });

       
 var g5 = new JustGage({
        id: "g5",
        value: 80,
        
        /*title: "Animation Type",*/
        label: "",
        startAnimationTime: 2000,
        startAnimationType: ">",
        refreshAnimationTime: 1000,
        refreshAnimationType: "bounce"
      });
        
    });
    </script>

    
</body>
</html>
