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

<title>Add Category</title>

<link rel="stylesheet" type="text/css" href="/admin/styles/recipe_input.css" />


<style type="text/css">


</style>

</head>

<body>





<div class=container>

<p><b>Add Category</b></p>
<div class=section1>
<form action="/admin/includes/recipecategory_actions.php" method="POST" enctype="multipart/form-data">
<p><label for="form"><span style="color:red">*</span> Enter Category name<br /><input type="text"  name="category" required/>
</p>

<p>Category Description
		  <br /><textarea name="description" rows="1" cols="60"></textarea>
</p>

<p><label for="Submit"><input type="submit" class="button" name="submit" value="Submit" />
</p>

</form>
</div>
<p><a href="/admin/admin.php">Back to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></p>

</div>
</body>
