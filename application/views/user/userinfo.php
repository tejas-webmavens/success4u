<?php
$this->load->model('dashboard_model');
?>
<div class="row">
	<div class="col-lg-12">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="row">
				<div class="small-box bg-aqua">
					<div class="inner">
						<div class="icon"> <i class="fa fa-bank"></i> </div>
						<?php $bal =  $this->common_model->Getcusomerbalance($this->session->MemberID);?>
						<h3><?php echo currency()." ".number_format($bal,2);?></h3>
						<p><?php echo  ucwords($this->lang->line('u_balance'));?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="row">
				<div class="small-box bg-aqua">
					<div class="inner">
						<div class="icon"> <i class="fa fa-ticket"></i> </div>
						<h3><?php echo $this->common_model->GetNewMembers($this->session->MemberID);?></h3>
						<p><?php echo  ucwords($this->lang->line('u_newsignup'));?></p>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="row">
				<div class="small-box bg-aqua">
					<div class="inner">
						<div class="icon"> <i class="fa fa-group"></i> </div>
						<?php $new_order = $this->common_model->GetNewOrdersTotal($this->session->MemberID);
						// echo "order".$new_order->OrderTotal;
						?>
						<h3><?php echo currency()." ".number_format($new_order,2);?></h3>
						<p><?php echo  ucwords($this->lang->line('u_neworders'));?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="row">
				<div class="small-box bg-aqua">
					<div class="inner">
						<div class="icon"> <i class="fa fa-plane"></i> </div>
						<?php $comm = $this->common_model->Getcusomercommission($this->session->MemberID);?>
						<h3><?php echo currency()." ".number_format($comm,2);?></h3>
						<p><?php echo  ucwords($this->lang->line('u_commissions'));?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>