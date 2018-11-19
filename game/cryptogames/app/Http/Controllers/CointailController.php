<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use App\UserLog;
use App\CointailLog;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class CointailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Home()
    {
    	$settings = Settings::first();
    	$data['page_title'] = "Coin Tail Game";
    	$data['game_pay'] = $settings->cointail_pay;
        $data['game_dates'] = CointailLog::orderBy('id','desc')->take(15)->get();
    	return view('user.games.cointail', $data);
    }

        public function Cointail(Request $request)
    {
    	    $this->validate($request,[
            'amount' => 'required|numeric|between:0.00000100,99.99999999',
            'game' => 'required',
            'g-recaptcha-response' => 'required',
            ]);
    	    try {
    	    // if (isset($request->head)) {
    	    // 	# code...
    	    // }
            // $c_id = Auth::user()->id;
            // $user = User::findOrFail($c_id);

    	    $user = Auth::user();	
            
            $setting = Settings::first();
            $pay_amount = $setting->cointail_pay;
            $head_or_tail = rand(0,1);
            $total_pay = ($request->amount/100)*$pay_amount;
            $total_pay = number_format($total_pay, 8, '.', ',');

            if ($request->game == 0) {
            	$best_game = "Head";
            } else {
            	$best_game = "Tail";
            }

            if ($user->profile->main_balance < $request->amount) {
            session()->flash('cointail_message', 'Your Balance is Insufficient');
            Session::flash('type', 'warning');	
            return redirect()->back();
            }

            if($request->game == $head_or_tail) {

            $ul['user_id'] = Auth::user()->id;
            $ul['amount'] = $total_pay;
            $ul['game'] = $best_game;
            $ul['made_date'] = Carbon::now();
            $ul['best'] = "Earn";
            CointailLog::create($ul);

            $log = UserLog::create([

            'user_id' => $user->id,
            'reference' => str_random(12),
            'for' => 'CoinTail Game',
            'from' => 'Self',
            'details'=>'You Win Bet in Coin Tail Game',
            'amount'=> $total_pay,
            ]);	

            $user->profile->main_balance = $user->profile->main_balance + $total_pay;
            $user->profile->save();
            session()->flash('cointail_message','You Win '. $total_pay . ' BTC');
            Session::flash('type', 'success');
            return redirect()->back();
	
            } else {

            $ul['user_id'] = Auth::user()->id;
            $ul['amount'] = $request->amount;
            $ul['game'] = $best_game;
            $ul['made_date'] = Carbon::now();
            $ul['best'] = "Lost";
            CointailLog::create($ul);

            $log = UserLog::create([

            'user_id' => $user->id,
            'reference' => str_random(12),
            'for' => 'CoinTail Game',
            'from' => 'Self',
            'details'=>'You Lost Bet in Coin Tail Game',
            'amount'=> $request->amount,
            ]);	

            $user->profile->main_balance = $user->profile->main_balance - $request->amount;
            $user->profile->save();
            session()->flash('cointail_message', 'You Lost '. $request->amount . ' BTC');
            Session::flash('type', 'danger');
            return redirect()->back();	

            }

        } catch (\PDOException $e) {
            session()->flash('cointail_message', $e->getMessage());
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
}
