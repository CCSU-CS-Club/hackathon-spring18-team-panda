<html>
<head>
<title>Process Item | Household Items</title></head>
<body>
<?php
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
echo "Success!!!";
}else{
print_r($errors);
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
echo "<img src='./images/$newfilenamet_1' style='margin:auto;display:block;border:red solid 2px;'>";
echo "<br>";
echo "<img src='./images/$newfilenamef_1' style='margin:auto;display:block;border:red solid 2px;'>";
}
echo "$nowfull or $dtnowx";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
$sql = "INSERT INTO `tbl_items` (`itmid`, `pplid`, `itmname`, `idmdesc`, `itmsn`, `itmvalue`, `itmats`) VALUES (NULL, '1', 'auto1', 'auto2', 'auto3', '111.11', '$nowfull');";
if ($conn->query($sql) === TRUE) {
	//echo "New record created successfully";
	echo "Item added correctly";
	//$statusx = "1";$filex="check_markp";
} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
	echo "Error adding item";
	//$statusx = "2";$filex="cross_markp";
}
?>
</body></html>
