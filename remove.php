<?php
require "/var/www/html/hk/inc/session-1.inc";
require "/var/www/html/hk/inc/dbinfo.inc";
$uid = $_SESSION["uid"];
?>
<!DOCTYPE html>
<html>
<title>Removed Item | Household Items</title>
<meta http-equiv="refresh" content="3; url= /hk/" />
<head>
    <link rel="stylesheet" href="https://s0.hfdstatic.com/sites/the_hartford/css/screen.min.css?v=2018-03-10_1444930866310">

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Household Items | Removed</h1>
        </div>
    </div>
</head>

<body>
    <a href="/hk">
        <button type="button" class="btn btn-primary">Return to list</button>
    </a> <a href="/hk/logout"><button type="button" class="btn btn-primary">Log Out</button></a><br><br>
    <div class="container">
        <!-- <h2>Edit your item:</h2> -->
<?php
require "/var/www/html/hk/inc/dbinfo.inc";
$n = $_GET["n"];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "DELETE FROM `tbl_items` WHERE `tbl_items`.`itmid` = $n;";
if ($conn->query($sql) === TRUE) {
	//echo "New record created successfully";
	echo "Item removed complete!<br><br><img src='/hk/check_mark.png' style='display:block;margin:auto;'><br><br>You will be redirected to the item list in 3 seconds.</b>";
	//$statusx = "1";$filex="check_markp";
} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
	echo "Error removing item!<br><br><img src='/hk/cross_mark.png' style='display:block;margin:auto;'><br><br><b>You will be redirected to the item list in 3 seconds.</b>";
	//$statusx = "2";$filex="cross_markp";
}
$conn->close();
?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<br><br><br><br>
<div class="panel panel-default" style="background-color: black;color:white;"><center style="font-size:small"><h2 style="padding-top:10px;">TEAM PANDA - 2018</h2></center></div>
</body>
</html
