<?php session_start();?>

<html>
	<head>
	<title>Cookery Corner - User Logout</title>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$doctype="$path"."/includes/doctype.php";
$head = "$path"."/includes/head_publicform.php";

require_once($config);
require_once($doctype);
require_once($head);
// Starting session

 
// Destroying session
session_destroy();
?>
<div class ="section">
<h2>You have successfully logged out.</h2>
<h2>Cookery Corner looks forward to interacting with you at a later date.</h2>
</div>
</html>
<?php exit();?>
