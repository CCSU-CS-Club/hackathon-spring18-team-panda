<?php
// work with PHP sessions
session_start();
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy();
?>
<html>
<head>
<title>???</title>
<meta http-equiv="refresh" content="3; url= /hk/login/" />
</head>
<body>
<div id="header">
		<h1 style="padding-left:6px;">Logout</h1>
	</div>
	<div id="content">
		<br>
		<table style="text-align: left; width: 920px; ">
			<tbody>
				<tr>
			      		<td class="dh">Goodbye!</td>
			    	</tr>
			    	<tr>
					<td class='oc' style="text-align:left;font-weight:normal;background-color:white;height:150px;"><b>-</b>You have been <b>logged out</b>.<br><b>-</b>You will be <b>redirected</b> to the <b>login screen</b> in <b>3 seconds</b>.</td>					
			    	</tr>
			</tbody>
		</table>
		<br>
	</div>
</body>
</html>
