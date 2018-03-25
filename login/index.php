<?php
session_start();
$_SESSION["level"] = "0";
if (isset($_POST["ema"]) && !empty($_POST["pwd"])) {
    //echo "Yes, mail is set";  
$ema = $_POST["ema"];
$pwd = $_POST["pwd"];
$servername = "localhost";
$username = "panda";
$password = "panda";
$dbname = "panda";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "SELECT pplid,pplsalt,pplhash,pplname,ppllevel FROM `tbl_people` WHERE pplemail='$ema' limit 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	$uid = $row["pplid"];
	$level = $row["ppllevel"];
	$salt = $row["pplsalt"];
	$hash = $row["pplhash"];
	$name = explode(" ",$row["pplname"]);}
} else {
//echo "naw";
}
if ($hash == crypt($pwd, $hash)) {
$_SESSION["uid"] = $uid;
$_SESSION["level"] = $level;
$_SESSION["name"] = $name;
//$userip = $_SERVER['REMOTE_ADDR'];
//$whenx = date( 'Y-m-d H:i:s');
$sql = "UPDATE `tbl_maintainers` SET `maintlastlogin` = '$whenx', `maintlastip` = '$userip' WHERE `tbl_maintainers`.`maintainid` = $uid;";
$result = $conn->query($sql);
$conn->close();
header( 'Location: /hk/' ) ;
//echo "success";
} else {
$_SESSION["level"] = "0";
//echo "fail";
header( 'Location: /hk/login/?e=1' ) ;
}  
}else{  
    //echo "N0, mail is not set";
}
?>
<!DOCTYPE html>
<html>
<title>Login | Household Items</title>
<!--<meta http-equiv="refresh" content="3; url= /hk/login/" />-->
<head>
    <link rel="stylesheet" href="https://s0.hfdstatic.com/sites/the_hartford/css/screen.min.css?v=2018-03-10_1444930866310">
    <!--<link rel="stylesheet" href="linkstyle.css">-->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Household Items | Welcome</h1>
        </div>
    </div>
</head>
<body>
    <!--<a href="/hk">
        <button type="button" class="btn btn-primary">Return to list</button>
    </a> <a href="/hk/logout"><button type="button" class="btn btn-primary">Log Out</button></a><br><br>-->
    <div class="container">

<form method="post" action="?" style="margin:auto;display:block;">
		<table style="text-align:left;width:100%;margin:auto;background-color:#eacfcf;">
			<tbody>
				<tr>
					<td colspan="2" style="background-color:white;text-align:left;">       <img src="/hk/login_graphic.png" style="height:400px;margin:auto;display:block;"></td>
				</tr>
			    	<tr>
					<td class='or' style="width:130px;font-weight:bold;">&nbsp;&nbsp;Email</td>	
					<td class='ol'><input type="text" name="ema" value="" required></td>					
			    	</tr>
				<tr>
					<td class='or' style="font-weight:bold;">&nbsp;&nbsp;Password</td>	
					<td class='ol'><input type="password" name="pwd" value="" required></td>					
			    	</tr>
				<tr>
					<td colspan=2" style="background-color:#cbf5fb;"><br>
						<input type="submit" value="Login" style="width:400px;height:60px;font-size:28px;font-weight:bold;display:block;margin:auto;"><br>
						<input type="reset" value="Reset" style="width:400px;height:60px;font-size:28px;font-weight:bold;display:block;margin:auto;"><br>
					</td>
				</tr>
				<?php if ($_GET["e"] == 1) {echo "<tr><td colspan='2' style='background-color:red;color:white;font-weight:bold;'>Invalid username or password!</td></tr>";} ?>
			</tbody>
		</table>
</form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<br><br>
<div class="panel panel-default" style="background-color: black;color:white;"><center style="font-size:small"><h2 style="padding-top:10px;">TEAM PANDA - 2018</h2></center></div>
</body>
</html
