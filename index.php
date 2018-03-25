<?php
require "/var/www/html/hk/inc/session-1.inc";
require "/var/www/html/hk/inc/dbinfo.inc";
$uid = $_SESSION["uid"];
$name1 = $_SESSION["name"][0];
?>
<!doctype html>
<html lang="en">
  <head>
<style>
td {
 	padding-left: 10px;
	 width:300px;
}
table{
	padding-right: 10px;	
}
img{
	/* padding-right: 50px; */
}
table tr{
 	width: 400px;
}
footer{
	position:fixed;
	bottom:0;
}
html {
  height: 100%;
}
body {
  min-height: 100%;
button{
padding-bottom: 50px!important;
}
}
.b {font-weight:bold;}
</style>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://s0.hfdstatic.com/sites/the_hartford/css/screen.min.css?v=2018-03-10_1444930866310">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <title>Item List | Household Items</title>
<script>
function changethislink(x) {
var newlink = "/hk/delete.php?n=" + x;
$("#changeme").attr("href", newlink);
}
</script>

<script>
var urlTest;

$(document).ready(function() 
{
	$('button').click(function() 
  {
		//$('#removeButton').attr('data-link', $(this).data('link'));
    		
			
		if ($(this).hasClass('remove-button'))
			{
			urlTest = $(this).data('link');
			$('#changeme').attr('href', $(this).data('link'));
			console.log(urlTest);
			//location.href='google.com';
			}
	//	if ($(this).hasClass('modal-delete'))
	//		location.href=urlTest;

  });
	$('#removeButton').click(function(){
		console.log(urlTest, 'Hello');
		location.href=urlTest;
	});
});
</script>
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1>Household Items | <?php echo "$name1's"; ?> List</h1>
      </div>
    </div><a href="/hk/add.php"><button type="button" class="btn btn-primary">Add Item</button></a> <a href="/hk/logout"><button type="button" class="btn btn-primary">Log Out</button></a><br><br>     
<?php
//require "/var/www/html/hk/assets/inc/session-1.inc";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "SELECT itmid,itmname,idmdesc, itmsn,itmvalue,itmats FROM tbl_items where pplid=$uid ORDER by itmats DESC;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	$img = date('mdy-His', strtotime($row["itmats"]));
	echo "<div class='row'><div class='col-sm-1'></div><div class='col-sm-3'><a href='/hk/images/ITEM-F-$img.jpg'><img src='/hk/images/ITEM-T-$img.jpg' style='width:400px;'></a></div>";
	echo "<div class='col-sm-6'><div class='container-fluid'><table class='table table-sm'><tr><td class='b'>Name</td><td>" . $row["itmname"] . "</td>";
	echo "</tr><tr><td class='b'>Description</td><td>" . $row["idmdesc"] . "</td></tr><tr><td class='b'>Value</td><td>$" . $row["itmvalue"] . "</td></tr><tr><td class='b'>Serial Number</td>";
	echo "<td>" . $row["itmsn"] . "</td></tr></table></div></div>";
	echo "<button type='button' class='btn btn-primary remove-button' data-toggle='modal' data-target='#deleteModal' data-link='remove.php?n=" . $row["itmid"] . "' onclick(changethislink(" . $row["itmid"] . ");)>Remove</button>&nbsp";
	echo "<button type='button' class='btn btn-primary' max-width=100%!important><a href ='edit.php?n=" . $row["itmid"] . "'>Edit</a></button>";
	echo "</div><div class='col-sm-1'></div>";


	//echo "<a href='/hk/images/ITEM-F-$img.jpg'><img src='/hk/images/ITEM-T-$img.jpg'></a>" . "<br>Name: " . $row["itmname"] . " - Desc: " . $row["idmdesc"] . "<br>SN: " . $row["itmsn"] . " - Price: $" . $row["itmvalue"] . ".";
	echo "<br>";
	} 
}
else {
//echo "<tr><td colspan='5'>No associations on record.  See links below.</td></tr>";
echo "<br><br><br><span style='color:red;font-weight:bold;text-align:center;font-size:20px;display:block;'>No items on record, please add one with the link above.</span><br><br><br>";
}
$conn->close();
?>

</div>
  <div class="col-sm-1"></div>
</div>
<br>
<br>
<div class="panel panel-default" style="background-color: black;color:white;"><center style="font-size:small"><h2 style="padding-top:10px;">TEAM PANDA - 2018</h2></center></div>

 <!-- The Removal Modal -->
 <div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Are you sure you wish to remove this item?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <a href="?" id='changeme'><button type="button" class="btn btn-primary modal-delete" data-dismiss="modal" id="removeButton">Delete</button></a>
      </div>

    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
  </body>

</html>
