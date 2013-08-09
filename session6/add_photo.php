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
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="add_photo.php">Add Photo</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container" id="content">
    <h2>Add Photo</h2>
    
    <form method="post" action="actions.php?action=add_photo" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
                <p><label>Select a Category</label>
                <select name="category">
                    <option value="">Select One</option>
                    <option value="sports">Sports</option>
                    <option value="foods">Foods</option>
                </select></p>
            </div>
            
            <div class="form-group">
                <p><label>Select a file</label>
                <input type="file" name="photo"></p>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </fieldset>
    </form>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>