<?php

if(isset($_FILES["uploadFile"]["name"]) && $_FILES["uploadFile"]["tmp_name"] != ""){
$dir = "img/";
$fileName = $_FILES["uploadFile"]["name"];
$file_temp =$_FILES["uploadFile"]["tmp_name"];
$fileType = $_FILES["uploadFile"]["type"];
$fileSize = $_FILES["uploadFile"]["size"];
$fileErr = $_FILES["uploadFile"]["error"];
$extension = strtolower(substr($fileName, strpos($fileName, '.') + 1));
$max_size = 10000000;
$uploaded_file = $dir.basename($fileName);
$uploadMeasure = 1;

if(isset($_POST["submit"])){
	$check = getimagesize($fileName);
	if($check !== false){
		$uploadMeasure = 1;
	} else {
		echo "File is not an image. <br>";
		$uploadMeasure = 0;
	}
}
if(file_exists($uploaded_file)){
	echo "Sorry, file already exists <br>";
	$uploadMeasure = 0;
} else if($fileSize > $max_size){
	echo "Sorry, your file it too large <br>";
	$uploadMeasure = 0;
} else if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif"){
	echo "Sorry, only jpg, png, jpeg, and png files are allowed <br>";
	$uploadMeasure = 0;
} else if(!$file_temp){
	echo "ERROR: Please browse file <br>";
	$uploadMeasure = 0;
}

else{

if(move_uploaded_file($file_temp, $dir.$fileName)){
	echo "$fileName upload is complete <br>";
} else {
	echo "move_uploaded_file function failed <br>";
}

}
} else{
	echo "Please choose a file for upload";
}

imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
?>
