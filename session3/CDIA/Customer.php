<?php

namespace CDIA;

class Customer {
    public static function getCustomers() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . 'get_customers');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = json_decode(curl_exec($ch), true);

        return $response['results'];
    }
}

?>