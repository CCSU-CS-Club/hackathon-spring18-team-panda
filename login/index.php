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
$sql = "SELECT pplid,pplsalt,pplhash,pplname FROM `tbl_people` WHERE pplemail='$ema' limit 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	$uid = $row["pplid"];
	//$level = $row["maintlevel"];
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
<html>
<head>
<title>Login | Household Items</title>
<link rel="stylesheet" type="text/css" href="/pm/assets/css/loginstyle.css">
</head>
<body>
<div id="header">
		<h1 style="padding-left:6px;">Login</h1>
	</div>
	<div id="content">
		<br>
<form method="post" action="?">
		<table style="text-align:left;width:920px;">
			<tbody>
				<tr>
					<td colspan="2" style="background-color:white;text-align:left;"><img src="/pm/assets/icn/logop.svgx" style="height:400px;"></td>
				</tr>
				<tr>
			      		<td class="dh" colspan="2">Welcome to Household Items!</td>
			    	</tr>
			    	<tr>
					<td class='or' style="width:130px;">Email</td>	
					<td class='ol'><input type="text" name="ema" value="" required></td>					
			    	</tr>
				<tr>
					<td class='or'>Password</td>	
					<td class='ol'><input type="password" name="pwd" value="" required></td>					
			    	</tr>
				<tr>
					<td colspan=2" style="background-color:#ccc2df;"><br>
						<input type="submit" value="Login" style="width:400px;height:60px;font-size:28px;font-weight:bold;display:block;margin:auto;"><br>
						<input type="reset" value="Reset" style="width:400px;height:60px;font-size:28px;font-weight:bold;display:block;margin:auto;"><br>
					</td>
				</tr>
				<?php if ($_GET["e"] == 1) {echo "<tr><td colspan='2' style='background-color:red;color:white;font-weight:bold;'>Invalid username or password!</td></tr>";} ?>
			</tbody>
		</table>
</form>
		<br>
	</div>
</body>
</html>
