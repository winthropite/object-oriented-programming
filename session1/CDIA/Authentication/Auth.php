<?php

namespace CDIA\Authentication;

class Auth {
    public function __construct(\CDIA\Database\Db $db) {
        $this->db = $db;
        echo $db->connect();
    }
    
    public function login() {
        return 'Logging in!';
    }
}

?>