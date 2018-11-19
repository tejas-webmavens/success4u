<?php

namespace App\Http\Controllers;

use App\Gateway;
use App\Offline;
use App\Settings;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserWithdrawsController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index()
    {
        $user=Auth::user();

        $withdraws= Withdraw::whereUser_id($user->id)->orderBy('created_at','desc')->paginate(15);

        $settings = Settings::first();

        return view('user.withdraw.index',compact('withdraws','settings'));
    }

    public function create()
    {

        $gateways = Offline::all();
        $gate = Gateway::first();
        $user = Auth::user();
        $settings = Settings::first();

        return view('user.withdraw.create',compact('gateways','user','settings','gate'));
    }

    public function postWithdraw(Request $request)
    {
        $this->validate($request, [
            'gateway'=> 'required|numeric',
            'amount' => 'required|numeric|between:0.00000000,99.99999999',
            'account' => 'required',
        ]);

        $user = Auth::user();

        $settings = Settings::first();

        if ($settings->minimum_withdraw > $request->amount){

            session()->flash('with_message', 'You need at least  $ '.$settings->minimum_withdraw.' to withdraw money. Please earn some money first. ');
            Session::flash('type', 'danger');

            return redirect(route('userWithdraw.create'));


        }
        if ($user->profile->main_balance < $request->amount){

            session()->flash('with_message', "You don't have enough funds to withdraw. You have only $ ".$user->profile->main_balance." to withdraw. Please earn some money first. ");
            Session::flash('type', 'warning');

            return redirect(route('userWithdraw.create'));


        }

        if ($request->gateway == 1000){

            $gateway= Gateway::first();

            $percentage =  $gateway->percent;
            $fixed =  $gateway->fixed;
            $charge = (($percentage / 100) * $request->amount) + $fixed;

            $new_amount = $request->amount - $charge;
            $withdraw= Withdraw::create([

                'transaction_id' => str_random(6).$user->id.str_random(6),
                'user_id'=> $user->id,
                'gateway_name'=> $gateway->name,
                'amount'=> $request->amount,
                'charge'=> $charge,
                'net_amount'=> $new_amount,
                'status'=> 0,
                'account'=> $request->account,

            ]);

            session()->flash('with_message', 'After Charging Gateway Fee Your Total Withdraw Amount $ '.$new_amount.' Has Been Successfully Requested. Fund is automatically send to your account Once we verify ');
            Session::flash('type', 'success');

            return redirect(route('userWithdraws'));

        }

        $gateway= Offline::whereId($request->gateway)->first();
        $percentage =  $gateway->percent;
        $fixed =  $gateway->fixed;
        $charge = (($percentage / 100) * $request->amount) + $fixed;
        $new_amount = $request->amount - $charge;

            $withdraw= Withdraw::create([

                'transaction_id' => str_random(6).$user->id.str_random(6),
                'user_id'=> $user->id,
                'gateway_name'=> $gateway->name,
                'amount'=> $request->amount,
                'charge'=> $charge,
                'net_amount'=> $new_amount,
                'status'=> 0,
                'account'=> $request->account,

            ]);

            session()->flash('with_message', 'After Charging Gateway Fee Your Total Withdraw Amount $ '.$new_amount.' Has Been Successfully Requested. Fund is automatically send to your account Once we verify ');
            Session::flash('type', 'success');

            return redirect(route('userWithdraws'));

    }





}
