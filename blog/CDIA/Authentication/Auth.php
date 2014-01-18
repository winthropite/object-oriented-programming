<?php

namespace CDIA\Authentication;

class Auth {
    
    private $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public function login() {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username, $password));
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        
        if ($result) {
            $_SESSION['username'] = $result->username;
        }
        
        return $result;
    }
    
    public function logout() {
        session_destroy();
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['username']);
    }
    
}

?>