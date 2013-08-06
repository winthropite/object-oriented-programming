<?php 

require_once 'actions.php'; 

$orders = \CDIA\Order::getOrders();

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css" media="screen">
body {
  padding-top: 50px;
}
#content {
  padding: 20px 0 0;
}
</style>
</head>
<body>
    
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CDIA Restaurant</a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="customer.php">Customer</a></li>
                <li class="active"><a href="chef.php">Chef</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container" id="content">
    <h2>CDIA Restaurant</h2>
    
    <?php if (count($orders) === 0): ?>
        <p>No Orders</p> 
    <?php else: ?>
        <ol>
            <?php foreach($orders as $order): ?>
                <li><?php echo $order['name']; ?> ordered <?php echo $order['meal']; ?></li>
            <?php endforeach; ?>
        </ol>
        
        <p><a href="actions.php?action=dequeue_order" class="btn btn-primary">Cook next meal in queue</a></p>
    <?php endif; ?>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>