<?php

define('BASE_PATH', 'http://127.0.0.1/~Dan/cdiabu/object-oriented-programming/session6/');
define('UPLOAD_PATH', __DIR__ . '/uploads/');

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

// actions
if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'add_photo':
        $uploadfile = UPLOAD_PATH . $_POST['category'] . '/' . basename($_FILES['photo']['name']);
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
            header('Location: index.php');
        }
        break;
    }
}

?>