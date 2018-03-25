<?php
session_start();
require "/var/www/html/hk/inc/dbinfo.inc";
$_SESSION["level"] = "0";
if (isset($_POST["ema"]) && !empty($_POST["pwd"])) {
    echo "Yes, mail is set";  
$ema = $_POST["ema"];
$pwd = $_POST["pwd"];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "SELECT pplname,pplcode FROM `tbl_people` WHERE pplemail='$ema' limit 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	echo "found";
	$uid = $row["pplid"];
	//$level = $row["maintlevel"];
	//$salt = $row["maintsalt"];
	$code = $row["pplcode"];
	//$hash = $row["mainthash"];
	$name = explode(" ",$row["pplname"]);}
} else {
//echo "naw";
}
if ($code == $pwd) {
$_SESSION["uid"] = $uid;
//$_SESSION["level"] = $level;
$_SESSION["name"] = $name;
$conn->close();
header( 'Location: /hk/' ) ;
//echo "success";
} else {
//echo "code = $code";
//$_SESSION["level"] = "0";
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
</head>
<body>
<div id="header">	
<form method="post" action="?">
		<table style="text-align:left;width:920px;">
			<tbody>
				
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
					<td colspan=2"><br>
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
<?php require '/var/www/html/hk/inc/footer.inc'; ?>
</body>
</html>
