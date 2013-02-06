<?php
ini_set('display_errors','Off');
session_start();
//unset($_SESSION);

$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password) {

$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

$query = mysql_query("SELECT * FROM users WHERE username='$username' AND Password= MD5('$password')");

$numrows = mysql_num_rows($query);


if($numrows > 0) {

	while ($row = mysql_fetch_assoc($query))
	{
		$dbusername = $row['username'];
		$dbpassword = $row['Password'];
		$user_id = $row['id'];
	}
	
	//check to see if they match
	if ($username==$dbusername&&md5($password)==$dbpassword)
	{
		echo "Your in! <a href='member.php'>Click</a> here to enter the member page.";
		$_SESSION['username']=$dbusername;
		$_SESSION['userid']=$user_id;
	        Header('Location: member.php');
	}
	else
		echo "<script language=\"javascript\">
		alert(\"Incorrect Username or Password\");
	        document.location = \"achievements.php\";
		</script>";

}
else
		echo "<script language=\"javascript\">
		alert(\"Incorrect Username or Password\");
	        document.location = \"achievements.php\";
		</script>";
}
?>
