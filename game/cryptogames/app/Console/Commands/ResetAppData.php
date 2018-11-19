<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetAppData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetAppData:resetcronlab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset CronLab PTC Application Data. This will Reset All With Seeder.';

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

        Artisan::call('down');

        Artisan::call('migrate:refresh', ["--force"=> true,'--seed'=>true ]);

        Artisan::call('up');


    }
}
