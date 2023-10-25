<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";

require_once($config);
if (!isset($_SESSION['loggedin'])) {
	$messaging= "Please log in first to access this page";
	include($loginpath);
	exit();
}
if ($_SESSION['role']!="admin"){
	echo "Hello ";
	if (!isset($_SESSION['loggedin'])) {
	
	echo $_SESSION['name']."!";
}
	echo "<p>You are not authorised to access this section of the site... yet!</p>
<p>Submit some recipes, tickle some tastebuds, who knows one day you too could be like Rowland.</p>

<p><a href=\"/index.php\">Home</a></p>";
exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />


<title>Cookery Corner Publisher Site</title>

<link rel="stylesheet" type="text/css" href="/admin/styles/admin.css" />
</head>
