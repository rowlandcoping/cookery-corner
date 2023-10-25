<?php session_start();?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
require_once($head);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>Blog entry page</title>

<link rel="stylesheet" type="text/css" href="styles/contact.css" />


<style type="text/css">

</style>

</head>

<body>

<form action="/admin/includes/blog_actions.php" method="POST" enctype="multipart/form-data">

<p>Bloooggggg</p>


<p>Title</p><input type="text"  name="title" />
<p>Content</p><textarea type="text"  name="content"></textarea></p>
<p>Keywords</p><input type="text"  name="keywords" /></p>
<p><label for="image">Blog Image:</label></p>
<p><input type="file"  name="blog_image"></p>

<p><input type="submit" class="button" name="submit" value="Submit" /></p>

</form>
<p><a href="/admin/admin.php">Back to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></p>
</body>
</html>
