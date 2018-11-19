<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CoinpaymentsController extends Controller
{
    //
    const ITEM_CURRENCY = 'BTC';
    const ITEM_PRICE    = 2;

    /**
     * Purchase items using coinpayments payment processor
     *
     * @param Request $request
     * @return array
     */
    public function purchaseItems (Request $request)
    {
        // validate that the request has the appropriate values
        $this->validate($request, [
            'currency' => 'required|string',
            'amount'   => 'required|numeric|min:0.00001',
        ]);


        $amount   = $request->amount;
        $currency = $request->currency;
        $user = Auth::user();

        /** @var Transaction $transaction */
        $transaction = \Coinpayments::createTransactionSimple($amount, self::ITEM_CURRENCY, $currency);

        $data['address'] = $transaction->address;
        $data['amount'] = $transaction->amount;
        $data['currency'] = $transaction->currency2;
        $data['qrcode_url'] = $transaction->qrcode_url;

            $deposit= Deposit::create([

            'transaction_id' => $transaction->txn_id,
            'user_id'=> $user->id,
            'gateway_name'=> 'Bitcoin',
            'amount'=> $transaction->amount,
            'charge'=> 0,
            'net_amount'=> $transaction->amount,
            'status'=> 0,
            'details'=>'No Details are Provided',
            'address'=> $transaction->address,

        ]);

        // return ['transaction' => $transaction];
        return view('user.deposit.btc',$data);
    }

    /**
     * Creates a donation transaction
     *
     * @param Request $request
     * @return array
     */
    public function donation (Request $request)
    {
        // validate that the request has the appropriate values
        $this->validate($request, [
            'currency' => 'required|string',
            'amount'   => 'required|integer|min:0.01',
        ]);

        $amount   = $request->get('amount');
        $currency = $request->get('currency');

        /*
         * Here we are donating the exact amount that they specify.
         * So we use the same currency in and out, with the same amount value.
         */
        $transaction = \Coinpayments::createTransactionSimple($amount, $currency, $currency);

        return ['transaction' => $transaction];
    }

    /**
     * Handled on callback of IPN
     *
     * @param Request $request
     */
    public function validateIpn (Request $request)
    {
        try {
            /** @var Ipn $ipn */
            $ipn = \Coinpayments::validateIPNRequest($request);

            // if the ipn came from the API side of coinpayments merchant
            if ($ipn->isApi()) {

                /*
                 * If it makes it into here then the payment is complete.
                 * So do whatever you want once the completed
                 */

                // do something here
                // Payment::find($ipn->txn_id);

                $dep_details = Deposit::where('transaction_id', '=', $ipn->txn_id)->take(1)->get();
                $user = Profile::where('user_id', '=', $dep_details->user_id)->take(1)->get();

                $user->deposit_balance = $user->deposit_balance + $dep_details->net_amount;
                $user->save();
                $dep_details->status = 1;
                $dep_details->save();
            }
        }
        catch (IpnIncompleteException $e) {
            $ipn = $e->getIpn();
            /*
             * Can do something here with the IPN model if desired.
             */
        }
    }
}
