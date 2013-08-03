<?php

namespace CDIA;

class Order {
    public static function orderOueueSize() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://173.203.102.128/cdiabu/index.php/order_queue_size');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = json_decode(curl_exec($ch), true);
        
        return intval($response['result']['order_queue_size']);
    }
}

?>