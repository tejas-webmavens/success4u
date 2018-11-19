<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;

use App\UserLog;
use App\Referral;
use App\ReferralRelationship;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class FaucetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }    
    public function Home()
    {
    	$settings = Settings::first();

            $user = Auth::user();
            $payTimePeriod = $settings->faucet_time; // Settings Faucet Time Period
            $current_date = Carbon::now(); // Current Date

            if ($user->last_claim == '') {
                $difference = $payTimePeriod + 1;
            } else {
                $last_claims = strtotime($user->last_claim);
                $current_time = strtotime($current_date);
                $difference = abs($last_claims - $current_time);
                $difference = round($difference / 60);
            }

            $next_claim = $payTimePeriod - $difference;

        $data['next_claim'] = $next_claim;
    	$data['page_title'] = "Faucet";
    	$data['faucet_pay'] = $settings->faucet_pay;
    	$data['faucet_time'] = $settings->faucet_time;
    	return view('user.games.faucet', $data);
    }

        public function Faucet(Request $request)
    {
    	    try {
            $this->validate($request, [

            'g-recaptcha-response' => 'required',

             ]); 
            // $c_id = Auth::user()->id;
            // $user = User::findOrFail($c_id);

    	    $user = Auth::user();	
            
            $setting = Settings::first();
            $pay_amount = $setting->faucet_pay;

            $payTimePeriod = $setting->faucet_time; // Settings Faucet Time Period
            $current_date = Carbon::now(); // Current Date

            if ($user->last_claim == '') {
            	$difference = $payTimePeriod + 1;
            } else {
            	$last_claims = strtotime($user->last_claim);
                $current_time = strtotime($current_date);
                $difference = abs($last_claims - $current_time);
                $difference = round($difference / 60);
            }

            $next_roll = $payTimePeriod - $difference;

            if($difference < $payTimePeriod) {

            session()->flash('f_message', 'Please wait until your limit expires. Next Claim in: ' . $next_roll . ' minutes.');
            Session::flash('type', 'warning');
            return redirect()->back();	
	
            }

            $log = UserLog::create([

            'user_id' => $user->id,
            'reference' => str_random(12),
            'for' => 'Faucet',
            'from' => 'Self',
            'details'=>'You Have Been Received Rewards for Faucet',
            'amount'=> $pay_amount,
            ]);

            $user->profile->main_balance = $user->profile->main_balance + $pay_amount;
            $user->profile->save();
            $user->last_claim = Carbon::now();
            $user->save();

        $upliner = Referral::whereUser_id($user->id)->count();

        if ($upliner == 1){

            $settings = Settings::first();

            $referral = Referral::whereUser_id($user->id)->first();

            $upliner = $referral->reflink->user->profile;

            $percentage = $settings->ref_faucet;

            $commission = (($percentage / 100) * $pay_amount);

            $upliner->referral_balance = $upliner->referral_balance + $commission;

            $upliner->save();


            if ($commission > 0) {

            $log = UserLog::create([

                'user_id' => $referral->reflink->user->id,
                'reference' => str_random(12),
                'for' => 'Referral',
                'from' => $user->name,
                'details'=>'You Have Been Received Referral Bonus for Faucet',
                'amount'=> $commission,

            ]);

            }


        }

            session()->flash('f_message','You Earn '. $pay_amount . ' BTC');
            Session::flash('type', 'success');
            return redirect()->back();

        } catch (\PDOException $e) {
            session()->flash('f_message', $e->getMessage());
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
}
