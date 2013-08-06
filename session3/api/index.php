<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__.'/vendor/autoload.php'; 

$app = new Silex\Application();

$app['debug'] = true;

define('HOST', '127.0.0.1');
define('PORT', null);
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'cdia_restaurant');

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

$app->get('/queue_size', function(Request $request) use($app) { 
    $sql = "SELECT COUNT(id) as queue_size FROM orders_queue";

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

$app->post('/enqueue_order', function(Request $request) use($app) {
    try {
        $app['db']->beginTransaction();
        $sql = "INSERT INTO orders (meal, customer_id) VALUES (:meal, :customer_id)";
        
        $stmt = $app['db']->prepare($sql);
        $stmt->bindValue(':meal', $request->get('meal'), \PDO::PARAM_STR);
        $stmt->bindValue(':customer_id', $request->get('customer_id'), \PDO::PARAM_INT);
        
        $stmt->execute();
        
        $order_id = $app['db']->lastInsertId();
     
        $sql2 = "INSERT INTO orders_queue (order_id) VALUES (:order_id)";

        $stmt2 = $app['db']->prepare($sql2);
        $stmt2->bindValue(':order_id', $order_id, \PDO::PARAM_INT);

        $result = $stmt2->execute();
        
        if (!$app['db']->commit()) {
            $result = false;
        }  
    } catch(\PDOException $e) {
        $app['db']->rollBack();
        
        $result = false;
    }
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('result' => $result));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('result' => $result));
    }
});

$app->get('/dequeue_order', function(Request $request) use($app) {
    try {
        $app['db']->beginTransaction();
    
        $sql = "SELECT orders_queue.*, orders.* FROM orders_queue INNER JOIN orders ON orders.id = orders_queue.order_id ORDER BY orders_queue.id ASC LIMIT 1";

        $stmt = $app['db']->prepare($sql);
    
        $stmt->execute();
    
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        $sql2 = "DELETE FROM orders_queue WHERE id = :id";

        $stmt2 = $app['db']->prepare($sql2);
        
        if ($result !== false) {
            $stmt2->bindValue(':id', $result->id, \PDO::PARAM_INT);
        
            $stmt2->execute();
        }
    
        if (!$app['db']->commit()) {
            $result = false;
        }
    } catch(\PDOException $e) {
        $app['db']->rollBack();
        
        $result = false;
    }
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('result' => $result));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('result' => $result));
    }
});

$app->get('/get_orders', function(Request $request) use($app) {
    $sql = "SELECT orders_queue.*, orders.* FROM orders_queue INNER JOIN orders ON orders.id = orders_queue.order_id ORDER BY orders_queue.id ASC";

    $stmt = $app['db']->prepare($sql);

    $stmt->execute();

    $results = $stmt->fetchAll(\PDO::FETCH_OBJ);
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse(array('results' => $results));
    
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse(array('results' => $results));
    }
});

$app->run();

?>