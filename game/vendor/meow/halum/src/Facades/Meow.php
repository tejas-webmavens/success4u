<?php

namespace Meow\Halum\Facades;

use Illuminate\Support\Facades\Facade;

class Meow extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'meow';
    }
}