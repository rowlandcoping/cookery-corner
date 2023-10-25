<?php set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] ); ?>

<html>

<head>


<title>Cookery Corner - keep the lights on it's a jungle out there</title>
<link rel="canonical" href="https://cookery-corner.co.uk/archive/archivee-mails.php" />
<link rel="stylesheet" type="text/css" href="/styles/css/archive.css" />

</head>

<body bgcolor="#808080">

<table border=0 bgcolor="#EEEEEE" rules=void frame=void cellpadding=0 cellspacing=0>

<tr>
<td background="images/spider.bmp" colspan=100%>
<p align=center><img src="images/Archive.bmp">
</td>
</tr>

<tr><td valign=top width=202>


<?php
$page=0; 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/archive/menunew.php";
require_once($path);
?> 


<td valign=top>

<table border=0>

<tr><td>
<h1><p align=center>How it All Began</h1></p>

<h3><p align=center>Cookery Corner used to be a simple beast, just a little plain text e-mail knocked together in 15 minutes at work when my manager wasn't looking.
<p align=center>Actually, looking at the effort and energy I've expended on this site I can't help but wonder what exactly has become of me.  Perhaps I need to get out more.
<p align=center>And one more thing, cookery fans.  If any of the original lucky Cookery Corner recipients happen to have kept any of this most rare work, please send it to me.
  I've deleted them all.  I know tragic, poor you.

</td></tr>

<tr><td height=80 background="images/spider.bmp" colspan=100%></td></tr>

<tr><td><br><p align=center><a href="120105.php">12/01/05</a><br align=center><a href="120105.php">The groundbreaking original - the Marmite and Philadelphia edition</a></td></tr>
<tr><td><br><p align=center><a href="270406.php">27/04/06</a><br align=center><a href="270406.php">The seismic Pot Noodle Edition</a></td></tr>

</table>


<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/analytics.php";
require_once($path);
?>


</body>

</html>


