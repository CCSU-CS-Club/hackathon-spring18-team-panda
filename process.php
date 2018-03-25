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
            <h1>Household Items | Added</h1>
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
//// global vars
$dtnowx = date("mdy-His");
$nowfull = date('Y-m-d H:i:s');
$fullsize = 2560;
$thumbsize = 400;
$fullquality = 90;
$thumbquality = 70;
$maximgsize = 20000000;
//// dynamic variables
$in = $_POST["itemname"];
$id = $_POST["itemdescription"];
$sn = $_POST["serial"];
$iv = $_POST["itemvalue"];
//// setting new filenames based off the type
$newfilenamet_1 = "ITEM-T-$dtnowx.jpg";
$newfilenamef_1 = "ITEM-F-$dtnowx.jpg";
//// file checks
if(isset($_FILES['image1'])){
$errors= array();
$file_name_1 = $dtnowx . $_FILES['image1']['name'];
$file_size_1 = $_FILES['image1']['size'];
$file_tmp_1 = $_FILES['image1']['tmp_name'];
$file_type_1 = $_FILES['image1']['type'];
$file_ext_1 =strtolower(end(explode('.',$_FILES['image1']['name'])));
//// check file extensions
if(($file_ext_1 == "jpg") or ($file_ext_1 == "jpeg") or ($file_ext_1 == "png")) {
//// extensions are all good!
} else {
$errors[]="extension not allowed, please choose a JPEG, JPG, or PNG file.";
}
//// check file size of the image and error when it is above 10MiB
if($file_size_1 > $maximgsize){
$errors[]='File size must be less than 20 MB';
}
//// move images from TMP to IMAGES
if(empty($errors)==true){
move_uploaded_file($file_tmp_1,"./images/".$file_name_1);
//echo "Success!!!";
}else{
//print_r($errors);
}
//// create two new image instances
$thumb_1 = new Imagick();
$full_1 = new Imagick();
//// load the images into the image instances
$thumb_1->readImage("./images/$file_name_1");
$full_1->readImage("./images/$file_name_1");
//// factoring in the user submited rotation and resize the image based on type
//// resize the images to thumbsize and fullsize
$thumb_1->resizeImage($thumbsize,0,Imagick::FILTER_LANCZOS,1);
$full_1->resizeImage($fullsize,0,Imagick::FILTER_LANCZOS,1);
//// exif correction
$thumb_1->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
$full_1->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
//// setting compressing values
$thumb_1->setImageCompression(Imagick::COMPRESSION_JPEG); 
$full_1->setImageCompression(Imagick::COMPRESSION_JPEG);
//// setting quality values
$thumb_1->setImageCompressionQuality($thumbquality);
$full_1->setImageCompressionQuality($fullquality);
//// writing the images
$thumb_1->writeImage("./images/$newfilenamet_1");
$full_1->writeImage("./images/$newfilenamef_1");
//// free the two image variables
$thumb_1->clear();
$full_1->clear();
//// delete the origional uploaded file so it doesnt take up disk space long term
unlink ("./images/$file_name_1");
//// present the images
//echo "<img src='./images/$newfilenamet_1' style='margin:auto;display:block;border:red solid 2px;'>";
//echo "<br>";
//echo "<img src='./images/$newfilenamef_1' style='margin:auto;display:block;border:red solid 2px;'>";
}
//echo "$nowfull or $dtnowx";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO `tbl_items` (`itmid`, `pplid`, `itmname`, `idmdesc`, `itmsn`, `itmvalue`, `itmats`) VALUES (NULL, '$uid', '$in', '$id', '$sn', '$iv', '$nowfull');";
if ($conn->query($sql) === TRUE) {
	//echo "New record created successfully";
	//echo "Item added correctly";
	//$statusx = "1";$filex="check_markp";
	echo "Item addition complete!<br><br><img src='/hk/check_mark.png' style='display:block;margin:auto;'><br><br>You will be redirected to the item list in 3 seconds.</b>";
} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
	//echo "Error adding item";
	//$statusx = "2";$filex="cross_markp";
	echo "Error adding item!<br><br><img src='/hk/cross_mark.png' style='display:block;margin:auto;'><br><br><b>You will be redirected to the item list in 3 seconds.</b>";
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
