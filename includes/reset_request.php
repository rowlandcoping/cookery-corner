<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$newpass ="$path"."/createnew_password.php";
$resetpass = "$path"."/reset_password.php";
$adminlogin = "$path"."/admin/adminlogin.php";

require($config);
require($path . "/mailconfig.php");

if (isset($_POST['reset-request'])) {
	
	$selector=bin2hex(random_bytes(8));
	$token=random_bytes(32);
	$url = "www.cookery-corner.co.uk/createnew_password.php?selector=".$selector."&validator=".bin2hex($token);
	$expires=date("U") + 900;
	$email=$_POST['email'];
	$token_hex = bin2hex($token);
    $hashed_token = password_hash($token_hex, PASSWORD_DEFAULT);
	
	$stmt=$conn->prepare("DELETE FROM password_reset WHERE reset_email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	
	$stmt=$conn->prepare("INSERT INTO password_reset (reset_email, reset_selector, reset_token, reset_expires) VALUES (?,?,?,?)");
	$stmt->bind_param("ssss", $email, $selector, $hashed_token, $expires);
	$stmt->execute();

    try {
        $mail = createMailer();
        $mail->addAddress($email);
        $mail->Subject = "Cookery Corner password reset";
        $mail->Body    = "<p>Follow the link to reset your password- please note the link expires in 30 minutes.</p>"
                       . "<p>If you did not request this e-mail feel free to ignore it.</p>"
                       . '<p><a href="' . $url . '">' . $url . '</a></p>';
        $mail->send();
        $errormess = "Password reset sent to " . $email;
    } catch (Exception $e) {
        $errormess = "Mailer error: " . $mail->ErrorInfo;
    }

    include($resetpass);	
}


