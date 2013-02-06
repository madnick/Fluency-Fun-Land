<?php
ini_set('display_errors','Off');
session_start();
//print_r($_SESSION);
/* Author: Sasha Ivkovic
 * Date: 03/11/2011
 * Usage: List list of award images and their labels with aditional link for del
 */
$onClickDelete= "onClick=\"javascript:return confirm('Are you sure you want to delete this award image from the list?')\"";
$connect = mysql_connect("localhost","tepps","ECn2R8","") or die("Couldn't Connect");
mysql_select_db("tepps") or die ("Couldnt find db");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fluency Fun Land - Award Images</title>
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
  [ <a href="member.php">back to menu</a> ] 
  [ <a href="add_award.php">add new image to the list</a> ] 
  <table cellspacing="1" border="1" align="center">
  <th>&nbsp;</th><th>Award Label</th><th>Award Image</th><td>Del</td>   
<?php
$query = "SELECT a.id, a.award_name, a.image_name
	FROM awards a 
	ORDER BY a.id DESC";

        $user_awards = mysql_query($query) or die("ERROR::Unable to execute query $query");
        while($row = mysql_fetch_assoc($user_awards)){
	++$cnt;
		print "<tr>
			<td>$cnt</td>\n
			<td><img border=\"0\" src = \"awards_assets/$row[image_name]\"/></td>\n
			<td>$row[award_name]</td>\n
			<td><a href=\"del_award_image_entry.php?id=$row[id]&user_id=$_SESSION[userid]\" $onClickDelete>Del</a></td>\n
		       </tr>\n"; 
	}//End of while
        
?>
 </table>
</body>
</html>
