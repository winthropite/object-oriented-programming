<?php

// start sessions
session_start();

// database connection constants
define('HOST', 'localhost');
define('PORT', null);
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'blog');

// autoload classes
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

// setup database
try {
    $host = HOST;
    $port = PORT;
    $database = DATABASE;
    $db = new \PDO("mysql:host=$host;port=$port;dbname=$database", USERNAME, PASSWORD);
} catch (\PDOException $e) {
    echo $e->getMessage();
    exit();
}

$auth = new \CDIA\Authentication\Auth($db);

?>