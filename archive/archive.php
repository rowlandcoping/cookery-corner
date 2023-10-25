<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/config.php";
require_once($path);
?>
<head>
<link rel="stylesheet" type="text/css" href="/styles/css/archive.css" />
<link rel="canonical" href="https://cookery-corner.co.uk/archive/archive.php" />
<title>Cookery Corner - keep the lights on it's a jungle out there</title>

</head>

<body bgcolor="#808080">

<table bgcolor="#EEEEEE" border=0 rules=void frame=void cellpadding=0 cellspacing=0>

<tr><td background="images/spider.bmp" colspan=100%>
<p align=center><img src="images/Archive.bmp">
</td>
</tr>

	

<tr><td valign=top width=200>


<?php
$page=0; 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/archive/menunew.php";
require_once($path);
?>

	



<td valign=top>

<table border=0>

<tr><td>
<h1><p align=center>Delve Deep into my Dingy Dungeon of Digestibles</h1></p>

<h3><p align=center>Abandon hope for ye have entered ye archive.  Where I keep yonder stuff, and ye can read it if you like.
<p align=center>Fine, I admit it's not that scary, but you should still abandon hope because you clearly have nothing better to do than visit my dank murky cellar.

</td></tr>

<tr><td height=80 background="iamges/spider.bmp" colspan=100%></td></tr>

<tr><td><br><p align=center>Before you browse, however, take a moment to see <a href="archivee-mails.php">how it all began</a>, mainly because Cookery Corner is having minor content issues (ie there isn't any).  Hey, it's late (again), there's no more JD and I want to go to bed (again).  What would you have done?  Ah, I fear my behaviour is becoming predictable...</td></tr>



<tr><td><br><h2><p align=center>Archive by section:</h2></p></td></tr>


<tr><td><br><p align=center><a href="archivehome.php">Main Feature</a></td></tr>
<tr><td><br><p align=center><a href="archivee-mails.php">Cookery Corner's original e-mail acrchive</a></td></tr>
<tr><td colspan=2 height=50><br></td></tr>
</table>

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/analytics.php";
require_once($path);
?>


</body>

</html>


