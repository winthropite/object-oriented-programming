<?php require_once 'actions.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
    
<form action="actions.php?action=login" method="post">
    <p><label>Username: </label>
    <input type="text" name="username"></p>
    
    <p><label>Password: </label>
    <input type="password" name="password"></p>
    
    <p><input type="submit" name="submit" /></p>
</form>

</body>
</html>