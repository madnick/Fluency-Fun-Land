<?php
ini_set('display_errors','Off');
session_start();
if(!$_GET[id])
	echo "<script language=\"javascript\">
	        alert(\"ERROR::Unknown image\");
                document.location = \"achievements.php\";
                </script>";

if($_GET[user_id]!=$_SESSION[userid])
	echo "<script language=\"javascript\">
	        alert(\"ERROR::Unknown user\");
                document.location = \"achievements.php\";
                </script>";

        
$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

$query = "SELECT award_name, image_name FROM awards WHERE id = $_GET[id]";

$res = mysql_query($query) or die("ERROR::".mysql_error($connect));
$row = mysql_fetch_assoc($res) or die("ERROR:: Unable to fetch award details");

$query = "DELETE FROM awards 
	WHERE id = $_GET[id]   
	LIMIT 1";
if(!$del = mysql_query($query)){
	echo "<script language=\"javascript\">
	     alert(\"ERROR:: Not allowed to delete. This image and label $row[award_name] seems to be associated with one or more user awards!\");
                document.location = \"list_award_images.php\";
                </script>";
		die("ERROR::Not allowed to delete. This image and label $row[award_name] seems to be associated with one or more user awards!");
}else{
		unlink("./awards_assets/$row[image_name]") or die("ERROR::Unable to remove /awards_assets/$row[image_name] image file!");
}//End of else

	Header("Location: list_award_images.php");
?>
