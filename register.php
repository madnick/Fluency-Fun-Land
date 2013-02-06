<?php   
  
if( isset($_POST['submit']) && $_POST['submit'])
{ 
//form data

$fullname = strip_tags($_POST['fullname']);
$username = strtolower(strip_tags($_POST['username']));
$password = strip_tags($_POST['password']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");

if (isset($_POST['submit']) && $_POST['submit'])
{

	//open database
	$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
	mysql_select_db("tepps") or die ("Couldnt find db");

	$namecheck = mysql_query("SELECT username FROM users WHERE username='$username'");
	$count = mysql_num_rows($namecheck);

	if ($count!=0)
	{
				echo "<script language=\"javascript\">
				alert(\"Error: Username already exist!\");
	       		document.location = \"register.php\";
				</script>";	}
	//check for existance
	if ($fullname&&$username&&$password&&$repeatpassword)
	{


		if ($password==$repeatpassword)
		{
			//check char legnth of username and fullname
			if (strlen($username)>25||strlen($fullname)>25)
			{
				echo "<script language=\"javascript\">
				alert(\"Error: Legnth of username or fullname is too long!\");
	       		document.location = \"register.php\";
				</script>";
			}
			else
			{
				//check password length
				if (strlen($password)>1000||strlen($password)<6)
				{
					echo "<script language=\"javascript\">
					alert(\"Error: Password must be between 6 and 25 characters\");
	       		 	document.location = \"register.php\";
					</script>";
				}
				else
				{
					//register the user
					
					//encrypt password
					$password = md5($password);
					$repeatpassword = md5($repeatpassword);
					

					
					$queryreg = mysql_query("
					
					INSERT INTO users VALUES ('$username','$password','$fullname','$date','')
					
					");

					die("You have been sucessfully registered! <a href='achievements.php'>Return to login page</a>");
				}
			}
		}
		else
			echo "<script language=\"javascript\">
			alert(\"Error: Your password do not match\");
	        	document.location = \"register.php\";
			</script>";
	}
	else

		echo "<script language=\"javascript\">
		alert(\"Fill in all fields\");
	        document.location = \"register.php\";
		</script>";
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fluency Fun Land - Achievements</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
</head>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html"><span>  </span></a></h1></div>
		<div id="page-wrap">
        <ul class="dropdown">
        	<li><a href="index.html">Home</a></li>
			<li><a href="about.html">About</a></li>
        	<li><a href="games.html">Activities</a><ul class="sub_menu">
        			<li><a href="wordandpictures.html">Words and Pictures</a></li>
        			<li><a href="colourin.html">Colour-In</a></li>
        			<li><a href="memory.html">Memory</a></li>
        			<li><a href="hotspots.html">Hotspots</a></li>
           			<li><a href="jigsaw.html">Jigsaw</a></li>
        	</ul>
			</li>
            <li><a href="achievements.php">Achievements</a></li>
        	<li><a href="contact.html">Contact Us</a></li>
        </ul>
		</div>
  </div>

  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="aboutus">
	<h2><span>Please enter details to register</span></h2>
	<form action='register.php' method='POST'>
	<div align="center">
	Password must be between 6-25 characters and contain at least one numerical character (0-9).</p>
	  <table align="center">
	    <tr>
	      <td>
	        Your full name:
	        </td>
	      <td>
	        <input type='text' name='fullname' value='<?php echo @$fullname; ?>'>
	        </td>
	      </tr>
	    
	    <tr>
	      <td>
	        Choose a username:
	        </td>
	      <td>
	        <input type='text' name='username' value='<?php echo @$username; ?>'>
	        </td>
	      </tr>

	    <tr>
	      <td>
	        Choose a password:
	        </td>
	      <td>
	        <input type='password' name='password'>
	        </td>
	      </tr>
	    
	    <tr>
	      <td>
	        Repeat your password:
	        </td>
	      <td>
	        <input type='password' name='repeatpassword'>
	        </td>
	      </tr>
	    
	    </table>
	  </div>
	<p>
	  <input type='submit' name='submit' value='Register'>
		</form>
      </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
      <div align="center">
  </div>
  <div class="footer">
    <div class="footer_resize">
      <ul class="fmenu">
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="games.html">Activities</a></li>
		  <li class="active"><a href="achievements.php">Achievements</a></li>
          <li><a href="contact.html">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
  </div>
</body>
</html>

