<?php require_once 'actions.php'; ?>
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
  padding: 20px 15px;
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
                <li class="active"><a href="customer.php">Customer</a></li>
                <li><a href="chef.php">Chef</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container" id="content">
    <h2>CDIA Restaurant</h2>

    <form method="post" action="actions.php?action=enqueue_order">
        <fieldset>
            <div class="form-group">
                <p><label>Customer</label>
                <select name="customer_id" class="form-control">
                    <option value="">Select One</option>
                    <option value="1">Customer 1</option>
                    <option value="2">Customer 2</option>
                    <option value="3">Customer 3</option>
                </select></p>
            </div>

            <div class="form-group">
                <p><label>Meal</label>
                <textarea name="meal" class="form-control"></textarea></p>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </fieldset>
    </form>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>