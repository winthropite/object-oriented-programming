<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__.'/vendor/autoload.php'; 

$app = new Silex\Application();

$app['debug'] = true;

define('HOST', '127.0.0.1');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'cdia_restaurant');

// http://173.203.102.128/cdiabu/index.php/order_queue_size

// setup database
try {
    $host = HOST;
    $port = PORT;
    $database = DATABASE;
    $app['db'] = new \PDO("mysql:host=$host;port=$port;dbname=$database", USERNAME, PASSWORD);
    $app['db']->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo $e->getMessage();
    exit();
}

$app->get('/enqueue_order/{order_id}', function(Request $request, $order_id) use($app) { 
    $sql = "INSERT INTO orders_queue (order_id) VALUES (:order_id)";

    $stmt = $app['db']->prepare($sql);

    $stmt->bindValue(':order_id', $order_id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
        $orders_queue_id = $app['db']->lastInsertId();
        $retval = $orders_queue_id;
    } else {
        $retval = false;
    }
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('result' => $retval));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('result' => $retval));
    }
});

$app->get('/dequeue_order', function(Request $request) use($app) {
    try {
        $app['db']->beginTransaction();
    
        $sql = "SELECT id, order_id FROM orders_queue ORDER BY id ASC LIMIT 1";

        $stmt = $app['db']->prepare($sql);
    
        $stmt->execute();
    
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        $sql2 = "DELETE FROM orders_queue WHERE id = :id";

        $stmt2 = $app['db']->prepare($sql2);
    
        $stmt2->bindValue(':id', $result->id, \PDO::PARAM_INT);
        
        $stmt2->execute();
    
        if (!$app['db']->commit()) {
            $result = false;
        }
    } catch(\PDOException $e) {
        $this->db->rollBack();
        
        $result = false;
    }
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('result' => $result));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('result' => $result));
    }
});

$app->get('/order_queue_size', function(Request $request) use($app) { 
    $sql = "SELECT COUNT(id) as order_queue_size FROM orders_queue";

    $stmt = $app['db']->prepare($sql);
    
    $stmt->execute();
    
    $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('result' => $result));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('result' => $result));
    }
});

$app->run();

?>