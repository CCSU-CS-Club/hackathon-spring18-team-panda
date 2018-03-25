<?php
require "/var/www/html/hk/inc/session-1.inc";
require "/var/www/html/hk/inc/dbinfo.inc";
$uid = $_SESSION["uid"];
?>
<!DOCTYPE html>
<html>
<title>Process Item | Household Items</title>
<meta http-equiv="refresh" content="3; url= /hk/" />
<head>
    <link rel="stylesheet" href="https://s0.hfdstatic.com/sites/the_hartford/css/screen.min.css?v=2018-03-10_1444930866310">
    <link rel="stylesheet" href="linkstyle.css">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Household Items | Updated</h1>
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
///var_dump($_POST);
///echo "<br>";
///var_dump($_FILES);
require "/var/www/html/hk/inc/dbinfo.inc";
//// dynamic variables
$in = $_POST["itemname"];
$id = $_POST["itemdescription"];
$sn = $_POST["serial"];
$iv = $_POST["itemvalue"];
$n = $_POST["n"];
//update command
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
//$sql = "INSERT INTO `tbl_items` (`itmid`, `pplid`, `itmname`, `idmdesc`, `itmsn`, `itmvalue`, `itmats`) VALUES (NULL, '1', '$in', '$id', '$sn', '$iv', '$nowfull');";
//$sql = "UPDATE `tbl_items` SET `idmdesc` = '$id' WHERE `tbl_items`.`itmid` = 4;";
$sql = "UPDATE `tbl_items` SET `itmname`='$in',`idmdesc`='$id',`itmsn`='$sn',`itmvalue`='$iv' WHERE tbl_items.itmid=$n";
if ($conn->query($sql) === TRUE) {
	//echo "New record created successfully";
	//echo "Item added correctly";
	//$statusx = "1";$filex="check_markp";
	echo "Item updated complete!<br><br><img src='/hk/check_mark.png' style='display:block;margin:auto;'><br><br>You will be redirected to the item list in 3 seconds.</b>";
} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
	//echo "Error adding item";
	//$statusx = "2";$filex="cross_markp";
	echo "Error updating item!<br><br><img src='/hk/cross_mark.png' style='display:block;margin:auto;'><br><br><b>You will be redirected to the item list in 3 seconds.</b>";
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
