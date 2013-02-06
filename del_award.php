<?php
ini_set('display_errors','Off');
session_start();
if(!$_GET[user_award_id] || !$_GET[user_id])
	echo "<script language=\"javascript\">
	        alert(\"ERROR::Unknown user award details\");
                document.location = \"achievements.php\";
                </script>";

if($_GET[user_id]!=$_SESSION[userid])
	echo "<script language=\"javascript\">
	        alert(\"ERROR::Unable to delete other user's session\");
                document.location = \"achievements.php\";
                </script>";

        
$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

$query = "DELETE FROM users_awards 
	WHERE user_award_id = $_GET[user_award_id]  AND 
	user_id = $_SESSION[userid] LIMIT 1";
        $del = mysql_query($query) or die("ERROR::Unable to execute query $query");

	Header("Location: view_awards.php");
?>
