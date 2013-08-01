<?php

namespace CDIA\Authentication;

class Auth {
    
    private $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public function login() {
        $username = $_POST['username'];
        $password = crypt($_POST['password'], '$5$rounds=5000$'.SALT.'$');
        
		$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        
        if ($result) {
            $_SESSION['username'] = $result->username;
        }
		
		return $result;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['username']);
    }
    
}

?>