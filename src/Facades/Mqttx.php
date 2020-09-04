<?php

namespace Jzzoo\Laravel\Mqttx\Facades;

use Illuminate\Support\Facades\Facade;

class Mqttx extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mqttx';
    }
}