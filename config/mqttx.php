<?php

return [
    'host'     => env('mqtt_host','127.0.0.1'),
    'password' => env('mqtt_password',''),
    'username' => env('mqtt_username',''),
    'certfile' => env('mqtt_cert_file',''),
    'port'     => env('mqtt_port','1883'),
    'debug'    => env('mqtt_debug',false),
    'qos'      => env('mqtt_qos', 0),
    'retain'   => env('mqtt_retain', 0)
];