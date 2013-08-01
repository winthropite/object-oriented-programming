<?php

session_start();

set_include_path('/Users/Dan/Sites/cdiabu/object-oriented-programming/session2');

// these should go outside of the web root
define('HOST', '127.0.0.1');
define('PORT', null);
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'cdia_user');
define('SALT', 'cdia');

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
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo $e->getMessage();
    exit();
}

// create auth object
$auth = new \CDIA\Authentication\Auth($db);

// actions
if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'login':
        if ($auth->login()) {
            header('Location: profile.php');
        } else {
            header('Location: index.php');
        }
        break;
    
        case 'logout':
        session_destroy();
        header('Location: index.php');
        break;
    }
}
    
?>