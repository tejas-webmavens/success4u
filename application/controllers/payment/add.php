<?php
                            $ac_account_email = $form_payment['ac_account_email'];
                            $ac_sci_name = $form_payment['ac_sci_name'];
                            $ac_amount = $form_deposit['amount'];
                            $ac_currency = strtoupper($currency_info->currency_unit);
                            $secret = $form_payment['ac_api_pwd'];
                            $ac_order_id = $form_deposit['deposit_id'];

                            $sign_hash = hash('sha256', implode(":", array(
                                $ac_account_email,
                                $ac_sci_name,
                                $ac_amount,
                                $ac_currency,
                                $secret,
                                $ac_order_id
                            )));
                        ?>

                            <form method="post" action="https://wallet.advcash.com/sci/" role="form" id="coform">
                                <input type="hidden" name="ac_account_email" value="<?php echo $form_payment['ac_account_email'];?>" />
                                <input type="hidden" name="ac_sci_name" value="<?php echo $form_payment['ac_sci_name'];?>" />
                                <input type="hidden" name="ac_amount" value="<?php echo $form_deposit['amount']; ?>" />
                                <input type="hidden" name="ac_currency" value="<?php echo strtoupper($currency_info->currency_unit); ?>" />
                                <input type="hidden" name="ac_order_id" value="<?php echo $form_deposit['deposit_id'];?>" />
                                <input type="hidden" name="ac_sign" value="<?php echo $sign_hash;?>" />
                                <!-- Optional Fields -->
                                <input type="hidden" name="ac_success_url" value="<?php echo $form_payment['success_url'];?>" />
                                <input type="hidden" name="ac_success_url_method" value="POST" />
                                <input type="hidden" name="ac_fail_url" value="<?php echo $form_payment['cancel_url'];?>" />
                                <input type="hidden" name="ac_fail_url_method" value="POST" />
                                <input type="hidden" name="ac_status_url" value="<?php echo $form_payment['ipn_url'];?>" />
                                <input type="hidden" name="ac_status_url_method" value="POST" />
                                <input type="hidden" name="ac_comments" value="Comment" />
                                <input type="hidden" name="operation_id" value="<?php echo $form_deposit['uusersid'];?>">
                                <input type="submit" name="button" id="button" value="Deposit" class="button" />
                                <input type="button" name="button" id="button" onclick="window.location='deposit.php'" value="Cancel" class="button" />
                            </form>

                    <?php }
