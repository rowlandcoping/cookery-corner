<?php session_start();

 $path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/config.php";
require_once($path);
// Starting session

 
// Destroying session
session_destroy();
echo"You have successfully logged out.  Why not <a href=\"/admin/adminlogin.php\">Log in</a> again?
<p>Or maybe actually the <a href=\"/index.php\">homepage</a> makes more sense actually.</p>";

?>
