<?php

namespace Meow\Halum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Artisan;

class MeowController extends Controller
{
    //
    public function interest()
    {


      Artisan::call('schedule:run');


    }
}
