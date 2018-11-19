<div class="footer clearfix">
	<div class="col-lg-12">
		<div class="row">
			<div class="bskt">
				<!--<div class="col-lg-3">
					<h2>quick <span>links</span></h2>
					<ul>
						<li><a href="#">Latest News</a></li>
						<li><a href="#">Faq's</a></li>
						<li><a href="#">Testimonial</a></li>
						<li><a href="#">Contact us</a></li>
					</ul>
				</div>-->
				<div class="col-lg-6">
					<h2>quick <span>links</span></h2>
					<ul>
						<?php FooterCMSNav('footer');?>
					</ul>
				</div>
				<!--<div class="col-lg-3">
					<div class="flashmessage_footer"></div>
					<h2>quick <span>links</span></h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
					<input type="text" id="subscmail" class="subscmail" />
					<input type="button" onclick="SubscribeFunc()" id="usersubc" value="send"/>
				</div>-->
			
				 <?php  $logodet = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='footercontent'",'arm_setting');
                 $sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting');
                 $address = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='address'",'arm_setting');
                   $interest_data=$this->common_model->DepositData();
                     echo $this->db->last_query();
            print_r($interest_data);
            
          if($interest_data!=0)
          {
          $this->load->library('cron');    
                $obj = new Cron();
                $obj->Jobs($interest_data);

          }

                    ?>
            
				<div class="col-lg-6 text-right"><br />
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

			
