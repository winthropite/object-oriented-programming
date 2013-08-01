<?php require_once 'actions.php'; ?>
<?php if (!$auth->isLoggedIn()) { header('Location: index.php'); } ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
    
<h3>Welcome <?php echo $_SESSION['username']; ?></h3>
<p><a href="actions.php?action=logout">Logout</a></p>

</body>
</html>