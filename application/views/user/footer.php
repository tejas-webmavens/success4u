<div class="footer clearfix">
	<div class="col-lg-12">
		<div class="row">
			<div class="bskt">
				<!--
				<div class="col-lg-3">
					<h2>quick <span>links</span></h2>
					<ul>
						<li><a href="#">Latest News</a></li>
						<li><a href="#">Faq's</a></li>
						<li><a href="#">Testimonial</a></li>
						<li><a href="#">Contact us</a></li>
						<li><a href="#">Privacy & Policy</a></li>
						<li><a href="#">Terms & Condition</a></li>
					</ul>
				</div>
				-->
				<div class="col-lg-3">
					<h2>quick <span>links</span></h2>
					<ul>
						<?php FooterCMSNav('footer');?>
					</ul>
				</div>
				<?php
					$con="KeyValue='bottomcontent'";
				///$con="'bottomcontent'";
					$getcontent=$this->common_model->GetRow($con,"arm_setting");
					?>
				
					<div class="col-lg-6">
					<h2>Aboutus<span></span></h2>
					
					<p><?php
				///	var_dump($getcontent);
					// substr(string, start)
					 echo substr($getcontent->ContentValue,0,151);?>
					 </p>
					 <a href="<?php echo base_url()."user/cms/bottomcontent";?>">Read More</a>
					 </div>
					
					
					<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
					<!-- <a href="#">Readmore</a> -->
					
				

		
				
			
				<?php 
				 $logodet = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='footercontent'",'arm_setting');
				 $sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting');
				 $address = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='address'",'arm_setting');
				$checkmatrix=$this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($checkmatrix->Id==9)
				{
					
					 $interest_data=$this->common_model->DepositData();
	                     // echo $this->db->last_query();
	                    // print_r($interest_data);
	            
	        		  if($interest_data!=0)
	        		  {
	        		 	    $this->load->library('cron');    
	        		        $obj = new Cron();
	        		        $obj->Jobs($interest_data);
			
	        		  }
				}
			
				?>
				<div class="col-lg-3 text-right"><br />
					<br />
					<img height="69px" src="<?php echo base_url().$sitelogo->ContentValue;?>" /><br />
					<br />
					<p><strong><?php echo  $address->ContentValue;?></strong></p>
					<!-- <p><strong><?php echo  $logodet->ContentValue;?></strong></p> -->
				</div>
			</div>
		</div>
	</div> <div><p class="col-lg-3 pull-right"><strong><?php echo  $logodet->ContentValue;?></strong></p></div>
</div>

			