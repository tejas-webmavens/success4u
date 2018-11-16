<aside class="main-sidebar">
				<section class="sidebar">
				<?php $mmdet = $this->db->query("SELECT ProfileImage,UserName,PackageId FROM arm_members WHERE MemberId='".$this->session->MemberID."'");
				// print_r($mmdet->row());
				$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
				if($mlsetting->Id==4) {
					$table = "arm_pv";
				}
				elseif($mlsetting->Id==9) {
					$table = "arm_hyip";
				} 

				elseif($mlsetting->Id==5) {
					$table = "arm_boardplan";
				} else {
					$table='arm_package';
				}

				$condition="PackageId='".$mmdet->row()->PackageId."'";
				$packagedetails = $this->common_model->GetRow($condition,$table);
				if($packagedetails) {
					$package_name = $packagedetails->PackageName;
				} else {
					$package_name = "";
				}
				
				?>
						<div class="user-panel">
							<div class="image"> 
								<?php 
									if(isset($mmdet->row()->ProfileImage))
										$image = base_url().$mmdet->row()->ProfileImage;
                                    else 
                                        $image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';
								?>
								<img src="<?php echo $image;?>" width="150" height="150" class="img-circle img-responsive"> 
							</div>
							<?if($mlsetting->Id!=5)
							{
								?>
							<div class="text-center info">
							
								<p><?php echo $this->session->userdata('full_name')."<br>".$mmdet->row()->UserName."<br/>".$package_name;?></p>
							</div>
							<?}
							else
							{
								$userid=$this->session->MemberID;
								$con="MemberId='".$userid."' order by BoardMemberId Desc limit 0,1";
								$checkuserpackage=$this->common_model->GetRow($con,"arm_boardmatrix");
								$stageid=$checkuserpackage->BoardId;
								$conn="PackageId='".$stageid."'";
								$checkpackagename=$this->common_model->GetRow($conn,"arm_boardplan");
								$packname=$checkpackagename->PackageName;?>
									<div class="text-center info">
							
								<p><?php echo $this->session->userdata('full_name')."<br>".$mmdet->row()->UserName."<br/>".$packname;?></p>
							</div>

							<?}
							?>
						</div>
						<ul class="sidebar-menu">
								<li> <a href="<?php echo base_url();?>user/dashboard"> <i class="fa fa-th fa-users"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_myaccount'));?></span> </a> </li>
								<li> <a href="<?php echo base_url();?>user/fund"> <i class="fa fa-th fa-money"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_myfundtransfer'));?></span> </a> </li>
										<?php

										if($mlsetting->Id!=9)
										{?>
								 <li> <a href="<?php echo base_url();?>user/upgrade"> <i class="fa fa-th fa-fire"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_memberupgrade'));?></span> </a> </li>
								<?		$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								if($mlsetting->MTMPayStatus=='1'){?>
								<li> <a href="<?php echo base_url();?>user/mtmpayment"> <i class="fa fa-th fa-list"></i> <br>
									<span><?php echo ucwords($this->lang->line('m_memberpayments'));?></span> </a> </li>
								<?php } ?>
										<?}
										?>



								<?if($mlsetting->Id==9)
								{
									$userid=$this->session->MemberID;
									?><li class="treeview"> <a href="<?php echo base_url();?>user/deposit"> <i class="fa fa-th fa-money"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_mydeposit'));?></span> </a> 
										<ul class="treeview-menu">
												<li><a href="<?php echo base_url();?>user/deposit"> <?php echo ucwords($this->lang->line('m_deposit'));?></a></li>
												
												<li><a href="<?php echo base_url();?>user/deposit/viewdeposit"> <?php echo ucwords($this->lang->line('m_mydeposit'));?></a></li>
												
												
										</ul>

										</li>
								<?}?>
								<li> <a href="<?php echo base_url();?>user/mywithdraw"> <i class="fa fa-th fa-money"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_mywithdraw'));?></span> </a> </li>
								<li> <a href="<?php echo base_url();?>user/mypage"> <i class="fa fa-th fa-link"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_myreferralpage'));?></span> </a> </li>
								<li> <a href="<?php echo base_url();?>user/mybiography"> <i class="fa fa-th fa-link"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_mybiography'));?></span> </a> </li>

										<?php
										if($mlsetting->Id!=9)
										{?>
								<li class="treeview"> <a href="#"> <i class="fa fa-share fa-ticket"></i> <br>
								<span><?php echo ucwords($this->lang->line('m_epin'));?></span> </a>
								<ul class="treeview-menu">
										<li><a href="<?php echo base_url();?>user/epin/"> <?php echo ucwords($this->lang->line('m_epinlist'));?></a></li>
										<li> <a href="#"><?php echo ucwords($this->lang->line('m_buyepins'));?><i class="fa fa-angle-left pull-right"></i></a>
												<ul class="treeview-menu">
														<li><a href="<?php echo base_url();?>user/epin/buy"> <?php echo ucwords($this->lang->line('m_online'));?></a></li>
														<li> <a href="<?php echo base_url();?>user/epin/request"> <?php echo ucwords($this->lang->line('m_offline'));?></a></li>
																
														
												</ul>
										</li>
										<li><a href="<?php echo base_url();?>user/epin/requestlist"> <?php echo ucwords($this->lang->line('m_epinrequestlist'));?> </a></li>
								</ul>
								</li>


										<?}

										?>

								<li class="treeview"> <a href="#"> <i class="fa fa-edit fa-tree"></i> <br>
										<span> <?php echo ucwords($this->lang->line('m_mygenealogy'));?></span> </a>
										<ul class="treeview-menu">
												<li><a href="<?php echo base_url();?>user/genealogy"> <?php echo ucwords($this->lang->line('m_viewgenealogy'));?></a></li>
												
												<li><a href="<?php echo base_url();?>user/mydownline"> <?php echo ucwords($this->lang->line('m_mydownlines'));?></a></li>
												<li><a href="<?php echo base_url();?>user/myupline"> <?php echo ucwords($this->lang->line('m_myuplines'));?> </a></li>
												<?php $mlmset =$this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
													if($mlmset->Id=='6' || $mlmset->Id=='7' ){?>
												<li><a href="<?php echo base_url();?>user/passup"> <?php echo ucwords($this->lang->line('m_mypassups'));?> </a></li>
												<?php  }?>
										</ul>
								</li>

								<li> <a href="<?php echo base_url();?>user/transaction"> <i class="fa fa-th fa-money"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_mytransactions'));?></span> </a> </li>
								<?php
								if($mlsetting->RankStatus==1)
								{?>
								<li> <a href="<?php echo base_url();?>user/rank"> <i class="fa fa-th fa-info"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_myranks'));?></span> </a> </li>
								<?}

								?>
								
								
								<li class="treeview"> <a href="#"> <i class="fa fa-edit fa-bullhorn"></i> <br>
										<span> <?php echo ucwords($this->lang->line('m_marketingtools'));?> </span> </a>
										<ul class="treeview-menu">	
										<li> <a href="<?php echo base_url();?>user/marketingtool"> <?php echo ucwords($this->lang->line('m_marketingtext'));?></a> </li>	
										<li> <a href="<?php echo base_url();?>user/marketingtool/image"> <?php echo ucwords($this->lang->line('m_marketingimage'));?></a> </li>	
										<li> <a href="<?php echo base_url();?>user/marketingtool/video">	<?php echo ucwords($this->lang->line('m_marketingvideo'));?> </a> </li>	
										<li> <a href="<?php echo base_url();?>user/marketingtool/document">	<?php echo ucwords($this->lang->line('m_marketingdocument'));?> </a> </li>	
										</ul>
								</li>

								<li class="treeview"> <a href="<?php echo base_url();?>user/shop"> <i class="fa fa-shopping-cart"></i><br>
										<span><?php echo ucwords($this->lang->line('m_shop'));?></span> </a>
										
								<li class="treeview"> <a href="<?php echo base_url();?>user/orders"> <i class="fa fa-tree"></i> <br>
									<span> <?php echo ucwords($this->lang->line('m_myorders'));?></span> </a>
								</li>
								<li class="treeview"> <a href="<?php echo base_url();?>user/subscriber"> <i class="fa fa-edit fa-tree"></i> <br>
									<span> <?php echo ucwords($this->lang->line('m_mysubscriber'));?> </span> </a>
								</li>
								<li> <a href="<?php echo base_url();?>user/ticket"> <i class="fa fa-th fa-1x"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_tickets'));?></span> </a> </li>
								<li class="treeview"> <a href="<?php echo base_url();?>user/message"> <i class="fa fa-pie-chart fa-1x"></i><br>
										<span><?php echo ucwords($this->lang->line('m_message'));?></span> </a>
										<!-- <ul class="treeview-menu">
												<li><a href="#"> ChartJS</a></li>
												<li><a href="#"> Morris</a></li>
												<li><a href="#"> Flot</a></li>
												<li><a href="#"> Inline charts</a></li>
										</ul> -->
								</li>
								<li class="treeview"> <a href="<?php echo base_url();?>user/tellus"> <i class="fa fa-laptop fa-1x"></i><br>
										<span><?php echo ucwords($this->lang->line('m_tellafriend'));?></span> </a>
										<!-- <ul class="treeview-menu">
												<li><a href="#"> General</a></li>
												<li><a href="#"> Icons</a></li>
												<li><a href="#"> Buttons</a></li>
												<li><a href="#"> Sliders</a></li>
												<li><a href="#"> Timeline</a></li>
												<li><a href="#"> Modals</a></li>
										</ul> -->
								</li>
								<li class="treeview"> <a href="#"> <i class="fa fa-edit fa-1x"></i> <br>
									<span> <?php echo ucwords($this->lang->line('m_testimonial'));?></span> </a>
									<ul class="treeview-menu">
										<li><a href="<?php echo base_url();?>user/testimonials"> <?php echo ucwords($this->lang->line('m_mytestimonial'));?> </a></li>
										<li><a href="<?php echo base_url();?>user/testimonials/create"> <?php echo ucwords($this->lang->line('m_createtestimonial'));?> </a></li>
									</ul>
								</li>
								<li class="treeview"> <a href="#"> <i class="fa fa-edit fa-1x"></i> <br>
									<span> <?php echo ucwords($this->lang->line('m_leads'));?> </span> </a>
									<ul class="treeview-menu">
										<li><a href="<?php echo base_url();?>user/lead"> <?php echo ucwords($this->lang->line('m_leads'));?> </a></li>
										<li><a href="<?php echo base_url();?>user/lead/links"> <?php echo ucwords($this->lang->line('m_leadslink'));?> </a></li>
									</ul>
								</li>
								<li class="treeview"> <a href="#"> <i class="fa fa-share fa-users"></i> <br>
								<span><?php echo ucwords($this->lang->line('m_profile'));?></span> </a>
								<ul class="treeview-menu">
										<li><a href="<?php echo base_url();?>user/profile/edit"> <?php echo ucwords($this->lang->line('m_updateprofile'));?></a></li>
										<li><a href="<?php echo base_url();?>user/profile/change"> <?php echo ucwords($this->lang->line('m_updatepassword'));?> </a></li>
										<li><a href="<?php echo base_url();?>user/profile/changetransaction"><?php echo ucwords($this->lang->line('m_updatetransaction'));?> <br> <?php echo ucwords($this->lang->line('m_password'));?></a></li>
								</ul>
								</li>
								
								<li> <a href="<?php echo base_url();?>login/logout"> <i class="fa fa-th fa-power-off"></i> <br>
										<span><?php echo ucwords($this->lang->line('m_logout'));?></span> </a> </li>

								
						</ul>
				</section>
		</aside>