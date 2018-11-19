<div class="box">
					<div class="box-body">
						<section class="content-header">
							<ol class="breadcrumb">
								<?php if(isset($this->uri->segments[1])){?>
								<li><a href="<?php echo  base_url().$this->uri->segments[1].'/dashboard';?>"> <i class="fa fa-dashboard"></i><?php echo ucwords('Dash board');?></a></li>
								<?php } if(isset($this->uri->segments[2])){?>
								<li><a href="<?php echo  base_url().$this->uri->segments[1].'/'.$this->uri->segments[2];?>"> <i class="fa fa-database"></i><?php echo  ucwords($this->uri->segments[2]);?></a></li>
								<?php } if(isset($this->uri->segments[3])){?>
								<li class="active"> <i class="fa fa-dedent"></i> <?php echo  ucwords($this->uri->segments[3]);?></li>
								<?php } ?>
							</ol>
						</section>
					</div>
				</div>