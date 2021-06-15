<?php

namespace Jzzoo\Laravel\Mqttx;

class Mqttx
{
    /**
     * Mqttx constructor.
     */
    public function __construct() {
        $this->host      = config('mqttx.host');
        $this->username  = config('mqttx.username');
        $this->password  = config('mqttx.password');
        $this->cert_file = config('mqttx.certfile');
        $this->port      = config('mqttx.port');
        $this->debug     = config('mqttx.debug');
        $this->qos       = config('mqttx.qos');
        $this->retain    = config('mqttx.retain');
    }

    /**
     * Send a message
     *
     * @param $topic
     * @param $msg
     * @param null $clientId
     * @return bool
     */
    public function Publish($topic, $msg, $clientId = null) {

        empty($clientId) && $clientId = $this->__genClientId();

        $mqtt = new MqttxNear($this->host,$this->port, $clientId, $this->cert_file, $this->debug);

        if ( $mqtt->connect(true, null, $this->username, $this->password) )  {
            $mqtt->publish($topic, $msg, $this->qos, $this->retain);

            $cmd = $iii = 0;
            do {
                $byte = $mqtt->read(1, true);

                if ((string)$byte === '') {
                    usleep(100000);
                } else {
                    $cmd = (int)(ord($byte) / 16);
                }

                if( $cmd == 4 ) break;

                $iii++;
            } while($cmd == 0 && $iii < 3600);

            $mqtt->close();
            return true;
        }

        return false;
    }

    /**
     * Subscribe to news
     *
     * @param $topic
     * @param $function
     * @param null $clientId
     * @return bool
     */
    public function Subscribe($topic, $function, $clientId = null) {

        empty($clientId) && $clientId = $this->__genClientId();

        $mqtt = new MqttxNear($this->host,$this->port, $clientId);
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

    /**
     * Generate the client ID
     *
     * @return string
     */
    private function __genClientId() {
        return uniqid('mqttx_');
    }
}