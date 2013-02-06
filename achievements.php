<?php 
session_start();
unset($_SESSION);
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
        	<li><a href="games.html">Activites</a><ul class="sub_menu">
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
<h2><span>Please Log in</span></h2>	
                <form action='login.php' method='POST'>
		Username<input type='text' name='username'><br>
		Password <input type='password' name='password'><br>
		<input type='submit' value='Log In'>
		</form>
      </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>

  <div align="center"><a href="register.php" class="header">Click here to create a user</a>
    
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
