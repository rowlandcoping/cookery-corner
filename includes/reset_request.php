<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$newpass ="$path"."/createnew_password.php";
$resetpass = "$path"."/reset_password.php";
$adminlogin = "$path"."/admin/adminlogin.php";

require($config);


if (isset($_POST['reset-request'])){
	
	$selector=bin2hex(random_bytes(8));
	$token=random_bytes(32);
	$url = "www.cookery-corner.co.uk/createnew_password.php?selector=".$selector."&validator=".bin2hex($token);
	$expires=date("U") + 900;
	$email=$_POST['email'];
	$hashed_token = password_hash($token, PASSWORD_DEFAULT);
	
	$stmt=$conn->prepare("DELETE FROM password_reset WHERE reset_email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	
	$stmt=$conn->prepare("INSERT INTO password_reset (reset_email, reset_selector, reset_token, reset_expires) VALUES (?,?,?,?)");
	$stmt->bind_param("ssss", $email, $selector, $hashed_token, $expires);
	$stmt->execute();
	
	$to=$email;
	$subject="Cookery Corner password reset";
	$message ="<p>Follow the link to reset your password- please note the link expires in 30 minutes.</p>";
	$message.="<p>If you did not request this e-mail feel free to ignore it.</p>";
	$message.='<a href="'.$url.'">'.$url.'</a></p>';
	$headers ="From: <noreply@cookery-corner.co.uk>\r\n";
	$headers.="Content-type: text/html\r\n";
	
mail($to, $subject, $message, $headers);

$errormess= "Password reset sent to ".$email;
include($resetpass);

	
	




	
}


