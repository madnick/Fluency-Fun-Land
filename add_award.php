<?php
ini_set('display_errors','Off');
session_start();
if(!$_SESSION[username])
	print "<script language=\"javascript\">
	alert(\"ERROR:: Unknown user\");
        document.location = \"achevements.php\";
	</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fluency Fun Land - Awards</title>
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
        	<li><a href="member.php">Home</a></li>
			<li><a href="about.html">About</a></li>
        	<li><a href="games.html">Games</a><ul class="sub_menu">
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
[ <a href="member.php">back to menu</a> ]
[ <a href="list_award_images.php">view list of award images</a> ]


<table cellpadding="2" border="1" >
<form method="post" action="add_award_do.php" enctype="multipart/form-data">
<h3>Add new award image</h3>
<table cellpadding='4' cellspacing='1' border='0' width="100%">
       <tr><td colspan='2'> 
       Upload Image File: <input type='file' name='file_name'>&nbsp;
       Image Label: <input type='text' name='award_name' size='15' maxlength='30'>&nbsp;
       <input type='submit' value='Submit'>
       [ <a href="member.php">cancel</a> ]
       </form>
       </td></tr>
 </table>
 </form>
</body>
</html>
