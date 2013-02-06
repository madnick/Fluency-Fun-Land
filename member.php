
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
 <script type="text/javascript"> 
 function check() { 
 document.getElementById("checkbox").checked = "checked"; 
 } 
 </script> 
</head>
<body>

  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html"><span>  </span></a></h1></div>
		<div id="page-wrap">
        <ul class="dropdown">
        	<li><a href="index.html">Home</a></li>
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

  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="aboutus">
	<h2><span>Create Achievements</span></h2>
<?php

session_start();
//print_r($_SESSION);
if ($_SESSION['username'])
	echo "Welcome, ".$_SESSION['username']."!<br>
	<a href='achievements.php'>Logout</a>";
else
	die("You must be logged in!");
	
?><br />
<form name="skills" method="POST" action="insertskills.php">
Welcome to the award section
   <? echo "$html_skills"; ?>
   <br>
  <div align="center"><a href="awards.php" class="header">Click here to create a new award</a>
  
  <div align="center"><a href="view_awards.php" class="header">View Awards</a>
  <div align="center"><a href="list_award_images.php" class="header">View List of Award Images</a>
  <div align="center"><a href="add_award.php" class="header">Upload Award Image</a>


      </div>
      <div class="clr"></div>
    </div>
  </div>

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
<?php

function get_checkbox_labels($table_name) {

  /* make an array */
  $arr = array();
  
  /* construct the query */
  $query = "SELECT * FROM $table_name";
  
  /* execute the query */
  $qid = mysql_query($query);

  /* each row in the result set will be packaged as
     an object and put in an array */
  while($row= mysql_fetch_object($qid)) {
    array_push($arr, $row);
  }
  
  return $arr;
}

/* Prints a nicely formatted table of checkbox choices.
   
   $arr is an array of objects that contain the choices
   $num is the number of elements wide we display in the table
   $width is the value of the width parameter to the table tag
   $name is the name of the checkbox array
   $checked is an array of element names that should be checked
*/   


function make_checkbox_html($arr, $num, $width, $name, $checked) {
  
  /* create string to hold out html */
  $str = "";
  
  /* make it */
  $str .= "<table width=\"$width\" border=\"0\">\n";
  $str .= "<tr>\n";

  /* determine if we will have to close add
     a closing tr tag at the end of our table */
  if (count($arr) % $num != 0) {
    $closingTR = true;
  }
  
  $i = 1;
  if (isset($checked)) {
    /* if we passed in an array of the checkboxes we want
       to be displayed as checked */
    foreach ($arr as $ele) {
      $str .= "<td><input type=\"checkbox\" name=\"$name\" value=\"$ele->id\"";
      foreach ($checked as $entry) {
    if ($entry == $ele->value) {
      $str .= "checked";
          continue;
        }
      }
      $str .= ">";
      $str .= "$ele->value";

      if ($i % $num == 0) {
        $str .= "</tr>\n<tr>";
      } else {
        $str .= "</td>\n";
      }
      $i++;
    }
  
  } else {
    /* we just want to print the checkboxes. none will have checks */
    foreach ($arr as $ele) {
      $str .= "<td><input type=\"checkbox\" name=\"$name\" value=\"$ele->id\">";
      $str .= "$ele->value";
      
      if ($i % $num == 0) {
        $str .= "</tr>\n<tr>";
      } else {
        $str .= "</td>\n";
      }
      $i++;
    }
  
  }

  /* tack on a closing tr tag if necessary */
  if ($closingTR == true) {
    $str .= "</tr></table>\n";
  } else {
    $str .= "</table>\n";
  }

  return $str;
}


?>
