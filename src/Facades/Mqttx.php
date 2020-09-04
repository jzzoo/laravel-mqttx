<?php

namespace Jzzoo\Laravel\Mqttx;

use Illuminate\Support\Facades\Facade;

class Mqttx extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mqttx';
    }
}