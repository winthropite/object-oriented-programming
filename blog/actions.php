<?php

require 'config.php';

if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'login':
        if ($auth->login()) {
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
        break;
    
        case 'logout':
        $auth->logout();
        header('Location: login.php');
        break;
    }
}
    
?>