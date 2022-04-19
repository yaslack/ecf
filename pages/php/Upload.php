<?php

if(isset($_POST["submitFacade"])){
  uploadFacade();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function uploadFacade(){
  if ( !isset($_SESSION) ) session_start();
  $ORDER = $_SESSION['name'][4];
  $path = "../../assets/hotels/".$ORDER."/facade/";
  $name = "facade.png";
  uploadImage($path,$name);
}
function uploadRoom(){
  if ( !isset($_SESSION) ) session_start();
  $ORDER = $_SESSION['name'][4];
  $path = "../../assets/hotels/".$ORDER."/room/";
  uploadImage($path,"room");
}
function uploadImage($targetPath,$name){
$target_dir = $targetPath;
$target_file = $target_dir . basename($name);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
  echo "Sorry, only JPG, JPEG & PNG files are allowed.";
  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    
    echo "Sorry, there was an error uploading your file.";
  }
  
}

}

?>