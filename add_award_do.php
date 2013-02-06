<?php
ini_set('display_errors','Off');
session_start();

//print_r($_SESSION);
/*
 Date:    02/11/2011
 Author:  Sasha Ivkovic 
 Usage:   Allow user to upload award image and supply the label
	  Uploaded file will be stored in the default images directory
	  File name will be randomly generated and 
	  stored in DB together with the label
 */

//Set some defaults
$image_allowed = array("jpg","jpeg","gif","png"); //Add to the list if needed
$image_max_size = 1000000; //1MB Size in bytes - Increase if needed

//Handle file upload
$my_file = ($_FILES['file_name']['name']);
$size = ($_FILES['file_name']['size']);
$tmp_name = ($_FILES['file_name']['tmp_name']);

//In case javascript validation failed catch empty submissions
if($_POST[award_name] == ""){ 
  print "<script language=\"javascript\">
  alert(\"Please provide award image label!\");
  document.location = \"$_SERVER[HTTP_REFERER]\";
  exit();
  </script>";
  die("ERROR::Please provide award image label!");
}//End of if
//Check file size
if($size > $image_max_size){ 
  print "<script language=\"javascript\">
  alert(\"ERROR::File $my_file is too large for upload ($size bytes)\");
  document.location = \"$_SERVER[HTTP_REFERER]\";
  exit();
  </script>";
  die("ERROR::File $my_file is too large for upload ($size bytes)");
}//End of if
//Handle empty upload
if($my_file ==""){ 
  print "<script language=\"javascript\">
  alert(\"ERROR::Nothing uploaded...Please click on 'Browse' to select a file\");
  document.location = \"$_SERVER[HTTP_REFERER]\";
  exit();
  </script>";
  die("ERROR::Nothing uploaded...Please click on 'Browse' to select a file");
}//End of if

//Check for allowed image file extensions
foreach($image_allowed as $allowed)
  $only_allowed.="$allowed ";

//Get length of the file extension (e.g. jpeg is 4 chars while jpg is 3 chars)
$extension_num_chars = strlen(strrchr($my_file ,".")) - 1;
//Use the length to get actual file extension 
$file_ext = strtolower(substr($my_file, - $extension_num_chars)) ;
//Assign new file name
$new_file_name = basename($tmp_name).".".$file_ext;
$new_name="./awards_assets/$new_file_name";
//Check if file extension is allowed
if(!in_array($file_ext,$image_allowed)){//img_allowed is array([0]=>gif,[1]=>jpeg) defined above 
  print "<script language=\"javascript\">
  alert(\"Sorry, $file_ext file extension not allowed::Allowed file types are: $only_allowed\");
  document.location = \"$_SERVER[HTTP_REFERER]\";
  exit();
  </script>";
  die("Sorry, $file_ext file extension not allowed::Allowed file types are: $only_allowed");
}//End of if
  //Check if file is uploaded on the server
  if(is_uploaded_file($tmp_name)){
    if(!copy($tmp_name, $new_name))
	  die("ERROR::Unable to copy file $my_file as $new_name");
  }//End of if

//If all OK here  
$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

$query = "INSERT INTO awards (award_name, image_name) 
	VALUES (\"$_POST[award_name]\", \"$new_file_name\")";

if(!$res = mysql_query($query,$connect))
	die("ERROR::".mysql_error($connect));
Header("Location: list_award_images.php");
