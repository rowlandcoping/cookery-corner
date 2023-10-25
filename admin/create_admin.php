<?php session_start();?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/admin/includes/head_admin.php";
require_once($path2);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>Christmas Live Blog Admin</title>

<link rel="stylesheet" type="text/css" href="styles/contact.css" />


<style type="text/css">

body
{

}


</style>

</head>

<body>


<title>Create User</title>
</head>
<body>
<div class="container">
	<div style="width: 40%; margin: 20px auto;">
		<form action="/admin/includes/admincreate_action.php" method="post" enctype="multipart/form-data">
			<h2>Register As User</h2>
			<p>*Username<br><input id="name" type="text" name="name" />
		  <br>*Food Experience Level<br><input id="food_pro" type="text" name="food_pro" />
		  <br><label class=textarea>Profile:</label>
		  <br><textarea name="profile" rows="1" cols="60"></textarea>
		 <br>Profile Pic<input type="file" name="profile_pic" />
			<br>*e-mail<br><input type="text" name="email" />
			<br>*password<br><input type="password" name="password_1" />
			<br>*password confirm<br><input type="password" name="password_2" />
			
			<br><button id="reg_user" type="submit" class="btn" name="reg_user">Register</button> 
			
		</form>
	
<p>* - compulsary field</p>	
<p><a href="/admin/admin.php">Return to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></p>
</div>
