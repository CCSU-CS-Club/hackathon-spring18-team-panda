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
            <h1>Household Items | Edit</h1>
        </div>
    </div>
</head>

<body>
    <a href="/hk">
        <button type="button" class="btn btn-primary">Return to list</button>
    </a> <a href="/hk/logout"><button type="button" class="btn btn-primary">Log Out</button></a><br><br>
    <div class="container">
        <h2>Edit your item:</h2>
        <form action="update.php" method="post">

<?php
require "/var/www/html/hk/inc/dbinfo.inc";
$n = $_GET["n"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "SELECT itmid,itmname,idmdesc, itmsn,itmvalue,itmats FROM tbl_items where itmid=$n;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	
echo "<div class='form-group'><label for='itemname'>Item Name:</label>";
echo "<input type='text' class='form-control' id='itemname' placeholder='Enter item name' name='itemname' value='" . $row["itmname"] . "'>";
echo "</div><div class='form-group'><label for='itemdescription'>Item Description:</label>";
echo "<input type='text' class='form-control' id='itemdescription' placeholder='Enter item description' name='itemdescription' value='" . $row["idmdesc"] . "'>";
echo "</div><div class='form-group'><label for='serial'>Serial Number (if applicable):</label>";
echo "<input type='text' class='form-control' id='serial' placeholder='Enter serial number' name='serial' value='" . $row["itmsn"] . "'>";
echo "</div><div class='form-group'><label for='itemvalue'>Item Value ($):</label>";
echo "<input type='text' class='form-control' id='itemvalue' placeholder='Enter item name' name='itemvalue' value='" . $row["itmvalue"] . "'>";
echo "</div><div class='row'><div class='col-sm-3'><button type='submit' class='btn btn-primary'>UPDATE</button>";
echo "</div><div clas='col-sm-3'><input type='hidden' name='n' value='$n'><a href='/hk/'><button type='button' class='btn btn-primary'>Cancel Edit</button></a></div></div>";
	//echo "<a href='/hk/images/ITEM-F-$img.jpg'><img src='/hk/images/ITEM-T-$img.jpg'></a>" . "<br>Name: " . $row["itmname"] . " - Desc: " . $row["idmdesc"] . "<br>SN: " . $row["itmsn"] . " - Price: $" . $row["itmvalue"] . ".";
	echo "<br>";
	} 
}
else {
//echo "<tr><td colspan='5'>No associations on record.  See links below.</td></tr>";
}
$conn->close();
?> 
        </form>
    </div>
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
