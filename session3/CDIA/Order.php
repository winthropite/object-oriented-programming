<?php

namespace CDIA;

class Order {
	public static function queueSize() {
        // create a curl resource
        $ch = curl_init();
        // set URL option
        curl_setopt($ch, CURLOPT_URL, API_URL . 'queue_size');
        // set return transfer to true so that we get data back
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // execute the curl request and convert from json to an array
        $response = json_decode(curl_exec($ch), true);
        
        // return just the queue_size index of the array
        return intval($response['result']['queue_size']);
    }
    
    public static function enqueueOrder() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'enqueue_order');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // set the post option to true so that we can send data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // define the fields that will be sent
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