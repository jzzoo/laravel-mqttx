<?php

namespace Jzzoo\Laravel\Mqttx;

class Mqttx
{
    public function __construct() {
        $this->host      = config('mqtt.host');
        $this->username  = config('mqtt.username');
        $this->password  = config('mqtt.password');
        $this->cert_file = config('mqtt.certfile');
        $this->port      = config('mqtt.port');
        $this->debug     = config('mqtt.debug');
        $this->qos       = config('mqtt.qos');
        $this->retain    = config('mqtt.retain');
    }

    /**
     * 发布消息
     *
     * @param $topic
     * @param $msg
     * @param null $client_id
     * @return bool
     */
    public function Publish($topic, $msg, $client_id = null) {

        empty($client_id) && $client_id = rand(10000, 99999);

        $mqtt = new MqttxNear($this->host,$this->port, $client_id, $this->cert_file, $this->debug);

        if ( $mqtt->connect(true, null, $this->username, $this->password) )  {
            $mqtt->publish($topic, $msg, $this->qos, $this->retain);
            $mqtt->close();
            return true;
        }

        return false;
    }

    /**
     * 订阅消息
     *
     * @param $topic
     * @param $function
     * @param null $client_id
     * @return bool
     */
    public function Subscribe($topic, $function, $client_id = null) {

        empty($client_id) && $client_id = mt_rand(10000, 99999);

        $mqtt = new MqttxNear($this->host,$this->port, $client_id);
        if( $mqtt->connect(true, null, $this->username, $this->password) ) {

            $topics[$topic] = [ 'qos' => 0, 'function' => $function ];
            $mqtt->subscribe($topics, 0);

            do {
                $rs = $mqtt->proc();
            } while($rs);

            $mqtt->close();
            return true;
        }
        return false;
    }
}