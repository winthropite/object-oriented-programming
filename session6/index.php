<?php 

require 'actions.php';

$gallery = new \CDIA\Gallery(UPLOAD_PATH);

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
        <a class="navbar-brand" href="index.php">Photo Gallery</a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="add_photo.php">Add Photo</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container" id="content">
    <h2>Sports</h2>
    
    <?php foreach($gallery->photos as $photo): ?>
        <?php if ($photo->category === 'sports'): ?>
            <p><img src="<?php echo $photo; ?>" alt=""></p>
        <?php endif; ?>
    <?php endforeach; ?>

    <h2>Foods</h2>

    <?php foreach($gallery->photos as $photo): ?>
        <?php if ($photo->category === 'foods'): ?>
            <p><img src="<?php echo $photo; ?>" alt=""></p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>