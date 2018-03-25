<?php
require "/var/www/html/hk/inc/session-1.inc";
require "/var/www/html/hk/inc/dbinfo.inc";
$uid = $_SESSION["uid"];
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://s0.hfdstatic.com/sites/the_hartford/css/screen.min.css?v=2018-03-10_1444930866310">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Household Items | Add</h1>
        </div>
    </div>
</head>

<body>
    <a href="/hk/">
        <button type="button" class="btn btn-primary">Return to list</button>
    </a>
    <div class="container">
        <h2>Add a valuable item:</h2>
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Image:</label>
                <input type="file" class="form-control" id="image1" placeholder="Select image" name="image1">
            </div>
            <div class="form-group">
                <label for="itemname">Item Name:</label>
                <input type="text" class="form-control" id="itemname" placeholder="Enter item name" name="itemname">
            </div>
            <div class="form-group">
                <label for="itemdescription">Item Description:</label>
                <input type="text" class="form-control" id="itemdescription" placeholder="Enter item description" name="itemdescription">
            </div>
            <div class="form-group">
                <label for="serial">Serial Number (if applicable):</label>
                <input type="text" class="form-control" id="serial" placeholder="Enter serial number" name="serial">
            </div>
            <div class="form-group">
                <label for="itemvalue">Item Value:</label>
                <input type="text" class="form-control" id="itemvalue" placeholder="Enter item name" name="itemvalue">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <br>
    <br>
<div class="panel panel-default" style="background-color: black;color:white;"><center style="font-size:small"><h2 style="padding-top:10px;">TEAM PANDA - 2018</h2></center></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html
