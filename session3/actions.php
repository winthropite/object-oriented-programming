<?php

define('HOST', '127.0.0.1');
define('PORT', null);
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'cdia_restaurant');
define('API_URL', 'http://127.0.0.1/~Dan/cdiabu/object-oriented-programming/session3/api/index.php/');
// define('API_URL', 'http://166.78.112.120/cdiabu/index.php/');

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

// actions
if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'enqueue_order':
        $result = \CDIA\Order::enqueueOrder();
        
        if ($result) {
        	header('Location: customer.php');
        }
        break;

        case 'dequeue_order':
        $result = \CDIA\Order::dequeueOrder();

        if ($result) {
            header('Location: chef.php');
        }
        break;
    }
}

?>