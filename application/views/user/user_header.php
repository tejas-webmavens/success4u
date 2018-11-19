<header class="main-header"> 
<?php 
				$sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting'); 
				if($sitelogo) {
					$logo =$sitelogo->ContentValue;
					}
					else
					{
						$logo ='assets/user/img/logo.png';
					}
			?>
	<a href="<?php echo base_url();?>" class="logo"> 
		<span class="logo-mini"><img style="height:45px;" src="<?php echo base_url().$logo;?>" class="img-responsive"></span> 
		<span class="logo-lg">
			<!-- <img src="<?php echo base_url();?>assets/user/img/dashboard.png" class="img-responsive"> -->
			
					<img  style="height:45px;" src="<?php echo base_url().$logo;?>" class="img-responsive"/>
			
		</span> 
	</a>
	<nav class="navbar navbar-static-top" role="navigation"> 
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> 
			<span class="sr-only">Toggle navigation</span> 
		</a>
		<div class="dshnme"><span>Dash</span>board</div>
		<div class="navbar-custom-menu">
		
			<ul class="nav navbar-nav">
				<?php 
					$condition= "IsDelete = '0'"; 
					$language_list = $this->common_model->GetResults($condition,'arm_language');
                                                 
					if($language_list) { 
						foreach ($language_list as $row) { 
				?>
						
					<li>
						<a href="<?php echo base_url(); ?>lang/<?php echo strtolower($row->LanguageName); ?>" class="dropdown-toggle" data-toggle="dropdown-no"> <?php echo ucfirst($row->LanguageName); ?> </a>
					</li>
				<?php	
						} 
					} 
				?>
				<li class="dropdown messages-menu"> 
					<a href="<?php echo  base_url();?>user" class="dropdown-toggle" data-toggle="dropdown-no"> <i class="fa fa-user"></i> </a>
				</li>
				<li class="dropdown notifications-menu"> 
					<a href="<?php echo  base_url();?>user/profile/edit" class="dropdown-toggle" data-toggle="dropdown-no"> <i class="fa fa-edit"></i> </a> 
				</li>
				<li class="dropdown tasks-menu"> 
					<a href="<?php echo  base_url();?>login/logout" class="dropdown-toggle" data-toggle="dropdown-no"> <i class="fa fa-power-off"></i> </a> 
				</li>

				<li class="dropdown user user-menu"> 
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
					<?php $mmdet = $this->db->query("SELECT * FROM arm_members WHERE MemberId='".$this->session->MemberID."'");

							if(isset($mmdet->row()->ProfileImage)) {
								$profile_image = base_url().$mmdet->row()->ProfileImage;	
							} else { 
								$profile_image = base_url().'assets/user/img/usr.png';
							}
						?>
						<img src="<?php echo $profile_image; ?>" class="user-image" alt="User Image"> 
					</a>
					<ul class="dropdown-menu">
						<li class="user-header"> 
						
							<img src="<?php echo $profile_image; ?>" class="img-circle" alt="User Image">
								<p><?php echo $mmdet->row()->FirstName." ".$mmdet->row()->LastName;?>  <small> Member Since - <?php echo date("d M Y",strtotime($mmdet->row()->DateAdded));?></small> </p>
						</li>
						<li class="user-footer">
							<div class="pull-left"> <a href="<?php echo  base_url();?>user/profile/edit" class="btn btn-default btn-flat"><?php echo ucwords($this->lang->line('m_profile'));?></a> </div>
							<div class="pull-right"> <a href="<?php echo  base_url();?>login/logout" class="btn btn-default btn-flat"><?php echo ucwords($this->lang->line('m_logout'));?></a> </div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>