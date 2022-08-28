<?php

if(isset($_POST["submitFacade"])){
  uploadFacade();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST["submitRooms"])){
  uploadRooms();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function uploadFacade(){
  if ( !isset($_SESSION) ) session_start();
  $ORDER = $_SESSION['name'][4];
  $path = "../../assets/hotels/".$ORDER."/facade/";
  $name = "facade.png";
  uploadImage($path,$name);
}
function uploadRooms(){
  if ( !isset($_SESSION) ) session_start();
  $ORDER = $_SESSION['name'][4];
  $path = "../../assets/hotels/".$ORDER."/room/";
  delTree($path);
  uploadMultipleDescription($path,"description");
  uploadMultiple($path,"files");
}

function  uploadMultiple($path,$name){
  if(isset($_FILES[$name])){
    // Count # of uploaded files in array
  $total = count($_FILES[$name]['name']);

    // Loop through each file
    for( $i=0 ; $i < $total ; $i++ ) {

      $target_dir = $path;
      $target_file = $target_dir.basename("room".($i+1).".png");

      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      
      $check = getimagesize($_FILES[$name]["tmp_name"][$i]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES[$name]["size"][$i] > 500000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "png") {
        echo "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        
        if (move_uploaded_file($_FILES[$name]["tmp_name"][$i], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES[$name]["tmp_name"][$i])). " has been uploaded.";
        } else {
          
          echo "Sorry, there was an error uploading your file.";
        }
        
      }
    }
  }
}

function delTree($dir) {
  $files = glob( $dir . '*', GLOB_MARK );
  foreach( $files as $file ){
      if( substr( $file, -1 ) == '/' )
          delTree( $file );
      else
          unlink( $file );
  }
  rmdir( $dir );
}

function  uploadMultipleDescription($path,$name){
  if(isset($_POST[$name])){
    // Count # of uploaded files in array
  $total = count($_POST[$name]);
    // Loop through each file
    for( $i=0 ; $i < $total ; $i++ ) {
      mkdir($path);
      $myfile = fopen($path."room".($i+1).".txt", "w") or die("Unable to open file!");
      $txt = $_POST[$name][$i];
      fwrite($myfile, $txt);
      fclose($myfile);
    }
  }
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
if ($_FILES["fileToUpload"]["size"] > 5000000) {
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