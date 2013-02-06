<?php
ini_set('display_errors','Off');
session_start();
//print_r($_SESSION);
$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

if (!isset($_POST['submit'])) { // if page is not submitted to itself echo the form
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

 [ <a href="member.php">back to menu</a> ]
 [ <a href="view_awards.php">view awards</a> ]  
 [ <a href="add_award.php">add new image to the list</a> ]
<table cellpadding="2" border="1" >
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php
 $query = "SELECT id, award_name, image_name FROM awards";
 $res = mysql_query($query,$connect) or die("ERROR::".mysql_error());
 $num_cols = 4;
 $num_awards = mysql_num_rows($res);
 $s = ($num_awards==1) ? "" : "s";
 print "<h3>Make a selection from the list of $num_awards award$s to create a new award for $_SESSION[username]</h3>";

 print "<tr><td colspan=\"$num_cols\">\n";
 print "Award Name:<input type=\"text\" size=\"25\" name=\"Fname\">\n
	<input type=\"submit\" value=\"submit\" name=\"submit\">\n
	[ <a href = \"member.php\">cancel</a> ]";
        //[ <a href=\"add_award.php\">upload new</a> ]";
 print "</td></tr>\n";
 print "<tr>\n";
 while($row = mysql_fetch_assoc($res)){
        ++$cur_img;
        $diff = $cur_img%$num_cols;

	 print "<td valign=\"bottom\">";
         print "<img src = 'awards_assets/$row[image_name]' border = '0' />";
	 $checked = ($cur_img == 1)  ? "checked" : "";
         print "<input type='radio' name='media' value='$row[id]' $checked title='$row[award_name]' />\n";
         print "<br/>$cur_img. <b>$row[award_name]</b>";
         print "</td>\n";

        if($diff == 0)
	    print "</tr><tr>\n";
 }//End of while

      if($diff != 0){
	$blanks = $num_cols - $diff;
       for($ii = 1; $ii <= $blanks; $ii++)
	     print "<td>&nbsp;</td>\n";
       print "</tr>\n";
      }//End of if

 print "</form></table>";
} else {


	$query = "INSERT INTO users_awards (user_id, award_id, award_name, date_achieved)
	          VALUES($_SESSION[userid], $_POST[media], '$_POST[Fname]', CURDATE())";
        $result = mysql_query($query) or die("ERROR::Unable to execute query $query");
     Header("Location: view_awards.php");
}//End of else
?>
</body>
</html>
