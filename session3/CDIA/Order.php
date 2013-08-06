<?php

namespace CDIA;

class Order {
	public static function queueSize() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'queue_size');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = json_decode(curl_exec($ch), true);
        
        return intval($response['result']['queue_size']);
    }
    
    public static function enqueueOrder() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'enqueue_order');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'customer_id' => $_POST['customer_id'],
            'meal' => $_POST['meal']
        ));
        
        return curl_exec($ch);
    }
    
    public static function dequeueOrder() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'dequeue_order');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = json_decode(curl_exec($ch), true);

        return $response['result'];
    }
    
    public static function getOrders() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'get_orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = json_decode(curl_exec($ch), true);

        return $response['results'];
    }
}

?>