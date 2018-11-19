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

class RollGameController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Home()
    {
            $user = Auth::user();
            $set_roll = Settings::first();

            $payTimePeriod = $set_roll->time_pay_roll; // Settings Roll Time Period
            $current_date = Carbon::now(); // Current Date
            // $last_claim = Carbon::now(); // Last Roll Claim Date
            // $last_claim = $last_claim->subMinutes(31);

            if ($user->last_roll_game == '') {
                $difference = $payTimePeriod + 1;
            } else {
                $last_claim = strtotime($user->last_roll_game);
                $current_time = strtotime($current_date);
                $difference = abs($last_claim - $current_time);
                $difference = round($difference / 60);
            }

            $next_roll = $payTimePeriod - $difference;

    	$data['page_title'] = "Roll Game";
        $data['time_roll'] = $next_roll;
        $data['pay_1'] = $set_roll->roll_level1;
        $data['pay_2'] = $set_roll->roll_level2;
        $data['pay_3'] = $set_roll->roll_level3;
        $data['pay_4'] = $set_roll->roll_level4;
        $data['pay_5'] = $set_roll->roll_level5;
        $data['pay_6'] = $set_roll->roll_level6;
    	return view('user.games.rollgame', $data);
    }
        public function RollGame(Request $request)
    {
    	    try {

            $this->validate($request, [

            'g-recaptcha-response' => 'required',
            // 'g-recaptcha-response' => 'required|recaptcha',

             ]);   
            // $c_id = Auth::user()->id;
            // $user = User::findOrFail($c_id);

            $user = Auth::user();
            
            $roll_number = rand(1,10000);
            $set_roll = Settings::first();
            if ($roll_number >= 0 && $roll_number <= 9885) {
            	$pay_amount = $set_roll->roll_level1; // Settings Pay Amount
            }
            else if ($roll_number >= 9886 && $roll_number <= 9985) {
            	$pay_amount = $set_roll->roll_level2; // Settings Pay Amount
            }
            else if ($roll_number >= 9986 && $roll_number <= 9993) {
            	$pay_amount = $set_roll->roll_level3; // Settings Pay Amount
            }
            else if ($roll_number >= 9994 && $roll_number <= 9997) {
            	$pay_amount = $set_roll->roll_level4; // Settings Pay Amount
            }
            else if ($roll_number >= 9998 && $roll_number <= 9999) {
            	$pay_amount = $set_roll->roll_level5; // Settings Pay Amount
            } else {
	            $pay_amount = $set_roll->roll_level6; // Settings Pay Amount
            }

            $payTimePeriod = $set_roll->time_pay_roll; // Settings Roll Time Period
            $current_date = Carbon::now(); // Current Date
            // $last_claim = Carbon::now(); // Last Roll Claim Date
            // $last_claim = $last_claim->subMinutes(31);

            if ($user->last_roll_game == '') {
            	$difference = $payTimePeriod + 1;
            } else {
            	$last_claim = strtotime($user->last_roll_game);
                $current_time = strtotime($current_date);
                $difference = abs($last_claim - $current_time);
                $difference = round($difference / 60);
            }

            $next_roll = $payTimePeriod - $difference;

            if($difference < $payTimePeriod) {

            session()->flash('roll_message','Please wait until your limit expires. Next Roll in: ' . $next_roll . ' minutes.');
            Session::flash('type', 'warning');
            return redirect()->back();	
	
            }
                    // $ul['user_id'] = Auth::user()->id;
                    // $ul['amount'] = $pay_amount;
                    // $ul['game'] = $roll_number;
                    // $ul['made_date'] = $current_date;
                    // // UserLog::create($ul);
                    // RollGameLog::create($ul);
            $log = UserLog::create([

            'user_id' => $user->id,
            'reference' => str_random(12),
            'for' => 'Roll Game',
            'from' => 'Self',
            'details'=>'You Have Been Received Rewards for Roll Game Play',
            'amount'=> $pay_amount,
            ]);

            $user->profile->main_balance = $user->profile->main_balance + $pay_amount;
            $user->profile->save();
            $user->last_roll_game = Carbon::now();
            $user->save();

        $upliner = Referral::whereUser_id($user->id)->count();

        if ($upliner == 1){

            $settings = Settings::first();

            $referral = Referral::whereUser_id($user->id)->first();

            $upliner = $referral->reflink->user->profile;

            $percentage = $settings->ref_roll;

            $commission = (($percentage / 100) * $pay_amount);

            $upliner->referral_balance = $upliner->referral_balance + $commission;

            $upliner->save();
                       

            if ($commission > 0) {

            $log = UserLog::create([

                'user_id' => $referral->reflink->user->id,
                'reference' => str_random(12),
                'for' => 'Referral',
                'from' => $user->name,
                'details'=>'You Have Been Received Referral Bonus for Roll Game Play',
                'amount'=> $commission,

            ]);

            }


        }

            session()->flash('roll_message','The roll number is: '.$roll_number);
            Session::flash('pay_amount', 'You have won '. $pay_amount .' BTC');
            Session::flash('type', 'success');
            return redirect()->back();

        } catch (\PDOException $e) {
            session()->flash('roll_message', $e->getMessage());
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
}
