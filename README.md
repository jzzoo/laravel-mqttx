# laravel-mqtt

A simple Laravel MQTT client provides Publish/Subscribe methods.

Source code is mainly based on [phpMQTT](https://github.com/bluerhinos/phpMQTT)

Once the configuration is complete, it is ready to use.

The install ``composer require jzzoo/laravel-mqttx``



Example: 
```php


$mqtt = new Mqttx();

// 发布
$mqtt->Publish('test/demo', sprintf("mqtt message: ", mt_rand(10,9999)));
   
// 订阅        
$mqtt->Subscribe('test/demo', function ($topic, $message){
    dump($topic);
    dump($message);
});

```