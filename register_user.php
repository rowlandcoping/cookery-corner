<?php session_start();?>
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
	<head>
	<title>Cookery Corner - Register User</title>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$doctype="$path"."/includes/doctype.php";
$head = "$path"."/includes/head_publicform.php";

require_once($config);
require_once($doctype);
require_once($head);
?>


<?php
if (isset($_SESSION['public'])) {
	header('Location: /index.php');
	exit;
}
?>

<body>
		<form action="/includes/usercreate_action.php" method="post" enctype="multipart/form-data">
<div class="form">
	
<div class="section">
			<h2>Register As User</h2>
			*Signifies compulsary fields.
</div>

<div class="list_section">
	<h3>Essentials:</h3>
	
			<ul class="form">
				<li id="name">*Name</li>
				<li id="inputname"><input id="name" type="text" name="name" /></li>
			</ul>
			
			<ul class="form">
				<li id="exp">*Food title<br>(eg Uncle Sausages)</li>
				<li id="inputexp"><input id="food_pro" type="text" name="food_pro" /></li>
			</ul>
		  
			<ul class="form">
				<li id="email">*e-mail</li>
				
				<li id="inputemail"><input id="realone" autocomplete="new-password" type="text" name="realone" /></li>
			</ul>
			
			<ul class="form">
				<li id="password">*Password</li>
				<li id="inputpassword"><input id="password_1" autocomplete="new-password" type="password" name="password_1" /></li>
			</ul>
			
			<ul class="form">
				<li id="passconf">*Password confirm</li>
				<li id="inputpassconf"><input id="password_2"  autocomplete="new-password" type="password" name="password_2" /></li>
			</ul>
</div>
<label for="If you can read this then please leave this field blank"><input id="email" type="text"  autocomplete="new-password" name="email" size="40"/></label>
<div class="list_section">		  
		  <label><h3>Write a profile:</h3></label>
		  <textarea name="profile" rows="10" cols="50"></textarea>
		 <script>
            CKEDITOR.replace( 'profile');
</script>
		 <ul class="form">
		 <li id="propic"><h3>Profile Pic:</h3></li>
		 <li id="inputpropic"><input id="profile_pic" type="file" name="profile_pic" /></li>
		</ul>	
</div>
<div class="section">			
<p><input type="submit" class="button" name="reg_user" value="Register" /></p> 
</div>			
</div>
</form>
</body>
