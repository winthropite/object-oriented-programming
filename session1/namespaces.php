<?php
    
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

use \CDIA\Database\Db;
use \CDIA\Authentication\Auth;

$db = new Db();

$auth = new Auth($db);
echo $auth->login();
    
?>