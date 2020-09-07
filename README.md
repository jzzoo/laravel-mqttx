# laravel-mqttx

A simple Laravel MQTT client provides Publish/Subscribe methods.

Source code is mainly based on [phpMQTT](https://github.com/bluerhinos/phpMQTT).

Once the configuration is complete, it is ready to use.

## install 


```php
$ composer require jzzoo/laravel-mqttx -vvv
$ php artisan vendor:publish
```

## config

config/mqttx.php

```php
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
```

## example: 
```php


$mqtt = new Mqttx();

// Post news to test/topic topic
$mqtt->Publish('test/topic', sprintf("mqtt message: %d", mt_rand(10,9999)));
   
   
// Subscribe to test/topic topic       
$mqtt->Subscribe('test/topic', function ($topic, $message) {
    dump($topic);
    dump($message);
});

```

If *Debug* is turned on and *Publish* is called on the browser, you can suppress the output using *ob_get_clean()*.
