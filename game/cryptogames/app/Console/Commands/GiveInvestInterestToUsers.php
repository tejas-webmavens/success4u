<?php

namespace App\Console\Commands;

use App\Interest;
use App\InterestLog;
use App\Invest;
use App\Membership;
use App\Settings;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;

class GiveInvestInterestToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GiveInvestInterestToUsers:cronlabinterest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Give Money Investment Interests To All User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $settings = Settings::first();
        
        if ($settings->membership_upgrade == 1){

            $users= User::all();

            foreach ($users as $user){

                $today = Carbon::today();
                $expired = $user->membership_expired;
                $datetime1 = new DateTime($today);
                $datetime2 = new DateTime($expired);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');

                if ($days == 0){
                    $membership = Membership::first();
                    $user->membership_id = $membership->id;
                    $user->membership_started = Carbon::today();
                    $user->membership_expired = $today->addDays($membership->duration);
                    $user->save();
                }

            }

        }

    }
}
