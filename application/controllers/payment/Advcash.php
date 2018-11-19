if(isset($_POST) && sizeof($_POST) >0) {

			$payment_data = $this->common_model->GetPayment('13');

			foreach ($payment_data as $row) {
				$form_data[$row->payment_key] = $row->payment_value;
			}
			if($_POST['ac_transaction_status']=='COMPLETED')
			{
				
				$deposit_status = $this->updateDeposit($_POST['ac_amount'], $_POST['ac_order_id']);
			} else {
				$data = array(
					'payment' => 'advcash',
					'post_content' => json_encode($_POST),
					'datetime' => date('Y-m-d H:i:s')
				);
				$this->db->insert('ipn_process', $data);
			}
			
		}