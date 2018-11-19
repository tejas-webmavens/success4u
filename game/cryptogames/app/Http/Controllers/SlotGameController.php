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

class SlotGameController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Home()
    {
        $user = Auth::user();
        $settings = Settings::first();
        $data['pay_bar'] = $settings->bar;
        $data['pay_cherry'] = $settings->cherry;
        $data['pay_orange'] = $settings->orange;
        $data['pay_grape'] = $settings->grape;
        $data['pay_seven'] = $settings->seven;
        $data['pay_bell'] = $settings->bell;
        $data['price_slot'] = $settings->price_c_slot;
        $data['slot_credits'] = $user->profile->slot_credits;
    	$data['page_title'] = "Slot Game";
    	return view('user.games.slot', $data);
    }
    public function Slot(Request $request)
    {
    	    try {

            $user = Auth::user();

            $settings = Settings::first();
            $pay_bar = $settings->bar;
            $pay_cherry = $settings->cherry;
            $pay_orange = $settings->orange;
            $pay_grape = $settings->grape;
            $pay_seven = $settings->seven;
            $pay_bell = $settings->bell;

            if ($user->profile->slot_credits > 0) {
                # code...

            $faces = array ('Cherry', 'Orange', 'Grape', 'Bell', 'Bar', 'Seven');

            $payouts = array (
                'Bar|Bar|Bar' => $pay_bar,
                'Orange|Orange|Orange' => $pay_cherry,
                'Grape|Grape|Grape' => $pay_orange,
                'Cherry|Cherry|Cherry' => $pay_grape,
                'Seven|Seven|Seven' => $pay_seven,
                'Bell|Bell|Bell' => $pay_bell,
                // 'Bar|Seven|Bell' => '0.100',
                // 'Bar|Seven|Bar' => '0.100',
                // 'Cherry|Bar|Seven' => '0.100',
                // 'Orange|Grape|Bar' => '0.100',
                // 'Cherry|Bar|Cherry' => '0.100',
                // 'Bell|Seven|Bell' => '0.100',
            );


            $wheel1 = array();
            foreach ($faces as $face) {
                $wheel1[] = $face;
            }
            $wheel2 = array_reverse($wheel1);
            $wheel3 = $wheel1;

            $rand1 = rand(1,6);
            $rand2 = rand(1,6);
            $rand3 = rand(1,6);

            $stop1 = rand(count($wheel1)+$rand1, 10*count($wheel1)) % count($wheel1);
            $stop2 = rand(count($wheel1)+$rand2, 10*count($wheel1)) % count($wheel1);
            $stop3 = rand(count($wheel1)+$rand3, 10*count($wheel1)) % count($wheel1);

            list($start1, $start2, $start3) = array($stop1, $stop2, $stop3);

            $stop1 = rand(count($wheel1)+$start1, 10*count($wheel1)) % count($wheel1);
            $stop2 = rand(count($wheel1)+$start2, 10*count($wheel1)) % count($wheel1);
            $stop3 = rand(count($wheel1)+$start3, 10*count($wheel1)) % count($wheel1);

            $result1 = $wheel1[$stop1];
            $result2 = $wheel2[$stop2];
            $result3 = $wheel3[$stop3];

            if (isset($payouts[$result1.'|'.$result2.'|'.$result3])) {
                // give the payout
                $user->profile->main_balance = $user->profile->main_balance + $payouts[$result1.'|'.$result2.'|'.$result3];
                $user->profile->slot_credits = $user->profile->slot_credits - 1;
                $user->profile->save();
                session()->flash('slot_message','You Won '. $payouts[$result1.'|'.$result2.'|'.$result3].' BTC');
                Session::flash('type', 'success');
            } else {
                // Lost
                $user->profile->slot_credits = $user->profile->slot_credits - 1;
                $user->profile->save();
                session()->flash('slot_message','You Lost');
                Session::flash('type', 'warning');
            }

            $slot_credits = $user->profile->slot_credits;
            $price_slot = $settings->price_c_slot;

            return view('user.games.slot',compact('result1','result2','result3','slot_credits','pay_bar','pay_cherry','pay_orange','pay_grape','pay_seven','pay_bell','price_slot'));

            } else {
                session()->flash('slot_message','Insufficient Slot Credits');
                Session::flash('type', 'warning');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('slot_message', $e->getMessage());
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
    public function BuySlot(Request $request)
    {

        $this->validate($request,[
            'credits' => 'required|numeric',
            ]);

            try {

            $user = Auth::user();
            $settings = Settings::first();
            $u_price = $settings->price_c_slot;
            $total_price = $request->credits*$u_price;

            if ($user->profile->main_balance > $total_price) {
                // give the payout
                $user->profile->main_balance = $user->profile->main_balance - $total_price;
                $user->profile->slot_credits = $user->profile->slot_credits + $request->credits;
                $user->profile->save();
                session()->flash('buy_message','Purchased successfully');
                Session::flash('type', 'success');
            } else {
                // Lost
                session()->flash('buy_message','Account Balance Insufficient');
                Session::flash('type', 'warning');
            }

            return redirect()->back();

        } catch (\PDOException $e) {
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }

    }
}
